<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Book;
use App\Customer;
use App\Room;

class BookOnsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'checkRoomCapacity']);
    }

    public function index() {
        $room = Room::where('status', '!=', '-1')
                    ->get();

        return view('admin.book-onsite.index', ['room' => $room]);
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('books')
                        ->selectRaw('
                            DATE_FORMAT(books.created_at, "%y%m%d%H%i") as ref, books.id, rooms.name as room,
                            CONCAT(customers.firstname, " ", customers.lastname) as customer,
                            books.adults, books.children, books.infants, books.add_person,
                            books.check_in, books.check_out, books.priceTotal, books.status, books.remarks
                        ')
                        ->join('rooms', 'rooms.id', '=', 'books.room_id')
                        ->join('customers', 'customers.id', '=', 'books.customer_id')
                        ->where('books.status', '!=', '-1')
                        ->where('books.type', '=', 'onsite')
                        ->get();

            foreach($data as $item) {
                $item->pax = $item->adults + ($item->children = null ? 0 : $item->children) + ($item->infants = null ? 0 : $item->infants) + ($item->add_person = null ? 0 : $item->add_person);
            }

            return $data;
        }
        
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get(Request $request, $id) {
        if ($request->ajax()) {
            $data = DB::table('books')
                        ->selectRaw('
                            books.id, rooms.name as room,
                            books.adults, books.children, books.infants, books.add_person, books.check_in, books.check_out,
                            customers.firstname, customers.lastname, customers.address, customers.sex, customers.contact_no, customers.email,
                            books.remarks
                        ')
                        ->join('rooms', 'rooms.id', '=', 'books.room_id')
                        ->join('customers', 'customers.id', '=', 'books.customer_id')
                        ->where('books.id', '=', $id)
                        ->get();

            return $data;
        }
        
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function checkRoomCapacity(Request $request) {
        $roomInfo = Room::whereId($request->room_id)->first();

        return response()->json([
            'adults' => $roomInfo->adults, 
            'children' => $roomInfo->children,
            'infants' => $roomInfo->infants
        ]);
    }

    public function checkRoom(Request $request) {
        $roomInfo = Room::whereId($request->room_id)->first();

        $priceTotal = 0;
        $add_person = $request->add_person * 750;

        $dates = [];
        $date = $request->check_in;
        do {
            array_push($dates, $date);
            $date = date('Y-m-d', strtotime($date. ' + 1 days'));
        } while ($date <= $request->check_out);

        for($i=0; $i<count($dates)-1; $i++) {
            if (date('N', strtotime($dates[$i])) == 5 || date('N', strtotime($dates[$i])) == 6 || date('N', strtotime($dates[$i])) == 7)
                $priceTotal += $roomInfo->price_we;
            else
                $priceTotal += $roomInfo->price_wd;
        }

        $priceTotal += $add_person;

        $totalRoom = Room::whereId($request->room_id)->first();

        $totalActive = Book::where('room_id', '=', $request->room_id)
            ->where('status', '=', 0)
            ->orWhere('status', '=', 1)
            ->orWhere('status', '=', 2)
            ->count();

        if ($totalActive < $totalRoom->no_rooms)
            return response()->json(['status' => 'available', 'price' => $priceTotal]);
        else {
            $check = Book::whereRaw('room_id = '.$request->room_id.' and (check_in <= "'.$request->check_in.'" and check_out >= "'.$request->check_in.'") and (status != -1 or status != 3)')
                    ->count();

            if ($check < $totalRoom->no_rooms)
                return response()->json(['status' => 'available', 'price' => $priceTotal]);
            else
                return response()->json(['status' => 'unavailable', 'price' => 0]);
        }
    }

    public function add(Request $request) {
        try {
            $proceed = false;

            $totalRoom = Room::whereId($request->room_id)->first();

            $totalActive = Book::where('room_id', '=', $request->room_id)
                ->where('status', '=', 0)
                ->where('status', '=', 1)
                ->count();

            if ($totalActive < $totalRoom->no_rooms)
                $proceed = true;
            else {
                $check = Book::where('room_id', '=', $request->room_id)
                        ->where('status', '!=', -1)
                        ->where('status', '!=', 2)
                        ->where('check_in', '<=', $request->check_in)
                        ->where('check_out', '>=', $request->check_in)
                        ->count();

                if ($check > 0)
                    $proceed = true;
                else
                    $proceed = false;
            }

            if ($proceed == true) {
                $roomInfo = Room::whereId($request->room_id)->first();

                $priceTotal = 0;
                $add_person = $request->add_person * 750;

                $dates = [];
                $date = $request->check_in;
                do {
                    array_push($dates, $date);
                    $date = date('Y-m-d', strtotime($date. ' + 1 days'));
                } while ($date <= $request->check_out);

                for($i=0; $i<count($dates)-1; $i++) {
                    if (date('N', strtotime($dates[$i])) == 5 || date('N', strtotime($dates[$i])) == 6 || date('N', strtotime($dates[$i])) == 7)
                        $priceTotal += $roomInfo->price_we;
                    else
                        $priceTotal += $roomInfo->price_wd;
                }

                $customer = Customer::create([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'address' => $request->address,
                    'sex' => $request->sex,
                    'contact_no' => $request->contact_no,
                    'email' => $request->email,
                    'created_by' => Auth::id()
                ]);

                Book::create([
                    'type' => 'onsite',
                    'customer_id' => $customer->id,
                    'room_id' => $request->room_id,
                    'adults' => $request->adults,
                    'children' => $request->children,
                    'infants' => $request->infants,
                    'add_person' => $request->add_person,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'priceTotal' => $priceTotal + $add_person,
                    'status' => 1,
                    'remarks' => $request->remarks,
                    'created_by' => Auth::id()
                ]);
            }

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateStatus($id, $status) {
        try {
            Book::whereId($id)
            ->update(['status' => $status]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function remarksUpdate(Request $request) {
        try {
            Book::whereId($request->remarks_id)
                ->update(['remarks' => $request->remarks_remarks]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

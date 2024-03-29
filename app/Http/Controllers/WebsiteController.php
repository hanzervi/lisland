<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\FoodDrink;
use App\Room;
use App\Pool;
use App\Book;
use App\Customer;
use App\Booker;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('index', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('index', ['data' => $data]);
    }

    public function restoBarView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $fb = FoodDrink::where('status', '!=', -1)
                        ->where('category', '=', 'Filipino Breakfast')
                        ->get();

        $pb = FoodDrink::where('status', '!=', -1)
                        ->where('category', '=', 'Power Breakfast')
                        ->get();

        $ls = FoodDrink::where('status', '!=', -1)
                        ->where('category', '=', "Lislands' Special")
                        ->get();

        $is = FoodDrink::where('status', '!=', -1)
                        ->where('category', '=', "International Specialties")
                        ->get();
        
        $is = FoodDrink::where('status', '!=', -1)
                        ->where('category', '=', "International Specialties")
                        ->get();

        $ds = FoodDrink::where('status', '!=', -1)
                        ->where('category', '=', "Drinks")
                        ->get();

        $data = [
            'room' => $room,
            'fb' => $fb,
            'pb' => $pb,
            'ls' => $ls,
            'is' => $is,
            'ds' => $ds
        ]; 

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('resto-bar', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('resto-bar', ['data' => $data]);
    }

    public function packagesView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('packages', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('packages', ['data' => $data]);
    }

    public function toursView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
            return view('tours', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('tours', ['data' => $data]);
    }

    public function roomView($id) {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $getRoom = Room::find($id);

        $data = [
            'room' => $room,
            'getRoom' => $getRoom
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('room', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('room', ['data' => $data]);
    }

    public function poolView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();
        
        $pool = Pool::get();

        $data = [
            'room' => $room,
            'pool' => $pool
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('pool', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('pool', ['data' => $data]);
    }

    public function ktvView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('ktv', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('ktv', ['data' => $data]);
    }

    public function urdujaView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('urduja', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('urduja', ['data' => $data]);
    }
    
    public function conferenceView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('conference', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('conference', ['data' => $data]);
    }

    public function checkRoom(Request $request) {
        $roomInfo = Room::whereId($request->room_id)->first();

        $priceTotal = 0;

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

        $totalRoom = Room::whereId($request->room_id)->first();

        $totalActive = Book::where('room_id', '=', $request->room_id)
            ->where('status', '=', 0)
            ->orWhere('status', '=', 1)
            ->orWhere('status', '=', 2)
            ->count();

        if ($totalActive < $totalRoom->no_rooms)
            return response()->json(['status' => 'available', 'price' => $priceTotal]);
        else {
            $check = Book::whereRaw('room_id = '.$request->room_id.' and (check_in <= "'.$request->check_in.'" and check_out > "'.$request->check_in.'") and (status != -1 or status != 3)')
                    ->count();

            if ($check < $totalRoom->no_rooms)
                return response()->json(['status' => 'available', 'price' => $priceTotal]);
            else
                return response()->json(['status' => 'unavailable', 'price' => 0]);
        }
    }

    public function addBook(Request $request) {
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

                $booker = Booker::find(Auth::user()->booker_id);
                $customer = Customer::create([
                    'firstname' => $booker->first_name,
                    'lastname' => $booker->last_name,
                    'address' => $booker->address,
                    'sex' => $booker->sex,
                    'contact_no' => $booker->contact,
                    'email' => $booker->email,
                    'created_by' => Auth::user()->id
                ]);

                Book::create([
                    'type' => 'online',
                    'customer_id' => $customer->id,
                    'room_id' => $request->room_id,
                    'adults' => $request->adults,
                    'children' => $request->children,
                    'infants' => $request->infants,
                    'add_person' => null,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'priceTotal' => $priceTotal,
                    'status' => 0,
                    'remarks' => null,
                    'created_by' => Auth::user()->id
                ]);
            }

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function threeD() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id != null)
                return view('3d', ['data' => $data]);
            else
                return redirect()->back();
        }
        return view('3d', ['data' => $data]);
    }

    public function inOut() {
        $data = DB::table('guests')->select('number')->first();

        return view('in-out', ['number' => $data->number]);
    }

    public function inOut_update($number) {
        return DB::table('guests')->update([
            'number' => $number
        ]);
    }
}

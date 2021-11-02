<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Book;
use App\Customer;
use App\Room;

class BookOnlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $room = Room::where('status', '!=', '-1')
                    ->get();

        return view('admin.book-online.index', ['room' => $room]);
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('books')
                        ->selectRaw('
                            books.id, rooms.name as room,
                            CONCAT(customers.firstname, " ", customers.lastname) as customer,
                            books.adults, books.children, books.infants, books.add_person,
                            books.check_in, books.check_out, books.priceTotal, books.status, books.remarks
                        ')
                        ->join('rooms', 'rooms.id', '=', 'books.room_id')
                        ->join('customers', 'customers.id', '=', 'books.customer_id')
                        ->where('books.status', '!=', '-1')
                        ->where('books.type', '=', 'online')
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

    public function countPending() {
        return Book::where('type', '=', 'online')
                    ->where('status', '=', 0)
                    ->count();
    }

    public function updateStatus($id, $status) {
        try {
            // if status = 1 
            // sms and email verification

            Book::whereId($id)
            ->update(['status' => $status]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            $book = Book::whereId($request->update_id)
                        ->first();

            $add = $request->update_add_person - $book->add_person;

            Book::whereId($request->update_id)
                ->update([
                    'adults' => $request->update_adults,
                    'children' => $request->update_children,
                    'infants' => $request->update_infants,
                    'add_person' => $request->update_add_person,
                    'priceTotal' => $book->priceTotal + ($add * 750),
                    'remarks' => $request->update_remarks
                ]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

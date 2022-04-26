<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Book;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $pending = Book::where('status', '=', 0)
                        ->count();

        $reserve = Book::where('status', '=', 1)
                        ->count();

        $checkedin = Book::where('status', '=', 2)
                        ->count();

        $book = DB::table('books')
                        ->selectRaw('
                            books.id, rooms.name as room,
                            books.adults, books.children, books.infants, books.add_person, books.status
                        ')
                        ->join('rooms', 'rooms.id', '=', 'books.room_id')
                        ->where('books.status', '!=', '-1')
                        ->where('books.status', '!=', '3')
                        ->get();

        $thisYear = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->count();

        $tyMonth[0] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '01')
                        ->count();
        $tyMonth[1] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '02')
                        ->count();
        $tyMonth[2] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '03')
                        ->count();
        $tyMonth[3] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '04')
                        ->count();
        $tyMonth[4] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '05')
                        ->count();
        $tyMonth[5] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '06')
                        ->count();
        $tyMonth[6] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '07')
                        ->count();
        $tyMonth[7] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '08')
                        ->count();
        $tyMonth[8] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '09')
                        ->count();
        $tyMonth[9] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '10')
                        ->count();
        $tyMonth[10] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '11')
                        ->count();
        $tyMonth[11] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', '12')
                        ->count();
        
        
        $lastYear = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->count();

        $lyMonth[0] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '01')
                        ->count();
        $lyMonth[1] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '02')
                        ->count();
        $lyMonth[2] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '03')
                        ->count();
        $lyMonth[3] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '04')
                        ->count();
        $lyMonth[4] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '05')
                        ->count();
        $lyMonth[5] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '06')
                        ->count();
        $lyMonth[6] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '07')
                        ->count();
        $lyMonth[7] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '08')
                        ->count();
        $lyMonth[8] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '09')
                        ->count();
        $lyMonth[9] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '10')
                        ->count();
        $lyMonth[10] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '11')
                        ->count();
        $lyMonth[11] = Book::where('status', '!=', -1)
                        ->whereYear('created_at', date('Y')-1)
                        ->whereMonth('created_at', '12')
                        ->count();

        $number = DB::table('guests')->where('status', '=', 1)->count();

        foreach($book as $item) {
                $item->pax = $item->adults + ($item->children = null ? 0 : $item->children) + ($item->infants = null ? 0 : $item->infants) + ($item->add_person = null ? 0 : $item->add_person);
        }
        
        $data = [
            'pending' => $pending,
            'reserve' => $reserve,
            'checkedin' => $checkedin,
            'book' => $book,
            'thisYear' => $thisYear,
            'lastYear' => $lastYear,
            'tyMonth' => $tyMonth,
            'lyMonth' => $lyMonth,
            'number' => $number
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id == null)
                return view('admin.dashboard.index', ['data' => $data]);
            else
                return redirect('/');
        }
    }
}

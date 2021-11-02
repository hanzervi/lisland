<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FoodDrink;
use App\Room;
use App\Pool;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

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

        return view('resto-bar', ['data' => $data]);
    }

    public function packagesView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        return view('packages', ['data' => $data]);
    }

    public function toursView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

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

        return view('pool', ['data' => $data]);
    }

    public function ktvView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        return view('ktv', ['data' => $data]);
    }

    public function urdujaView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        return view('urduja', ['data' => $data]);
    }
    
    public function conferenceView() {
        $room = Room::where('status', '!=', -1)
                    ->orderBy('price_wd', 'desc')
                    ->get();

        $data = [
            'room' => $room
        ];

        return view('conference', ['data' => $data]);
    }
}

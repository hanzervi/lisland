<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Guest;

class InOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $child = Guest::whereRaw('(TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) > -1 AND TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) < 13) AND status = 1')->count();
        $adult = Guest::whereRaw('(TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) > 12 AND TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) < 60) AND status = 1')->count();
        $senior = Guest::whereRaw('(TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) > 59) AND status = 1')->count();

        $data = [
            'child' => $child,
            'adult' => $adult,
            'senior' => $senior
        ];

        if (Auth::check()) {
            if (Auth::user()->booker_id == null)
                return view('admin.in-and-out.index', ['data' => $data]);
            else
                return redirect('/');
        }
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return Guest::where('status', '=', '1')
                    ->orderBy('id', 'desc')
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function add(Request $request) {
        try {
            $input = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'birthdate' => $request->birthdate,
                'contact' => $request->contact,
                'email' => $request->email,
                'status' => 1,
                'created_by' => Auth::id()
            ];

            Guest::create($input);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function out($id) {
        $status = Guest::whereId($id)
            ->update(['status' => '0']);

        if ($status)
            return 'success';
        
        return 'error';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        if (Auth::check()) {
            if (Auth::user()->booker_id == null)
                return view('admin.customer.index');
            else
                return redirect('/');
        }
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return Customer::orderBy('id', 'desc')->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }
}

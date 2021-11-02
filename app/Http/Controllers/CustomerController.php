<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.customer.index');
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return Customer::orderBy('id', 'desc')->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }
}

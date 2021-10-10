<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

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
            return Customer::where('status', '!=', '-1')
                    ->get();
        }
        
        return response()->json(['error' => 'Unauthorized.'], 401);
    }
}

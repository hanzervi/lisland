<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;
use Auth;

use App\User;
use App\Booker;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'add']);
    }

    public function index() {
        if (Auth::check()) {
            if (Auth::user()->booker_id == null) {
                if (Auth::id() == 1) {
                    return view('admin.users.index');
                }
                return response()->json(['error' => 'Unauthorized.'], 401);
            }
            else
                return redirect('/');
        }
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return User::where('status', '!=', '-1')
                    ->where('id', '!=', '1')
                    ->where('booker_id', '=', null)
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get(Request $request, $id) {
        if ($request->ajax()) {
            if (Auth::user()->booker_id == null)
                return User::whereId($id)->get();
            else {
                $booker = Booker::whereId(Auth::user()->booker_id)->first();
                
                $user = User::whereId($id)->get();

                foreach($user as $item) {
                    $item->first_name = $booker->first_name;
                    $item->last_name = $booker->last_name;
                    $item->address = $booker->address;
                    $item->sex = $booker->sex;
                    $item->contact = $booker->contact;
                    $item->email = $booker->email;
                }

                return $user;
            }
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    function add(Request $request) {
        $result = null;
        if ($request->password == $request->confirmPw) {
            DB::transaction(function() use($request, &$result){ 
                $validator = Validator::make($request->all(), [
                    'username' => ['required', 'unique:users,username']
                ]);

                if ($validator->passes()) {
                    if (Auth::check()) {
                        $input = [
                            'name' => $request->name,
                            'username' => $request->username,
                            'password' => Hash::make($request->password),
                            'status' => 1,
                            'created_by' => Auth::id()
                        ];
    
                        User::create($input);
                        $result = 'success';
                    }
                    else {
                        $booker = Booker::create([
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'address' => $request->address,
                            'sex' => $request->sex,
                            'contact' => $request->contact,
                            'email' => $request->email
                        ]);

                        $input = [
                            'name' => $booker->first_name . " " . $booker->last_name,
                            'username' => $request->username,
                            'password' => Hash::make($request->password),
                            'status' => 1,
                            'booker_id' => $booker->id
                        ];
    
                        User::create($input);
                        $result = 'success';
                    }
                }
                else
                    $result = 'username_error';
            });

            try {
                DB::commit();
                return response($result);
            }
            catch(\Exception $e) {
                DB::rollback();
                return response($e->getMessage());
            }

        }
        else {
            $result = 'password_error';
            return response($result);
        }
    }

    function remove($id) {
        $status = User::whereId($id)
            ->update(['status' => '-1']);

        if ($status)
            return 'success';
        
        return 'error';
    }

    function update(Request $request) {
        $result = null;
        DB::transaction(function() use($request, &$result) {
        $user = User::find($request->update_id);

        if ($user->username != $request->update_username) {
                $validator = Validator::make($request->all(), [
                    'update_username' => ['required', 'unique:users,username']
                ]);
                if ($validator->passes()) {

                    if (Auth::user()->booker_id == null) {
                        if ($request->update_password != '') {
                            User::where('id', '=', $request->update_id)
                                ->update([
                                            'name' => $request->update_name, 
                                            'username' => $request->update_username, 
                                            'password' => Hash::make($request->update_password)
                                        ]);
                        }
                        else {
                            User::where('id', '=', $request->update_id)
                                ->update([
                                            'name' => $request->update_name, 
                                            'username' => $request->update_username
                                        ]);
                        }
                    }
                    else {
                        if ($request->update_password != '') {
                            User::where('id', '=', $request->update_id)
                                ->update([
                                            'name' => $request->update_firstname . " " . $request->update_lastname, 
                                            'username' => $request->update_username, 
                                            'password' => Hash::make($request->update_password)
                                        ]);
                        }
                        else {
                            User::where('id', '=', $request->update_id)
                                ->update([
                                            'name' => $request->update_firstname . " " . $request->update_lastname, 
                                            'username' => $request->update_username
                                        ]);
                        }

                        Booker::whereId(Auth::user()->booker_id)
                                ->update([
                                    'first_name' => $request->update_firstname,
                                    'last_name' => $request->update_lastname,
                                    'address' => $request->update_address,
                                    'sex' => $request->update_sex,
                                    'contact' => $request->update_contact,
                                    'email' => $request->update_email
                                ]);
                    }

                    $result = 'success';
                }
                else
                    $result = 'username_error';
        }
        else {
            
            if (Auth::user()->booker_id == null) {
                if ($request->update_password != '') {
                    User::where('id', '=', $request->update_id)
                        ->update([
                                    'name' => $request->update_name, 
                                    'password' => Hash::make($request->update_password)
                                ]);
                }
                else {
                    User::where('id', '=', $request->update_id)
                        ->update([
                                    'name' => $request->update_name, 
                                ]);
                }
            }
            else {
                if ($request->update_password != '') {
                    User::where('id', '=', $request->update_id)
                        ->update([
                                    'name' => $request->update_firstname . " " . $request->update_lastname, 
                                    'password' => Hash::make($request->update_password)
                                ]);
                }
                else {
                    User::where('id', '=', $request->update_id)
                        ->update([
                                    'name' => $request->update_firstname . " " . $request->update_lastname, 
                                ]);
                }

                Booker::whereId(Auth::user()->booker_id)
                        ->update([
                            'first_name' => $request->update_firstname,
                            'last_name' => $request->update_lastname,
                            'address' => $request->update_address,
                            'sex' => $request->update_sex,
                            'contact' => $request->update_contact,
                            'email' => $request->update_email
                        ]);
            }

            $result = 'success';
        }
        });
        try {
            DB::commit();
            return response($result);
        }
        catch(\Exception $e) {
            DB::rollback();
            return response($e->getMessage());
        }
    }

    function profile(Request $request) {
        $result = null;
        DB::transaction(function() use($request, &$result) {
        $user = User::find($request->profile_id);

        if ($user->username != $request->profile_username) {
                $validator = Validator::make($request->all(), [
                    'profile_username' => ['required', 'unique:users,username']
                ]);
                if ($validator->passes()) {

                    if ($request->profile_password != '') {
                        User::where('id', '=', $request->profile_id)
                            ->update([
                                        'name' => $request->profile_name, 
                                        'username' => $request->profile_username, 
                                        'password' => Hash::make($request->profile_password)
                                    ]);
                    }
                    else {
                        User::where('id', '=', $request->profile_id)
                            ->update([
                                        'name' => $request->profile_name, 
                                        'username' => $request->profile_username
                                    ]);
                    }

                    $result = 'success';
                }
                else
                    $result = 'username_error';
        }
        else {
            if ($request->profile_password != '') {
                User::where('id', '=', $request->profile_id)
                    ->update([
                                'name' => $request->profile_name, 
                                'password' => Hash::make($request->profile_password)
                            ]);
            }
            else {
                User::where('id', '=', $request->profile_id)
                    ->update([
                                'name' => $request->profile_name, 
                            ]);
            }

            $result = 'success';
        }
        });
        try {
            DB::commit();
            return response($result);
        }
        catch(\Exception $e) {
            DB::rollback();
            return response($e->getMessage());
        }
    }

    public function bin() {
        if (Auth::check()) {
            if (Auth::user()->booker_id == null) {
                if (Auth::id() == 1) {
                    return view('admin.users.bin');
                }
                return response()->json(['error' => 'Unauthorized.'], 401);
            }
            else
                return redirect('/');
        }
    }

    public function binTable(Request $request) {
        if ($request->ajax()) {
            return User::where('status', '=', '-1')
                    ->where('id', '!=', '1')
                    ->where('booker_id', '=', null)
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    function restore($id) {
        $status = User::whereId($id)
            ->update(['status' => '1']);

        if ($status)
            return 'success';
        
        return 'error';
    }
}

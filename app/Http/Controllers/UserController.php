<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;
use Auth;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        if (Auth::id() == 1) {
            return view('admin.users.index');
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return User::where('status', '!=', '-1')
                    ->where('id', '!=', '1')
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get(Request $request, $id) {
        if ($request->ajax()) {
            return User::whereId($id)->get();
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

                    $result = 'success';
                }
                else
                    $result = 'username_error';
        }
        else {
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
        return view('admin.users.bin');
    }

    public function binTable(Request $request) {
        if ($request->ajax()) {
            return User::where('status', '=', '-1')
                    ->where('id', '!=', '1')
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

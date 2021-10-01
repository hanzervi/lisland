<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;
use Auth;

use App\User;

class UserAccounts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.user-accounts.index');
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return User::where('status', '!=', '-1')
                    ->where('id', '!=', '1')
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get($id) {
        return User::whereId($id)->get();
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
}

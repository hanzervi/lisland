<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Pool;

class PoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.pool.index');
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return Pool::where('status', '!=', '-1')
                    ->get();
        }
        
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get(Request $request, $id) {
        if ($request->ajax()) {
            return Pool::whereId($id)->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function add(Request $request) {
        try {
            $images = $request->file('images');
            $arrImg = [];
            if($request->hasFile('images')) {
                foreach ($images as $image) {
                    $full_file = $image->getClientOriginalName();
                    $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                    $ext_file = $image->getClientOriginalExtension();
                    $file_name = $name_file.'_'.time().'_.'.$ext_file;
                    $path = $image->storeAs('public/pool', $file_name);
                    $arrImg[] = $file_name;
                }
            }

            $image360 = null;
            if ($request->hasFile('image360')) {
                $full_file = $request->file('image360')->getClientOriginalName();
                $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                $ext_file = $request->file('image360')->getClientOriginalExtension();
                $file_name = '360-'.$name_file.'_'.time().'_.'.$ext_file;
                $path = $request->file('image360')->storeAs('public/pool', $file_name);
                $image360 = $file_name;
            }

            $input = [
                'name' => $request->name,
                'description' => $request->description,
                'images' => json_encode($arrImg),
                'image360' => $image360,
                'status' => 1,
                'created_by' => Auth::id()
            ];

            Pool::create($input);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            
            $dataImages = Pool::whereId($request->update_id)->first();
            $arrImg = json_decode($dataImages->images);

            $images = $request->file('update_images');
            if($request->hasFile('update_images')) {
                $arrImg = [];
                foreach ($images as $image) {
                    $full_file = $image->getClientOriginalName();
                    $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                    $ext_file = $image->getClientOriginalExtension();
                    $file_name = $name_file.'_'.time().'_.'.$ext_file;
                    $path = $image->storeAs('public/pool', $file_name);
                    $arrImg[] = $file_name;
                }
            }

            $dataImage360 = Pool::whereId($request->update_id)->first();
            $image360 = $dataImage360->image360;

            if ($request->hasFile('update_image360')) {
                $full_file = $request->file('update_image360')->getClientOriginalName();
                $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                $ext_file = $request->file('update_image360')->getClientOriginalExtension();
                $file_name = '360-'.$name_file.'_'.time().'_.'.$ext_file;
                $path = $request->file('update_image360')->storeAs('public/pool', $file_name);
                $image360 = $file_name;
            }

            $input = [
                'name' => $request->update_name,
                'description' => $request->update_description,
                'images' => json_encode($arrImg),
                'image360' => $image360
            ];

            Pool::whereId($request->update_id)
                ->update($input);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function bin() {
        if (Auth::id() == 1) {
            return view('admin.pool.bin');
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function binTable(Request $request) {
        if ($request->ajax()) {
            return Pool::where('status', '=', '-1')
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    function restore($id) {
        $status = Pool::whereId($id)
            ->update(['status' => '1']);

        if ($status)
            return 'success';
        
        return 'error';
    }

    function removeP($id) {
        $status = Pool::whereId($id)
            ->delete();

        if ($status)
            return 'success';
        
        return 'error';
    }
    
    function remove($id) {
        $status = Pool::whereId($id)
            ->update(['status' => '-1']);

        if ($status)
            return 'success';
        
        return 'error';
    }
}

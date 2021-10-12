<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Room;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.room.index');
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return Room::where('status', '!=', '-1')
                    ->get();
        }
        
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get(Request $request, $id) {
        if ($request->ajax()) {
            return Room::whereId($id)->get();
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
                    $path = $image->storeAs('public/room', $file_name);
                    $arrImg[] = $file_name;
                }
            }

            $image360 = null;
            if ($request->hasFile('image360')) {
                $full_file = $request->file('image360')->getClientOriginalName();
                $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                $ext_file = $request->file('image360')->getClientOriginalExtension();
                $file_name = '360-'.$name_file.'_'.time().'_.'.$ext_file;
                $path = $request->file('image360')->storeAs('public/room', $file_name);
                $image360 = $file_name;
            }

            $input = [
                'name' => $request->name,
                'description' => $request->description,
                'price_wd' => $request->price_wd,
                'price_we' => $request->price_we,
                'adults' => $request->adults,
                'children' => $request->children,
                'infants' => $request->infants,
                'includes' => $request->includes,
                'images' => json_encode($arrImg),
                'image360' => $image360,
                'status' => 1,
                'created_by' => Auth::id()
            ];

            Room::create($input);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            
            $dataImages = Room::whereId($request->update_id)->first();
            $arrImg = json_decode($dataImages->images);

            $images = $request->file('update_images');
            if($request->hasFile('update_images')) {
                $arrImg = [];
                foreach ($images as $image) {
                    $full_file = $image->getClientOriginalName();
                    $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                    $ext_file = $image->getClientOriginalExtension();
                    $file_name = $name_file.'_'.time().'_.'.$ext_file;
                    $path = $image->storeAs('public/room', $file_name);
                    $arrImg[] = $file_name;
                }
            }

            $dataImage360 = Room::whereId($request->update_id)->first();
            $image360 = $dataImage360->image360;

            if ($request->hasFile('update_image360')) {
                $full_file = $request->file('update_image360')->getClientOriginalName();
                $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                $ext_file = $request->file('update_image360')->getClientOriginalExtension();
                $file_name = '360-'.$name_file.'_'.time().'_.'.$ext_file;
                $path = $request->file('update_image360')->storeAs('public/room', $file_name);
                $image360 = $file_name;
            }

            $input = [
                'name' => $request->update_name,
                'description' => $request->update_description,
                'price_wd' => $request->update_price_wd,
                'price_we' => $request->update_price_we,
                'adults' => $request->update_adults,
                'children' => $request->update_children,
                'infants' => $request->update_infants,
                'includes' => $request->update_includes,
                'images' => json_encode($arrImg),
                'image360' => $image360
            ];

            Room::whereId($request->update_id)
                ->update($input);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function remove($id) {
        $status = Room::whereId($id)
            ->update(['status' => '-1']);

        if ($status)
            return 'success';
        
        return 'error';
    }

    public function bin() {
        if (Auth::id() == 1) {
            return view('admin.room.bin');
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function binTable(Request $request) {
        if ($request->ajax()) {
            return Room::where('status', '=', '-1')
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    function restore($id) {
        $status = Room::whereId($id)
            ->update(['status' => '1']);

        if ($status)
            return 'success';
        
        return 'error';
    }

    function removeP($id) {
        $status = Room::whereId($id)
            ->delete();

        if ($status)
            return 'success';
        
        return 'error';
    }

    function image360($id) {
        $image360 = Room::whereId($id)->first();

        return view('admin.room.image360', ['data' => $image360->image360]);
    }
}

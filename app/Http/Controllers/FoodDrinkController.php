<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\FoodDrink;

class FoodDrinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $category = [
            'Filipino Breakfast',
            'Power Breakfast',
            'Lislands\' Special',
            'International Specialties',
            'Drinks'
        ];
        
        return view('admin.food-drink.index', ['category' => $category]);
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            return FoodDrink::where('status', '!=', '-1')
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get(Request $request, $id) {
        if ($request->ajax()) {
            return FoodDrink::whereId($id)->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function add(Request $request) {
        try {
            $image = 'noimage.png';
            if ($request->hasFile('food-image')) {
                $full_file = $request->file('food-image')->getClientOriginalName();
                $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                $ext_file = $request->file('food-image')->getClientOriginalExtension();
                $file_name = $name_file.'_'.time().'_.'.$ext_file;
                $path = $request->file('food-image')->storeAs('public/fooddrink', $file_name);
                $image = $file_name;
            }

            $input = [
                'image' => $image,
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'price' => $request->price,
                'status' => 1,
                'created_by' => Auth::id()
            ];

            FoodDrink::create($input);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            $data = FoodDrink::whereId($request->update_id)
                            ->get();

            $image = $data[0]->image;
            if ($request->hasFile('update_food-image')) {
                $full_file = $request->file('update_food-image')->getClientOriginalName();
                $name_file = pathinfo($full_file, PATHINFO_FILENAME);
                $ext_file = $request->file('update_food-image')->getClientOriginalExtension();
                $file_name = $name_file.'_'.time().'_.'.$ext_file;
                $path = $request->file('update_food-image')->storeAs('public/fooddrink', $file_name);
                $image = $file_name;
            }

            FoodDrink::whereId($request->update_id)
                    ->update([
                        'image' => $image,
                        'name' => $request->update_name,
                        'description' => $request->update_description,
                        'category' => $request->update_category,
                        'price' => $request->update_price,
                    ]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function remove($id) {
        $status = FoodDrink::whereId($id)
            ->update(['status' => '-1']);

        if ($status)
            return 'success';
        
        return 'error';
    }

    public function bin() {
        if (Auth::id() == 1) {
            return view('admin.food-drink.bin');
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function binTable(Request $request) {
        if ($request->ajax()) {
            return FoodDrink::where('status', '=', '-1')
                    ->get();
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    function restore($id) {
        $status = FoodDrink::whereId($id)
            ->update(['status' => '1']);

        if ($status)
            return 'success';
        
        return 'error';
    }

    function removeP($id) {
        $status = FoodDrink::whereId($id)
            ->delete();

        if ($status)
            return 'success';
        
        return 'error';
    }
}

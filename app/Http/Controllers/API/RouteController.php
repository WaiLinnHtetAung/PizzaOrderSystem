<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //product lit
    public function productList() {
        $products = Product::all();
        $users = User::all();


        $data = ['products' => $products, 'users' => $users];

        return response()->json($data,200);
    }

    public function productCategory() {
        $categories = Category::all();

        return response()->json($categories, 200);
    }

    public function productOrderList() {
        $orderLists = OrderList::all();

        return response()->json($orderLists,200);
    }

    public function categoryCreate(Request $request) {
        $data = Category::create(['name' => $request->name]);

        return response()->json($data,200);
    }

    public function contactCreate(Request $request) {

        $data = Contact::create($request->all());

        return response()->json($data, 200);
    }

    //delete category
    public function categoryDelete(Request $request) {
        $data = Category::where('id', $request->category_id)->first();

        if(isset($data)) {
            $delData = Category::where('id', $request->category_id)->delete();

            return response()->json(['status' => 'true', 'message' => 'delete success'], 200);
        }

        return response()->json(['messsage' => 'This category is not in the database', 'status' => 'false'],200);
    }

    //category detail
    public function categoryDetail($id) {
        $categoryDetail = Category::where('id', $id)->first();

        if(isset($categoryDetail)) {
            return response()->json(['status' => true, $categoryDetail, 200]);
        } else {
            return response()->json(['status' => false, 'message' => 'There is no category'], 500);
        }
    }

    //category update
    public function categoryUpdate(Request $request) {
        $dbSource = Category::where('id', $request->category_id)->first();

        $data = [
            'name' => $request->category_name,
        ];

        if(isset($dbSource)) {
            Category::where('id', $request->category_id)->update($data);
            $response = Category::where('id', $request->category_id)->first();

            return response()->json(['staus' => true, $response], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'There is no category'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // --------------products list----------------
    public function list() {

        $products = Product::when(request('search_product'), function($query) {
                            $key = request('search_product');
                            $query->where('name', 'like', "%$key%");
                            })
                            ->orderBy('id', 'desc')
                            ->paginate(4);

        $products->appends(request()->all());

        return view('admin.products.list', compact('products'));
    }

    // ----------------product createPage------------
    public function createPage() {
        $categories = Category::select('id','name')->get();
        return view('admin.products.create', compact('categories'));
    }

    // -----------------product create---------------
    public function create(Request $request) {

        $this->productValidationCheck($request);
        $data = $this->getProductData($request);

        $fileName = uniqid() . $request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->storeAs('public',$fileName);

        $data['image'] = $fileName;
        Product::create($data);


        return redirect()->route('products#list')->with(['createdProduct' => 'New product is created successfully.']);
    }

    // ----------------------delete product----------------------
    public function delete($id) {
        Product::where('id', $id)->delete();

        return redirect()->route('products#list')->with(['deletedProduct' => 'Deleted Successfully.']);
    }

    // --------------------Detail product----------------------
    public function detail($id) {
        $product = Product::where('id', $id)->first();

        return view('admin.products.detail', compact('product'));
    }










    // ============Private Function===========

    // -----------product validation check ----------------
    private function productValidationCheck($request) {
        Validator::make($request->all(), [
            'productName' => 'required | unique:products,name',
            'productCategory' => 'required',
            'productDescription' => 'required',
            'productWaitingTime' => 'required',
            'productPrice' => 'required',
            'productImage' => 'required | file | image',
        ])->validate();
    }

    // -------------get product data---------------
    private function getProductData($request) {
        return [
            'name' => $request->productName,
            'category_id' => $request->productCategory,
            'description' => $request->productDescription,
            'waiting_time' => $request->productWaitingTime,
            'price' => $request->productPrice,
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list page
    public function list() {
        $categories = Category::when(request('search_category'), function($query) {
                                $key = request('search_category');
                                $query->where('name', 'like', "%$key%");
                            })

                            ->orderBy('category_id', 'desc')->paginate(5);

        return view('admin.category.list', compact('categories'));
    }

    //category create page
    public function createPage() {
        return view('admin.category.create');
    }

    //create category
    public function create( Request $request) {
        $this->categoryValidationCheck($request);

        $data = $this->requestCategoryData($request);

        Category::create($data);

        return redirect()->route('category#list')->with(['createSuccess' => 'Created category successfully...']);
    }

    //delete category
    public function delete($id) {
        Category::where('category_id', $id)->delete();

        return back()->with(['deleteSuccess' => 'Deleted category successfully!']);
    }




    // ===========Private functions===============

    //category validation
    private function categoryValidationCheck($request) {
        Validator::make($request->all(), [
            'categoryName' => 'required | unique:categories,name'
        ])->validate();
    }

    //request category data
    private function requestCategoryData($request) {
        return [
            'name' => $request->categoryName
        ];
    }
}

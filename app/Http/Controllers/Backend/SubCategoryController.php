<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = SubCategory::with('category')->orderBy('order_by')->get();
        return view('backend.modules.sub-category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        // dd($categories);
        return view ('backend.modules.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:sub_categories',
            'category_id'=>'required',
            'order_by'=>'required|numeric',
            'status'=>'required',
        ]);


        $sub_category_data = $request->all();
        $sub_category_data['slug'] = Str::slug($request->input('slug'));
        SubCategory::create($sub_category_data);

        // flash message
        session()->flash('cls','success');
        session()->flash('msg', 'Sub Category Created Successfully');
        return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        $subCategory->load('category');
        return view('backend.modules.sub-category.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::pluck('name', 'id')->all();
        // dd($categories);
        return view ('backend.modules.sub-category.edit', compact('categories', 'subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'slug'=>'required|max:255|min:5|unique:sub_categories,slug,'.$subCategory->id,
            'category_id'=>'required',
            'order_by'=>'required|numeric',
            'status'=>'required',
        ]);


        $subCategory_data = $request->all();
        $subCategory_data['slug'] = Str::slug($request->input('slug'));
        $subCategory->update($subCategory_data);

        // flash message
        session()->flash('cls','success');
        session()->flash('msg', 'Sub Category Updated Successfully');
        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        session()->flash('msg', 'Sub Category Deleted Successfully');
        session()->flash('cls', 'error');
        return redirect()->route('sub-category.index');
    }

    public function getSubCategoryByCategoryId(int $id)
    {

        $sub_categories = SubCategory::select('id','name')->where('status', 1)->where('category_id', $id)->get();
        return response()->json($sub_categories);
    }


}

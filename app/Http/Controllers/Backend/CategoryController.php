<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('order_by')->latest()->paginate(5);
        return view('backend.modules.category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:categories',
            'order_by'=>'required|numeric',
            'status'=>'required',
        ]);


        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug'));
        Category::create($category_data);

        // flash message
        session()->flash('cls','success');
        session()->flash('msg', 'Category Created Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        return view('backend.modules.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.modules.category.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'slug'=>'required|max:255|min:5|unique:categories,slug,'.$category->id,
            'order_by'=>'required|numeric',
            'status'=>'required',
        ]);


        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug'));
        $category->update($category_data);

        // flash message
        session()->flash('cls','success');
        session()->flash('msg', 'Category Updated Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('msg', 'Category Deleted Successfully');
        session()->flash('cls', 'error');
        return redirect()->route('category.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{   
    //index
   public function index(Request $request) 
   {
        $categories = DB::table('categories')->when($request->keyword, function($query) use ($request){
            $query->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('description', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.categories.index', compact('categories'));
   }
   //create
   public function create() 
   {
        return view('pages.categories.create');
   }
   //store
   public function store(Request $request) 
   {
        $request->validate([
            'name' => 'required|unique:categories|min:3',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
   }
   //edit
   public function edit(Category $category) 
   {
        return view('pages.categories.edit', compact('category'));
   }
   //update
   public function update(Request $request, $id) 
   {
        $request->validate([
            'name' => 'required|unique:categories|min:3',
        ]);
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
   }
   //destroy
   public function destroy($id) 
   {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
   }
}

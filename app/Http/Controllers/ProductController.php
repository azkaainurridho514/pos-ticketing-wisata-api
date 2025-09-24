<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::when($request->keyword, function($query) use ($request){
            $query->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('description', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.products.index', compact('products'));
    }
    //create
    public function create(){
        $categories = DB::table('categories')->get();
        return view('pages.products.create', compact('categories'));
    }
    //store
    public function store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'criteria' => 'required',
            'favorite' => 'required',
            'status' => 'required',
            'stock' => 'required',
        ]);
        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->criteria = $request->criteria;
        $product->favorite = $request->favorite;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $file = $request->file('image');
        $imageName = time().'.'.$file->extension();
        $file->move('storage/products', $imageName);
        $product->image = $imageName;
        $product->save();
        
        return redirect()->route('products.index')->with('success', 'Product created successfully.');   
    }
    //edit
    public function edit(Product $product){
        $categories = DB::table('categories')->get();
        return view('pages.products.edit', compact('product', 'categories'));
    }
    //update
    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'criteria' => 'required',
            'favorite' => 'required',
            'status' => 'required',
        ]);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->criteria = $request->criteria;
        $product->favorite = $request->favorite;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    //destroy
    public function destroy($id){
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

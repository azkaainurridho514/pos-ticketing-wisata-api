<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //index
    public function index(Request $request){
        $products = Product::with('category')->when($request->status, function($query) use ($request){
            $query->where('status', 'like', "%{$request->status}%");
        })->orderBy('favorite', 'desc')->get();
        if(!$products){
            return response()->json(['status' => 'success', 'message' => "data not found",  'data' => []], 400);
        }
        return response()->json(['status' => 'success', 'message' => "get all products", 'data' => $products], 200);
    }
    //store
    public function store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
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
        if($request->file('image')){
            $image = $request->file('image');
            $imageName =  Auth::user()->id . '_' . time() .'.'.$image->extension();
            $image->move('storage/products', $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return response()->json(['status' => 'success', 'message' => "product created"], 200);
    }

    //show
    public function show($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status' => 'success', 'message' => "data not found",  'data' => []], 400);
        }
        return response()->json(['status' => 'success', 'message' => "detail product", 'data' => $product], 200);
    }
    //update
    public function update(Request $request, $id){

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'criteria' => 'required',
            'favorite' => 'required',
            'status' => 'required',
            'stock' => 'required',
            'image' => 'required',
        ]);
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status' => 'success', 'message' => "data not found", 'data' => []], 400);
        }
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->criteria = $request->criteria;
        $product->favorite = $request->favorite;
        $product->status = $request->status;
        $product->stock = $request->stock;
        if($request->file('image')){
            $file = $request->file('image');
            //replace image sebelum nya
            $imageName = time().'.'.$file->extension();
            $file->move('storage/products', $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return response()->json(['status' => 'success', 'message' => "product updated"], 200);
    }
    //destroy
    public function destroy($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status' => 'success', 'message' => "data not found",  'data' => []], 400);
        }
        $product->delete();
        return response()->json(['status' => 'success', 'message' => "product deleted"], 200);
    }
}

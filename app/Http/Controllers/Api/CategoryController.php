<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //index
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        if(!$categories){
            return response()->json(['status' => 'Data not found', 'data' => ''], 400);
        }
        return response()->json(['status' => 'success', 'data' => $categories], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories =  Category::all();
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }


    public function getCategoryById($id)
    {
        $category = Category::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }
}

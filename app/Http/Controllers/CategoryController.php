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

    public function addCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failure',
                'message' => $validator->errors()->first()
            ]);
        }

        $category = new Category();
        $category->name = $request->name;
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/category'), $imageName);
        $imageFullPath = 'images/category/' . $imageName;
        $category->image = $imageFullPath;

        $category->save();
        return response()->json([
            'status' => 'success',
            'message' => 'category updated successfully'
        ]);
    }

    public function updateCategory(Request $request)
    {
        $category = Category::find($request->id);
        if ($request->has('name')) {
            $category->name = $request->name;
        }
        if ($request->has('image')) {

            //check for previous image
            if ($category->image) {
                $imagePath = public_path($category->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category'), $imageName);
            $imageFullPath = 'images/category/' . $imageName;
            $category->image = $imageFullPath;
        }

        $category->save();
        return response()->json([
            'status' => 'success',
            'message' => 'category updated successfully'
        ]);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            $imagePath = public_path($category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'category deleted successfully'
        ]);
    }
}

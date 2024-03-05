<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function addCategory(CategoryRequest $request)
    {
        $data = $request->all();
        $imagePath = $request->file('image')->store('category_image', 'public');
        $data['image'] = $imagePath;
        $category = Category::create($data);
        return response()->json('YOUR CATEGORY ADDED SUCSESFULY');
    }

    function editCategory(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $imagePath = $request->file('image')->store('category_image', 'public');
        $data['image'] = $imagePath;
        $category = Category::findorfail($id);
        $category->update(
            $data
        );
        return response()->json('YOUR CATEGORY EDITED SUCSESFULY');
    }

    function deleteCategory($id)
    {
        $category = Category::destroy($id);
        return response()->json('YOUR CATEGORY DELETED SUCSESFULY');
    }

    function showCategoryById($id)
    {
        $category = Category::findorfail($id);
        $books = Book::where('category_id', $id)->get();
        return response()->json($category);
    }

    function showAllCategories()
    {
        $categories = Category::get();
        return response()->json($categories);
    }
}

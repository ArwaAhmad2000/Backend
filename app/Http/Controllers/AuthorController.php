<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function addAuthor(AuthorRequest $request)
    {
        $data = $request->all();
        $imagePath = $request->file('image')->store('author_image', 'public');
        $data['image'] = $imagePath;
        $authors = Author::create($data);
        return response()->json('YOUR DATA ADDED SUCSESFULY');
    }

    function editAuthor(AuthorRequest $request, $id)
    {
        $data = $request->all();
        $imagePath = $request->file('image')->store('author_image', 'public');
        $data['image'] = $imagePath;
        $author = Author::findorfail($id);
        $author->update(
            $data
        );
        return response()->json('YOUR DATA EDITED SUCSESFULY');
    }

    function deleteAuthor($id)
    {
        $author = Author::destroy($id);
        return response()->json('YOUR DATA DELETED SUCSESFULY');
    }

    function showAuthorById($id)
    {
        $author = Author::findorfail($id);
        return response()->json($author);
    }

    function showAllAuthors()
    {
        $authors = Author::get();
        return response()->json($authors);
    }
}

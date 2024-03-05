<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    function addBook(BookRequest $request)
    {
        $data = $request->all();
        $book = new Book();
        $book->image = $request->file('image')->store('book_image', 'public');
        $book->book = $request->file('book')->store('book', 'public');
        $book->title = $request->title;
        $book->description = $request->description;
        $book->slug = $request->slug;
        $book->ibsn = $request->ibsn;
        $book->publish_year = $request->publish_year;
        $book->rate = $request->rate;
        $book->admin_id = auth()->guard('admin')->id();
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->save();
        return response()->json('THE BOOK ADDED SUCSESFULY');
    }

    function editBook(BookRequest $request, $id)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('book_image', 'public');
        $data['book']  = $request->file('book')->store('book', 'public');
        $book = Book::findorfail($id);
        $book->update(
            $data
        );
        return response()->json('YOUR BOOK EDITED SUCSESFULY');
    }

    function deleteBook($id)
    {
        $book = Book::destroy($id);
        return response()->json('YOUR DATA DELETED SUCSESFULY');
    }

    function showBookById($id)
    {
        $book = Book::findorfail($id);
        return response()->json($book);
    }

    function showAllBooks()
    {
        $books = QueryBuilder::for(Book::class)->with('category:id,name', 'author:id,name')
            ->allowedFilters(['rate', 'category.name', 'author.name'])
            ->whereHas('category', function ($query) {
                $query->where('name', '!=', '');
            })->whereHas('author', function ($query) {
                $query->where('name', '!=', '');
            })
            ->get();
        return response()->json($books);
    }

    function searchBook($title)
    {
        
        return response(Book::where("title", 'like', '%' . $title . '%')->get());
    }
}

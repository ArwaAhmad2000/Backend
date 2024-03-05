<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistsRequest;
use App\Models\Wishlists;
use Illuminate\Http\Request;

class WishlistsController extends Controller
{
    function addWishlist(WishlistsRequest $request)
    {
        if (Wishlists::where('book_id', $request->book_id)->where('user_id', auth()->id())->exists()) {
            return response()->json('cant add wishlist');
        }
        $data = $request->all();
        $wishlist = new Wishlists();
        $wishlist->book_id = $request->book_id;
        $wishlist->user_id = auth()->id();
        $wishlist->save();
        return response()->json('YOUR WISHLIST ADDED SUCSESFULY');
    }

    function deleteWishlist($id)
    {
        $wishlist = Wishlists::destroy($id);
        return response()->json('YOUR DATA DELETED SUCSESFULY');
    }

    function showWishlistById($user_id)
    {
        return response(Wishlists::with('user', 'book')->where("user_id", $user_id)->get());
    }
}

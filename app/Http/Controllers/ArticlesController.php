<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticlesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Articles;

class ArticlesController extends Controller
{
    function addArticle(ArticlesRequest $request)
    {
        $data = $request->all();
        $article = new Articles();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $request->file('image')->store('article_image', 'public');
        $article->admin_id = auth()->guard('admin')->id();
        $article->save();
        return response()->json('YOUR ARTICLE ADDED SUCSESFULY');
    }

    function editArticle(ArticlesRequest $request, $id)
    {
        $data = $request->all();
        $article = Articles::findorfail($id);
        $article->update(
            $data
        );
        return response()->json('YOUR ARTICLE EDITED SUCSESFULY');
    }

    function deleteArticle($id)
    {
        $article = Articles::destroy($id);
        return response()->json('YOUR ARTICLE DELETED SUCSESFULY');
    }

    function showArticleById($id)
    {
        $article = Articles::findorfail($id);
        return response()->json($article);
    }

    function showAllArticles()
    {
        $articles = Articles::get();
        return response()->json($articles);
    }
}

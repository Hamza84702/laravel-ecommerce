<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use Auth;


class ProductpageController extends Controller
{
    public function products()
    {
        $products = Product::query()->paginate(6)->withQueryString();
        $comments = Comment::with('replies')->orderBy('id','desc')->get();
        return view('frontend.products_page',compact('products','comments'));
    }

    public function products_search(request $request)
    {

        $search_text = $request->search_text;
        $products = Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text%")->paginate(6);
        $comments = Comment::with('replies')->orderBy('id','desc')->get();
        return view('frontend.products_page',compact('products','comments'));
    }
}

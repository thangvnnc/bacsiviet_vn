<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Article;
use App\Deals;

class MessagesController extends Controller
{
	public function __construct()
	{
		$article = Article::orderBy('article_id','DESC')->limit(5)->get();
		view()->share('article',$article);
	
		$deals= Deals::orderBy('ranked','DESC')->get();
		view()->share('deals',$deals);

        //news new 5
		$news_new = Article::orderBy('article_id','DESC')->limit(5)->get();
        view()->share('news_new',$news_new);
        //news popular
        $news_popular = Article::where('popular', 1)->orderBy('article_id','DESC')->limit(5)->get();
        view()->share('news_popular',$news_popular);
	}

    public function index(){

    	return view('messages');
    }

}

<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

//use Request;

use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index(){

    	//$articles = Article::latest('published_at')->get(); show all
    	$articles = Article::latest('published_at')->published()->get();
    	return view('articles.index', compact ('articles'));
    }

    public function show($id)
    {
    	$article = Article::findOrFail($id);
    	//dd($article);
    	return view('articles.show', compact('article'));
    }

    public function create()
    {
    	return view('articles.create');
    }

    public function store(ArticleRequest $request) //create article method
    {
    	//$input = Request::all();
    	//$input['published_at'] = Carbon::now();
    	//Article::create($input);

    	//Article::create(Request::all());

    	$article = new Article($request->all());

    	Auth::user()->articles()->save($article);

    	return redirect('articles');

    }

    public function edit($id)
    {
    	$article = Article::findOrFail($id);

    	return view('articles.edit', compact('article'));

    }

    public function update($id, ArticleRequest $request)
    {
    	$article = Article::findOrFail($id);

    	$article->update($request->all());

    	return redirect('articles');
    }
}

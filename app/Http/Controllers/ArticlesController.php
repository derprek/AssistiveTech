<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;
use App\Tag;

//use Request;

use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index(){

    	//$articles = Article::latest('published_at')->get(); show all
    	$articles = Article::latest('published_at')->published()->get();
    	return view('articles.index', compact ('articles'));
    }

    public function show(Article $article)
    {
    	//dd($id);
    	//$article = Article::findOrFail($id);
    	//dd($article);
    	return view('articles.show', compact('article'));
    }

    public function create()
    {
    	$tags = Tag::lists('name', 'id');

    	return view('articles.create', compact('tags'));
    }

    public function store(ArticleRequest $request) //create article method
    {
    	//$input = Request::all();
    	//$input['published_at'] = Carbon::now();
    	//Article::create($input);

    	//Article::create(Request::all());
    	//dd($request->input('tags'));
    	$article = Auth::user()->articles()->create($request->all());
    	$article->tags()->attach($request->input('tag_list'));

    	return redirect('articles');

    }

    public function edit(Article $article)
    {
    	$tags = Tag::lists('name', 'id');
    	return view('articles.edit', compact('article', 'tags'));
    }

    public function update(Article $article, ArticleRequest $request)
    {
    	//s$article = Article::findOrFail($id);

    	$article->update($request->all());

    	$article->tags()->sync($request->input('tag_list'));

    	return redirect('articles');
    }
}

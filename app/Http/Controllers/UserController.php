<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;

class UserController extends Controller
{
    public function index()
    {
    	$articles = Article::all();

    	return $articles;
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getIndex()
    {
    	return view('laraql.posts.index');
    }

    public function create()
    {
    	return view('laraql.posts.create');
    }
}

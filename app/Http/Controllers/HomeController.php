<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts= Post::all();
        return view('public.home', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if($post) {
          return view('public.show', compact('post'));
        } else {
          return abort('404');
        }

    }
}

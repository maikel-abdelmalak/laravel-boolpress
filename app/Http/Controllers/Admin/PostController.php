<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $posts = Post::with('category')->get();
        $data = [
            'tags' => $tags,
            'posts' => $posts
        ];
        return view('admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            'tags' => $tags,
            'categories' => $categories
        ];
        return view('admin.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title' => 'required|max:255|unique:posts,title',
          'text' => 'required'
      ]);

      $dati = $request->all();
      $slug = Str::of($dati['title'])->slug('-');
      $slug_originale = $slug;
      $post_trovato = Post::where('slug', $slug)->first();
      $i = 1;
      while($post_trovato) {
          $slug = $slug_originale . '-' . $i;
          $post_trovato = Post::where('slug', $slug)->first();
          $i++;
      }
       $dati['slug'] = $slug;
       $post = new Post();
       $post->fill($dati);
       $post->save();
        if(!empty($dati['tags'])) {
          $post->tags()->sync($dati['tags']);
        }
      return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post) {
           return view('admin.show', compact('post'));
        } else {
           return abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post) {
           $categories = Category::all();
           $tags = Tag::all();
           $data = [
               'post' => $post,
               'categories' => $categories,
               'tags' => $tags
           ];
           return view('admin.edit', $data);
        } else {
           return abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:posts,title,'.$id,
            'text' => 'required'
      ]);

      $dati = $request->all();
      $slug = Str::of($dati['title'])->slug('-');
      $slug_originale = $slug;
      $post_trovato = Post::where('slug', $slug)->first();
      $i = 1;
      while($post_trovato) {
          $slug = $slug_originale . '-' . $i;
          $post_trovato = Post::where('slug', $slug)->first();
          $i++;
      }

       $dati['slug'] = $slug;
       $post = Post::find($id);
       $post->update($dati);
       if(!empty($dati['tags'])) {
         $post->tags()->sync($dati['tags']);
       }
       return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post) {
          $post->delete();
          return redirect()->route('admin.posts.index');
        } else {
          return abort('404');
        }
    }
}

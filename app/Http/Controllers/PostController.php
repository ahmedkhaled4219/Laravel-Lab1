<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $posts = [
        ['id' => 1, 'title' => 'graduation', 'body' => 'congrats', 'image' => 'pic1.png'],
        ['id' => 2, 'title' => 'php', 'body' => 'my fav programming lang', 'image' => 'pic2.png'],
        ['id' => 3, 'title' => 'graduation', 'body' => 'nas2al allah el khalas', 'image' => 'pic3.png'],
        ['id' => 4, 'title' => 'job fair', 'body' => 'ekrmna ya rab', 'image' => 'pic4.png'],

    ];

    function create()
    {
        return view("create");
    }
    function index()
    {
        // $posts = DB::table('posts')->get();
        // return $posts;
        $posts = Post::all();
        return view("index", ["posts" => $posts]);
    }
    function show($id)
    {
        $post = Post::findOrFail($id);
        return view("show", ["post" => $post]);
    }
    function edit($id)
    {
        $post = Post::findOrFail($id);
        return view("edit", ["post" => $post]);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function createUsers()
    {
        User::factory()->count(10)->create();
    }

    function create()
    {
        $users = User::all();
        return view("create", ["users" => $users]);
    }
    public function store(Request $request)
    {

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;


        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/iti'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('posts.index');
    }

    function index()
    {
        // $posts = DB::table('posts')->get();
        // return $posts;
        $posts = Post::paginate(3);
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
    public function update(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/iti'), $imageName);
            $post->image = $imageName;
        }
        $post->save();
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}

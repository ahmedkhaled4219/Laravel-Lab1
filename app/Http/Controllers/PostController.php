<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view("index", ["posts" => $this->posts]);
    }
    function show($id)
    {
        if ($id <= count($this->posts)) {
            $post = $this->posts[$id - 1];
            return view('show', ["post" => $post]);
        }
        return abort(404);
    }
    function edit($id)
    {
        if ($id <= count($this->posts)) {
            $post = $this->posts[$id - 1];
            return view('edit', ["post" => $post]);
        }
        return abort(404);
    }
    public function destroy($id)
    {
        $postIndex = $id - 1;

        if ($postIndex < count($this->posts)) {
            unset($this->posts[$postIndex]);

            $this->posts = array_values($this->posts);
            return view('index', ["posts" => $this->posts]);
        }

        return abort(404);
    }
}

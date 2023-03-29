<?php

namespace App\Http\Controllers;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\IndexRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        $filter = new PostFilter($data);
        $posts = Post::filter($filter)->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * @throws \Exception
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        (new Post())->saveData($data);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

}

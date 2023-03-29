<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\UpdateRequest;
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

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        (new Post())->saveData($data);

        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post_tags = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_tags'));
    }

    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        $post->updateData($data);

        return redirect()->route('admin.posts.show', $post->id);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }


}

@extends('layouts.admin')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary mb-3">Edit</a>
        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger" value="Delete">
        </form>
    </div>
    <div>
        <p><span class="font-weight-bold">id: </span>{{ $post->id }}</p>
        <p><span class="font-weight-bold">title: </span>{{ $post->title }}</p>
        <p><span class="font-weight-bold">content: </span>{{ $post->content }}</p>
        <p><span class="font-weight-bold">created_at: </span>{{ $post->created_at }}</p>
    </div>
    <div>
    </div>
@endsection

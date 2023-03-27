@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mb-3">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger" value="Delete">
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Created</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->created_at }}</td>
        </tr>

        </tbody>
    </table>
    <div>
    </div>
@endsection

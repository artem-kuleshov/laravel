@extends('layouts.admin')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create</a>
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
        @foreach($posts as $post)
            <tr>
                <th scope="row"><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->id }}</a></th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->created_at }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $posts->withQueryString()->links() }}
    <div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div>
        <p><span class="font-weight-bold">id: </span>{{ $post->id }}</p>
        <p><span class="font-weight-bold">title: </span>{{ $post->title }}</p>
        <p><span class="font-weight-bold">content: </span>{{ $post->content }}</p>
        <p><span class="font-weight-bold">created_at: </span>{{ $post->created_at }}</p>
    </div>
    <div>
    </div>
@endsection

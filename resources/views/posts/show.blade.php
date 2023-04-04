@extends('layout.app')
@section('title') Post @endsection
@section('content')
<div class="card mt-4">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$post->title}}</h5>
        <h5 class="card-text">Description: {{$post->description}}</h5>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        Post Creator Info
    </div>
    <div class="card-body">
        @if ($post->user != null)
        <h5 class="card-title">Posted By: {{$post->user->name}}</h5>
        @else
        <h5 class="card-title">Posted By: user not found</h5>
        @endif
        @if ($post->created_at != null)
        <h5 class="card-title">Created At: {{$post->created_at}}</h5>
        @endif
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        Comments
    </div>
    <div class="card-body  mt-4">
        <form action="{{ route('comments.store',['post'=>$post->id]) }}" method="POST">
            @csrf
            <input type="text" name="comment" class="form-control" placeholder="Enter your comment here" >
            <input type="submit" class="btn btn-success  mt-2" >
        </form>
    </div>
</div>
    @foreach($post->comments as $comment)
        <div class="card mt-1">
            <div class="card-body  mt-2">
                  {{  $comment->comment }}
                <a href="{{ route('comments.update',['post'=>$post->id]) }}"> <i class="fa fa-edit"></i></a>
                <a href="{{ route('comments.destroy',['post'=>$post->id]) }}"> <i class="fa fa-trash"></i></a>
            </div>
        </div>
    @endforeach
@endsection

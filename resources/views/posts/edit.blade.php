@extends('layout.app')

@section('title')
Edit
@endsection

@section('content')
@dd($post)
<form method="POST" action="{{ route('posts.update',['post'=>$post->id]) }}">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter post title">
        <small id="title" class="form-text text-muted">enter post title here.</small>
    </div>
    <input type="submit" class="btn btn-success" value="Edit">
</form>
@endsection
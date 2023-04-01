@extends('layout.app')

@section('title')
Create Post
@endsection

@section('content')
<form  action=" {{ route('posts.store') }}">
    @method('POST')
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Title">
        <small id="titleHelp" class="form-text text-muted">Add your post title here.</small>
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>




@endsection
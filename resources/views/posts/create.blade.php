@extends('layout.app')

@section('title')
Create Post
@endsection

@section('content')
<form action=" {{ route('posts.store') }}" method="POST">
    @method('POST')
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="description">description</label>
        <input type="text" name="description" class="form-control" id="description" placeholder="description">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">User</label>
        <select class="form-select form-select-lg" name="user">
            @foreach ( $users as $user )
            <option selected>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection
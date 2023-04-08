@extends('layouts.app')

@section('title')
    Create Post
@endsection
<div class="container">
    @section('content')
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action=" {{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
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
                <select class="form-select form-select-lg" name="user_id">
                    <option selected> Chosee user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <input class="form-control" name='image' type="file" />
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    @endsection
</div>

@extends('layouts.app')

@section('title')
    Edit
@endsection

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
    <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter post title">
            <small id="title" class="form-text text-muted">enter post title here.</small>
        </div>
          <div class="form-group">
            <label for="title">Descrption </label>
            <input type="text" class="form-control" name="description" placeholder="Enter post title">
            <small id="title" class="form-text text-muted">enter post Descrption here.</small>
        </div>
        <input class="form-control" name='image' type="file" />
        <input type="submit" class="btn btn-success" value="Edit">
    </form>
@endsection

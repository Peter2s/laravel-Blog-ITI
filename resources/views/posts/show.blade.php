@extends('layouts.app')
@section('title')
    Post
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{ $post->title }}</h5>
            <h5 class="card-text">Description: {{ $post->description }}</h5>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            @if ($post->user != null)
                <h5 class="card-title">Posted By: {{ $post->user->name }}</h5>
            @else
                <h5 class="card-title">Posted By: user not found</h5>
            @endif
            @if ($post->created_at != null)
                <h5 class="card-title">Created At: {{ $post->created_at }}</h5>
            @endif
            {{-- @dd($post->image) --}}
            @if ($post->image)
                <img class="" width="400px" height="500px" src="{{ $post->image }}" alt="{{ $post->description }}" />
            @endif
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body  mt-4">
            <form action="{{ route('comments.store', ['post' => $post->id]) }}" method="POST">
                @csrf
                <input type="text" name="comment" class="form-control" placeholder="Enter your comment here">
                <input type="submit" class="btn btn-success  mt-2">
            </form>
        </div>
    </div>
    @foreach ($post->comments as $comment)
        <div class="card mt-1">
            <div class="card-body  mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-8 text-capitalize text-bold h3 p-2">
                            {{ $comment->comment }}

                        </div>
                        {{-- edit button --}}
                        <div class="col-4 d-flex justify-content-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa fa-edit"></i>
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form
                                            action="{{ route('comments.update', ['post' => $post->id, 'comment' => $comment->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit comment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="comment" class="form-control"
                                                    placeholder="comment" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('comments.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-danger m-1"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

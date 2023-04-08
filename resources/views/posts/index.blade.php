@extends('layouts.app')

@section('title')
index
@endsection

@section('content')
<div> <a class="btn btn-primary w-25  p-2 fs-3 m-auto d-flex justify-content-center   mt-3" href="{{route('posts.create')}}" role="button"> Add Post </a></div>
<div class="table-responsive">
    <table class="table table-striped
    table-hover
    table-borderless
    align-middle mt-4">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>slug</th>
                <th>Posted By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ( $posts as $post )
            <tr class="table-primary">
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->slug }}</td>
                @if ($post->user != null)
                    <td>{{ $post->user->name }}</td>
                @else
                    <td>user not found</td>
                @endif
                <td>{{ $post->created_at }}</td>
                <td>
                    <div class="d-flex  p-2  justify-content-between">
                    @if(!$post->trashed())
                        <x-button type='info' route="{{ route('posts.show' , ['post'=>$post->id]) }}"> View </x-button>
                        <x-button type='primary' route="{{ route('posts.edit' , ['post'=>$post->id]) }}"> Edit </x-button>
                    @endif

                    @if (!$post->trashed())
                    <form class="deleteFrom d-inline" action="{{ route('posts.destroy' , ['post'=>$post->id] ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"> Delete</button>
                    </form>
                    @else
                    <form class="deleteFrom d-inline" action="{{ route('posts.restore' , ['post'=>$post->id] ) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success"> Restore</button>
                    </form>
                    @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->onEachSide(5)->links()   }}
</div>
<script>
    $(document).ready(function() {
        $('.deleteFrom').submit(function(e) {
            e.preventDefault();
            let deleteUrl = $(this).attr('action');
            let dialog = $.confirm({
                title: 'Confirm Delete',
                content: 'Are you sure !?',
                buttons: {
                    confirm: () => {
                        this.submit() // if the user confirms the deletion, submit the form
                    },
                    cancel: () => {
                        dialog.close();
                    }
                }
            });
        });
    });
</script>
@endsection

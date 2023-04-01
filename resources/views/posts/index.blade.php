@extends('layout.app')

@section('title')
index
@endsection

@section('content')
<div> <a class="btn btn-primary w-50 m-auto d-flex " href="{{route('posts.create')}}" role="button"> Add </a></div>
<div class="table-responsive">
    <table class="table table-striped
    table-hover	
    table-borderless
    align-middle mt-4">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Posted By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ( $posts as $post )
            <tr class="table-primary">
                <td scope="row">{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <x-button type='info' route="{{ route('posts.show' , ['post'=>$post['id']]) }}"> View </x-button>
                    <x-button type='primary'  route="{{ route('posts.edit' , ['post'=>$post['id']]) }}"> Edit </x-button>
                    <form class="deleteFrom d-inline" action="{{ route('posts.destroy' , ['post'=>$post['id']] ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"> Delete</button>
                    </form>
                   

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('.deleteFrom').submit(function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('action');
            let dialog = $.confirm({
                title: 'Confirm Delete',
                content: 'Are you sure you want to delete this Post ?',
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
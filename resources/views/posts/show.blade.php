@extends('layout.app')
@section('title') Post @endsection
@section('content')
<div class="card mt-4">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$post['title']}}</h5>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        Post Creator Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Posted By: {{$post['posted_by']}}</h5>
    </div>
</div>
@endsection
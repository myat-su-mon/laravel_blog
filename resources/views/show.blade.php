@extends('layout')

@section('content')
<div class="container">
    <div class="card">
    <h5 class="card-header">Contents</h5>
    <div class="card-body">
        <div>
            <h5 class="card-title">{{$post->name}}</h5>
            <p class="card-text">{{$post->description}}</p>
            <p class="card-text">{{$post->category_id}}</p>
        </div>
    </div>
    </div>
    <div>
        <a href="/posts" class="btn btn-success">Back</a>
    </div><br>
</div>

@endsection

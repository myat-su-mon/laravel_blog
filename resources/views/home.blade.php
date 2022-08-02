@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <a href="/posts/create" class="btn btn-success">New Post</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
        <h4>{{Auth::user()->name}}</h4>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contents') }}</div>
                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}

                    @foreach ($data as $post)
                        <div>
                            <h5 class="card-title">{{ $post->name }}</h5>
                            <p class="card-text">{{ $post->description }}</p>
                            <div class="form-row">
                                <a href="/posts/{{$post->id}}" class="btn btn-primary">View</a>
                                <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                                <form action="/posts/{{$post->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

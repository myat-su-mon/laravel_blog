@extends('layout')

@section('content')
<style>
    .form-error {
        border: 2px solid red;
    }
</style>
<div class="container">
    <div class="card">
    <h5 class="card-header">New Post</h5>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/posts" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control {{$errors->first('name') ? "form-error" : ""}} " name="name" placeholder="Enter Name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">Description</label>
                <textarea class="form-control" name="description" placeholder="Enter Description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <select name="category_id" class ="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <a href="/posts" class="btn btn-success">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>

@endsection

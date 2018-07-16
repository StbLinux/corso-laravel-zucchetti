@extends('layouts.app')

@section('content')

<h4>Create a new post</h4>

<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">

    @csrf

    @include('posts._form')

    <button type="submit" class="btn btn-block btn-success">Publish post</button>
</form>

@stop

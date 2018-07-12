@extends('layouts.app')

@section('content')

<h4>Update post</h4>

<form method="POST" action="{{ route('posts.update', $post) }}">

    @csrf
    @method('PATCH')

    @include('posts._form')

    <button type="submit" class="btn btn-block btn-warning">Update post</button>
</form>

<hr>

@can('delete', $post)
    <form method="POST" action="{{ route('posts.destroy', $post) }}">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete This Post</button>

    </form>
@endcan

@stop

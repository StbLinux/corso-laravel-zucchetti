@extends('layouts.app')

@section('content')

<h4>Create a new post</h4>

<form method="POST" action="{{ route('posts.store') }}">

    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" class="form-control">
            <option></option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="preview">Preview</label>
        <textarea class="form-control" name="preview"></textarea>
    </div>

    <div class="form-group">
        <label for="body">Post body</label>
        <textarea class="form-control" name="body" rows="7"></textarea>
    </div>

    <div class="form-group">
        <label for="tags[]">Tags</label>
        <select name="tags[]" class="form-control" multiple="">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-block btn-success">Publish post</button>
</form>

@stop

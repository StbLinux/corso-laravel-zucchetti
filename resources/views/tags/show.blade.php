@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h4>Posts tagged with <strong>#{{ $tag->name }}</strong> ({{ $posts->total() }})</h4>
        </div>
    </div>

    @include('posts._posts-list')

@stop

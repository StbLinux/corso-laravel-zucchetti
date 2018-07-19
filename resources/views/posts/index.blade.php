@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h4>{{ __('blog.posts.recent') }} {{ request('month') }} {{ request('year') }} ({{ $posts->total() }})</h4>
        </div>
    </div>

    @include('posts._posts-list')

@stop

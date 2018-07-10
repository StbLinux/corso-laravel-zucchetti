@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h4>Latest Posts ({{ $posts->total() }})</h4>
        </div>
    </div>

    @foreach($posts as $post)
        @include('posts._post', ['full' => false])
    @endforeach

    <div class="row">
        <div class="col-md-12">
            {{ $posts->links() }}
        </div>
    </div>

@stop

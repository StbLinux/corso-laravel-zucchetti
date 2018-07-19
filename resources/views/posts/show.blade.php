@extends('layouts.app')

@section('content')

    @include('posts._post', ['full' => true])



@stop

@section('js')
{{--     <script type="text/javascript">
        alert('12');
    </script> --}}
@stop

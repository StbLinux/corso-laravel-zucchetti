@extends('layouts.app')

@section('content')

    <h4>Manage Access Tokens</h4>

    <passport-clients></passport-clients>
    <passport-authorized-clients></passport-authorized-clients>
    <passport-personal-access-tokens></passport-personal-access-tokens>

@stop

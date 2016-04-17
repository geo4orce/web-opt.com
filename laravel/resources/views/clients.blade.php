@extends('master')

@section('title')
    Clients {{ $PIPE }} @parent
@endsection

@section('body')
    <img src="{{ asset('img/clients.png') }}">
@endsection

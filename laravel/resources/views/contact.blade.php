@extends('master')

@section('title')
    Contact {{ $PIPE }} @parent
@endsection

@section('body')
    <img src="{{ asset('img/contacts.png') }}">
@endsection

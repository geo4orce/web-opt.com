@extends('master')

@section('title')
    Welcome {{ $title_divider }} @parent
@endsection

@section('head')
    <style>
        body {
            background-color: #000032;
            background-image: url('{{ asset('img/logo.png') }}');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
@endsection

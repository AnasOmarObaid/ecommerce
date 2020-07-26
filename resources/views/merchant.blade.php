@extends('layouts.app')

@section('title')

@endsection
<style>
    .body {
        margin: 0;
        padding: 0;
    }

    .bg {
        position: relative;
        width: 100%;
        height: 1000px;

    }

    .my_hero {
        position: absolute;
        width: 100%;
        top: 0;
        right: 0;
        left: 0;
        height: 100%;
        bottom: 0;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>

@section('content')
<div class="bg">
    <div class="my_hero" style="background-image: url({{asset('public/images/z.jpeg')}})">

    </div>
</div>
@endsection
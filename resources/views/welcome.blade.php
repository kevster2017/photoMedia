@extends('layouts.app')

@section('content')

<style>
    .bg {
        /* The image used */
        background-image: url("/storage/images/K_Icon.JPG");
        /* Full height */
        height: 100%;
        width: 100%;
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>


<div class="container">

    <div class="bg">
        <div class="text-left ms-5 py-5">
            <h1>Welcome to Kevstagram</h1>
            <p>To get started, register an account or log in if you are already with us</p>
        </div>

        <div class="text-left ms-5 py-5">

            <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Sign Up</a>
            <a href="{{ route('login') }}" class="btn btn-lg btn-info ms-3">Login</a>
        </div>

    </div>

</div>
@endsection
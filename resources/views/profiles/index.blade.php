@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <!-- Set default image if profile picture is NULL -->
        @if($user->profile->image !== NULL)
        <div class="col-3 p-5">
            <img src="/storage/{{ $user->profile->image}}" class="rounded-circle w-100">
        </div>

        @else
        <div class="col-3 p-5">
            <img src="/storage/images/profileImage.jpg" class="rounded-circle w-100">
        </div>
        @endif

        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between">
                <div class="d-flex align items-center pb-3">
                    <h1>{{ $user->username }}</h1>


                    @if (!$user->profile->followedBy(auth()->user()))
                    <form action="{{ route('profiles.follows', $user->profile->id) }}" method="POST" class="mr-1">
                        @csrf
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <button class="btn btn-primary btn-sm ms-3 mt-2">Follow</button>
                        </div>

                    </form>
                    @else
                    <form action="{{ route('profiles.unfollows', $user->profile->id) }}" method="POST" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <div class="btn-group me-2" role="group" aria-label="Second group">
                            <button class="btn btn-primary btn-sm ms-3 mt-2">Unfollow</button>

                        </div>
                    </form>
                    @endif




                </div>
                <div class="mt-3">
                    @can('update', $user->profile)
                    <a href="{{ route('posts.create')}}">Add new post</a>
                    @endcan
                </div>



            </div>
            @can('update', $user->profile)
            <a href="/profiles/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">

                <div class="pe-5"><strong>{{ $postCount}}</strong> {{ Str::plural('post', $user->posts->count())}}</div>
                <div class="pe-5"><strong>{{ $followersCount }}</strong> {{ Str::plural('follower', $user->profile->follows->count())}}</div>
                <div class="pe-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 fw-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="{{ $user->profile->url }}" target="_blank">{{ $user->profile->url }}</a></div>
            <div><a href="mailto:">{{ $user->email }}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="{{ route('posts.show', $post->id) }}"> <img src="/storage/{{ $post->image }}" class="w-100"> </a>
        </div>
        @endforeach

    </div>

</div>
@endsection
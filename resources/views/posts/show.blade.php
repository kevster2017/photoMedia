@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pe-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div>
                        <div class="fw-bold">
                            <a href="/profiles/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>

                        </div>
                        <span>Posted: {{$post->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <hr>

                <p>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
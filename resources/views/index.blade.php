@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/profiles/{{ $post->user_id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>
        </div>
      
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div>
                    <p>
                    <span class="font-weight-bold">
                        <a href="/profiles/{{ $post->user_id }}">
                           
                        </a>
                    </span>

                    
                    <div class="d-flex">
                        <div class="p-2 flex-fill"><strong> {{ $post->caption }}  </strong> </div>
                  
                        <div class="p-2 flex-fill text-end"><strong>Posted: </strong>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</div>
                   
                    </div>
                   
                     
                    </p>
                    
                </div>
            </div>
        </div>
    @endforeach

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
</div>
@endsection
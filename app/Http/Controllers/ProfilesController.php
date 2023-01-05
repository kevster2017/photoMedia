<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class ProfilesController extends Controller
{

    public function index(User $user)
    {

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            }
        );



        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->follows->count();
            }
        );


        
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->follows->count();
            }
        );

        

/*
        $followingCount = DB::table('follows')
            ->where('user_id', auth()->user()->id)
            ->count();
          */

        return view('profiles.index', compact('user', 'postCount', 'followersCount', 'followingCount'));

    }


    public function edit(User $user)
    {
       


        return view('profiles.edit', compact('user'));
    }

    public function update(User $user, Request $request, Profile $profile)
    {
        

        $data = request()->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'url' => 'url | nullable',
            'image' => '',
        ]);

     

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        if (!empty($request->input('title'))) {
            $profile->title = $request->title;
        } else {
            $profile->title = $profile->title;
        }
        if (!empty($request->input('description'))) {
            $profile->description = $request->description;
        } else {
            $profile->description = $profile->description;
        }
        if (!empty($request->input('url'))) {
            $profile->url = $request->url;
        } else {
            $profile->url = $profile->url;
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));


        return redirect("/profiles/{$user->id}");
    }
}

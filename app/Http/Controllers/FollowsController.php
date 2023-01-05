<?php

namespace App\Http\Controllers;

use App\Models\Profile;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Profile $profile)
    {


        if ($profile->followedBy($request->user())) {
            return response(null, 409);
        }

        $profile->follows()->create([
            'user_id' => $request->user()->id,


        ]);


        return back();
    }


    public function destroy(Profile $profile, Request $request)
    {

        $request->user()->follows()
            ->where('profile_id', $profile->id)
            ->delete();

        return back();
    }
}

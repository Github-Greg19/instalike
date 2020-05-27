<?php

namespace App\Http\Controllers;
//Added
use App\User;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id): false;

        return view('profiles.index', compact('user','follows'));
    }
    /*public function index($user)
    {
        //dd($user);
        //$user = User::find($user);
        $user = User::findOrFail($user);    

        return view('profiles.index', [
            'user' => $user,
        ]);
    }*/

    public function edit(User $user)
    {
        $this->authorize('update',$user->profile); // Authorization via Policy.
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {

        $this->authorize('update',$user->profile); // Authorization via Policy.
        $data = request()->validate([
            'title' => 'required', // "" if not required
            'description' => 'required',
            'url' => 'url',
            'image' => '',  
        ]);
        auth()->user()->profile->update($data);
        

        
        //For the profile picture
        if (request('image'))
        {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
        
            $imageArray = ['image' => $imagePath];
        }
        
        //auth()->$user->profile->update($data);
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
            //['image' => $imagePath], #overides the value in $data array.
        ));
        
        return redirect("/profile/{$user->id}");
    }

}

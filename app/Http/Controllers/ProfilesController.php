<?php

namespace App\Http\Controllers;
//Added
use App\User;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
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
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'title' => 'required', // "" if not required
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        #dd($data);

        $user->profile->update($data);

        return redirect("/profile/{{ $user->id }}");
    }

}

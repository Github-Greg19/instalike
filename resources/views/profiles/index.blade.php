@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://instagram.fmnl6-2.fna.fbcdn.net/v/t51.2885-19/s320x320/97566921_2973768799380412_5562195854791540736_n.jpg?_nc_ht=instagram.fmnl6-2.fna.fbcdn.net&_nc_ohc=HTiOQChzaQgAX_pIJUa&oh=21003d7c51d5192e4321f275a948fe29&oe=5EF4B89F" style="height:200px;" class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1> {{ $user->username }} <h1>
                <a href="/p/create"><h3>Add New Post<h3></a>
               
            </div>
            <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            <div class="d-flex">
                <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts </div>
                <div class="pr-4"><strong>23k</strong> followers </div>
                <div class="pr-4"><strong>212</strong> Following </div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url  }}</div>
        </div>
        


        <div class="row pt-5 ">
            @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                    </a>
                </div>
            @endforeach

            
        </div>

    </div>
</div>
@endsection

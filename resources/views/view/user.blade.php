@extends('layouts.master')
@section('body')
    <div class="container mt-3 p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="{{asset('storage/avatars/'.$user->avatar)}}" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{$user->name}}
                    </h5>
                    <p>Rating : <span>{{$user->rating_overall}}</span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home"
                               aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile"
                               aria-selected="false">List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile_wishlist" role="tab"
                               aria-controls="profile"
                               aria-selected="false">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile_watchlist" role="tab"
                               aria-controls="profile"
                               aria-selected="false">Watchlist</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->email}}</p>
                                    </div>
                                </div>
                            </div>
                            {{-- TODO FOR NASKO --- TODO FOR NASKO --- TODO FOR NASKO --}}
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                {{-- Тук трябва да се изписват всички постове на потребителя --}}
                            </div>
                            <div class="tab-pane fade" id="profile_wishlist" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                    @foreach($wishlist as $m)
                                    <li class="list-group-item"><a href="/movie/{{$m->id}}">{{$m->title}}</a></li>
                                    @endforeach
                                </ul>
                                {{$wishlist->links()}}
                            </div>
                            <div class="tab-pane fade" id="profile_watchlist" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                @foreach($watchlist as $m)
                                <li class="list-group-item"><a href="/movie/{{$m->id}}">{{$m->title}}</a></li>
                                @endforeach
                                </ul>
                                {{$watchlist->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a href="{{route('account.settings',\Illuminate\Support\Facades\Auth::id())}}">
                    <button class="profile-edit-btn">Edit Profile</button>
                </a>
                @role('Admin')
                        @if($user->trashed())
                            <a href="/admin/user/{{$user->id}}/restore">
                                <button class="profile-edit-btn" type="submit">Restore</button>
                            </a>
                        @else
                            {{--                            <a href="/admin/user/{{$user->id}}/destroy">--}}
                            <form action="/admin/user/{{$user->id}}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="profile-edit-btn btn-danger" type="submit">Deactivate</button>
                            </form>
                        @endif
                        @endrole
            </div>
        </div>
    </div>
@endsection

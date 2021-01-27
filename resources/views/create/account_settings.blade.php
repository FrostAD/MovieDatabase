@extends('layouts.master')
@section('body')
    <div class="container mt-3 p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="{{asset('storage/avatars/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="">
                    {{-- Change Photo --}}
                    <form action="/account/upload" method="POST" enctype="multipart/form-data">
                        {{-- TODO --- TODO --- TODO --- TODO --}}
                        @csrf
                        {{--<div class="custom-file">--}}
                        {{--<input type="file" name="image" class="custom-file-input" id="inputGroupFile01"--}}
                        {{--aria-describedby="inputGroupFileAddon01">--}}
                        {{--<label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                        {{--</div>--}}
                        <input type="file" name="image"/>
                        <button class="btn btn-primary" type="submit">Change Photo</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-lg-12 text-center mb-3">
                    <h2>Edit Profile</h2>
                </div>
                <div class="col-lg-8 personal-info">
                    <form method="POST" action="/account/update/{{\Illuminate\Support\Facades\Auth::id()}}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ __('Name') }}</label>
                            <div class="col-lg-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>

                            <div class="col-lg-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ __('Password') }}</label>

                            <div class="col-lg-9">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ __('Confirm Password') }}</label>
                            <div class="col-lg-9">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

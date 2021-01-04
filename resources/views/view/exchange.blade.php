@extends('layouts.master')
@section('body')
    @auth
        <x-alert />
        @if($exchange->first_user->id == \Illuminate\Support\Facades\Auth::user()->id)
            @if($exchange->second_user)
                @include('view.exchange.auth_first_second_no_ret',$exchange)
            @else
                @include('view.exchange.auth_first_no_second_no_ret',$exchange)
            @endif
        @elseif($exchange->second_user)
            @if($exchange->second_user->id == \Illuminate\Support\Facades\Auth::user()->id)
                @include('view.exchange.auth_second',$exchange)
            @endif
        @else
            @include('view.exchange.viewer',$exchange)
        @endif
    @endauth
    @guest
        @include('view.exchange.guest')
    @endguest
@endsection

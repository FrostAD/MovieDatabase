@extends('layouts.master')
@section('body')
<div class="container">
    <h3 class="text-center my-4">ALL EXCHANGES</h3>
{{--    <form class="form-inline justify-content-center mb-4">--}}
{{--        <input class="form-control mr-sm-2" type="search" placeholder="Search">--}}
{{--        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
{{--    </form>--}}
    <ol id="all-exchange-list" class="list-group">
        @include('index.exchanges_only')
    </ol>
</div>
@endsection

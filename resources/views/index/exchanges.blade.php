@extends('layouts.master')
@section('body')
<div class="container">
    <h3 class="text-center my-4">ALL EXCHANGES</h3>
    <ol id="all-exchange-list" class="list-group">
        @include('index.exchanges_only')
    </ol>
</div>
@endsection

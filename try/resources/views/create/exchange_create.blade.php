@extends('layouts.master')
@section('body')
    <div class=" col ml-2 border">
        <h4 class="text-center">Publish offer</h4>
        <x-alert />
        <form action="/exchange/create/save" method="POST">
            @csrf
        <div class="form-group my-2">
            <label for="movie">Movie:</label>
            <select class="livesearch form-control" name="movie1_id"></select>
        </div>
        <div class="float-right">
            <input type="submit" value="Publish">
            <input type="submit" value="Cancel">
        </div>
        </form>
    </div>
@endsection

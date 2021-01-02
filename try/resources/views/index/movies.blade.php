@extends('layouts.master')
@section('body')
<div class="container">
    <h3 class="text-center my-4">ALL MOVIES</h3>
    <div class="form-group sortBy">
         <input type="hidden" id="sorting" value="" />
        <label for="sortBy">Sort By:</label>
            <select class="form-control" id="sortType" name="sortType">
                <option value="title">Name</option>
                <option value="published">Year</option>
                <option value="rating">Rating</option>
                <option value="created_at">Last added</option>
            </select>
    </div>
    <div id="moviesTable">
    @include('index.movies_only')

    </div>
</div>
@endsection

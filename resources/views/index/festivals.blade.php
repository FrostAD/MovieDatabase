@extends('layouts.master')
@section('body')
    <div class="container">
        <h3 class="text-center my-4">ALL FESTIVALS</h3>
        <div class="form-group sortBy">
            <input type="hidden" id="sorting" value="" />
            <label for="sortBy">Sort By:</label>
            <select class="form-control" id="sortType" name="sortType">
                <option value="name">Name</option>
                <option value="founded">Founded</option>
                <option value="date">Date</option>
            </select>
        </div>
        <div id="festivalsTable">
            @include('index.festivals_only')

        </div>
    </div>
@endsection

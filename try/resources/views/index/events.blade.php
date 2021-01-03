@extends('layouts.master')
@section('body')
    <div class="container">
        <h3 class="text-center my-4">ALL EVENTS</h3>
        <div class="form-group sortBy">
            <input type="hidden" id="sorting" value="" />
            <label for="sortBy">Sort By:</label>
            <select class="form-control" id="sortType" name="sortType">
                <option value="name">Name</option>
                <option value="capacity">Capacity</option>
                <option value="date">Date</option>
            </select>
        </div>
        <div id="eventsTable">
            @include('index.events_only')

        </div>
    </div>
@endsection

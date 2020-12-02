@extends('layouts.master')
@section('body')
  <div class="container">
<x-alert/>

    <form id="add-actor-form" action="/actors/add" method="POST">
      @csrf
      <div class="form-group my-2">
        <div class="row">
          <div class="col">
            <label for="first-name">First Name:</label>
            <input class="form-control" name='first_name' type="text">
          </div>
          <div class="col">
            <label for="last-name">Last Name:</label>
            <input class="form-control" name='last_name' type="text">
          </div>
          <div class="col">
            <label for="event-date">Date</label>
            <input class="form-control" id="datepicker" name="born_date" type="date" autocomplete="off" />
          </div>
          <div class="col">
            <label for="last-name">Born:</label>
            <input class="form-control" name='born_place' type="text">
          </div>
        </div>
      </div>
      <!-- Bio -->
      <div class="form-group">
        <label for="bio">Bio:</label>
        <textarea class="form-control" rows="5" name="description"></textarea>
      </div>
      <!-- Participation in movies -->
      {{-- <div class="form-group">
        <label for="participation">Movies (hold ctrl or shift to select more than one):</label>
        <select multiple class="form-control" name='movie'>
          <option>Movie 1</option>
          <option>Movie 2</option>
          <option>Movie 3</option>
        </select>
      </div> --}}
      <div class="form-group">
        <label for="image">Image: </label>
        <input type="file" class="form-control-file">
      </div>
      <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
  </div>
@endsection
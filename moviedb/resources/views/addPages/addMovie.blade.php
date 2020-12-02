@extends('layouts.master')
@section('body')
    
<x-alert/>
  <div class="container">
    <form id="add-movie-form" action="/movies/add" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- Title | Year | Timespan-->
      <div class="form-group my-2">
        <div class="row">
          <div class="col">
            <label for="title">Title:</label>
            <input class="form-control" type="text" name="title">
          </div>
          <div class="col">
            <label for="date">Date</label>
            <input class="form-control" id="datepicker" name="published_at" type="date" autocomplete="off" />
          </div>
          <div class="col">
            <label for="timespan">Timespan</label>
            <div class="input-group">
              <input type="number" class="form-control" name="timespan_hours" placeholder="Hours" value="0" />
              <input type="number" class="form-control" name="timespan_minutes" placeholder="Mins" value="0"/>
            </div>
          </div>
        </div>
      </div>
      <!-- Bio -->
      <div class="form-group">
        <label for="bio">Bio:</label>
        <textarea class="form-control" rows="5" name="description"></textarea>
      </div>
      <!-- Genre -->
      <div class="form-group">
        <label for="sel2">Genre (hold ctrl or shift to select more than one):</label>
        <select multiple class="form-control" name="genres[]">
          <option>Action</option>
          <option>Drama</option>
          <option>Comedy</option>
          <option>Horror</option>
        </select>
      </div>
      <!-- Actors -->
      <div class="form-group">
        <label for="sel2">Actors (hold ctrl or shift to select more than one):</label>
        <select multiple class="form-control" name="actors[]">
          <option>Al Pacino</option>
          <option>Leonardo DiCaprio</option>
          <option>Brad Pitt</option>
          <option>Rober DeNiro</option>
        </select>
      </div>
      <div class="form-group my-2">
        <div class="row">
          <div class="col">
            <label for="producer">Producer:</label>
            <input class="form-control" name="producer" type="text">
          </div>
          <div class="col">
            <label for="music">Music:</label>
            <input class="form-control" name="music" type="text">
          </div>
          <div class="col">
            <label for="studio">Studio:</label>
            <input class="form-control" name="studio" type="text">
          </div>
        </div>
      </div>
      <div class="form-group my-2">
        <div class="row">
          <div class="col">
            <label for="country">Country:</label>
            <select class="form-control" name="country">
              <option>Sofia</option>
              <option>Bansko</option>
              <option>Ruse</option>
              <option>Burgas</option>
            </select>
          </div>
          <div class="col">
            <label for="trailer">Trailer(URL):</label>
            <input class="form-control" name="trailer" type="url">
          </div>
        </div>
      </div>
      <!-- Movie Poster -->
      <div class="form-group">
        <label for="image">Image: </label>
        <input type="file" class="form-control-file" name="poster">
      </div>
      <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
  </div>
@endsection

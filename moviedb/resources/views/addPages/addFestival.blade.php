

@extends('layouts.master')
@section('body')

  <div class="container">
<x-alert/>

    <form id="add-festival-form" action='/festivals/add' method='POST'>
      @csrf
      <div class="form-group my-2">
        <div class="row">
          <div class="col">
            <label for="festival-name">Festival Name:</label>
            <input class="form-control" type="text" name='name'>
          </div>
          <div class="col">
            <label for="festival-date">Date</label>
            <input class="form-control" id="datepicker" name="date" type="date" autocomplete="off" />
          </div>
          <div class="col">
            <label for="festival-location">Festival Location:</label>
            <input class="form-control" type="text" name='location'>
          </div>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="festival-info">Bio:</label>
        <textarea class="form-control" rows="5" name="description"></textarea>
      </div>
      <div class="form-group">
        <label for="image">Image: </label>
        <input type="file" class="form-control-file" name="festival-img">
      </div>
      <ol>
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
      </ol>
      <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
  </div>
@endsection
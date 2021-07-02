@extends('layout.baseLayout')

@section('content')
  <div class="container d-flex flex-column justify-content-center" style="height: 75vh; width:100vw;">
    @if ($errors->any())
      <div class="alert alert-danger row">
        @foreach ($errors->all() as $error)
          <li><strong>{{ $error }}</strong></li>
        @endforeach
      </div>
    @endif
    <form class="row d-flex align-items-center flex-column py-3 w-100" action="{{ route('room.store') }}" method="POST"
      enctype="multipart/form-data">
      @csrf
      <h3 class="col-5 p-0 mb-5"><strong>Room creation:</strong></h3>

      <div class="col-md-5">
        <div class="row d-flex align-items-center mb-4 p-0">
          <label for="room_type" class="form-label col-md-4 m-0 p-0">Room Type:</label>
          <div class="col-md-8 p-0">
            <input type="text" class="form-control" id="room_type" name='room_type' required>
          </div>
        </div>

        <div class="row d-flex align-items-center mb-4 p-0">
          <div class="col-6 d-flex align-items-center p-0">
            <label for="room_number" class="form-label col-md-8 m-0">Room Number:</label>
            <div class="col-md-4 p-0">
              <input type="number" class="form-control" id="room_number" name='room_number' required>
            </div>
          </div>

          <div class="col-1"></div>

          <div class="col-5 d-flex align-items-center p-0">
            <label for="oppervlakte" class="form-label col-md-7 m-0 p-0">Oppervlakte:</label>
            <div class="col-md-5 p-0">
              <input type="number" class="form-control" id="oppervlakte" name='oppervlakte' required>
            </div>
          </div>

        </div>

        <div class="row d-flex align-items-center mb-4 p-0">

          <div class="col-6 d-flex align-items-center p-0">
            <label for="flexSwitchCheckDefault">The room has a minibar?</label>
            <div class="form-check m-0 ms-2" style="position: relative; top:0.1rem;">
              <input class="form-check-input" type="checkbox" id="has_minibar" name='has_minibar'>
            </div>
          </div>

          <div class="col-6 d-flex align-items-center p-0 justify-content-end">
            <label for="flexSwitchCheckDefault">The room has a bath?</label>
            <div class="form-check m-0 ms-2" style="position: relative; top:0.1rem;">
              <input class="form-check-input" type="checkbox" id="has_bath" name='has_bath'>
            </div>
          </div>

        </div>

        <div class="row d-flex align-items-center mb-4 p-0">
          <div class="col-9 d-flex align-items-center p-0">
            <label for="people_it_comports" class="form-label col-md-7 m-0 ">How many people it comports:</label>
            <div class="col-md-2">
              <input type="number" class="form-control" id="people_it_comports" name='people_it_comports' required>
            </div>
          </div>

          <div class="col-3 d-flex align-items-center p-0">
            <label for="price" class="form-label col-md-5 m-0">Price:</label>
            <div class="col-md-7">
              <input type="number" class="form-control" id="price" name='price' required>
            </div>
          </div>

        </div>

        <div class="row mb-4 d-flex flex-row align-items-center">
          <label for="photo" class="form-label p-0 col-2 p-0 pr-2">Photo:</label>
          <div class="col-10 p-0">
            <input class="form-control" type="file" id="photo" name="photo" required>
          </div>
        </div>

        <div class="row d-flex justify-content-end p-0">
          <button type="submit" class="btn btn-primary col-3">Create</button>
        </div>
      </div>
    </form>
  </div>
@endsection

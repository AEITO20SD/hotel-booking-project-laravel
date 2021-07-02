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
    <form class="row d-flex align-items-center flex-column py-3 w-100"
      action="{{ route('room.bookings.store', ['room' => $room_id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="col-5 p-0 mb-5"><strong>Booking registration:</strong></h3>

      <div class="col-md-5">
        <div class="row d-flex align-items-center mb-4 p-0">
          <label for="name" class="form-label col-md-4 m-0 p-0">Costumer Name:</label>
          <div class="col-md-8 p-0">
            <input type="text" class="form-control" id="name" name='name' required>
          </div>
        </div>

        <div class="row d-flex align-items-center mb-4 p-0">
          <label for="name" class="form-label col-md-4 m-0 p-0">Costumer Email:</label>
          <div class="col-md-8 p-0">
            <input type="email" class="form-control" id="email" name='email' required>
          </div>
        </div>

        <div class="row d-flex align-items-center mb-4 p-0">
          <label for="credit_card_number" class="form-label col-md-4 m-0 p-0">Credit card number:</label>
          <div class="col-md-8 p-0">
            <input type="text" class="form-control" id="credit_card_number" name='credit_card_number' required>
          </div>
        </div>

        <div class="row d-flex align-items-center mb-4 p-0">
          <div class="col-6 d-flex align-items-center p-0">
            <label for="arrival_date" class="form-label col-md-4 m-0">Arrival:</label>
            <div class="col-md-8 p-0">
              <input type="date" class="form-control" id="arrival_date" name='arrival_date' required>
            </div>
          </div>

          <div class="col-6 d-flex align-items-center p-0">
            <label for="departure" class="form-label col-md-4 m-0 ps-2">Departure:</label>
            <div class="col-md-8 p-0">
              <input type="date" class="form-control" id="departure" name='departure' required>
            </div>
          </div>

        </div>

        <div class="row d-flex justify-content-end p-0">
          <button type="submit" class="btn btn-primary col-3">Book</button>
        </div>
      </div>
    </form>
  </div>
@endsection

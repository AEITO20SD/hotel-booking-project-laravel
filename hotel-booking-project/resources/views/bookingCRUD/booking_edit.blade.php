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
      action="{{ route('room.bookings.update', ['room' => $booking->room_id, 'booking' => $booking->id]) }}"
      method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <h3 class="col-5 p-0 mb-5"><strong>Booking update:</strong></h3>

      <div class="col-md-5">
        <div class="row d-flex align-items-center mb-4 p-0">
          <label for="name" class="form-label col-md-4 m-0 p-0">Costumer Name:</label>
          <div class="col-md-8 p-0">
            <input type="text" class="form-control" id="name" name='name' required value="{{ $booking->name }}">
          </div>
        </div>

        <div class="row d-flex align-items-center mb-4 p-0">
          <label for="credit_card_number" class="form-label col-md-4 m-0 p-0">Credit card number:</label>
          <div class="col-md-8 p-0">
            <input type="text" class="form-control" id="credit_card_number" name='credit_card_number' required
              value="{{ $booking->credit_card_number }}">
          </div>
        </div>

        <div class="row d-flex align-items-center mb-4 p-0">
          <div class="col-6 d-flex align-items-center p-0">
            <label for="arrival_date" class="form-label col-md-4 m-0">Arrival:</label>
            <div class="col-md-8 p-0">
              <input type="date" class="form-control" id="arrival_date" name='arrival_date' required
                value="{{ $booking->arrival_date }}">
            </div>
          </div>

          <div class="col-6 d-flex align-items-center p-0">
            <label for="departure" class="form-label col-md-4 m-0 ps-2">Departure:</label>
            <div class="col-md-8 p-0">
              <input type="date" class="form-control" id="departure" name='departure' required
                value="{{ $booking->departure }}">
            </div>
          </div>

        </div>

        <div class="row d-flex justify-content-end p-0">
          <button type="submit" class="btn btn-primary col-3">Update</button>
        </div>
      </div>
    </form>
  </div>
@endsection

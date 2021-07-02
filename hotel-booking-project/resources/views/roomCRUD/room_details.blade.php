@extends('layout.baseLayout')

@section('content')
  <div class="container py-3" style="min-height: 75vh; width:100vw;">
    <div class="row p-0 d-flex justify-content-center">
      <div class="col-4" style="height: 450px;">
        <img src="{{ asset($room->photo_path) }}" class="w-100 h-100">
      </div>

      <div class="col-3 d-flex flex-column align-items-start ms-4">
        <style>
          .list-group {
            width: 100%;
          }

          .list-group li {
            margin-bottom: 0.7rem;
            font-size: 1.2rem;
          }

        </style>
        <ul class="list-group list-group-flush">

          <li class="d-flex justify-content-between">
            <strong>Room type:</strong>
            {{ $room->room_type }}
          </li>
          <li class="d-flex justify-content-between">
            <strong>Room number:</strong>
            {{ $room->room_number }}
          </li>
          <li class="d-flex justify-content-between">
            <strong>Oppervlakte:</strong>
            {{ $room->oppervlakte }}m²
          </li>
          <li class="d-flex justify-content-between">
            <strong>Has a minibar:</strong>
            <strong class="m-0 {{ $room->has_minibar ? 'text-success' : 'text-danger' }}">
              {{ $room->has_minibar ? 'yes' : 'no' }}
            </strong>
          </li>
          <li class="d-flex justify-content-between">
            <strong>Has a bath:</strong>
            <strong class="m-0 {{ $room->has_bath ? 'text-success' : 'text-danger' }}">
              {{ $room->has_bath ? 'yes' : 'no' }}
            </strong>
          </li>
          <li class="d-flex justify-content-between">
            <strong>People it comports:</strong>
            {{ $room->people_it_comports }}
          </li>
          <li class="d-flex justify-content-between">
            <strong>Price:</strong>
            ${{ $room->price }}
          </li>
        </ul>
      </div>
    </div>

    <div class="row justify-content-center mt-3">
      <div class="col-10">
        <h3>Booking for this room:</h3>
        <table class="table table-striped col-10">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Arrival</th>
              <th scope="col">Departure</th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 0;
            @endphp

            @foreach ($bookings as $booking)
              <tr>
                <th scope="row">{{ ++$i }}</th>
                <td>{{ $booking->arrival_date }}</td>
                <td>{{ $booking->departure }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

    <div class="row d-flex justify-content-center p-0 mt-5">
      <div class="col-7 d-flex justify-content-end p-0">

        <script>
          function submit() {
            if (confirm('Are you sure you want to delete it?'))
              document.getElementById('delete_form_submit').click();
          }
        </script>

        <div class="col-6 p-0 d-flex justify-content-end">
          @if (auth()->user())
            <button class="btn btn-danger col-5" onclick="submit()">Delete</button>
            <form action="{{ route('room.destroy', $room->id) }}" hidden method="POST">
              @method('DELETE')
              @csrf
              <button type="submit" id="delete_form_submit"></button>
            </form>
            <div class="col-1"></div>
            <a class="btn btn-primary col-5" href="{{ route('room.edit', $room->id) }}">Update</a>
          @else
            <a class="btn btn-primary col-5" href="{{ route('room.bookings.create', ['room' => $room->id]) }}">Book</a>
          @endif
        </div>

      </div>
    </div>
  </div>
@endsection

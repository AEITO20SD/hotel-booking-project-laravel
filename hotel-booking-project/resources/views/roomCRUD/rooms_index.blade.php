@extends('layout.baseLayout')

@section('content')
  <div style="min-height: 75vh;">
    <div class="container d-flex flex-wrap py-3 justify-content-start" style="width:100vw;">
      @if (!sizeof($rooms))
        <div class="m-auto">
          <h4>No rooms registered!</h4>
        </div>
      @else
        @foreach ($rooms as $room)
          <div class="p-2 px-3 rounded" style="box-shadow: 0 0 2px #0d6efd; width:22%; height: auto;">
            <div class="row" style="height: 200px;">
              <img src="{{ asset($room->photo_path) }}" class="w-100 h-100">
            </div>

            <ul class="text-decoration-none list-unstyled mt-2">
              <style>
                li {
                  margin-bottom: 0.3rem;
                }

              </style>
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

            <style>
              .btn {
                font-size: 1rem;
              }

            </style>

            <div class="row justify-content-end px-2">
              <a class="btn btn-primary col-5" href="{{ route('rooms.show', $room->id) }}">Details</a>
            </div>
          </div>
          <div style="width: 3%;"></div>
        @endforeach
      @endif

    </div>
  </div>

  @if (session()->has('ROOM_DELETED'))
    <script>
      alert('Room deleted');
    </script>
  @endif

@endsection

@extends('layout.baseLayout')

@section('content')
  <div
    class="container d-flex flex-column {{ sizeof($bookings) ? 'justify-content-start' : 'justify-content-center' }} "
    style="min-height: 75vh; width:100vw;">
    @if ($errors->any())
      <div class="alert alert-danger row">
        @foreach ($errors->all() as $error)
          <li><strong>{{ $error }}</strong></li>
        @endforeach
      </div>
    @endif
    @if (!session()->has('client_email'))
      @include('bookingCRUD.set_email_form')
    @else
      @if (!sizeof($bookings))
        <div class="m-auto">
          <h4>No bookings made with this email</h4>
        </div>
      @else
        <div class="row justify-content-center mt-3">
          <div class="col-10">
            <h3>Booking for this room:</h3>
            <table class="table table-striped col-10">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Arrival</th>
                  <th scope="col" class="text-center">Departure</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $i = 0;
                @endphp

                @foreach ($bookings as $booking)
                  <tr>
                    <th scope="row" class="align-middle text-center">{{ ++$i }}</th>
                    <td class="align-middle text-center">{{ $booking->arrival_date }}</td>
                    <td class="align-middle text-center">
                      {{ $booking->departure }}
                    </td>
                    <td class="text-center ">
                      <a class="btn btn-primary"
                        href="{{ route('room.bookings.edit', ['room' => $booking->room_id, 'booking' => $booking->id]) }}">
                        Update
                      </a>
                      <script>
                        function submit() {
                          if (confirm('Are you sure you want to delete it?'))
                            document.getElementById('delete_form_submit').click();
                        }
                      </script>
                      <form
                        action="{{ route('room.bookings.destroy', ['room' => $booking->room_id, 'booking' => $booking->id]) }}"
                        method="post" hidden>
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="delete_form_submit"></button>
                      </form>
                      <a class="btn btn-danger" onclick="submit()">Cancel</a>

                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
    @endif
  </div>
  @if (session()->has('BOOKING_DELETED'))
    <script>
      alert('Booking deleted');
    </script>
  @endif
@endsection

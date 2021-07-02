<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DUO VAGO</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
  <header class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-column align-items-center logo-area">
      <i class="bi bi-book" id="logo-book"></i>
      <h4>DuoVago</h4>
    </div>

    <nav>
      <ul class="nav justify-content-end px-4 py-3">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('rooms.index') }}">Available Rooms</a>
        </li>
        @if (!auth()->user())
          <li class="nav-item">
            <a class="nav-link" href="{{ route('bookings.index') }}">My bookings</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="{{ route('hotel_facilities') }}">Hotel Facilities</a>
        </li>
        @if (auth()->user())
          <li class="nav-item">
            <a class="btn btn-primary" href="{{ route('room.create') }}">Add a room</a>
          </li>
          <li class="nav-item ms-2">
            <form action="{{ route('admin_logout') }}" method="POST">
              @csrf
              <button class="btn btn-secondary" type="submit">Logout</button>
            </form>
          </li>
        @endif
      </ul>
    </nav>
  </header>


  @yield('content')

  <footer class="col-lg-12 py-2">
    <div class="col-md-5 offset-4 d-flex justify-content-center flex-column">
      <p class="mb-0">Duo Vago is hotel booking company working in the field for years, and now we have our own website!
      </p>
      <p>Come and make your reservation right away!</p>
    </div>
    <div class="col-md-12 d-flex justify-content-center align-items-center">
      <a href="#" class="media-icon">
        <i class="bi bi-facebook"></i>
      </a>
      <a href="#" class="media-icon">
        <i class="bi bi-instagram"></i>
      </a>
      <a href="#" class="media-icon">
        <i class="bi bi-youtube"></i>
      </a>
      <a href="#" class="media-icon">
        <i class="bi bi-linkedin"></i>
      </a>
    </div>

    <div class="col-md-12 d-flex justify-content-center align-items-center">
      <h5>&copy; copyrights reserved</h4>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

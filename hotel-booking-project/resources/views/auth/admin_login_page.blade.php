@extends('layout.baseLayout')

@section('content')
  <div class="container d-flex align-items-center" style="height: 75vh; width:100vw;">
    <form class="row d-flex align-items-center flex-column py-3 w-100" action="{{ route('admin_login_post') }}"
      method="POST">
      @csrf
      @if ($errors->any())
        <div class="alert alert-danger col-md-5">
          <strong>
            Wrong credentials
        </div>
      @endif
      <div class="col-md-5">
        <div class="col-12 d-flex align-items-center mb-4 p-0">
          <label for="inputEmail4" class="form-label col-md-4 m-0">Email:</label>
          <div class="col-md-7">
            <input type="email" class="form-control" id="email" name='email' required>
          </div>
        </div>
        <div class="col-12 d-flex align-items-center mb-4 p-0">
          <label for="inputPassword4" class="form-label col-md-4 m-0">Password</label>
          <div class="col-md-7">
            <input type="password" class="form-control" id="password" name='password' required>
          </div>
        </div>
        <div class="col-12 d-flex justify-content-end p-0">
          <button type="submit" class="btn btn-primary me-5">Sign in</button>
        </div>
      </div>
    </form>
  </div>

@endsection

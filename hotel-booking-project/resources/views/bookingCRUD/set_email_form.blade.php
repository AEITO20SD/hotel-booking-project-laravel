<form class="row d-flex align-items-center flex-column py-3 w-100" action="{{ route('bookings.set_email') }}"
  method="POST">
  @csrf
  <h3 class="col-5 p-0 mb-5"><strong>Please, enter your email:</strong></h3>
  <div class="col-md-5">
    <div class="row d-flex align-items-center mb-4 p-0">
      <label for="name" class="form-label col-md-4 m-0 p-0">Costumer Email:</label>
      <div class="col-md-8 p-0">
        <input type="email" class="form-control" id="email" name='email' required>
      </div>
    </div>

    <div class="row d-flex justify-content-end p-0">
      <button type="submit" class="btn btn-primary col-3">Send</button>
    </div>
  </div>
</form>

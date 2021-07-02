@extends('layout.baseLayout')

@section('content')
  <div class="container d-flex py-3 align-items-center" style="width:100vw;min-height: 75vh;">
    <div class="m-auto">
      <h4>We are a online booking site! Come <a href="{{ route('rooms.index') }}">book rooms with us!</a></h4>
    </div>
  </div>
@endsection

{{--Admin login:--}}
{{--email: admin@example.com--}}
{{--User Avatar--}}
{{--password: 123456789--}}

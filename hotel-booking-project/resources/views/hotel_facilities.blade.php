@extends('layout.baseLayout')

@section('content')
  <div class="container d-flex flex-column py-3 justify-content-start" style="width:100vw;min-height: 75vh;">
    <style>
      img {
        height: 100%;
        width: 100%;
      }

      .blue-box {
        box-shadow: 0 0 2px #0d6efd;
        border-radius: 10px;
      }

    </style>
    <div class="row justify-content-center my-2">
      <div class="col-9 row py-3 d-flex blue-box">
        <div class="col-5" style="height: 200px;">
          <img src="https://leisurepoolsusa.com/wp-content/uploads/2020/06/best-type-of-swimming-pool-for-my-home_2.jpg"
            alt="">
        </div>
        <div class="col-7">
          <h4>Our hotel has an amazing pool!</h4>
          <p>Fun for the kids in our amazing swimming pool! </p>
        </div>
      </div>

    </div>
    <div class="row justify-content-center my-2">
      <div class="col-9 row py-3 d-flex blue-box">
        <div class="col-7">
          <h4>Our hotel has a cassino!</h4>
          <p>Play until you have no more money to play or win it all in our amazing cassino! </p>
        </div>
        <div class="col-5" style="height: 200px;">
          <img
            src="https://super.abril.com.br/wp-content/uploads/2018/07/563263e482bee127f1034e75temporada-de-cruzeiros-2012-2013-no-brasil-pullmantur-navio-empress-cassino-foto-pullmantur-divulgacao.jpeg"
            alt="">
        </div>
      </div>

    </div>
    <div class="row justify-content-center my-2">
      <div class="col-9 row py-3 d-flex blue-box">
        <div class="col-5" style="height: 200px;">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWDZLexqKdwxG2eVYH-oC3Ki33JrmYIIQF2w&usqp=CAU"
            alt="">
        </div>
        <div class="col-7">
          <h4>Our hotel has a park!</h4>
          <p>Let the kids play in our park while you have your own fun! </p>
        </div>
      </div>

    </div>


  </div>
@endsection

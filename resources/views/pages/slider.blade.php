@extends('layouts.slider')

@section('description')
@endsection
@section('keywords')
@endsection
@section('title')
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row">
      <!-- Carousel Card -->
      <div class="card card-raised card-carousel">
        <div id="carousel-example-generic" class="carousel" data-ride="carousel">
          <div class="carousel" data-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
              <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              @foreach($sliders as $slider)
              @if($slider->order == 1)
              <div class="item active">
                <img src="{{ $slider->image_path }}" alt="">
                <div class="carousel-caption">
                </div>
              </div>
              @else
              <div class="item">
                <img src="{{ $slider->image_path }}" alt="">
                <div class="carousel-caption">
                </div>
              </div>
              @endif
              @endforeach

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <i class="material-icons">keyboard_arrow_left</i>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <i class="material-icons">keyboard_arrow_right</i>
            </a>
          </div>
        </div>
      </div>
      <!-- End Carousel Card -->
    </div>
  </div>
@endsection

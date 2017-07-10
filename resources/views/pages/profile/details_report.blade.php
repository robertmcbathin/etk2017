@extends('layouts.profile')
@section('description')
@endsection
@section('keywords') 
@endsection
@section('title')
Поездки и списания
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/triangle-background.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Поездки и списания</h4>
        </div>
      </div>
        <div class="row">
          <div class="col-md-7">
          @if ($trips)
           <div class="table-responsive">
            <table class="table table-striped">
              <tbody>
                @if (count($trips) > 0)
                <thead>
                  <tr>
                    <th>Дата и время</th>
                    <th>Маршрут</th>
                    <th>Стоимость</th>
                  </tr>
                </thead>
                @foreach ($trips as $trip)
                <tr>
                    <td>{{ $trip->DATE_OF }}</td>
                    <td> <img src="/images/icons/{{$trip->transport_type}}.png" alt=""> {{ $trip->name }}</td>
                    <td>{{ $trip->AMOUNT }} <i class="fa fa-ruble"></i></td>
                    </tr>
                    @endforeach
                    @else
                    <h4>Поездок нет</h4>
                    @endif
                  </tbody>

                </table>
              </div>
          @else
          <h4>К сожалению, данных по карте нет</h4>
          @endif
        <div class="row">
            <div class="card-content text-center">
                <?php echo $trips->render(); ?>
            </div>
        </div>
          </div>
          <div class="col-md-5">
                              <div class="card">
                        <div class="card-header card-header-icon" data-background-color="blue">
                            <i class="material-icons">timeline</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Coloured Bars Chart
                                <small> - Rounded</small>
                            </h4>
                        </div>
                        <div id="colouredBarsChart" class="ct-chart"></div>
                    </div>
              <div class="card">
                                <div class="card-header card-header-icon" data-background-color="blue">
                                    <i class="material-icons">timeline</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">График списаний
                                    </h4>
                                </div>
                                <div id="colouredRoundedLineChart" class="ct-chart"></div>
                            </div>
          </div>
        </div>

    </div>
  </div>
</div>
@endsection






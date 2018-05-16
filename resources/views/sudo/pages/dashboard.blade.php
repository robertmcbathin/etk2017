@section('title')
Панель управления
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Вопросы</p>
                            <h3 class="card-title">{{$questions_count}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">list</i><a href="">Перейти к вопросам</a> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">query_builder</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Ожидают активации</p>
                            <h3 class="card-title">{{$waiting_for_activation}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                            <i class="material-icons">contact_mail</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Всего пользователей</p>
                            <h3 class="card-title">{{$users_count}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            </div>
                        </div>
                    </div>
                </div>
                @if ($new_detailing_requests_count > 0)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Новые запросы на детализацию</p>
                            <h3 class="card-title">{{$new_detailing_requests_count}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if ($new_detailing_requests_count == 0)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Новые запросы на детализацию</p>
                            <h3 class="card-title">{{$new_detailing_requests_count}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                                <div class="card-header card-header-icon" data-background-color="red">
                                    <i class="material-icons">pie_chart</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Перекодированные карты</h4>
                                </div>
                                <div id="chartRecodingPreferences" class="ct-chart"></div>
                                <div class="card-footer">
                                    <h6>Описание</h6>
                                    <i class="fa fa-circle text-info"></i> Формат В
                                    <i class="fa fa-circle text-warning"></i> Формат А
                                    <br>
                                    Всего активных карт за 3 месяца: {{ $cards_count }}, из них перекодировано {{ $recoded_cards_count }}
                                </div>
                            </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">

                        <div class="card-header" data-background-color="green">
                            <i class="material-icons"></i>
                        </div>
                        
                        <div class="card-content">
                            <p class="category">Статус системы пополнения</p>
                            <h3 class="card-title">{{$new_detailing_requests_count}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="green">
                            <i class="material-icons">timeline</i>
                        </div>
                        <div class="card-content">
                        <h4 class="card-title">Новые пользователи
                                <small> - по дням</small>
                            </h4>
                        </div>
                        <div id="newUsersChart" class="ct-chart"></div>
                    </div>
                </div>
            </div>
                            <div class="col-md-6">
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
                </div>
            <div class="row">
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul>
                    <li>
                        <a href="dashboard.html#">
                            Панель управления
                        </a>
                        <?php echo date('l jS \of F Y h:i:s A'); ?>
                    </li>
                </ul>
            </nav>
            <p class="copyright pull-right">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>
                ООО "Единая транспортная карта"
            </p>
        </div>
    </footer>
</div>
<script>
   /*  **************** sbDepositChart Line Chart - Line Chart ******************** */

   var sbDepositDays = 
   [
   @foreach ($sbDeposits as $sbDeposit) 
   '{{ $sbDeposit->day_of_month }}' ,
   @endforeach];
   var sbDepositSeries = 
   [
   @foreach ($sbDeposits as $sbDeposit) 
   {{ $sbDeposit->amount }} ,
   @endforeach];


   /*  **************** newUsersChart Line Chart - Line Chart ******************** */  

    var newUsersDays = 
   [
   @foreach ($newUsers as $newUser) 
   '{{ $newUser->day_of_month }}' ,
   @endforeach
   ];
   var newUsersSeries = 
   [
   @foreach ($newUsers as $newUser) 
   {{ $newUser->amount }} ,
   @endforeach
   ];

   /*  **************** newUsersChart Line Chart - Line Chart ******************** */  

   var recodingCards = 
   [
   {{ $recoded_cards_percent }}, {{ $non_recoded_cards_percent }}
   ];
</script>
@endsection
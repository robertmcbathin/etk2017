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
                <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-text" data-background-color="orange">
                                    <h4 class="card-title">Блокировка карт</h4>
                                </div>
                                <div class="card-content table-responsive">
                                <div class="form-group">
                                        <label class="label-control">Выбрать дату</label>
                                        <input type="text" class="form-control datepicker" value="10/10/2016">
                                    <span class="material-input"></span></div>
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                            <tr><th>ID</th>
                                            <th>Name</th>
                                            <th>Salary</th>
                                            <th>Country</th>
                                        </tr></thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Dakota Rice</td>
                                                <td>$36,738</td>
                                                <td>Niger</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Minerva Hooper</td>
                                                <td>$23,789</td>
                                                <td>Curaçao</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Sage Rodriguez</td>
                                                <td>$56,142</td>
                                                <td>Netherlands</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Philip Chaney</td>
                                                <td>$38,735</td>
                                                <td>Korea, South</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
@endsection
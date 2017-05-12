@section('title')
Детализация поездок
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>                
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-shopping">
                                 <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Начало периода</th>
                                    <th>Окончание периода</th>
                                    <th>Причина</th>
                                    <th class="text-right">Статус</th>
                                    <th class="text-right">Срок</th>
                                  </tr>
                                </thead>
                                @foreach ($requests as $request)
                                <tr>
                                  <td>{{$request->id}}</td>
                                  <td>{{$request->date_start}}</td>
                                  <td>{{$request->date_end}}</td>
                                  <td>{{$request->reason}}</td>
                                  @if ($request->status == 1)
                                  <td class="text-right"><span class="label label-warning">Новый</span></td>
                                  @endif
                                  @if ($request->status == 2)
                                  <td class="text-right"><span class="label label-info">Принят к обработке</span></td>
                                  @endif
                                  @if ($request->status == 3)
                                  <td class="text-right"><span class="label label-success">Готов</span></td>
                                  @endif
                                  <td class="text-right">{{$request->estimated}}</td>
                                </tr>
                                @endforeach
                                <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-content" style="float:right;">
                <?php echo $requests->render(); ?>
            </div>
        </div>
    </div>
</div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="{{route('sudo.pages.dashboard')}}">
                        Панель управления
                    </a>
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
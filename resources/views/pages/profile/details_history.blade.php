@extends('layouts.profile')
@section('description')
@endsection
@section('keywords') 
@endsection
@section('title')
История запросов на детализацию
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h3 class="title">История запросов на детализацию</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="table-responsive">
            <table class="table table-striped">
              <tbody>
                @if (count($requests) > 0)
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Начало периода</th>
                    <th>Окончание периода</th>
                    <th>Причина</th>
                    <th class="text-right">Статус</th>
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
                  <td class="text-right"><span class="label label-success">Готов</span>
                    <a class="btn btn-success" href="{{ $request->filepath }}" target="_blank">
                      <span class="btn-label">
                        <i class="material-icons">file_download</i>
                      </span>
                      Открыть файл
                      <div class="ripple-container"></div></a></td>
                      @endif
                    </tr>
                    @endforeach
                    @else
                    <h3>Запросов детализации не поступало</h3>
                    @endif
                  </tbody>

                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    @endsection






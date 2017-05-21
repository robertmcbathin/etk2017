@extends('layouts.profile')
@section('description')
@endsection
@section('keywords') 
@endsection
@section('title')
История пополнения карты (Сбербанк)
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h3 class="title">История пополнения</h3>
        </div>
      </div>
      <div class="row">
        <div class="alert alert-info">
          <div class="container">
            <div class="alert-icon">
              <i class="material-icons">info_outline</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>

            <b>Внимание:</b> Отображается история пополнения через терминалы Сбербанка (информация доступна на следующий рабочий день после 10:00).
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-md-8 col-md-offset-2">
                                        <div class="table-responsive">
                          <h3 id="operations-results-none"></h3><table class="table table-striped">
                          <tbody>
                            @if (count($operations) > 0)
                            <thead>
                              <tr>
                                <th>Номер карты</th>
                                <th>Транзакция</th>
                                <th>Терминал</th>
                                <th class="text-right">Сумма</th>
                                <th class="text-right">Дата</th>
                              </tr>
                            </thead>
                            @foreach ($operations as $operation)
                            <tr>
                              <td>{{$operation->card_number}}</td>
                              <td>{{$operation->transaction_number}}</td>
                              <td>{{$operation->terminal_number}}</td>
                              <td class="text-right">{{$operation->value}}</td>
                              <td class="text-right">{{$operation->transaction_date}}</td>
                            </tr>
                            @endforeach
                            <small>Последнее обновление базы данных: <strong>{{ $last_import }}</strong></small>
                            @else
                            <h4>Пока данных нет</h4>
                            <small>Последнее обновление базы данных: <strong>{{ $last_import }}</strong></small>
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






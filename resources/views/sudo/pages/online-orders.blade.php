@section('title')
Онлайн-заказы на пополнение
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
            <script>
              var token = '{{ Session::token() }}';
          </script>
          @if (Session::has('success'))
          <div class="row">
              <div class="container">
                <div class="alert alert-success">
                  <div class="container">
                    <div class="alert-icon">
                      <i class="material-icons">error_outline</i>
                  </div>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"><i class="material-icons">clear</i></span>
                  </button>
                  <strong>{{Session::pull('success')}}</strong>
              </div>
          </div>  
      </div>
  </div>
  @endif
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">credit_card</i>
            </div>                
            <h4 class="card-title">Онлайн-заказы на пополнение -
            </h4>
            <div class="card-content">
                <div class="row">
                    <label class="col-sm-2 label-on-left"></label>
                    <div class="col-sm-2">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input id="card_serie" class="form-control compensations-handler" type="text" name="required" required="true" aria-required="true" placeholder="00"  minlength="2" maxlength="2">
                            <span class="material-input">Серия 2 цифры (по умолчанию 23)</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"></label>
                            <input id="card_number" class="form-control compensations-handler" type="text" name="required" required="true" aria-required="true" placeholder="000 000"  minlength="6" maxlength="6">
                            <span class="material-input">Последние 6 цифр</span></div>
                        </div>
                        <label class="col-sm-2 label-on-right">
                        </label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Список заказов</h4>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th># заказа</th>
                                            <th>Заказчик</th>
                                            <th># карты</th>
                                            <th class="text-right">Сумма к пополнению</th>
                                            <th class="text-right">Сумма к списанию</th>
                                            <th class="text-right">Тип заказа</th>
                                            <th class="text-right">Статус оплаты</th>
                                            <th class="text-right">Статус ОП</th>
                                            <th class="text-right">Дата</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">
                                        @foreach ($orders as $order)
                                        <tr>
                                            <th>{{ $order->id }}</th>
                                            <th>{{ $order->order_name }}</th>
                                            <th>{{ $order->name }}</th>
                                            <th>{{ $order->card_number }}</th>
                                            <th class="text-right">{{ $order->payment_to_card }}</th>
                                            <th class="text-right">{{ $order->payment_to_acquirer }}</th>
                                            @if ($order->order_type == 1)
                                             <td class="text-right"><img src="/admin/img/logo.jpg" alt=""></td>
                                             @endif
                                             @if ($order->order_type == 2)
                                             <td class="text-right"><span class="label label-success">Сбербанк Онлайн</span></td>
                                             @endif


                                            @if ($order->payment_status == null)
                                             <td class="text-right"><span class="label label-info">Не оплачен</span></td>
                                             @endif
                                             @if ($order->payment_status == 'paid')
                                             <td class="text-right"><span class="label label-warning">Оплачен</span></td>
                                             @endif
                                             @if ($order->payment_status == 'authorized')
                                             <td class="text-right"><span class="label label-success">Авторизован</span></td>
                                             @endif
                                             @if ($order->payment_status == 'canceled')
                                             <td class="text-right"><span class="label label-danger">Отменен</span></td>
                                             @endif
                                             @if ($order->payment_status == 'waiting')
                                             <td class="text-right"><span class="label label-warning">Ожидается оплата</span></td>
                                             @endif

                                             @if ($order->rewrite_status == 0)
                                             <td class="text-right"><span class="label label-info">Не создано</span></td>
                                             @endif
                                             @if ($order->rewrite_status == 1)
                                             <td class="text-right"><span class="label label-success">Создано</span></td>
                                             @endif
                                            <th class="text-right">{{ $order->created_at }}</th>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="card-content" style="float:right;">
                        <?php echo $orders->render(); ?>
                    </div>
                </div>
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
<script>
  var token = '{{ Session::token() }}';
  var url = '{{ route('ajax.check_card_compensations') }}';
</script>
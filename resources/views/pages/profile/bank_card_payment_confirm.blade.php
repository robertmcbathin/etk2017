@extends('layouts.profile')
@section('description')
личный кабинет держателя карты ЕТК
@endsection
@section('keywords') 
@endsection
@section('title')
Проверка реквизитов платежа
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">

        @if (Session::has('warning'))
        <div class="row">
          <div class="container">
            <div class="alert alert-warning">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('warning')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        
        @if (Session::has('error'))
        <div class="row">
          <div class="container">
            <div class="alert alert-danger">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('error')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('info'))
        <div class="row">
          <div class="container">
            <div class="alert alert-info">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('info')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif

        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Проверка реквизитов платежа</h4>
          <p class="description">
            <b>Внимание:</b> Пополнение производится не моментально, а по типу "отложенное пополнение". Т.е., может достигать <b>до 2-х рабочих дней</b>.
          </p>
          <br>
        </div>

      </div>
      <div class="row">
       <div class="col-md-10 col-md-offset-1">
        <div class="card card-plain card-blog">
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="card-image">
                <img class="img img-raised" src="/images/uniteller.jpg">
                <div class="ripple-container"></div><div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div></div>
              </div>



              <div class="col-md-8 col-sm-12">
                <h2 class="title">Пополнение транспортной карты</h2>
                <div class="row">
                  <p class="pull-right">номер транспортной карты: <b>{{ $current_card }}</b></p>
                </div>
                <div class="row">
                  <p class="pull-right">E-mail: <b>{{ $email }}</b></p>
                </div>
                <div class="row">
                  <p class="pull-right">к зачислению на карту: <b>{{$payment_to_card}} р.е.</b></p>
                </div>
                <div class="row">
                  <p class="pull-right">комиссия: <b>{{$comission}} р.</b></p>
                </div>
                <div class="row">
                  <p class="pull-right">к списанию: <b>{{$payment_to_acquirer}} р.</b></p>
                </div>
                <div class="row">
                <p class="pull-right">дата платежа: 
                <b>
                <script>
                var date = new Date();
                var options = {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric',
                  weekday: 'long',
                  timezone: 'UTC',
                  hour: 'numeric',
                  minute: 'numeric',
                  second: 'numeric'
                };
                document.write(date.toLocaleString("ru",options))
                </script>
                </b>
              </p>
                </div>
                <div id="acordeon">
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-border panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                          <h4 class="panel-title">
                            Гарантия безопасности
                            <i class="material-icons">keyboard_arrow_down</i>
                          </h4>
                        </a>
                      </div>
                      <div id="collapseOne" class="panel-collapsein collapse" aria-expanded="false">
                        <div class="panel-body">
                        <p>Уважаемый клиент!</p>
                        <p>Вы можете оплатить свой заказ онлайн с помощью предложенных методов оплат через
платежный сервис компании <a href="https://uniteller.ru" target="_blank">Uniteller</a>. После подтверждения заказа Вы будете
перенаправлены на защищенную платежную страницу Uniteller, где необходимо будет
ввести данные для оплаты заказа. После успешной оплаты на указанную в форме оплаты
электронную почту будет направлен электронный чек с информацией о заказе и данными по
произведенной оплате. </p>
<b>Гарантии безопасности</b>
<p>Безопасность процессинга Uniteller подтверждена сертификатом стандарта безопасности
данных индустрии платежных карт PCI DSS. Надежность сервиса обеспечивается
интеллектуальной системой мониторинга мошеннических операций, а также применением
3D Secure - современной технологией безопасности интернет-платежей.</p>
<p>Данные Вашей карты вводятся на специальной защищенной платежной странице.
Передача информации в <a href="https://www.uniteller.ru/services/solutions/" target="_blank">процессинговую компанию</a> Uniteller происходит с применением
технологии шифрования TLS. Дальнейшая передача информации осуществляется по
закрытым банковским каналам, имеющим наивысший уровень надежности.</p>
<b>Uniteller не передает данные Вашей карты магазину и иным третьим лицам!</b>
<p>Если Ваша карта поддерживает технологию 3D Secure, для осуществления платежа, Вам
необходимо будет пройти дополнительную проверку пользователя в банке-эмитенте (банк,
который выпустил Вашу карту). Для этого Вы будете направлены на страницу банка,
выдавшего карту. Вид проверки зависит от банка. Как правило, это дополнительный пароль,
который отправляется в SMS, карта переменных кодов, либо другие способы. </p>
<p>Если у Вас возникли вопросы по совершенному платежу, Вы можете обратиться в службу
технической поддержки процессингового центра Uniteller: <a href="mailto:support@uniteller.ru">support@uniteller.ru</a> или по
телефону <b>8 800 100 19 60</b></p>
                        </div>
                      </div>
                    </div>

                 </div>
               </div><!--  end acordeon -->
              <form action="https://wpay.uniteller.ru/pay/" method="POST">
               <div class="row">
               <input type="hidden" name="Shop_IDP" value="{{ $Shop_IDP }}">
               <input type="hidden" name="Order_IDP" value="{{ $Order_IDP }}">
               <input type="hidden" name="Subtotal_P" value="{{ $Subtotal_P }}">
               <input type="hidden" name="Lifetime" value="{{ $Lifetime }}">
               <input type="hidden" name="Customer_IDP" value="{{ $Customer_IDP }}">
               <input type="hidden" name="Signature" value="{{ $Signature }}">
               <input type="hidden" name="URL_RETURN_OK" value="{{ $URL_RETURN_OK }}">
               <input type="hidden" name="URL_RETURN_NO" value="{{ $URL_RETURN_NO }}">
               <input type="hidden" name="email" value="{{ $email }}">
                <input id="submit_payment" type="submit" class="btn btn-success btn-fullwidth" value="Подтвердить заказ">
              </div>
              </form>
            </div>


          </div>
        </div>

      </div>
    </div>
      <div class="row"></div>

    </div>
  </div>
</div>
@endsection






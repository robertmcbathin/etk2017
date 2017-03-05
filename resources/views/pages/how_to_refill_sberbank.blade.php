@extends('layouts.wizard')

@section('description')
Как пополнить транспортную карту ЕТК в терминале Сбербанка
@endsection
@section('keywords')
как пополнить карту етк чебоксары,
@endsection
@section('title')
Как пополнить карту ЕТК в терминале Сбербанка
@endsection
@section('content')
<div class="page-header  simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_sbercard.jpg&quot;); transform: translate3d(0px, 0px, 0px);  ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Как пополнить карту ЕТК</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Как пополнить транспортную карту в терминале Сбербанка</h2>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="purple" id="wizard">
                            <!--        You can switch " data-color="rose" "  with one of the next bright colors: "blue", "green", "orange", "purple"        -->

                            <div class="wizard-header">
                                <h5>При пололнении карты следуйте инструкции</h5>
                            </div>
                            <div class="wizard-navigation">
                                <ul>
                                    <li><a  href="#choice" data-toggle="tab">Меню</a></li>
                                    <li><a href="#card" data-toggle="tab">Карта</a></li>
                                    <li><a href="#enter" data-toggle="tab">Сумма</a></li>
                                    <li><a href="#cashback" data-toggle="tab">Сдача</a></li>
                                    <li><a href="#entry" data-toggle="tab">Внесение</a></li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="choice">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h4 class="info-text">На экране терминала выполните следующие действия </h4>
                                            <hr>
                                            <p>1. ПЛАТЕЖИ НАЛИЧНЫМИ</p>
                                            <p>2. ДРУГИЕ КАТЕГОРИИ</p>
                                            <p>3. ТРАНСПОРТНАЯ КАРТА</p>
                                            <p>4. ТРАНСПОРТНАЯ КАРТА</p>
                                            <p>5. СОГЛАСИТЕСЬ С УСЛОВИЯМИ ПРИЕМА ПЛАТЕЖЕЙ</p>                                        
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="card">
                                                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h4 class="info-text">Далее необходимо приложить карту к устройству и не забирать ее пока операция не выполнится </h4>
                                            <hr>
                                            <p>1. ПРИЛОЖИТЕ КАРТУ К СЧИТЫВАЮЩЕМУ УСТРОЙСТВУ</p>
                                            <p>2. ПРОДОЛЖИТЬ</p>
                                            <p>3. ПРОДОЛЖИТЬ</p>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="enter">
                                                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h4 class="info-text">Теперь можно ввести сумму для пополнения</h4>
                                            <hr>
                                            <p>1. ВВЕДИТЕ СУММУ ПОПОЛНЕНИЯ</p>
                                            <p>2. ПРОДОЛЖИТЬ</p>
                                            <p>3. ПРОДОЛЖИТЬ</p>                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="cashback">
                                                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h4 class="info-text">Далее Вам необходимо выбрать пункт для получения сдачи </h4>
                                            <hr>
                                            <p>1. ВЫБЕРИТЕ СПОСОБ ПОЛУЧЕНИЯ СДАЧИ </p>
                                            <p>2. ВВЕДИТЕ СВОЙ НОМЕР ТЕЛЕФОНА </p>
                                            <p>3. ПРОДОЛЖИТЬ </p>
                                            <p>4. ПРОДОЛЖИТЬ </p>
                                            <p>5. ОПЛАТИТЬ</p>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="entry">
                                                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h4 class="info-text">Теперь Вы можете внести необходимую сумму по одной купюре</h4>
                                            <hr>
                                            <p>1. ВНЕСИТЕ НАЛИЧНЫЕ </p>
                                            <p>2. ДОЖДИТЕСЬ ПОДТВЕРЖДЕНИЯ О ВНЕСЕНИЕ ДАННЫХ НА КАРТУ</p>
                                            <p>3. ЗАБЕРИТЕ КАРТУ</p>
                                            <p>4. ВОЗЬМИТЕ ЧЕК</p>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Далее' />
                                    <input type='button' class='btn btn-finish btn-fill btn-primary btn-wd' name='finish' value='Готово' />
                                </div>
                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Назад' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </div> <!-- row -->  
        </div>
    </div>
</div>

@endsection

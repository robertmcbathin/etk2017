@extends('layouts.map')

@section('description')
Пункты пополнения карт ЕТК
@endsection
@section('keywords')
етк чебоксары пункты пополнения, 
@endsection
@section('title')
Список пунктов пополнения
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_about.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Список пунктов пополнения</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
          <div class="row">
          <h2 class="title">город Чебоксары</h2>
            <h3 class="title">Пункты ЕТК</h3>
            <ul>
              <li>Центральная касса, г.Чебоксары, Московский проспект, 41/1, Пн-Пт: с 8 до 17</li>
            <li>Диспетчерский павильон, г.Чебоксары, ул. Привокзальная, 1а</li>
            </ul>
            <h3 class="title">Отделения Почты России</h3>
            <ul>
            <li>Главпочтамт, г.Чебоксары, пр. Ленина, 2</li>
            <li>Отделение почтовой службы №22, г.Чебоксары, ул. Космонавта Николаева, 57</li>
            <li>Отделение почтовой службы №23, г.Чебоксары, ул. Энтузиастов, 23</li>
            <li>Отделение почтовой службы №27, г.Чебоксары, проспект 9-й Пятилетки, 19/37</li>
            <li>Отделение почтовой службы №28, г.Чебоксары, проспект Тракторостроителей, 63/2</li>
            <li>Отделение почтовой службы №32, г.Чебоксары, улица Ленинградская, 16</li>
            <li>Отделение почтовой службы №34, г.Чебоксары, улица Мичмана Павлова, 58А</li>
            <li>Отделение почтовой службы №37, г.Чебоксары, улица Ленинского Комсомола, 68/2</li>
            <li>Отделение почтовой службы №38, г.Чебоксары, улица Чернышевского, 8</li>
            </ul>
            <h3 class="title">Отделения Сбербанка России</h3>
            <ul>
            <li>Филиал Сбербанка №8613/0001, г.Чебоксары, пр. И. Яковлева, 3а</li>
            <li>Филиал Сбербанка №8613/0002, г.Чебоксары, улица 50 лет Октября, 17</li>
            <li>Филиал Сбербанка №8613/0004, г.Чебоксары, улица Карла Маркса, 22</li>
          <!--  <li>Филиал Сбербанка №8613/0005, г.Чебоксары, улица Ивана Франко, 14</li> -->
            <li>Филиал Сбербанка №8613/0009, г.Чебоксары, улица Б. Хмельницкого, 109</li>
            <li>Филиал Сбербанка №8613/0010, г.Чебоксары, пр. Ленина, 28</li>
            <li>Филиал Сбербанка №8613/0011, г.Чебоксары, улица Энтузиастов, 23</li>
            <li>Филиал Сбербанка №8613/0013, г.Чебоксары, улица Гузовского, 17</li>
            <li>Филиал Сбербанка №8613/0014, г.Чебоксары, улица Ахазова, 8</li>
         <!--   <li>Филиал Сбербанка №8613/0015, г.Чебоксары, улица 324 Стрелковой дивизии, 3б</li>
            <li>Филиал Сбербанка №8613/0016, г.Чебоксары, улица Ашмарина, 19</li> -->
            <li>Филиал Сбербанка №8613/0017, г.Чебоксары, проспект Тракторостроителей, 1/34</li>
            <li>Филиал Сбербанка №8613/0018, г.Чебоксары, проспект Тракторостроителей, 63/21</li>
            <li>Филиал Сбербанка №8613/0019, г.Чебоксары, улица Университетская, 20/1</li>
            <li>Филиал Сбербанка №8613/0020, г.Чебоксары, пр. И. Яковлева, 2а</li>
            <li>Филиал Сбербанка №8613/0021, г.Чебоксары, улица Болгарстроя, 9/11</li>
            <li>Филиал Сбербанка №8613/0022, г.Чебоксары, проспект Тракторостроителей, 35а</li>
            <li>Филиал Сбербанка №8613/0023, г.Чебоксары, Московский проспект, 40</li>
            <li>Филиал Сбербанка №8613/0024, г.Чебоксары, улица Космонавта Николаева, 3</li>
            <li>Филиал Сбербанка №8613/0025, г.Чебоксары, улица Гагарина, 27</li>
            <li>Филиал Сбербанка №8613/0026, г.Чебоксары, улица улица Спиридона Михайлова, 1</li>
            <li>Филиал Сбербанка №8613/0027, г.Чебоксары, проспект Максима Горького, 32/25</li>
            <li>Филиал Сбербанка №8613/0028, г.Чебоксары, улица Гражданская, 83</li>
            <li>Филиал Сбербанка №8613/0029, г.Чебоксары, улица Матэ Залка, 11</li>
            <li>Филиал Сбербанка №8613/0030, г.Чебоксары, проспект 9-й Пятилетки, 18/2</li>
            <li>Филиал Сбербанка №8613/0032, г.Чебоксары, проспект Максима Горького, 10</li>
            <li>Филиал Сбербанка №8613/0034, г.Чебоксары, улица Карла Маркса, 52</li>
            <li>Филиал Сбербанка №8613/0038, г.Чебоксары, улица Мичмана Павлова, 39</li>
            <li>Филиал Сбербанка №8613/0052, г.Чебоксары, Московский проспект, 5</li>
            <li>Филиал Сбербанка №8613/0053, г.Чебоксары, Эгерский бульвар, 21</li>
            <li>Офис самообслуживания Сбербанка, г.Чебоксары, улица 324 Стрелковой дивизии, 13а</li>
            <li>Гимназия №5, г.Чебоксары, Президентский бульвар, 21</li>
            <li>Офис интернет-провайдера Дом.ру, г.Чебоксары, проспект Ленина, 7</li>
            <li>Многофункциональный центр (МФЦ), г.Чебоксары, улица Ленинградская, 36</li>
            <li>Остановка "Агрегатный завод" (мини-офис Сбербанка), г.Чебоксары, проспект Мира, 1</li>
            <li>Остановка "Дом мод" (офис самообслуживания Сбербанка), г.Чебоксары, улица Композиторов Воробьевых, 20</li>
            <li>Остановка "Дорисс-парк" (офис самообслуживания Сбербанка), г.Чебоксары, проспект 9 Пятилетки, 2/3</li>
            <li>Остановка "Кооперативный институт" (офис самообслуживания Сбербанка), г.Чебоксары, проспект М. Горького, 24</li>
            <li>Остановка "Пригородный автовокзал" (офис самообслуживания Сбербанка), г.Чебоксары, проспект Ивана Яковлева, 3</li>
            <li>Остановка "Роща" (офис самообслуживания Сбербанка), г.Чебоксары, улица Гузовского, 4а</li>
            <li>Остановка "Энергозапчасть" (офис самообслуживания Сбербанка),г.Чебоксары, улица Калинина, 112</li>
            <li>Управление пенсионного фонда России по г.Чебоксары, г.Чебоксары, улица Калинина, 109/1</li>
            <li>ФБУ "Кадастровая палата по Чувашской Республике", г.Чебоксары, Московский проспект, 37</li>
            <li>ТРЦ "Каскад", г.Чебоксары, Президентский бульвар, 20</li>
            <li>МТВ-Центр, г.Чебоксары, проспект Ивана Яковлева, 4</li>
            <li>ТРЦ "Мега Молл", г.Чебоксары, улица Калинина, 105а</li>
            <li>Остановка "Улица Афанасьева" (мини-офис), г.Чебоксары, Московский проспект, 17, корпус 1</li>
            </ul>
            <h2 class="title">город Новочебоксарск</h2>
            <h3 class="title">Отделения Почты России</h3>
            <ul>
            <li>Отделение почтовой службы №38, г.Чебоксары, улица Чернышевского, 8</li>
            <li>Отделение почтовой службы №1Н, г.Новочебоксарск, бульвар Гидростроителей, 4</li>
            <li>Отделение почтовой службы №5Н, г.Новочебоксарск, улица Винокурова, 23</li>
            <li>Отделение почтовой службы №6Н, г.Новочебоксарск, улица Винокурова, 111</li>
            <li>Отделение почтовой службы, г.Новочебоксарск, улица 10-й Пятилетки, 24</li>
            </ul>
            <h3 class="title">Отделения Сбербанка России</h3>
            <ul>
            <li>Филиал Сбербанка №8613/0100, г.Новочебоксарск, улица Винокурова, 51</li>
            <li>Филиал Сбербанка №8613/0101, г.Новочебоксарск, улица Винокурова, 20</li>
            <li>Филиал Сбербанка №8613/0102, г.Новочебоксарск, улица Ж.Крутовой, 10а</li>
            <li>Филиал Сбербанка №8613/0104, г.Новочебоксарск, улица Советская, 7</li>
            <li>Филиал Сбербанка №8613/0105, г.Новочебоксарск, улица Советская, 15</li>
            <li>Филиал Сбербанка №8613/0107, г.Новочебоксарск, улица 10-й Пятилетки, 31</li>
            <li>Филиал Сбербанка №8613/0108, г.Новочебоксарск, улица Строителей, 16</li>
            <li>Филиал Сбербанка №8613/0109, г.Новочебоксарск, улица 10-й Пятилетки, 2</li>
         <!--   <li>Филиал Сбербанка №8613/0110, г.Новочебоксарск, улица Советская, 65</li> -->
            </ul>
            <h2 class="title">Кугеси</h3>
            <ul>
              <li>Филиал Сбербанка №8613/0111, п.г.т.Кугеси, улица Советская, 23</li>
            </ul>
            <h2 class="title">Канаш</h3>
            <ul>
              <li>Филиал Сбербанка №8613/0400,г.Канаш, улица Железнодорожная, 87</li>
            </ul>
            <h2 class="title">Шумерля</h3>
            <ul>
              <li>Филиал Сбербанка №8613/0202, г.Шумерля, улица Октябрьская, 11</li>
            </ul>
            <h2 class="title">Цивильск</h3>
            <ul>
              <li>Филиал Сбербанка №8613/0300, г.Цивильск, улица Никитина, 2б</li>
            </ul>
            <h2 class="title">Ядрин</h3>
            <ul>
              <li>Филиал Сбербанка №8613/0226, г.Ядрин, улица Карла Маркса, 20</li>
            </ul>
          </div>  
      </div>
  </div>
</div>

@endsection
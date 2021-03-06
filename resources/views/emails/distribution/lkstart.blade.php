@component('mail::message')
Приветствуем Вас!
Видимо, Вы когда-то задавали вопрос на сайте ЕТК, поэтому получили это письмо.
Мы предлагаем Вам опробовать бета-версию личного кабинета держателя карты ЕТК.
Вы можете пройти регистрацию по ссылке ниже и добавить Вашу карту.

@component('mail::button', ['url' => $url])
Зарегистрироваться!
@endcomponent

На данный момент, Вы можете узнать баланс карты и её состояние.  
Чтобы получить возможность просмотреть отчет по поездкам за последний месяц, создать запрос на детализацию или просмотреть историю пополнения, Вам нужно будет подтвердить карту.
Будем рады услышать Ваши замечания и предложения!
В дороге с Вами,<br>
{{ config('app.name') }}
@endcomponent

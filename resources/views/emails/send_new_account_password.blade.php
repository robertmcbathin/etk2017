@component('mail::message')
Мы получили от Вас запрос на восстановление доступа к личному кабинету держателя карты ЕТК <br>
@component('mail::panel')
Ваш новый пароль: <strong>{{ $password_to_send }}</strong>
@endcomponent
Для активации нового пароля перейдите по ссылке ниже. Это письмо было сгенерировано автоматически, на него не нужно отвечать.

@component('mail::button', ['url' => $url])
Подтвердить изменение пароля
@endcomponent

Всегда вместе с Вами,<br>
{{ config('app.name') }}
@endcomponent

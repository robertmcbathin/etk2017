@component('mail::message')
Здравствуйте, {{ $username }}. Мы получили от Вас запрос на изменение адреса электронной почты.
Для подтверждения нового адреса перейдите по ссылке ниже

@component('mail::button', ['url' => 'http://etk21.ru/profile/change_password/{{$token}}'])
Подтвердить изменение адреса
@endcomponent

Если Вы не запрашивали изменение адреса, просто проигнорируйте это письмо
С наилучшими пожеланиями,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')

Здравствуйте! Мы подготовили для Вас отчет о детализации поездок за указанный период. Вы можете просмотреть и скачать его в личном кабинете

@component('mail::button', ['url' => $url])
Перейти к отчету
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

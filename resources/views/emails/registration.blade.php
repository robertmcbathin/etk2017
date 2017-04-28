<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Активация аккаунта</title>
<link href="/css/email.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body itemscope itemtype="http://schema.org/EmailMessage">

<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" width="600">
      <div class="content">
        <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
          <tr>
            <td class="content-wrap">
              <meta itemprop="name" content="Confirm Email"/>
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    Добро пожаловать в личный кабинет держателя карты ЕТК!
                  </td>
                </tr>
                <tr>
                  <td class="content-block">
                    Вы активировали личный кабинет держателя карты №{{ $card_number }}. Для активации Вашего аккаунта пройдите по ссылке ниже. Ваш пароль: {{ $password }}. Это письмо было сгенерировано автоматически, на него не нужно отвечать.
                  </td>
                </tr>
                <tr>
                  <td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler">
                    <a href="http://etk21.ru/confirm-account/{{$register_token}}" class="btn-primary" itemprop="url">Подтвердить email-адрес</a>
                  </td>
                </tr>
                <tr>
                  <td class="content-block">
                    &mdash; ООО "ЕТК"
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <div class="footer">
          <table width="100%">
            <tr>
              <td class="aligncenter content-block">- <a href="http://etk21.ru">Единая Транспортная Карта</a> -</td>
            </tr>
          </table>
        </div></div>
    </td>
    <td></td>
  </tr>
</table>

</body>
</html>

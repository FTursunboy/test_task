<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Отправка Логина</title>


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    </head>
    <body class="antialiased">
        <div>
            <p>Ваш логиrн: <strong>{{$login}}</strong></p>
            <p>Ваш пароль: <strong>{{$pasword}}</strong></p>
        </div>
    </body>
</html>

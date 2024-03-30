<!DOCTYPE html>
<html lang="ru">
<head>
    <style>
        * {
            transition: all .3s ease;
        }
        html {
            background-color: #2d2d2d;
        }
        body {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
            background-color: #2d2d2d;
            color: white;
        }
        a {
            text-decoration: none;
            color: white;
            cursor: pointer;
        }
        a:hover, button:hover {
            scale: 1.05;
            opacity: .8;
        }
        a:active, button:active {
            scale: .95;
            opacity: .8;
        }
        a.btn-primary {
            background-color: #2F80ED;
            border: none;
            outline: none;
            padding: 10px 20px;
            color: white;
            border-radius: 20px;
            font-size: 18px;
            cursor: pointer;
            user-select: none;
        }
        .container {
            position: relative;
            top: 50%;
            transform: translateY(50%);
            display: flex;
            align-items: center;
            flex-direction: column;
            background-color: #3f3f3f;
            padding: 40px;
            border-radius: 20px;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            margin: 0 0 10px 0;
            color: white;
            font-size: 24px;
            text-align: center;
        }
        p {
            margin: 0 0 10px 0;
            color: white;
            text-align: center;
        }
        small {
            margin-top: 10px;
            color: white;
            text-align: center;
        }
    </style>
    <title>Восстановление пароля</title>
</head>
<body>

<div class="container">
    <h1>{{ config('app.name') }}</h1>
    <p>Вы получили это письмо, потому что запросили восстановление пароля для своей учетной записи.</p>
    <p>Пожалуйста, перейдите по следующей ссылке для восстановления пароля:</p>
    <a class="btn-primary" href="{{ route('reset-password.store', ['token' => $token]) }}">Восстановить пароль</a>
    <small>Ссылка действительна в течение 10 минут.</small>
</div>

</body>
</html>

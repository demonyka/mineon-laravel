<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>500 - {{ config('app.name') }}</title>
    <style>
        * {
            transition: all .3s ease;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: #2d2d2d;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Montserrat, sans-serif;
        }

        .error-container {
            background-color: #3f3f3f;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            border-radius: 40px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 30px;
        }

        .btn {
            background-color: #2F80ED;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-flex;
        }
        .btn:hover {
            opacity: .8;
            scale: 1.05;
        }
        .btn:active {
            opacity: .8;
            scale: 0.95;
        }
    </style>
</head>
<body>
<div class="error-container">
    <h1>500 Server Error</h1>
    <p>Произошла ошибка на стороне сервера, попробуйте позже.</p>
    <a href="{{ route('index.view') }}" class="btn">На главную</a>
</div>
</body>
</html>

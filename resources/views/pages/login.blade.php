<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset("/assets/css/login.css") }}">
    <title>Login</title>
</head>
<body>
    <div class="super">
        <div class="formulaire">
            <h1 class="title">Welcome to IKOPPEN IT</h1>
            <form action="/login" method="POST">
                <div class="input">
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="input">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="input">
                    <input type="submit" value="Ok" class="btn dark">
                </div>
                <h3 class="account"><a href="/inscription">Ajouter une société</a></h3>
            </form>
        </div>
        <div class="bg-gradient">
            <img src="{{URL::asset('/assets/img/logo-white.png')}}" alt="">
        </div>
    </div>
</body>
</html>
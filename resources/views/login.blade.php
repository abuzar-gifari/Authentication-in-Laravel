<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @include('navbar')

    <h3>Login</h3>
    
    <form action="{{ route('login') }}" method="post">
        <div>
            <label for="email">Email Address</label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div style="margin-top: 10px">
            <input type="submit" value="Login">
        </div><br>
        <div>
            <a href="{{ route('forget_password') }}">Forget Password</a>
        </div>
    </form>

</body>
</html>

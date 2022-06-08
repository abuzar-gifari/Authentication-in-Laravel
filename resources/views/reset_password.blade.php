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

    <h3>Reset Password</h3>
    
    <form action="{{ route('reset_password_submit') }}" method="post">@csrf

        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="password">New Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="retype_password">Retype Password</label>
            <input type="password" name="retype_password">
        </div>
        <div style="margin-top: 10px">
            <input type="submit" value="update">
        </div>
    </form>

</body>
</html>

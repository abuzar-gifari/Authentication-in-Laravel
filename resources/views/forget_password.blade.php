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

    <h3>Forget Password</h3>
    
    <form action="{{ route('forget_password_submit') }}" method="post">@csrf
        <div>
            <label for="email">Email Address</label>
            <input type="text" name="email">
        </div>
        <div style="margin-top: 10px">
            <input type="submit" value="submit">
        </div>
        <h3><a href="{{ route('login') }}">Back to Login Page</a></h3>
    </form>

</body>
</html>

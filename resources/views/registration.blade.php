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

    <h3>Registration</h3>
    
    <form action="{{ route('registration_submit') }}" method="post">@csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="email">Email Address</label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="retype_password">Retype Password</label>
            <input type="password" name="retype_password">
        </div>
        <div style="margin-top: 10px">
            <input type="submit" value="Registration">
        </div>
    </form>

</body>
</html>

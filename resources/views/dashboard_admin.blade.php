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

    <h3>Dashboard Page - Admin</h3>
    <p>
        hey {{ auth()->user()->name }} Welcome to dashboard.
    </p>
</body>
</html>

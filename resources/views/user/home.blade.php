<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    This is user page.

    <h1>Role - {{Auth::user()->role}}</h1>

    <br>
    <form action="{{route('logout')}}" method="POST">
        @csrf

        <input type="submit" value="Logout">
    </form>
</body>
</html>

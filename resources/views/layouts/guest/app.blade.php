<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/layouts/guest.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light">
    <div class="nav_title">
        <h3 class="nav_title-name">NEWWAVE </h3>
    </div>
    <div class="form">
        <select class="form-select" aria-label="Default select example">
            <option value="Tiếng Việt">Tiếng Việt</option>
            <option value="English">English</option>
        </select>
    </div>
</nav>
@yield('content')
</body>
<footer>
</footer>
</html>


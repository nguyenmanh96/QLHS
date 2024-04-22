<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light">
    <div class="form">
        <select class="form-select" aria-label="Default select example">
            <option value="Tiếng Việt">Tiếng Việt</option>
            <option value="English">English</option>
        </select>
    </div>
</nav>
<div class="container">
    <div class="block">
        <div class="title">
            <h1 class="title_name"> ĐĂNG NHẬP </h1>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="Tên tài khoản">
            <label for="floatingInput">Tên tài khoản</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Mật khẩu</label>
        </div>
        <div class="login_btn">
            <button type="button" class="btn btn-warning">Đăng nhập</button>
        </div>
    </div>

</div>
</body>
</html>


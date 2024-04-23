@extends('layouts.guest.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/login/login.css')}}">
<div class="container">
    <div class="block">
        <div class="title">
            <h1 class="title_name"> Đăng nhập </h1>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="Tên tài khoản">
            <label for="floatingInput">Tên tài khoản</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Mật khẩu </label>
            <span class="password-toggle-icon" id="button-hide"><i class="fa-regular fa-eye-slash"></i></span>
        </div>
        <div class="login_btn">
            <button type="button" class="btn btn-warning">Đăng nhập</button>
            <a class="forgot_link" href="{{route('forgot')}}">Quên mật khẩu?</a>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
@endsection


@extends('layouts.guest.layout')
@section('content')
    <link rel="stylesheet" href="{{asset('css/login/forgot.css')}}">
    <div class="container">
        <div class="block">
            <div class="title">
                <h3 class="title_name"> {{__('messages.forgot_pw')}} </h3>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="Email đăng nhập">
                <label for="floatingInput">Email</label>
            </div>
            <div class="login_btn">
                <button type="button" class="btn btn-warning">{{__('messages.send_link')}}</button>
            </div>
        </div>
    </div>
@endsection

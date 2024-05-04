@extends('layouts.guest.layout')
@section('content')
    <link rel="stylesheet" href="{{asset('css/login/forgot.css')}}">
    <form action="{{route('send-link')}}" method="POST">
    @csrf
        <div class="container">
            <div class="block">
                <div class="title">
                    <h3 class="title_name"> {{__('messages.forgot_pw')}} </h3>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" value="{{old('email')}}" name="email" class="form-control" id="floatingInput" placeholder="Email đăng nhập" required autofocus>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="login_btn">
                    <button type="submit" class="btn btn-warning">{{__('messages.send_link')}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@extends('layouts.guest.layout')
@section('content')
    @if(session('error'))
        <div id="errorAlert" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <div class="block">
            <div class="title">
                <h1 class="title_name" > {{__('messages.login')}} </h1>
            </div>
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                           placeholder="Tên tài khoản">
                    <label for="floatingInput"> {{__('messages.username')}} </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                           placeholder="Password">
                    <label for="floatingPassword"> {{__('messages.password')}} </label>
                    <span class="password-toggle-icon" id="button-hide"><i class="fa-regular fa-eye-slash"></i></span>
                </div>
                <div class="login_btn">
                    <button type="submit" class="btn btn-warning"> {{__('messages.login')}} </button>
                    <span class="social.title">{{__('messages.or_signin_with')}}</span>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>
                    <a class="forgot_link" href="{{route('forgot')}}">{{__('messages.forgot_password')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection

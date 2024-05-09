@extends('layouts.guest.layout')
@section('content')
    <div class="space"></div>
    <div class="container">
        <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <div class="text-center" id="text-center_reset">
                        <h2 class="text-center">{{__('messages.reset_pw')}}</h2>
                        <p>{{__('messages.reset_text')}}</p>
                    </div>
                </div>
                <div class="sc-alert">
                </div>
                <div class="panel-body" id="panel-body_fix">
                    <form action="{{ route('resetPassword', ['token' => $token]) }}" id="forget-form" role="form"
                          autocomplete="off"
                          class="form" method="POST">
                        @csrf
                        @include('layouts._message')
                        <div class="form-group">
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input id="password" name="password" placeholder="{{__('messages.new_pw')}}"
                                       class="form-control"
                                       type="password" value="{{ old('password')}}">
                            </div>
                            <div class="input-group">
                                <input id="confirm_password" name="confirm_password"
                                       placeholder="{{__('messages.confirm_pw')}}"
                                       class="form-control"
                                       type="password" value="{{ old('password')}}">
                            </div>
                        </div>
                        <div class="form-group" id="btn-reset">
                            <button type="submit"> {{__('messages.change_pw')}} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

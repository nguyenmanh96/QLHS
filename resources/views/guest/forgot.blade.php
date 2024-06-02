@extends('layouts.guest.layout')
@section('content')
    <div class="space"></div>
    <div class="container">
        <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i id="lock-icon" class="fa fa-lock fa-3x"></i></h3>
                        <h2 class="text-center">{{__('messages.forgot_password')}}</h2>
                        <p>{{__('messages.reset_text')}}</p>
                    </div>
                </div>
                <div class="sc-alert">
                    @include('_message')
                </div>
                <div class="panel-body" id="panel-body_fix">
                    <form action="{{route('sendLink')}}" id="forget-form" role="form" autocomplete="off" class="form"
                          method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input id="email" name="email" placeholder="Email" class="form-control"
                                       type="email">
                            </div>
                        </div>
                        <div class="form-group" id="btn-reset">
                            <button type="submit"> {{__('messages.send_link')}} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.guest.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Quên mật khẩu</div>
                    <div class="card-body">
                        <form >
                            @csrf
                            <div class="form-group">
                                <label for="email">Địa chỉ Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập địa chỉ email của bạn">
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi mail cài lại mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

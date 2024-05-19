@extends('layouts.student.layout')

@section('content')
    @include('_message')
    <div class="container mt-3">
        <h1>Trang cá nhân</h1>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="info_edit" style="display: flex">
                        <h5 class="card-title">Thông tin cá nhân</h5>
                        <img class="avatar"
                             src="https://cdn.sforum.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg" width="30"
                             height="40" style="border-radius: 20px ">
                    </div>
                    <p class="card-text">Name: </p>
                    <p class="card-text">Email: </p>
                    <p class="card-text">Student ID: </p>
                    <a href="#" class="btn btn-primary">Sửa</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách môn học</h5>
                    <ul class="list-group">
                        <li class="list-group-item"> 1</li>
                        <li class="list-group-item"> 2</li>
                        <li class="list-group-item"> 3</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

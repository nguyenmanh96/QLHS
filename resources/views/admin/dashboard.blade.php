@extends('layouts.admin.layout')

@section('content')
    @if(session('success'))
        <div id="successAlert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh sách quản lý</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="#" >Màn hình chính</a></li>
                            <li class="list-group-item"><a href="#" >Quản lý học sinh</a></li>
                            <li class="list-group-item"><a href="#" >Quản lý môn học</a></li>
                            <li class="list-group-item"><a href="#" >Quản lý khoa</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dashboard</h5>
                        <p class="card-text"> ................</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

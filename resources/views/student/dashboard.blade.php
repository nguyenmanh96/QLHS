@extends('layouts.student.layout')

@section('content')
    <div class="container content-body" id="departmentBody">
        @include('_message')
        <div class="alert alert-success" style="display: none"></div>
        <h1 class="header-title">{{__('messages.profile')}}</h1>
        <div class="student-profile py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent text-center">
                                <div class="alert alert-error" style="display: none"></div>
                                <form action="{{route('change-image')}}" class="avatar" id="avatar" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <img src="{{asset('avatar/'.Auth::user()->avatar)}}" id="avatar-image"
                                         class="avatar_img"  alt="avatar">
                                    <div class="avatar_upload">
                                        <label class="upload_label" for="upload">{{__('messages.upload')}}
                                            <input type="file" id="upload" name="upload" onchange="this.form.submit()" >
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <p class="mb-0"><strong class="pr-1">{{__('messages.st_id')}} :</strong>{{$student->id}}
                                </p>
                                <p class="mb-0"><strong class="pr-1">{{__('messages.st_name')}}
                                        :</strong>{{$student->name}}</p>
                                <p class="mb-0"><strong class="pr-1">{{__('messages.dob')}} :</strong>{{$student->dob}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>{{__('messages.general_info')}}</h3>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">{{__('messages.gender')}}</th>
                                        <td>{{__('messages.'.$student->code)}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">{{__('messages.academic_yeah')}}</th>
                                        <td>2024</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">{{__('messages.country')}}</th>
                                        <td>{{__('messages.country_name')}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">{{__('messages.religion')}}</th>
                                        <td>{{__('messages.religion_type')}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">{{__('messages.admission_date')}}</th>
                                        <td>{{explode(' ',$student->created_at)[0]}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

    </script>

@endpush

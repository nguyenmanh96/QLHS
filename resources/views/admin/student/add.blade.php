@extends('layouts.admin.layout')
@section('content')
    <div class="container content-body">
        @include('_message')
        <h1 class="content-title mt-4">{{__('messages.add_student')}}</h1>
        <div class="form-add">
            <form action="{{route('student.add')}}" method="POST" id="addStudentForm">
                @csrf
                <div class="mb-3">
                    <label for="email"
                           class="form-label">Email</label>
                    <input value="{{old('email')}}" type="email" class="form-control" id="email" name="email"
                           required>
                </div>
                <div class="mb-3">
                    <label for="studentName"
                           class="form-label">{{__('messages.student_name')}}</label>
                    <input value="{{old('studentName')}}" type="text" class="form-control" id="studentName"
                           name="studentName"
                           required>
                </div>
                <div class="mb-3">
                    <label for="dob"
                           class="form-label">{{__('messages.dob')}}</label>
                    <input value="{{old('dob')}}" type="date" class="form-control" id="dob" name="dob"
                           required>
                </div>
                <div class="mb-3">
                    <label for="sex"
                           class="form-label">{{__('messages.gender')}}</label>
                    <select class="form-select" name="sex" id="sex">
                        <option
                            value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>{{__('messages.Male')}}</option>
                        <option
                            value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>{{__('messages.Female')}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="departmentId"
                           class="form-label">{{__('messages.dep')}}</label>
                    <select class="form-select" name="departmentId" id="departmentId">
                        @foreach($departments as $department)
                            <option
                                value="{{$department->id}}" {{old('departmentId') == $department->id ? 'selected' : ''}} >{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="{{route('student.list')}}"
                       class="content-btn btn btn-secondary mr-2">{{__('messages.back')}}</a>
                    <button type="submit"
                            class="content-btn btn btn-success">{{__('messages.save')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <style>
        .form-add {
            height: 60%;
            position: relative;
            padding: 30px;
            border-radius: 45px;
        }

        .content-title {
            margin-bottom: 45px;
        }

        #addStudentForm {
            position: relative;
            width: 50%;
            left: 25%;
        }

        .form-select {
            height: 38px;
        }
    </style>
@endpush

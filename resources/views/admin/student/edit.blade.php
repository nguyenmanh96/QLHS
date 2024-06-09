@extends('layouts.admin.layout')
@section('content')
    <div class="container content-body">
        @include('_message')
        <h1 class="content-title mt-4">{{__('messages.edit_student')}}</h1>
        <form action="{{ route('student.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" id="id" name="id" value="{{$student->id}}">
            <div class="mb-3">
                <label for="studentName" class="form-label edit">{{__('messages.student_name')}}</label>
                <input type="text" class="form-control" id="studentName" name="studentName"
                       value="{{ old('studentName',$student->name) }}">
            </div>
            <div class="mb-3">
                <label for="departmentId"
                       class="form-label">{{__('messages.dep')}}</label>
                <select class="form-select" name="departmentId" id="departmentId">
                    @foreach($departments as $department)
                        <option
                            value="{{ $department->id }}" {{ $student->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label edit">{{__('messages.dob')}}</label>
                <input type="date" class="form-control" id="dob" name="dob"
                       value="{{ $student->dob}}">
            </div>
            <div class="mb-3">
                <label for="sex"
                       class="form-label">{{__('messages.gender')}}</label>
                <select class="form-select" name="sex" id="sex">
                    <option value="Male">{{__('messages.Male')}}</option>
                    <option value="Female">{{__('messages.Female')}}</option>
                </select>
            </div>
            <a href="{{ route('student.list') }}"
               class="content-btn btn btn-secondary">{{__('messages.back')}}</a>
            <button type="submit" class="content-btn btn btn-primary">{{__('messages.save')}}</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                    class="content-btn btn btn-danger delete_student-btn">{{__('messages.delete')}}</button>
        </form>
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
             aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="confirmDeleteModalLabel">{{__('messages.warning')}}</h5>
                    </div>
                    <form action="{{route('student.delete')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$student->id}}">
                        <div class="modal-body">
                            <p>{{__('messages.ask_delete_st')}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="content-btn btn btn-secondary"
                                    data-bs-dismiss="modal">{{__('messages.cancel')}}</button>
                            <button type="submit"
                                    class="content-btn btn btn-danger">{{__('messages.accept')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

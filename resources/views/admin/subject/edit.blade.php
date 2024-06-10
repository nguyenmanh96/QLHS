@extends('layouts.admin.layout')
@section('content')
    <div class="container content-body">
        @include('_message')
        <h1 class="content-title mt-4">{{__('messages.edit_subject')}}</h1>
        <form action="{{ route('admin.subject.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" id="id" name="id" value="{{$subject->id}}">
            <div class="mb-3">
                <label for="subjectName" class="form-label edit">{{__('messages.subject_name')}}</label>
                <input type="text" class="form-control" id="subjectName" name="subjectName"
                       value="{{ old('subjectName',$subject->name) }}">
            </div>
            <div class="mb-3">
                <label for="departmentId" class="form-label edit">{{__('messages.dep_id')}}</label>
                <input type="text" class="form-control" id="departmentId" name="departmentId"
                       value="{{ old('departmentId',$subject->department_id)}}">
            </div>

            <div class="mb-3">
                <label for="created_at" class="form-label edit">{{__('messages.created_at')}}</label>
                <input type="date" class="form-control" id="created_at" name="created_at"
                       value="{{ $subject->created_at->format('Y-m-d') }}" disabled>
            </div>

            <a href="{{ route('admin.subject.list') }}"
               class="content-btn btn btn-secondary">{{__('messages.back')}}</a>
            <button type="submit" class="content-btn btn btn-primary">{{__('messages.save')}}</button>
            <button type="button" class="content-btn btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#confirmDeleteModal">{{__('messages.delete')}}
            </button>
        </form>
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
             aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">{{__('messages.warning')}}</h5>
                    </div>
                    <form action="{{ route('admin.subject.delete')}}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="id" name="id" value="{{$subject->id}}">
                        <div class="modal-body">
                            <p>{{__('messages.ask_delete_sub')}}</p>
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

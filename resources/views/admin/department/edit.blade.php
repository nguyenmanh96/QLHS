@extends('layouts.admin.layout')
@section('content')
    <div class="container department-body">
        @include('_message')
        <h1 class="department-title mt-4">{{__('messages.edit_department')}}</h1>
        <form action="{{ route('update-department')}}" method="POST">
            @csrf
            @method('PUT')
                <input type="hidden" class="form-control" id="id" name="id" value="{{$department->id}}" >
            <div class="mb-3">
                <label for="name" class="form-label edit">{{__('messages.department_name')}}</label>
                <input type="text" class="form-control" id="departmentName" name="departmentName"
                       value="{{ $department->name }}">
            </div>

            <div class="mb-3">
                <label for="created_at" class="form-label edit">{{__('messages.created_at')}}</label>
                <input type="date" class="form-control" id="created_at" name="created_at"
                       value="{{ $department->created_at->format('Y-m-d') }}" disabled>
            </div>

            <a href="{{ route('department-list') }}"
               class="department-btn btn btn-secondary">{{__('messages.back')}}</a>
            <button type="submit" class="department-btn btn btn-primary">{{__('messages.save')}}</button>
            <button type="button" data-bs-toggle="modal"  data-bs-target="#confirmDeleteModal" class="department-btn btn btn-danger delete_department-btn">{{__('messages.delete')}}</button>
        </form>
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
             aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="confirmDeleteModalLabel">{{__('messages.warning')}}</h5>
                    </div>
                    <form action="{{route('delete-department')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$department->id}}" >
                        <div class="modal-body">
                            <p>{{__('messages.ask_delete')}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="department-btn btn btn-secondary"
                                    data-bs-dismiss="modal">{{__('messages.cancel')}}</button>
                            <button type="submit"
                                    class="department-btn btn btn-danger">{{__('messages.accept')}}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

    </script>
@endpush
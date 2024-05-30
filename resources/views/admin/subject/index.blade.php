@extends('layouts.admin.layout')
@section('content')
    <div class="container content-body" id="subjectBody">
        <div class="alert alert-success" style="display: none">

        </div>
        @include('_message')
        <h1 class="content-title mt-4">{{__('messages.subject_list')}}</h1>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">{{__('messages.order_number')}}</th>
                <th scope="col">{{__('messages.subject_name')}}</th>
                <th scope="col">{{__('messages.dep_id')}}</th>
                <th scope="col">{{__('messages.created_at')}}</th>
                <th class="action-col" scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr class="subject-tr">
                    <th scope="row">{{$subject['id']}}</th>
                    <td>{{$subject['name']}}</td>
                    <td>{{$subject['department_id']}}</td>
                    <td>{{$subject['created_at']}}</td>
                    <td class="tr-flex">
                        <a href="{{route('edit-subject',$subject['id'])}}"
                           class="content-btn btn btn-primary">{{__('messages.edit')}}</a>
                        <button type="button" data-value="{{$subject['id']}}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" class="content-btn btn btn-danger delete_department-btn">{{__('messages.delete')}}</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
             aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="confirmDeleteModalLabel">{{__('messages.warning')}}</h5>
                    </div>
                    <form action="{{route('delete-subject')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="id" name='id' value="">
                        <div class="modal-body">
                            <p>{{__('messages.ask_delete')}}</p>
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
        <div class="table_footer">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addSubjectModal"
                    class="content-btn btn btn-warning">{{__('messages.add')}}</button>
            <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addSubjectModalLabel">{{__('messages.add_subject')}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-alert_error"></div>
                            <form action="{{route('add-subject')}}" method="POST" id="addSubjectForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="subjectName"
                                           class="form-label">{{__('messages.subject_name')}}</label>
                                    <input type="text" class="form-control" id="subjectName" name="subjectName"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="departmentId"
                                           class="form-label">{{__('messages.dep_id')}}</label>
                                    <input type="text" class="form-control" id="departmentId" name="departmentId"
                                           required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit"
                                            class="content-btn btn btn-success">{{__('messages.save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{ $subjects->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.delete_department-btn').click(function (e) {
                e.preventDefault()
                const subject_id = $(this).data('value');
                $('#id').val(subject_id);
            })
        });
    </script>
@endpush

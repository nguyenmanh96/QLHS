@extends('layouts.admin.layout')
@section('content')
    <div class="container content-body" id="departmentBody">
        <div class="alert alert-success" style="display: none">

        </div>
        @include('_message')
        <h1 class="content-title mt-4">{{__('messages.department_list')}}</h1>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">{{__('messages.order_number')}}</th>
                <th scope="col">{{__('messages.department_name')}}</th>
                <th scope="col">{{__('messages.created_at')}}</th>
                <th class="action-col" scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr class="department-tr">
                    <th scope="row">{{$department['id']}}</th>
                    <td>{{$department['name']}}</td>
                    <td>{{$department['created_at']}}</td>
                    <td class="tr-flex">
                        <a href="{{route('admin.department.edit',$department['id'])}}"
                           class="content-btn btn btn-primary">{{__('messages.edit')}}</a>
                        <button type="button" data-value="{{$department['id']}}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" class="content-btn btn btn-danger delete_department-btn">{{__('messages.delete')}}</button>
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
                    <form action="{{route('admin.department.delete')}}" method="POST">
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
            <button type="button" data-bs-toggle="modal" data-bs-target="#addDepartmentModal"
                    class="content-btn btn btn-warning">{{__('messages.add')}}</button>
            <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addDepartmentModalLabel">{{__('messages.add_department')}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-alert_error">

                            </div>
                            <form action="{{route('admin.department.store')}}" method="POST" id="addDepartmentForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="departmentName"
                                           class="form-label">{{__('messages.department_name')}}</label>
                                    <input type="text" class="form-control" id="departmentName" name="departmentName"
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
            {{ $departments->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.delete_department-btn').click(function () {
                const department_id = $(this).data('value');
                $('#id').val(department_id);
            })
        });
    </script>
@endpush

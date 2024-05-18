@extends('layouts.admin.layout')
@section('content')
    <div class="container department-body">
        @include('layouts._message')
        <h1 class="department-title mt-4">{{__('messages.department_list')}}</h1>
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
                <tr>
                    <th scope="row">{{$department['id']}}</th>
                    <td>{{$department['name']}}</td>
                    <td>{{$department['created_at']}}</td>
                    <td class="tr-flex">
                        <form action="{{route('edit-department',$department['id'])}}" method="GET">
                            <button type="submit"
                                    class="department-btn btn btn-primary">{{__('messages.edit')}}</button>
                        </form>
                        <form action="{{route('delete-department',$department['id'])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                    class="department-btn btn btn-danger">{{__('messages.delete')}}</button>
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                                 aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="confirmDeleteModalLabel">{{__('messages.warning')}}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{__('messages.ask_delete')}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="department-btn btn btn-secondary"
                                                    data-bs-dismiss="modal">{{__('messages.cancel')}}</button>
                                            <button type="submit"
                                                    class="department-btn btn btn-danger">{{__('messages.accept')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="paginate-btn">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addDepartmentModal"
                    class="department-btn btn btn-warning">{{__('messages.add')}}</button>
            <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addDepartmentModalLabel">{{__('messages.add_department')}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('add-department')}}" method="POST" id="addDepartmentForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="departmentName"
                                           class="form-label">{{__('messages.department_name')}}</label>
                                    <input type="text" class="form-control" id="departmentName" name="departmentName">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit"
                                            class="department-btn btn btn-success">{{__('messages.save')}}</button>
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


@endpush

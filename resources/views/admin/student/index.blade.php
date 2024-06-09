@extends('layouts.admin.layout')
@section('content')
    <div class="container content-body" id="studentBody">
        <div class="alert alert-success" style="display: none">

        </div>
        <div class="alert alert-danger" style="display: none">

        </div>
        @include('_message')
        <h1 class="content-title mt-4">{{__('messages.student_list')}}</h1>
        <div class="search">
            <form class="search-form" id="search-form" action="{{route('student.list')}}" method="GET">
                <div class="form-group">
                    <input name="age_from_keyword" value="{{ request('age_from_keyword') }}" id="age_keyword"
                           class="form-control" type="text" placeholder="{{__('messages.input_age')}}"/>
                </div>
                <div>~</div>
                <div class="form-group">
                    <input name="age_to_keyword" value="{{ request('age_to_keyword')}}" id="age_to_keyword"
                           class="form-control" type="text" placeholder="{{ __('messages.input_age') }}"/>
                </div>
                <div>/</div>
                <div class="form-group">
                    <input name="score_from_keyword" value="{{ request('score_from_keyword') }}" id="score_from_keyword"
                           class="form-control" type="text" placeholder="{{ __('messages.input_grades') }}"/>
                </div>
                <div>~</div>
                <div class="form-group">
                    <input name="score_to_keyword" value="{{ request('score_to_keyword') }}" id="score_to_keyword"
                           class="form-control" type="text" placeholder="{{ __('messages.input_grades') }}"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn content-btn btn-primary">{{__('messages.search')}}</button>
                </div>
            </form>
        </div>
        <div class="add-footer">
            <a type="button" href="{{route('student.getForm.add')}}"
               class="content-btn btn btn-success">{{__('messages.add')}}</a>
            <button type="button" data-bs-toggle="modal" data-bs-target="#addStudentModal"
                    class="content-btn btn btn-warning">{{__('messages.quick_add')}}</button>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">{{__('messages.order_number')}}</th>
                <th scope="col">{{__('messages.student_name')}}</th>
                <th scope="col">{{__('messages.code')}}</th>
                <th scope="col">{{__('messages.dob')}}</th>
                <th scope="col">{{__('messages.gender')}}</th>
                <th scope="col">{{__('messages.dep')}}</th>
                <th scope="col">{{__('messages.registered_sub')}}</th>
                <th scope="col">{{__('messages.avg_grades')}}</th>
                <th class="action-col" scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr class="department-tr">
                    <th scope="row">{{$student['id']}}</th>
                    <td>{{$student['name']}}</td>
                    <td>{{$student['code']}}</td>
                    <td>{{$student['dob']}}</td>
                    <td>{{__('messages.'.$student['sex'])}}</td>
                    <td>{{$student->department->name}}</td>
                    <td class="td-sub">
                        <a href="{{route('student.registeredSubject',$student['id'])}}"
                           class="content-btn btn btn-info">{{$student->subjectReg}}</a>
                    </td>
                    <td>{{$student->avg_score ?? __('messages.grades_not_yet')}}</td>
                    <td class="tr-flex">
                        <button type="submit" class="content-btn btn btn-success notifyBtn" id="notifyBtn"
                                name="notifyBtn"
                                data-notify-btn="{{$student->id}}" {{$student->notReg->isEmpty() ?  'disabled' : ''}}>
                            Thông báo
                        </button>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <a href="{{route('student.edit',$student['id'])}}"
                           class="content-btn btn btn-primary">{{__('messages.edit')}}</a>
                        <button type="button" data-value="{{$student['id']}}" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal"
                                class="content-btn btn btn-danger delete_student-btn">{{__('messages.delete')}}</button>
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
                    <form action="{{route('student.delete')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="id" name='id' value="">
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
        <div class="table_footer">
            <div class="add-footer">
                <a type="button" href="{{route('student.getForm.add')}}"
                   class="content-btn btn btn-success">{{__('messages.add')}}</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addStudentModal"
                        class="content-btn btn btn-warning">{{__('messages.quick_add')}}</button>
            </div>
            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addStudentModalLabel">{{__('messages.add_student')}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-alert_error">

                            </div>
                            <form action="{{route('student.add')}}" method="POST" id="addStudentForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="email"
                                           class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="studentName"
                                           class="form-label">{{__('messages.student_name')}}</label>
                                    <input type="text" class="form-control" id="studentName" name="studentName"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="dob"
                                           class="form-label">{{__('messages.dob')}}</label>
                                    <input type="date" class="form-control" id="dob" name="dob"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="sex"
                                           class="form-label">{{__('messages.gender')}}</label>
                                    <select class="form-select" name="sex" id="sex">
                                        <option value="Male">{{__('messages.Male')}}</option>
                                        <option value="Female">{{__('messages.Female')}}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="departmentId"
                                           class="form-label">{{__('messages.dep')}}</label>
                                    <select class="form-select" name="departmentId" id="departmentId">
                                        @foreach($departments as $department)
                                            <option
                                                value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
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
            {{ $students->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.delete_student-btn').click(function () {
                const student_id = $(this).data('value');
                $('#id').val(student_id);
            })
        });

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $(document).ready(function () {
            $('.notifyBtn').click(function () {
                const studentID = $(this).data('notify-btn');
                $('.alert').css('display', 'none')
                $.ajax({
                    url: "{{ route('student.notification')}}",
                    type: 'POST',
                    data: {
                        id: studentID
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        if (response.status) {
                            $('.alert-success').html(response.message).css('display', 'block');
                        } else {
                            $('.alert-danger').html(response.message).css('display', 'block');
                        }
                    }
                });
            });
        });
    </script>
    <style>
        .search {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .content-btn.btn.btn-warning {
            width: auto;
        }

        .form-group .form-control {
            width: 170px;
        }

        .form-group {
            margin: 10px;
        }

        .search-form {
            display: flex;
            align-items: center;
        }
    </style>
@endpush

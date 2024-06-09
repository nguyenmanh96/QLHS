@extends('layouts.admin.layout')
@section('content')
    <div class="container content-body" id="subjectBody">
        <div class="alert alert-success" style="display: none"></div>
        @include('_message')
        <h1 class="content-title mt-4">{{ __('messages.sub_registered_list')}} {{$student->code}}</h1>
        <div class="search">
            <form id="search-form" action="{{route('student.registeredSubject',$student['id'])}}" method="GET">
                <div class="form-group">
                    <input name="subjectName_keyword" value="{{ request('subjectName_keyword') }}"
                           id="subjectName_keyword"
                           class="form-control" type="text" placeholder="{{__('messages.subject_name')}}"/>
                </div>
                <div class="form-group">
                    <input name="departmentName_keyword" value="{{ request('departmentName_keyword') }}"
                           id="departmentName_keyword"
                           class="form-control" type="text" placeholder="{{__('messages.dep')}}"/>
                </div>
                <div class="form-group">
                    <input name="grades_keyword" value="{{ request('grades_keyword') }}" id="grades_keyword"
                           class="form-control" type="text" placeholder="{{ __('messages.grades') }}"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn content-btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">{{ __('messages.order_number') }}</th>
                <th scope="col">{{ __('messages.subject_name') }}</th>
                <th scope="col">{{ __('messages.dep') }}</th>
                <th scope="col">{{ __('messages.grades') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr class="subject-tr">
                    <th scope="row">{{ $subject->id }}</th>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->department->name}}</td>
                    <td>
                        <button type="button" data-subject-id="{{$subject->id}}"
                                class="content-btn btn btn-success edit-score-btn" data-bs-toggle="modal"
                                data-bs-target="#editScoreModal"
                                style="width: auto"> {{ $subject->score ?? __('messages.grades_not_yet') }} </button>
                    </td>
                </tr>
            @endforeach
            <div class="modal fade" id="editScoreModal" tabindex="-1" aria-labelledby="editScoreModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editScoreModalLabel">{{__('messages.edit_grades')}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('student.score.update')}}" method="POST" id="addStudentForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="studentId" name="studentId" value="{{$student->id}}">
                                <input type="hidden" id="subjectId" name="subjectId" value="">
                                <div class="mb-3">
                                    <label for="grades"
                                           class="form-label">{{__('messages.grades')}}</label>
                                    <input type="text" class="form-control" id="grades" name="grades"
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
            </tbody>
        </table>
        <div class="table_footer">
            <a href="{{route('student.list')}}" class="content-btn btn btn-secondary">{{__('messages.back')}}</a>
            <div class="table_footer">
                {{ $subjects->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.edit-score-btn').click(function () {
                const subject_id = $(this).data('subject-id');
                $('#subjectId').val(subject_id);
            })
        });
    </script>
    <style>
        .modal {
            --bs-modal-width: 350px;
        }

        .search {
            margin-top: 20px;
            display: flex;
        }

        #search-form {
            display: flex;
        }

        .form-group {
            margin-right: 8px;
        }

        .form-group .form-control {
            width: auto;
        }

        .table-footer {
        }
    </style>
@endpush

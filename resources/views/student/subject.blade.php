@extends('layouts.student.layout')
@section('content')
    <div class="container content-body" id="subjectBody">
        <div class="alert alert-success" style="display: none">

        </div>
        @include('_message')
        <h1 class="content-title mt-4">{{__('messages.subject_list')}}</h1>
        <div class="search">
            <div class="row" id="search">
                <form id="search-form" action="{{route('search-result')}}" method="GET">
                    <div class="form-group col-5">
                        <input name="search_keyword" value="{{old('search_keyword')}}" id="search_keyword" class="form-control" type="text" placeholder="Search" />
                    </div>
                    <div class="form-group col-3">
                        <select data-filter="make" class="filter-make filter form-control" name="search_option" id="search_option">
                            <option value="order_number">Order Number</option>
                            <option value="subject_name">Subject Name</option>
                            <option value="department_id">Department ID</option>
                            <option value="grades">Grades</option>
                            <option value="actions">Actions</option>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <button type="submit" class="btn content-btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="row" id="filter">
                <form class="filter-form">

                </form>
            </div>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">{{__('messages.order_number')}}</th>
                <th scope="col">{{__('messages.subject_name')}}</th>
                <th scope="col">{{__('messages.dep_id')}}</th>
                <th scope="col">{{__('messages.grades')}}</th>
                <th class="action-col" scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr class="subject-tr">
                    <th scope="row">{{$subject['id']}}</th>
                    <td>{{$subject['name']}}</td>
                    <td>{{$subject['department_id']}}</td>
                    <td>{{$score = $subject->result->pluck('pivot')->first()->score ?? __('messages.grades_not_yet')}}</td>
{{--                    @dd($subject->registeredSubject->pluck('pivot')->where('subject_id', $subject['id'])->first())--}}
                    <td class="tr-flex">
                        <form action="{{route('register-subject')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{$subject['id']}}">
                            <button type="submit"
                                    class="content-btn btn btn-primary" {{$subject->registeredSubject->pluck('pivot')->where('subject_id', $subject['id'])->first()&&$subject->registeredSubject->pluck('pivot')->where('subject_id', $subject['id'])->first()->status === "Registered" ? 'disabled' : ''}}>
                                {{$subject->registeredSubject->pluck('pivot')->where('subject_id', $subject['id'])->first()->status ?? __('messages.register')}} </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="table_footer">
            {{ $subjects->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
@push('student-scripts')
    <script>
        function disableButton(subjectId) {
            let buttonId = 'register-btn-' + subjectId;
            document.getElementById(buttonId).setAttribute('disabled', 'true');
        }
    </script>
    <style>

        .search{
            margin-top: 20px;
            display: flex;
        }

        #search-form{
            display: flex;
        }

        .filter-form{
            display: flex;
        }

        .form-group{
            margin-right: 8px;
        }

    </style>
@endpush

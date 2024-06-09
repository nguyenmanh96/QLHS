@extends('layouts.student.layout')
@section('content')
    <div class="container content-body" id="subjectBody">
        <div class="alert alert-success" style="display: none"></div>
        @include('_message')
        <h1 class="content-title mt-4">{{ __('messages.subject_list') }}</h1>
        <div class="search">
            <form id="search-form" action="{{route('st.subject.search')}}" method="GET">
                <div class="form-group">
                    <input name="subjectName_keyword" value="{{ old('search_keyword') }}" id="subjectName_keyword"
                           class="form-control" type="text" placeholder="{{__('messages.subject_name')}}"/>
                </div>
                <div class="form-group">
                    <input name="departmentId_keyword" value="{{ old('search_keyword') }}" id="departmentId_keyword"
                           class="form-control" type="text" placeholder="{{ __('messages.dep_id') }}"/>
                </div>
                <div class="form-group">
                    <input name="grades_keyword" value="{{ old('search_keyword') }}" id="grades_keyword"
                           class="form-control" type="text" placeholder="{{ __('messages.grades') }}"/>
                </div>
                <div class="form-group">
                    <input name="status_keyword" value="{{ old('search_keyword') }}" id="status_keyword"
                           class="form-control" type="text" placeholder="{{ __('messages.status') }}"/>
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
                <th scope="col">{{ __('messages.dep_id') }}</th>
                <th scope="col">{{ __('messages.grades') }}</th>
                <th class="action-col" scope="col">{{ __('messages.status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr class="subject-tr">
                    <th scope="row">{{ $subject->id }}</th>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->department_id }}</td>
                    <td>{{ $subject->score ?? __('messages.grades_not_yet') }}</td>
                    <td class="tr-flex">
                        <form action="{{route('st.subject.register')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $subject->id }}">

                            <button type="submit" class="content-btn btn btn-primary"
                                {{ $subject->status === 'Registered' ? 'disabled' : '' }}>
                                {{ $subject->status === 'Registered' ? __('messages.' . $subject->status) : __('messages.register') }}
                            </button>
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
@push('scripts')
    <script>
        function disableButton(subjectId) {
            let buttonId = 'register-btn-' + subjectId;
            document.getElementById(buttonId).setAttribute('disabled', 'true');
        }
    </script>
    <style>
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
    </style>
@endpush

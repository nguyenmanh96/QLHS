@extends('layouts.student.layout')
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
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr class="department-tr">
                    <th scope="row">{{$department['id']}}</th>
                    <td>{{$department['name']}}</td>
                    <td>{{$department['created_at']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $departments->links('vendor.pagination.custom') }}
    </div>
@endsection
@push('scripts')
    <script>

    </script>
@endpush

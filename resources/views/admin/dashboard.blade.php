@extends('layouts.admin.layout')

@section('content')
    @include('_message')
    <div class="sky">
        <div class="moon-hi" >
            <span>Hello </span>
            <span>{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
        </div>
        <div class="moon">
            <div class="crater crater1"></div>
            <div class="crater crater2"></div>
            <div class="crater crater3"></div>
            <div class="crater crater4"></div>
            <div class="crater crater5"></div>
            <div class="shadow"></div>
            <div class="eye eye-l"></div>
            <div class="eye eye-r"></div>
            <div class="mouth"></div>
            <div class="blush blush1"></div>
            <div class="blush blush2"></div>
        </div>

        <div class="orbit">
            <div class="rocket">
                <div class="window"></div>
            </div>
        </div>
    </div>
@endsection

@push('admin-scripts')
    <script>

    </script>
@endpush


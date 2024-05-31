@extends('layouts.admin.layout')

@section('content')
    @include('_message')
    <div class="sky">
        <div class="moon-hi" >
            <span>Hello </span>
            <span>{{Auth::user()->email}}</span>
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
@push('scripts')
    <script>
        function createStar() {
            const star = document.createElement("div");
            star.className = "star";
            star.style.left = Math.random() * window.innerWidth + "px";
            star.style.top = Math.random() * window.innerHeight + "px";
            document.body.appendChild(star);

            setTimeout(() => {
                star.remove();
            }, 5000);
        }

        function animateStars() {
            setInterval(() => {
                createStar();
            }, 200);
        }
        animateStars();
    </script>
@endpush


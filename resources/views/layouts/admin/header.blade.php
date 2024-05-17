<nav class="nav-title">
    <div class="logo_title">
        <a class="logo_name" href="{{route('admin-dashboard')}}">NEWWAVE</a>
    </div>
    <div class="form-lang">
        <form class="lang_form" action="{{ url()->current() }}">
            @csrf
            <select id="form-lang-select" class="form-select" aria-label="Default select example" name="locale"
                    onchange="this.form.submit()">
                <option value="vi" {{ session('locale') == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>English</option>
            </select>
        </form>
    </div>
</nav>
<body>
<div class="action">
    <div class="weather-info">
        <p class="item weather-info_place" id="weather-location"></p>
        <p class="item weather-info_date" id="weather-date"></p>
        <p class="item weather-info_time" id="time"></p>
        <p class="item weather-info_temp" id="weather-temp_c">°C</p>
        <img class="item weather-info_image" id="weather-image">

    </div>
    <span class="span-space"></span>
    <div class="profile">
        <img src="http://qlhs.com/admin.jpg" alt="profile-img">
    </div>
    <div class="menu">
        <form class="menu_form-lang" action="{{route('logout')}}" method="POST">
            @csrf
            <h5 style="text-align: center"> {{Auth::user()->email}}</h5>
            <button class="menu_btn-logout" type="submit">{{__('messages.logout')}}</button>
        </form>
    </div>
</div>

<div class="dashboard-layout">
    <div class="dashboard-atom">
        <div class="atom-panel atom-panel--left left">
            <nav class="atom-toolbar atom-toolbar-vertical expanded">
                <a href="{{route('department-list')}}" class="btn btn-default">
                    <span class="octicon octicon-terminal"></span>
                    <span class="title">{{__('messages.department_list')}}</span>
                </a>
                <a href="" class="btn btn-default">
                    <span class="octicon octicon-telescope"></span>
                    <span class="title">{{__('messages.subject_list')}}</span>
                </a>
                <a href="#" class="btn btn-default">
                    <span class="octicon octicon-desktop-download"></span>
                    <span class="title">{{__('messages.student_list')}}</span>
                </a>
                <hr class="atom-toolbar-spacer">
                <a href="#" class="btn btn-default">
                    <span class="octicon octicon-file-directory"></span>
                    <span class="title">{{__('messages.quick_add')}}</span>
                </a>
                <div class="atom-toolbar-toggle-button left atom-toolbar-toggle-button-visible expanded">
                    <div class="atom-toolbar-toggle-button-inner left">
                        <svg class="atom-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                             width="24px" fill="#ff">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/>
                        </svg>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="dashboard_container">
        @yield('content')
    </div>
</div>






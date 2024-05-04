<nav class="navbar navbar-light">
    <div class="nav_title">
        <a class="nav_title-name" href="{{route('login')}}">NEWWAVE</a>
    </div>
    <div class="form">
        <form class="lang_form" action="{{ route('change_language') }}" method="POST" >
            @csrf
            <select class="form-select" aria-label="Default select example" name="locale" onchange="this.form.submit()">
                <option value="vi" {{ session('locale') == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>English</option>
            </select>
        </form>
    </div>
</nav>

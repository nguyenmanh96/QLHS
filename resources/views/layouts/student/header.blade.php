<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Trang cá nhân</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            {{Session('userinfo')}}
                        </button>
                        <form action="{{route('logout')}}" method="POST" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @csrf
                            <button type="submit" class="dropdown-item" href="#">Logout</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Môn học</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hồ sơ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

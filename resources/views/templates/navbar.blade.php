<nav class="navbar navbar-expand-lg navbar-light  nav-main mb-5 sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ASPIRA-SI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Feed <span class="sr-only">(current)</span></a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">My Aspiration</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Announcement</a>--}}
{{--                </li>--}}
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-link-lg nav-link-user" data-toggle="dropdown" href="#">
                        <img alt="image" class="rounded-circle mr-1" style="max-width: 30px" src="{{'assets/img/telkom.jpg'}}">
                        <div class="d-sm-none d-lg-inline-block">Hi, {{session(0)->nama_mahasiswa}}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item has-icon" href="profile-praktikan.html">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item has-icon text-danger" href="{{route('logout')}}">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>

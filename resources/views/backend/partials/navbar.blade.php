<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center">
        <a href="/">
            <img src="{{ asset('backend/img/logo-blue.png') }}">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (Auth::user()->picture != null)
                        <img src="{{ Storage::url(Auth::user()->picture) }}" alt="Profile" class="rounded-circle">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="Profile"
                            class="rounded-circle">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->email }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.profile') }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

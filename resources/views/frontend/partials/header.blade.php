<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center" style="background-color:#3d59ab; margin-bottom:-1px;">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-telephone-fill d-flex align-items-center"><span>{{ $frontend->telephone }}</span></i>
            <i class="bi bi-envelope-fill d-flex align-items-center ms-4"><a
                    href="mailto:{{ $frontend->email }}">{{ $frontend->email }}
                </a></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="{{ $frontend->facebook }}" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="{{ $frontend->twitter }}" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="{{ $frontend->instagram }}" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</section>
<!-- End Top Bar-->

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center" style="background-color: #001349">
    <div class="container d-flex align-items-center justify-content-between">
        <div id="logo">
            <h1><a href="/">
                    <img src="https://tekkom.ft.undip.ac.id/wp-content/uploads/2020/10/DEPARTEMEN-TEKKOM.png">
                </a></h1>
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li>
                    <a class="nav-link scrollto" href="/">BERANDA</a>
                </li>
                <li class="dropdown"><a href="#"><span>DOKUMEN</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="nav-link scrollto" href="/dokmasuk"><i class="bi bi-file-earmark-arrow-down"
                                    style="margin-right: 10px"></i>Dokumen Masuk</a></li>
                        <li><a class="nav-link scrollto" href="/dokkeluar"><i class="bi bi-file-earmark-arrow-up"
                                    style="margin-right: 10px"></i>Dokumen Keluar</a></li>
                    </ul>
                </li>
                @auth
                    <li class="dropdown nav-item"><a href="#"><span>Selamat Datang, {{ $user->name }}&nbsp;</span>
                            @if ($user->picture != null)
                                <img src="{{ Storage::url($user->picture) }}" alt="Profile" class="rounded-circle"
                                    width="30" height="30">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="Profile"
                                    class="rounded-circle" width="30">
                            @endif
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            @if ($user->role == 'admin' || $user->role == 'kadep' || $user->role == 'koor')
                                <li><a class="dropdown-item" href="/dashboard">
                                        <i class="bi bi-layout-text-window-reverse"
                                            style="margin-right: 10px"></i>Dashboard</a>
                                </li>
                            @else
                                <li><a class="dropdown-item" href="/profile">
                                        <i class="bi bi-person" style="margin-right: 10px"></i>My Profile</a>
                                </li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn">
                                        <i class="bi bi-box-arrow-right" style="margin-right: 10px"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a class="nav-link scrollto" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right" style="margin-right: 10px"></i>LOGIN</a>
                    </li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
<!-- End Header -->

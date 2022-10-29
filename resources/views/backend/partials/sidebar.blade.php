<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- Menu --}}
        <li class="nav-heading">Menu</li>
        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if ($user->role == 'admin')
            {{-- Front End --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/setfrontend*') ? '' : 'collapsed' }}"
                    href="{{ route('setfrontend') }}">
                    <i class="bi bi-display"></i>
                    <span>Frontend Setting</span>
                </a>
            </li><!-- End Frontend Setting Nav -->
        @endif

        {{-- Dokumen --}}
        <li class="nav-heading mt-4">Dokumen</li>
        @if ($user->role == 'koor' || $user->role == 'admin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/sender*') ? '' : 'collapsed' }}" href="/dashboard/sender">
                    <i class="bi bi-file-earmark-person"></i>
                    <span>Pengirim Surat</span>
                </a>
            </li><!-- End Sender Page Nav -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/receiver*') ? '' : 'collapsed' }}"
                    href="/dashboard/receiver">
                    <i class="bi bi-file-person"></i>
                    <span>Penerima Surat</span>
                </a>
            </li><!-- End Receiver Page Nav -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/document*') ? '' : 'collapsed' }}"
                    data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journals"></i><span>Surat</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav"
                    class="nav-content collapse {{ Request::is('dashboard/document*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('document.create') }}"
                            class="{{ Request::is('dashboard/document/create') ? 'active' : '' }}">
                            <i class="bi bi-journal-plus"></i>
                            <span>Tambah Surat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('doc.incoming') }}"
                            class="{{ Request::is('dashboard/document/incoming') ? 'active' : '' }}">
                            <i class="bi bi-journal-arrow-down"></i>
                            <span>Surat Masuk</span>
                        </a>
                    </li><!-- End Incoming Letter Nav -->
                    <li>
                        <a href="{{ route('doc.outgoing') }}"
                            class="{{ Request::is('dashboard/document/outgoing') ? 'active' : '' }}">
                            <i class="bi bi-journal-arrow-up"></i>
                            <span>Surat Keluar</span>
                        </a>
                    </li><!-- End Outgoing Letter Nav -->
                </ul>
            </li><!-- End Letter Nav -->
        @endif
        @if ($user->role == 'kadep')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/surat/incoming') ? '' : 'collapsed' }}"
                    href="{{ route('kadep.incoming') }}">
                    <i class="bi bi-journal-arrow-down"></i><span>Surat Masuk</span>
                </a>
            </li><!-- End Incoming Letter Nav -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/surat/outgoing') ? '' : 'collapsed' }}"
                    href="{{ route('kadep.outgoing') }}">
                    <i class="bi bi-journal-arrow-up"></i><span>Surat Keluar</span>
                </a>
            </li><!-- End Outgoing Letter Nav -->
        @endif
        @if ($user->role == 'kadep' || $user->role == 'admin')
            {{-- Letter for Kadep --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/kadep*') ? '' : 'collapsed' }}"
                    href="{{ route('kadep.index') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Surat untuk Kadep</span>
                </a>
            </li><!-- End Add Letter Nav -->
        @endif
        @if ($user->role == 'admin' || $user->role == 'koor')
            {{-- User Setting --}}
            <li class="nav-heading mt-4">Users</li>
        @endif
        @if ($user->role == 'admin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/operator*') ? '' : 'collapsed' }}"
                    href="{{ route('operator.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Data Pengurus</span>
                </a>
            </li><!-- End Profile Admin Nav -->
        @endif
        @if ($user->role == 'admin' || $user->role == 'koor')
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/user*') ? '' : 'collapsed' }}"
                    href="{{ route('user.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Data Pengguna</span>
                </a>
            </li><!-- End Profile User Nav -->
        @endif
    </ul>

</aside><!-- End Sidebar-->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2 "
                style="text-transform: capitalize">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard </div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Main Menu</span>
        </li>
        <li class="menu-item {{ Request::is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link ">
                <i class='bx bx-group menu-icon tf-icons'></i>
                <div data-i18n="Basic">Users</div>
            </a>
        </li>
        @role('Planner')
        <li class="menu-item {{ Request::is('glwali*') ? 'active' : '' }}">
            <a href="{{ route('glwali.index') }}" class="menu-link ">
                <i class='bx bx-group menu-icon tf-icons'></i>
                <div data-i18n="Basic">Gl Wali</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('databank*') ? 'active' : '' }}">
            <a href="{{ route('databank.index') }}" class="menu-link ">
                <i class='bx bx-file menu-icon tf-icons'></i>
                <div data-i18n="Basic">Databank</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('databank*') ? 'active' : '' }}">
            <a href="{{ route('databank.index') }}" class="menu-link ">
                <i class='bx bx-file menu-icon tf-icons'></i>
                <div data-i18n="Basic">Databank</div>
            </a>
        </li>
        @endrole
        {{-- <li class="menu-item {{ Request::is('attendance*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class='bx bx-user-check menu-icon tf-icons'></i>
            <div data-i18n="Account Settings">Absensi</div>
        </a>
        <ul class="menu-sub">
            <li
                class="menu-item {{ request()->is('attendance') && request()->query('role') == 'kabag' ? 'active' : '' }}">
                <a href="/attendance?role=kabag" class="menu-link">
                    <div data-i18n="Account">Kabag</div>
                </a>
            </li>
            <li
                class="menu-item {{ request()->is('attendance') && request()->query('role') == 'pegawai' ? 'active' : '' }}">
                <a href="/attendance?role=pegawai" class="menu-link">
                    <div data-i18n="Notifications">Pegawai</div>
                </a>
            </li>
        </ul>
        </li>
        <li class="menu-item {{ Request::is('report*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='bx bx-file menu-icon tf-icons'></i>
                <div data-i18n="Authentications">Laporan Kerja</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ request()->is('report') && request()->query('role') == 'kabag' ? 'active' : '' }}">
                    <a href="/report?role=kabag" class="menu-link">
                        <div data-i18n="Account">Kabag</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->is('report') && request()->query('role') == 'pegawai' ? 'active' : '' }}">
                    <a href="/report?role=pegawai" class="menu-link">
                        <div data-i18n="Account">Pegawai</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ Request::is('score*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='bx bx-line-chart menu-icon tf-icons'></i>
                <div data-i18n="Authentications">Penilaian</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ request()->is('score') && request()->query('role') == 'kabag' ? 'active' : '' }}">
                    <a href="/score?role=kabag" class="menu-link">
                        <div data-i18n="Account">Kabag</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->is('score') && request()->query('role') == 'pegawai' ? 'active' : '' }}">
                    <a href="/score?role=pegawai" class="menu-link">
                        <div data-i18n="Account">Pegawai</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Master Data</span></li> --}}
        {{-- <li class="menu-item {{ Request::is('users*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class='bx bx-group menu-icon tf-icons'></i>
            <div data-i18n="Account Settings">User</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->is('users') && request()->query('role') == 'kabag' ? 'active' : '' }}">
                <a href="/users?role=kabag" class="menu-link">
                    <div data-i18n="Account">Kabag</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('users') && request()->query('role') == 'pegawai' ? 'active' : '' }}">
                <a href="/users?role=pegawai" class="menu-link">
                    <div data-i18n="Account">Pegawai</div>
                </a>
            </li>
        </ul>
        </li> --}}
        <!-- Cards -->
        {{-- <li class="menu-item {{ Request::is('departments*') ? 'active' : '' }}">
        <a href="/departments" class="menu-link ">
            <i class='bx bx-category menu-icon tf-icons'></i>
            <div data-i18n="Basic">Bidang</div>
        </a>
        </li> --}}
    </ul>
</aside>

<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ route('home') }}" class="navbar-brand p-0">
            <h1 class="text-primary"><i class="fas fa-futbol me-3"></i>AMC Mini Soccer </h1>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('field') }}"
                    class="nav-item nav-link {{ Request::routeIs('field*') ? 'active' : '' }}">
                    Sewa Lapangan
                </a>

                <a href="{{ route('booked-field') }}"
                    class="nav-item nav-link {{ Request::routeIs('booked-field') ? 'active' : '' }}">
                    Lapangan Tersewa
                </a>

                @guest
                    <a href="{{ route('login') }}"
                        class="nav-item nav-link d-lg-none {{ Request::routeIs('login') ? 'active' : '' }}">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="nav-item nav-link d-lg-none {{ Request::routeIs('register') ? 'active' : '' }}">
                        Daftar
                    </a>
                @endguest

                @auth
                    <div class="nav-item nav-link d-lg-none fw-bold">
                        Halo, {{ auth()->user()->name }}
                    </div>
                @endauth
            </div>
        </div>

        @guest
            <div class="d-none d-lg-flex ms-3">
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4 me-2">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill py-2 px-4">Daftar</a>
            </div>
        @endguest

        @auth
            <div class="nav-item dropdown d-none d-lg-flex ms-3 align-items-center">
                <a href="#" class="nav-link dropdown-toggle fw-bold" data-bs-toggle="dropdown">
                    Halo, {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu m-0">

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin-dashboard') }}"
                            class="dropdown-item {{ Request::routeIs('admin-dashboard') ? 'active' : '' }}">
                            Admin Dashboard
                        </a>
                    @elseif (auth()->user()->role === 'customer')
                        <a href="{{ route('profile') }}"
                            class="dropdown-item {{ Request::routeIs('profile') ? 'active' : '' }}">
                            Profil Saya
                        </a>
                        <a href="{{ route('rent.index') }}"
                            class="dropdown-item {{ Request::routeIs('rent.index') ? 'active' : '' }}">
                            Riwayat Sewa
                        </a>
                    @endif

                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item w-100 text-start">Keluar</button>
                    </form>
                </div>
            </div>
        @endauth
    </nav>
</div>

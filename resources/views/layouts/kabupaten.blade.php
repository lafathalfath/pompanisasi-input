<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>Satgas Pompanisasi</title>
        <link rel="shortcut icon" href="{{ asset('assets/img/logobbpsip.png') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <style>
            body {
                font-family: Poppins, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
            }

            .sidebar {
                width: 200px;
                background-color: #007b83;
                color: white;
                height: 100%;
                overflow-y: scroll;
                position: fixed;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .sidebar-header {
                text-align: center;
                padding: 20px;
            }

            .logo {
                width: 80px;
                height: 80px;
            }

            .sidebar h1 {
                font-size: 18px;
                margin: 10px 0 0;
            }

            .sidebar-menu {
                list-style: none;
                padding: 0;
                margin: 0;
                width: 100%;
            }

            .sidebar-menu li {
                width: 100%;
            }

            .sidebar-menu li a {
                display: block;
                padding: 15px 20px;
                color: white;
            }

            .sidebar-menu li a:hover,
            .active,
            .logout:hover {
                background-color: #005f62;
                text-decoration: none !important;
                color: #fff !important;
            }

            .logout {
                margin-top: auto;
                padding: 15px 20px;
                width: 100%;
                text-align: center;
                color: white;
                text-decoration: none !important;
            }

            .content {
                margin-left: 150px;
                padding: 20px;
                flex-grow: 1;
            }
            .user-info {
                margin-top: 20px;
            }
            .user-role {
                font-size: 14px;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('kabupaten.dashboard') }}">
                <img src="/assets/img/logobbpsip.png" alt="Logo" class="logo">
                </a>
                <h1>Satgas Pompanisasi</h1>
                <div class="user-info text-left">
                    <div class="text-capitalize fw-bold mb-2">{{ Auth::user()->nama }}</div>
                    <p class="user-role text-capitalize">
                        PJ {{ ucwords(strtolower(Auth::user()->kabupaten->nama)) }},<br>
                        {{ ucwords(strtolower(Auth::user()->kabupaten->provinsi->nama)) }}
                    </p>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('kabupaten.dashboard') }}" class="{{ request()->url() == route('kabupaten.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pompa Refocusing
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.pompa.ref.diterima') }}">Diterima</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.pompa.ref.digunakan') }}">Digunakan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pompa ABT
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.pompa.abt.usulan') }}">Usulan</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.pompa.abt.diterima') }}">Diterima</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.pompa.abt.digunakan') }}">Digunakan</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('luasTanamHarianKab') }}" class="{{ request()->url() == route('luasTanamHarianKab') ? 'active' : '' }}">Luas Tanam Harian</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Verifikasi Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.verif.ref.diterima.view') }}">Refocusing Diterima</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.verif.ref.digunakan.view') }}">Refocusing Digunakan</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.verif.abt.usulan.view') }}">ABT Usulan</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.verif.abt.diterima.view') }}">ABT Diterima</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.verif.abt.digunakan.view') }}">ABT Digunakan</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kabupaten.verif.luasTanam.view') }}">Luas Tanam Harian</a></li>
                    </ul>
                </li>
                {{-- <li><a href="{{ route('kabupaten.verifikasi.data') }}" class="{{ request()->url() == route('kabupaten.verifikasi.data') ? 'active' : '' }}">Verifikasi Data</a></li> --}}
            </ul>
            <a href="{{ route('logout') }}" class="logout">Logout</a>
        </div>

        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
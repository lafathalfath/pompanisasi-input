<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <link rel="stylesheet" href="styles.css"> --}}
        <title>Dashboard Admin</title>
        <link rel="shortcut icon" href="{{ asset('assets/img/logobbpsip.png') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            body {
                font-family: Poppins, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
            }

            .sidebar {
                width: 180px;
                background-color: #007b83;
                color: white;
                height: 100%;
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
            a{
                text-decoration: none;
            }
            .user-info {
                margin-top: 20px;
                text-align: left;
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
                <h1>Satgas Pompanisasi<br></h1>
                <div class="user-info text-left">
                    <div class="text-capitalize fw-bold mb-2">{{ Auth::user()->nama }}</div>
                    <p class="user-role text-capitalize">
                        Admin
                    </p>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->url() == route('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.verifikasiPj') }}" class="{{ request()->url() == route('admin.verifikasiPj') ? 'active' : '' }}">Verifikasi <br>Penanggungjawab</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kelola Wilayah
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="{{ route('admin.manage.provinsi') }}">Provinsi</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('admin.manage.kabupaten') }}">Kabupaten</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('admin.manage.kecamatan') }}">Kecamatan</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('admin.manage.desa') }}">Desa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.kelolaAkun') }}">Kelola Akun</a>
                </li>

            </ul>
            <br>
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </body>
</html>
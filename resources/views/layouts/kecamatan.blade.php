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
            /* width */
            .sidebar::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            .sidebar::-webkit-scrollbar-track {
                border: 1px solid lightgray;
                border-radius: 10px;
            }
            
            /* Handle */
            .sidebar::-webkit-scrollbar-thumb {
                background: lightgray; 
                border-radius: 10px;
            }

            .sidebar::-webkit-scrollbar-thumb:hover {
                background: gray; 
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
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('kecamatan.dashboard') }}" class="{{ request()->url() == route('kecamatan.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                
                {{-- <li><a href="{{ route('kecamatan.dashboard') }}" class="{{ request()->url() == route('kecamatan.dashboard') ? 'active' : '' }}">Pompa Refocusing</a></li>    --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pompa Refocusing
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="{{ route('kecamatan.pompa.ref.usulan') }}">Usulan</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kecamatan.pompa.ref.diterima') }}">Diterima</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kecamatan.pompa.ref.digunakan') }}">Digunakan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pompa ABT
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="{{ route('kecamatan.pompa.abt.usulan') }}">Usulan</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kecamatan.pompa.abt.diterima') }}">Diterima</a></li>
                        <li><a class="dropdown-item text-dark" href="{{ route('kecamatan.pompa.abt.digunakan') }}">Digunakan</a></li>
                    </ul>
                </li>


                {{-- <li><a href="{{ route('kecamatan.dashboard') }}" class="{{ request()->url() == route('kecamatan.dashboard') ? 'active' : '' }}">Pompa ABT</a></li> --}}
                
                {{-- <li><a href="{{ route('kecamatan.refocusing.usulan.input') }}" class="{{ request()->url() == route('kecamatan.refocusing.usulan.input') ? 'active' : '' }}" target="_blank">Input pompanisasi refocusing usulan</a></li>
                <li><a href="{{ route('kecamatan.refocusing.diterima.input') }}" class="{{ request()->url() == route('kecamatan.refocusing.diterima.input') ? 'active' : '' }}" target="_blank">Input pompanisasi refocusing diterima</a></li>
                <li><a href="{{ route('kecamatan.refocusing.digunakan.input') }}" class="{{ request()->url() == route('kecamatan.refocusing.digunakan.input') ? 'active' : '' }}" target="_blank">Input pompanisasi refocusing digunakan</a></li>
                <li><a href="{{ route('kecamatan.abt.usulan.input') }}" class="{{ request()->url() == route('kecamatan.abt.usulan.input') ? 'active' : '' }}" target="_blank">Input pompanisasi ABT usulan</a></li>
                <li><a href="{{ route('kecamatan.abt.diterima.input') }}" class="{{ request()->url() == route('kecamatan.abt.diterima.input') ? 'active' : '' }}" target="_blank">Input pompanisasi ABT diterima</a></li>
                <li><a href="{{ route('kecamatan.abt.digunakan.input') }}" class="{{ request()->url() == route('kecamatan.abt.digunakan.input') ? 'active' : '' }}" target="_blank">Input pompanisasi ABT digunakan</a></li> --}}
            </ul>
            <br>
            <a href="{{ route('logout') }}" class="logout">Logout</a>
        </div>

        <div class="content">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
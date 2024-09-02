<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi ditolak</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logobbpsip.png') }}"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        a {
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body style="height: 100dvh; background-color: #eee">
    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
        <div class="bg-light p-5 rounded-3 shadow d-flex flex-column align-items-center justify-content-center">
            <div class="w-100">
                <a href="{{ route('logout') }}">&#129104; Logout</a>
            </div>
            <img src="/assets/img/logobbpsip.png" alt="Logo">
            <h4>Satgas Pompanisasi</h4>
            <br>
            <h5>Akun ditolak atau dinonaktifkan</h5>
            <p>Silahkan hubungi Admin atau PJ Wilayah</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
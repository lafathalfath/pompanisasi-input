@extends('layouts.kecamatan')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pompanisasi Kelompok Tani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .info-section {
            margin-top: 20px;
        }
        .info-section h5 {
            font-weight: bold;
        }
        .data-section {
            margin-top: 20px;
            font-weight: bold;
        }
        .data-section p {
            margin-bottom: 5px;
        }
        .image-section img {
            width: 100%;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h5><b>Pompa Refocusing Digunakan</b></h5>

<br><br>

<div class="container mt-4">
    <!-- Info Section -->
    <div class="row info-section">
        <div class="col-md-3">
            <h5>Tanggal</h5>
            <p>04-08-2024</p>
        </div>
        <div class="col-md-3">
            <h5>Desa/Kelurahan</h5>
            <p>Cisarua</p>
        </div>
        <div class="col-md-3">
            <h5>Kelompok Tani</h5>
            <p>Kelompok tani I</p>
        </div>
        <div class="col-md-3">
            <h5>Luas Lahan (HA)</h5>
            <p>10</p>
        </div>
    </div>

    <br><br>

    <div class="row info-section">
        <div class="col-md-3">
            <h5>Usulan ABT 3 Inch (unit)</h5>
            <p>3</p>
        </div>
        <div class="col-md-3">
            <h5>Usulan ABT 4 Inch (unit)</h5>
            <p>1</p>
        </div>
        <div class="col-md-3">
            <h5>Usulan ABT 6 Inch (unit)</h5>
            <p>2</p>
        </div>
        <div class="col-md-3">
            <h5>No HP Poktan</h5>
            <p>08123456789</p>
        </div>
    </div>

    <br><br><br>

    <!-- Image Section -->
    <div class="row image-section">
        <div class="col-12">
            <h5 class="text-center"><b>DOKUMENTASI FOTO</b></h5>
            <img src="https://cdn.ajnn.net/files/images/20240626-img-8166.jpg" alt="Dokumentasi Foto">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection
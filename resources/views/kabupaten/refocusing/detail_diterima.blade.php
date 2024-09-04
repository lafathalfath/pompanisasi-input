@extends('layouts.kabupaten')
@section('content')
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


<br><br>

<div class="container mt-4">
    <h3><b>Pompa Refocusing Diterima</b></h3><br>
    <!-- Info Section -->
    <div class="row info-section">
        <div class="col-md-3">
            <h5>Tanggal</h5>
            <p>{{ $ref_diterima->tanggal }}</p>
        </div>
        <div class="col-md-3">
            <h5>Desa/Kelurahan</h5>
            <p>{{ $ref_diterima->desa->nama }}</p>
        </div>
        <div class="col-md-3">
            <h5>Kelompok Tani</h5>
            <p>{{ $ref_diterima->nama_poktan }}</p>
        </div>
        <div class="col-md-3">
            <h5>Luas Lahan (Ha)</h5>
            <p>{{ $ref_diterima->luas_lahan }}</p>
        </div>
    </div>

    <br><br>

    <div class="row info-section">
        <div class="col-md-3">
            <h5>Pompa Refocusing 3 Inch (unit)</h5>
            <p>{{ $ref_diterima->pompa_3_inch }}</p>
        </div>
        <div class="col-md-3">
            <h5>Pompa Refocusing 4 Inch (unit)</h5>
            <p>{{ $ref_diterima->pompa_4_inch }}</p>
        </div>
        <div class="col-md-3">
            <h5>Pompa Refocusing 6 Inch (unit)</h5>
            <p>{{ $ref_diterima->pompa_6_inch }}</p>
        </div>
        <div class="col-md-3">
            <h5>No HP Poktan</h5>
            <p>{{ $ref_diterima->no_hp_poktan ? $ref_diterima->no_hp_poktan : '-' }}</p>
        </div>
    </div>

    <br><br><br>

    <!-- Image Section -->
    <div class="row image-section">
        <div class="col-12">
            <h5 class="text-center"><b>DOKUMENTASI FOTO</b></h5>
            <img src="{{ $ref_diterima->url_gambar }}" alt="Dokumentasi Foto">
        </div>
    </div>
</div>
@endsection
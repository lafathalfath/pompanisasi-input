@extends('layouts.kecamatan')
@section('content')

<style>
    .table thead th {
        vertical-align: middle;
        text-align: center;
        background-color: #c8dce4;
    }

    .merged-cell {
        background-color: #d9ead3;
        text-align: center;
        vertical-align: middle;
    }
    .mt-4 {
    margin-left: px;
    }
    .detail-button {
        background-color: #c8dce4;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 7px;
        text-decoration: none !important;
        color: black;
    }

</style>

<div class="container mt-4">
    <div class="row" style="margin-left: 3px">
        <h2>Rekap Data Kecamatan</h2>
        <table class="table table-bordered table-custom" style="width: 45%; margin-right: 20px; display: inline-table;">
            <thead>
                <tr>
                    <th colspan="2">CPCL Pompa Refocusing</th>
                </tr>
            </thead>
            <tbody>
                {{-- buat sidebar di halaman dashboard --}}
                <tr>
                    <td style="font-weight: bold;">Refocusing Usulan</td>
                    <td style="padding: 10px 20px;">0</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Diterima</td>
                    <td style="padding: 10px 20px;">0</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Digunakan</td>
                    <td style="padding: 10px 20px;">0</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-custom" style="width: 45%;">
            <thead>
                <tr>
                    <th colspan="2">CPCL Pompa ABT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">ABT Usulan</td>
                    <td style="padding: 10px 20px;">0</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Diterima</td>
                    <td style="padding: 10px 20px;">0</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Digunakan</td>
                    <td style="padding: 10px 20px;">0</td>
                </tr>
            </tbody>
        </table>
        {{-- tabel untuk luas Tanam Harian --}}
    <h5><b>Luas Tanam Harian</b></h5>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Desa</th>
                <th>Kelompok Tani</th>
                <th>Luas Tanam (ha)</th>
            </tr>
        </thead>
        <tbody>
            {{-- contoh isi data dummy yang diambil --}}
            <tr>
                <td>1</td>
                <td>2024-07-01</td>
                <td>Kotanagara</td>
                <td>Mekar Jaya</td>
                <td>7</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2024-07-01</td>
                <td>Cikeruh</td>
                <td>Harapan Baru</td>
                <td>5</td>
            </tr>
            <tr>
                <td>3</td>
                <td>2024-07-01</td>
                <td>Payungagung</td>
                <td>Subur Makmur</td>
                <td>6</td>
            </tr>
            <tr>
                <td>4</td>
                <td>2024-07-01</td>
                <td>Sukamulya</td>
                <td>Mandiri Tani</td>
                <td>8</td>
            </tr>
            <tr>
                <td>5</td>
                <td>2024-07-01</td>
                <td>Sidaraja</td>
                <td>Sejahtera</td>
                <td>9</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

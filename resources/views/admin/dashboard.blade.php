@extends('layouts.admin')
@section('content')
<style>
    .content{
        margin-left: 180px;
    }
    th {
        vertical-align: middle;
        text-align: center;
    }
</style>
<div class="container mt-4">
    <h2>Dashboard Admin</h2><br>
    <h3>Rekapitulasi Penanggungjawab</h3>

    <table class="w-50 table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">Penanggungjawab</th>
                <th colspan="3" class="text-center">Status</th>
            </tr>
            <tr>
                <th>Ditolak</th>
                <th>Proses</th>
                <th>Terverifikasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Wilayah</td>
                <td>{{ $summary['wilayah']['ditolak'] }}</td>
                <td>{{ $summary['wilayah']['proses'] }}</td>
                <td>{{ $summary['wilayah']['terverifikasi'] }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>{{ $summary['provinsi']['ditolak'] }}</td>
                <td>{{ $summary['provinsi']['proses'] }}</td>
                <td>{{ $summary['provinsi']['terverifikasi'] }}</td>
            </tr>
            <tr>
                <td>Kabupaten/Kota</td>
                <td>{{ $summary['kabupaten']['ditolak'] }}</td>
                <td>{{ $summary['kabupaten']['proses'] }}</td>
                <td>{{ $summary['kabupaten']['terverifikasi'] }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>{{ $summary['kecamatan']['ditolak'] }}</td>
                <td>{{ $summary['kecamatan']['proses'] }}</td>
                <td>{{ $summary['kecamatan']['terverifikasi'] }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.provinsi')
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

    .btn btn-sm btn-info {
        background-color: yellow;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
    }

    .content {
        margin-left: 180px;
    }
</style>

<h5><b>Luas Tanam Harian</b></h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Wilayah</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>Luas Tanam (ha)</th>
        </tr>
    </thead>
    <tbody>

            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
    </tbody>
</table>

@endsection
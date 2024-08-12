@extends('layouts.provinsi')
@section('content')

<head>
    <style>
        .content{
        margin-left: 200px;
    }
    </style>
</head>

<div class="d-flex flex-col justify-content-center">
    <div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Provinsi</th>
                    <th rowspan="2">Kabupaten</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Kelompok tani</th>
                    <th rowspan="2">Luas lahan (ha)</th>
                    <th colspan="3" class="text-center">Pompa Refocusing Diterima</th>
                    <th rowspan="2">No HP Poktan (jika ada)</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>3 inch (unit)</th>
                    <th>4 inch (unit)</th>
                    <th>6 inch (unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jawa Barat</td>
                    <td>Bogor</td>
                    <td>Babakan</td>
                    <td>Kelompok tani 1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>08123456789</td>
                    <td><a href="{{ route('provinsi.detailkabupaten') }}" class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            </tbody>
        </table>

    </div>

</div>
@endsection

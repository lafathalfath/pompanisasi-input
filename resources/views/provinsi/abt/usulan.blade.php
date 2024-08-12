@extends('layouts.provinsi')
@section('content')

<head>
    <style>
        .content{
        margin-left: 200px;
    }
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
    </style>
</head>

</style>
<div class="d-flex flex-col justify-content-center">
    <div>
        <!-- <div>
            <a href="{{ route('kecamatan.abt.usulan.input') }}" type="submit" class="btn btn-success">Input Data</a>
        </div><br> -->
        <div class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <i class="fa-solid fa-sliders"></i>
            <input type="date" class="form-control" id="date">
            <select name="kota_kabupaten" class="form-control" id="kota-kabupaten">
                <option value="" disabled selected>Pilih Provinsi</option>
                <option value="Jawa Barat">Jawa Barat</option>
                <option value="Jawa Tengah">Jawa Tengah</option>
                <!-- Tambahkan opsi Provinsi lainnya yang 1 wilayah -->
            </select>
        </div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kabupaten</th>
                    <th rowspan="2">Kelompok tani</th>
                    <th rowspan="2">Luas lahan (ha)</th>
                    <th colspan="3" class="text-center">Pompa Refocusing Usulan</th>
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
                    <td>Bogor</td>
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

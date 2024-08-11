@extends('layouts.nasional')

@section('content')
<div class="d-flex flex-col justify-content-center">
    <!-- Bagian Filter -->
    <div class="mb-3">
        <div class="d-flex justify-content-between">
            <div>
                <!-- Filter Tanggal -->
                <label for="filter-tanggal" class="form-label">Filter Tanggal</label>
                <input type="date" id="filter-tanggal" class="form-control">
            </div>
            <div>
                <!-- Filter Provinsi -->
                <label for="filter-provinsi" class="form-label">Filter Provinsi</label>
                <select id="filter-provinsi" class="form-control">
                    <option value="">Semua Provinsi</option>
                    <option value="jawa-barat">Jawa Barat</option>
                    <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
                </select>
            </div>
        </div>
    </div>

    <!-- Tombol Input Data -->
    <div class="mb-3">
        <a href="{{ route('kecamatan.refocusing.usulan.input') }}" class="btn btn-success">Input Data</a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Provinsi</th>
                    <th rowspan="2">Kabupaten</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Kelompok Tani</th>
                    <th rowspan="2">Luas Lahan (ha)</th>
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
                    <td>Kelompok Tani 1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>08123456789</td>
                    <td><a href="{{ route('provinsi.detailprovinsi') }}" class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

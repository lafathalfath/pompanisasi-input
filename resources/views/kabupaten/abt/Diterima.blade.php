@extends('layouts.kabupaten')
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
</style>
<div class="d-flex flex-col justify-content-center">
    <div>
        <br>
        <div class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <i class="fa-solid fa-sliders"></i>
            <input type="date" class="form-control" id="date">
            <select name="kota_kabupaten" class="form-control" id="kota-kabupaten">
                <option value="" disabled selected>Pilih Kecamatan</option>
                <option value="Bogor Utara">Bogor Utara</option>
                <option value="Bogor Tengah">Bogor Tengah</option>
                <!-- Tambahkan opsi kota/kabupaten lainnya -->
            </select>
        </div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Kelompok tani</th>
                    <th rowspan="2">Luas lahan (ha)</th>
                    <th colspan="3" class="text-center">Pompa ABT Diterima</th>
                    <th rowspan="2">No HP Poktan (jika ada)</th>
                    <th rowspan="2">Aksi</th>
                    {{-- <th rowspan="2">Total diusulkan (unit)</th> --}}
                </tr>
                <tr>
                    <th>3 inch (unit)</th>
                    <th>4 inch (unit)</th>
                    <th>6 inch (unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    {{-- contoh isi data dummy sementara--}}
                    <td>1</td>
                    <td>Bogor Utara</td>
                    <td>4-08-2024</td>
                    <td>Kelompok tani 1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>08123456789</td>
                    <td><a href="" class="btn btn-sm btn-info">Detail</a></td>
                    {{-- <td>0</td> --}}
                </tr>
            </tbody>
        </table>

    </div>

</div>
@endsection

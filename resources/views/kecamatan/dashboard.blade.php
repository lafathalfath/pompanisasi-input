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
</style>

<div class="container mt-4">
    <h2>CPCL Pompa ABT</h2>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal:</label>
        <input type="date" class="form-control" id="date">
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Kabupaten/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa ABT Usulan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Total diusulkan (unit)</th>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Kabupaten/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa ABT Diterima</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Total Diterima (unit)</th>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Kabupaten/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa ABT Digunakan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Total Digunakan (unit)</th>
        </tr>
        <tr>
            <th>Pompa 3 inch (unit)</th>
            <th>Pompa 4 inch (unit)</th>
            <th>Pompa 6 inch (unit)</th>
            <th>Pompa 3 inch (unit)</th>
            <th>Pompa 4 inch (unit)</th>
            <th>Pompa 6 inch (unit)</th>
            <th>Pompa 3 inch (unit)</th>
            <th>Pompa 4 inch (unit)</th>
            <th>Pompa 6 inch (unit)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kota Bogor</td>
            <td>Bogor Tengah</td>
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kota Bogor</td>
            <td>Bogor Tengah</td>
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kota Bogor</td>
            <td>Bogor Tengah</td>
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kabupaten Sukabumi</td>
            <td>Nagrak</td>
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kabupaten Sukabumi</td>
            <td>Nagrak</td>
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kabupaten Sukabumi</td>
            <td>Nagrak</td>
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>
    <table class="table table-bordered table-custom" style="width: fit-content;">
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
</div>
<div class="container mt-4">
    <h2>CPCL Pompa Refocusing</h2>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal:</label>
        <input type="date" class="form-control" id="date">
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">Refocusing Usulan</th>
            <th rowspan="2">Refocusing Diterima</th>
            <th rowspan="2">Refocusing Digunakan</th> -->
            <th rowspan="2">Kabupaten/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa Refocusing Usulan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Total diusulkan (unit)</th>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">Refocusing Usulan</th>
            <th rowspan="2">Refocusing Diterima</th>
            <th rowspan="2">Refocusing Digunakan</th> -->
            <th rowspan="2">Kabupaten/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa Refocusing Diterima</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Total Diterima (unit)</th>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">Refocusing Usulan</th>
            <th rowspan="2">Refocusing Diterima</th>
            <th rowspan="2">Refocusing Digunakan</th> -->
            <th rowspan="2">Kabupaten/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa Refocusing Digunakan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Total Digunakan (unit)</th>
        </tr>
        <tr>
            <th>Pompa 3 inch (unit)</th>
            <th>Pompa 4 inch (unit)</th>
            <th>Pompa 6 inch (unit)</th>
            <th>Pompa 3 inch (unit)</th>
            <th>Pompa 4 inch (unit)</th>
            <th>Pompa 6 inch (unit)</th>
            <th>Pompa 3 inch (unit)</th>
            <th>Pompa 4 inch (unit)</th>
            <th>Pompa 6 inch (unit)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kota Bogor</td>
            <td>Bogor Tengah</td>
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kota Bogor</td>
            <td>Bogor Tengah</td>
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kota Bogor</td>
            <td>Bogor Tengah</td>
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kabupaten Sukabumi</td>
            <td>Nagrak</td>
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kabupaten Sukabumi</td>
            <td>Nagrak</td>
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Kabupaten Sukabumi</td>
            <td>Nagrak</td>
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            <td>0</td>
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>
    <table class="table table-bordered table-custom" style="width: fit-content;">
        <thead>
            <tr>
                <th colspan="2">CPCL Pompa Refocusing</th>
                </tr>
                </thead>
                <tbody>
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
</div>
@endsection
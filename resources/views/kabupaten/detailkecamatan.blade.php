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

<div class="container mt-4">
    <div class="row" style="margin-left: 3px">
        <h2>Rekap Data Kecamatan</h2>
        <table class="table table-bordered table-custom" style="width: fit-content; margin-right: 20px; display: inline-table;">
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
    <br><br>
    <h2>Detail Data Pompa ABT</h2>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal:</label>
        <input type="date" class="form-control" id="date">
    </div>

    <h5><b>Usulan Pompa ABT</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Usulan Pompa ABT</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
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
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>

    <h5><b>Pompa ABT Diterima</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa ABT Diterima</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
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
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>

    <h5><b>Pompa ABT Diterima</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa ABT Digunakan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
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
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>
</div>
<br><br>
<div class="container mt-4">
    <h2>Detail Data Pompa Refocusing</h2>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal:</label>
        <input type="date" class="form-control" id="date">
    </div>

    <h5><b>Usulan Pompa Refocusing</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Usulan Pompa Refocusing</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
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
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>

    <h5><b>Pompa Refocusing Diterima</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa Refocusing Diterima</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
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
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>

    <h5><b>Pompa Refocusing Digunakan</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <!-- <th rowspan="2">ABT Usulan</th>
            <th rowspan="2">ABT Diterima</th>
            <th rowspan="2">ABT Digunakan</th> -->
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa Refocusing Digunakan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
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
            <td>1</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Babakan</td>
            <td>Kelompok tani 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <tr>
            <td>2</td>
            <!-- <td>0</td>
            <td>0</td>
            <td>0</td> -->
            <td>Cisarua</td>
            <td>Kelompok tani 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>08123456789</td>
            {{-- <td>0</td> --}}
        </tr>
        <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>
</div>
@endsection
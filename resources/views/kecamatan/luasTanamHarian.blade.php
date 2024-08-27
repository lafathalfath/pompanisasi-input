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
<div class="d-flex flex-col justify-content-center">
    <div>
        {{-- <div>
            <a href="{{ route('kecamatan.abt.usulan.input') }}" type="submit" class="btn btn-success">Input Data</a>
            <a href="{{ url('/export-pompa-abt-usulan') }}" class="btn btn-secondary"><i class="fa fa-download"></i> Excel</a>
        </div><br> --}}
        <div class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ route('kecamatan.inputLuasTanam') }}" type="submit" class="d-flex align-items-center btn btn-success" style="white-space: nowrap;">Input Data</a>
            <a href="{{ url('/export-luastanamharian') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" class="form-control" id="date">
            <select name="desa_id" class="form-control" id="desa">
                <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                {{-- @foreach ($desa as $des)
                    <option value="{{ $des->id }}">{{ $des->nama }}</option>
                @endforeach --}}
            </select>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Kelompok Tani</th>
                    <th>Luas Tanam (ha)</th>
                </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> --}}
                @forelse ($luas_tanam as $lt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lt->tanggal }}</td>
                        <td>{{ $lt->desa->kecamatan->nama }}</td>
                        <td>{{ $lt->desa->nama }}</td>
                        <td>{{ $lt->nama_poktan }}</td>
                        <td>{{ $lt->luas_tanam }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>


{{-- <h5><b>Luas Tanam Harian</b></h5>
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
</table> --}}

@endsection
@extends('layouts.poktan')
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0]
    title.innerHTML += ' | Dashboard'
</script>

<style>
    .table thead th {
        vertical-align: middle;
        text-align: center;
    }
    .merged-cell {
        background-color: #d9ead3;
        text-align: center;
        vertical-align: middle;
    }
    .merged-cell-yellow {
        background-color: #fff2cc;
        text-align: center;
        vertical-align: middle;
    }
    .merged-cell-pink {
        background-color: #ead1dc;
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="container">
    <h1 class="mt-5">Rekapitulasi Perluasan Areal Tanam dan Pompanisasi</h1>

    <form method="GET" class="my-3">
        <div class="form-group">
            <label for="kecamatan">Filter by Kecamatan</label>
            <input type="text" name="desa" id="kecamatan" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" class="merged-cell">No</th>
                <th rowspan="2" class="merged-cell">Desa</th>
                <th rowspan="2" class="merged-cell">Luas Tanam</th>
                <th colspan="3" class="merged-cell-pink">Pompa Refocusing</th>
                <th colspan="3" class="merged-cell-yellow">Pompa ABT</th>
            </tr>
            <tr>
                <th class="merged-cell-pink">Usulan</th>
                <th class="merged-cell-pink">Diterima</th>
                <th class="merged-cell-pink">Digunakan</th>
                <th class="merged-cell-yellow">Usulan</th>
                <th class="merged-cell-yellow">Diterima</th>
                <th class="merged-cell-yellow">Digunakan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp

            @forelse ($pompanisasi as $i=>$pomp)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $pomp->desa->nama }}</td>
                    <td>{{ $pomp->luas_tanam }}</td>
                    <td>{{ $pomp->pompa_refocusing->usulan }}</td>
                    <td>{{ $pomp->pompa_refocusing->diterima }}</td>
                    <td>{{ $pomp->pompa_refocusing->digunakan }}</td>
                    <td>{{ $pomp->pompa_abt->usulan }}</td>
                    <td>{{ $pomp->pompa_abt->diterima }}</td>
                    <td>{{ $pomp->pompa_abt->digunakan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">Data belum ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection


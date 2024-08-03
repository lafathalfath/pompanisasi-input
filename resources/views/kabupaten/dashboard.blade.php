{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Perluasan Areal Tanam dan Pompanisasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> --}}
@extends('layouts.kabupaten')
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
                <input type="text" name="kecamatan" id="kecamatan" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="merged-cell">No</th>
                    <th rowspan="2" class="merged-cell">Kecamatan</th>
                    <th rowspan="2" class="merged-cell">Desa</th>
                    <th rowspan="2" class="merged-cell">Nama Poktan</th>
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

                @forelse ($expand_kecamatan as $i=>$exp)
                    <tr>
                        {{-- no --}}
                        <td>{{ $nomor++ }}</td>
                        {{-- kecamatan --}}
                        <td>{{ $exp->kecamatan->nama }}</td>
                        {{-- desa --}}
                        <td>{{ $exp->desa->nama }}</td>
                        {{-- nama poktan --}}
                        <td>
                            @forelse ($exp->nama_poktan as $np)
                                @if ($loop->iteration == count($exp->nama_poktan))
                                    {{ $np }}
                                @else
                                    {{ $np }},<br/>
                                @endif
                            @empty
                                -
                            @endforelse
                        </td>
                        {{-- luas tanam --}}
                        <td>{{ $exp->luas_tanam }}</td>
                        {{-- pompa refocusing usulan --}}
                        <td>{{ $exp->pompanisasi->pompa_refocusing->usulan }}</td>
                        {{-- pompa refocusing diterima --}}
                        <td>{{ $exp->pompanisasi->pompa_refocusing->diterima }}</td>
                        {{-- pompa refocusing digunakan --}}
                        <td>{{ $exp->pompanisasi->pompa_refocusing->digunakan }}</td>
                        {{-- pompa abt usulan --}}
                        <td>{{ $exp->pompanisasi->pompa_abt->usulan }}</td>
                        {{-- pompa abt diterima --}}
                        <td>{{ $exp->pompanisasi->pompa_abt->diterima }}</td>
                        {{-- pompa abt digunakan --}}
                        <td>{{ $exp->pompanisasi->pompa_abt->digunakan }}</td>
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

{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}}

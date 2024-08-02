<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Perluasan Areal Tanam dan Pompanisasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
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

            @if ($kabupaten)
                @forelse ($kabupaten->kecamatan as $i=>$kec)
                    {{-- {{ dd('$kec') }} --}}
                    @foreach ($kec->desa as $j=>$des)
                        <tr>
                            {{-- no --}}
                            <td>{{ $nomor++ }}</td>
                            {{-- kecamatan --}}
                            <td>{{ $kec->nama }}</td>
                            {{-- desa --}}
                            <td>{{ $des->nama }}</td>
                            {{-- nama poktan --}}
                            <td>
                                @forelse ($des->pompanisasi as $despom)
                                    @if ($loop->iteration == count($des->pompanisasi))
                                        {{ $despom->poktan->nama }}
                                    @else
                                        {{ $despom->poktan->nama }},<br/>
                                    @endif
                                @empty
                                    -
                                @endforelse
                            </td>
                            {{-- luas tanam --}}
                            <td>
                                @php
                                    $luas_tanam = 0;
                                    foreach ($des->pompanisasi as $pom) {
                                        $luas_tanam += $pom->luas_tanam;
                                    }
                                @endphp
                                {{ $luas_tanam }}
                            </td>
                            {{-- pompa refocusing usulan --}}
                            <td>
                                @php
                                    $pru = 0;
                                    foreach ($des->pompanisasi as $pom) {
                                        $pru += $pom->pompa_refocusing->usulan;
                                    }
                                @endphp
                                {{ $pru }}
                            </td>
                            {{-- pompa refocusing diterima --}}
                            <td>
                                @php
                                    $prdt = 0;
                                    foreach ($des->pompanisasi as $pom) {
                                        $prdt += $pom->pompa_refocusing->diterima;
                                    }
                                @endphp
                                {{ $prdt }}
                            </td>
                            {{-- pompa refocusing digunakan --}}
                            <td>
                                @php
                                    $prdg = 0;
                                    foreach ($des->pompanisasi as $pom) {
                                        $prdg += $pom->pompa_refocusing->digunakan;
                                    }
                                @endphp
                                {{ $prdg }}
                            </td>
                            {{-- pompa abt usulan --}}
                            <td>
                                @php
                                    $pau = 0;
                                    foreach ($des->pompanisasi as $pom) {
                                        $pau += $pom->pompa_abt->usulan;
                                    }
                                @endphp
                                {{ $pau }}
                            </td>
                            {{-- pompa abt diterima --}}
                            <td>
                                @php
                                    $padt = 0;
                                    foreach ($des->pompanisasi as $pom) {
                                        $padt += $pom->pompa_abt->diterima;
                                    }
                                @endphp
                                {{ $padt }}
                            </td>
                            {{-- pompa abt digunakan --}}
                            <td>
                                @php
                                    $padg = 0;
                                    foreach ($des->pompanisasi as $pom) {
                                        $padg += $pom->pompa_abt->digunakan;
                                    }
                                @endphp
                                {{ $padg }}
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Data belum ditemukan</td>
                    </tr>
                @endforelse
            @else
                <tr>
                    <td colspan="12" class="text-center">Data belum ditemukan</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

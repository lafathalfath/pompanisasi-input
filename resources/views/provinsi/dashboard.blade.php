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
            <label for="provinsi">Filter by Provinsi</label>
            <input type="text" name="provinsi" id="provinsi" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" class="merged-cell">No</th>
                <th rowspan="2" class="merged-cell">Provinsi</th>
                <th rowspan="2" class="merged-cell">Nama Poktan</th>
                <th rowspan="2" class="merged-cell">CPCL Pompa</th>
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
                $data = [
                    ['provinsi' => 'provinsi A', 'nama_poktan' => 'Poktan 1', 'cpcl_pompa' => 0, 'luas_tanam' => 10, 'pompa_refocusing_usulan' => 23, 'pompa_refocusing_diterima' => 2, 'pompa_refocusing_digunakan' => 3, 'pompa_abt_usulan' => 12, 'pompa_abt_diterima' => 3, 'pompa_abt_digunakan' => 45],
                    ['provinsi' => 'provinsi B', 'nama_poktan' => 'Poktan 2', 'cpcl_pompa' => 0, 'luas_tanam' => 0, 'pompa_refocusing_usulan' => 0, 'pompa_refocusing_diterima' => 0, 'pompa_refocusing_digunakan' => 0, 'pompa_abt_usulan' => 0, 'pompa_abt_diterima' => 0, 'pompa_abt_digunakan' => 0],
                    ['provinsi' => 'provinsi C', 'nama_poktan' => 'Poktan 3', 'cpcl_pompa' => 0, 'luas_tanam' => 0, 'pompa_refocusing_usulan' => 0, 'pompa_refocusing_diterima' => 0, 'pompa_refocusing_digunakan' => 0, 'pompa_abt_usulan' => 0, 'pompa_abt_diterima' => 0, 'pompa_abt_digunakan' => 0],
                    // Tambahkan data dummy lainnya sesuai kebutuhan
                ];
            @endphp

            @forelse ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['provinsi'] }}</td>
                    <td>{{ $item['nama_poktan'] }}</td>
                    <td>{{ $item['cpcl_pompa'] }}</td>
                    <td>{{ $item['luas_tanam'] }}</td>
                    <td>{{ $item['pompa_refocusing_usulan'] }}</td>
                    <td>{{ $item['pompa_refocusing_diterima'] }}</td>
                    <td>{{ $item['pompa_refocusing_digunakan'] }}</td>
                    <td>{{ $item['pompa_abt_usulan'] }}</td>
                    <td>{{ $item['pompa_abt_diterima'] }}</td>
                    <td>{{ $item['pompa_abt_digunakan'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">No data found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

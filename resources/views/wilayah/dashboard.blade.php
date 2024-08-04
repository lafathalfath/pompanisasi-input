<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Perluasan Areal Tanam dan Pompanisasi Wilayah</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar {
            background-color: #006F91; 
        }
        .navbar-brand {
            display: flex;
            align-items: center; 
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .navbar-brand img {
            max-height: 50px; 
            margin-right: 20px; 
            margin-left: 100px
        }
        .table thead th {
            vertical-align: middle;
            text-align: center;
            background-color: #006F91; 
            color: white; 
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
        .container {
            margin-top: 20px; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="/assets/img/logobbpsip.png" alt="Logo">
            <span>Dashboard Perluasan Areal Tanam Dan Pompanisasi Wilayah</span>
        </a>
    </nav>

    <div class="container">
        <h1 class="mt-5">Rekapitulasi Perluasan Areal Tanam dan Pompanisasi Wilayah</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="merged-cell">No</th>
                    <th rowspan="2" class="merged-cell">Provinsi</th>
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
                        ['provinsi' => 'provinsi A', 'luas_tanam' => 10, 'pompa_refocusing_usulan' => 23, 'pompa_refocusing_diterima' => 2, 'pompa_refocusing_digunakan' => 3, 'pompa_abt_usulan' => 12, 'pompa_abt_diterima' => 3, 'pompa_abt_digunakan' => 45],
                        ['provinsi' => 'provinsi B', 'luas_tanam' => 0, 'pompa_refocusing_usulan' => 0, 'pompa_refocusing_diterima' => 0, 'pompa_refocusing_digunakan' => 0, 'pompa_abt_usulan' => 0, 'pompa_abt_diterima' => 0, 'pompa_abt_digunakan' => 0],
                        ['provinsi' => 'provinsi C', 'luas_tanam' => 0, 'pompa_refocusing_usulan' => 0, 'pompa_refocusing_diterima' => 0, 'pompa_refocusing_digunakan' => 0, 'pompa_abt_usulan' => 0, 'pompa_abt_diterima' => 0, 'pompa_abt_digunakan' => 0]
                    ];

                    $total = [
                        'luas_tanam' => 0,
                        'pompa_refocusing_usulan' => 0,
                        'pompa_refocusing_diterima' => 0,
                        'pompa_refocusing_digunakan' => 0,
                        'pompa_abt_usulan' => 0,
                        'pompa_abt_diterima' => 0,
                        'pompa_abt_digunakan' => 0
                    ];

                    foreach ($data as $item) {
                        $total['luas_tanam'] += $item['luas_tanam'];
                        $total['pompa_refocusing_usulan'] += $item['pompa_refocusing_usulan'];
                        $total['pompa_refocusing_diterima'] += $item['pompa_refocusing_diterima'];
                        $total['pompa_refocusing_digunakan'] += $item['pompa_refocusing_digunakan'];
                        $total['pompa_abt_usulan'] += $item['pompa_abt_usulan'];
                        $total['pompa_abt_diterima'] += $item['pompa_abt_diterima'];
                        $total['pompa_abt_digunakan'] += $item['pompa_abt_digunakan'];
                    }
                @endphp

                @forelse ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ url('/provinsi/' . urlencode($item['provinsi'])) }}">
                                {{ ucfirst($item['provinsi']) }}
                            </a>
                        </td>
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
                        <td colspan="9" class="text-center">No data found</td>
                    </tr>
                @endforelse

                <!--Total -->
                <tr class="total-row">
                    <td colspan="2">Total</td>
                    <td>{{ $total['luas_tanam'] }}</td>
                    <td>{{ $total['pompa_refocusing_usulan'] }}</td>
                    <td>{{ $total['pompa_refocusing_diterima'] }}</td>
                    <td>{{ $total['pompa_refocusing_digunakan'] }}</td>
                    <td>{{ $total['pompa_abt_usulan'] }}</td>
                    <td>{{ $total['pompa_abt_diterima'] }}</td>
                    <td>{{ $total['pompa_abt_digunakan'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
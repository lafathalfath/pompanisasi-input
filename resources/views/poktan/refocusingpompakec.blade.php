<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPCL Pompa Refocusing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>CPCL Pompa Refocusing</h2>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal: (Hari/Bulan/Tahun)</label>
        <input type="date" class="form-control" id="date">
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kabupaten/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Kelompok tani</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa Refocusing Usulan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Jumlah yg diusulkan (unit)</th>
        </tr>
        <tr>
            <th>Pompa 3 inch (unit)</th>
            <th>Pompa 4 inch (unit)</th>
            <th>Pompa 6 inch (unit)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Kabupaten/Kota 1</td>
            <td>Kecamatan 1</td>
            <td>Desa/Kel 1</td>
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
            <td>Kabupaten/Kota 2</td>
            <td>Kecamatan 2</td>
            <td>Desa/Kel 2</td>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

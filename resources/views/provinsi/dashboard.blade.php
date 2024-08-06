@extends('layouts.provinsi')
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

    .detail-button {
        background-color: yellow;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }
</style>

    <!-- Grafik -->
    <div class="container mt-4">
    <div class="chart-container">
        <canvas id="rekapDataChart" width="400" height="200"></canvas>
    </div> 
    <!-- Akhir Grafik -->

    <div class="row" style="margin-left: 3px">
        <h2>Rekap Data Provinsi</h2>
        <table class="table table-bordered table-custom" style="width: fit-content; margin-right: 20px; display: inline-table;">
            <thead>
                <tr>
                    <th colspan="2">CPCL Pompa Refocusing</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Refocusing Usulan</td>
                    <td style="padding: 10px 20px;">10</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Diterima</td>
                    <td style="padding: 10px 20px;">8</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Digunakan</td>
                    <td style="padding: 10px 20px;">7</td>
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
                    <td style="padding: 10px 20px;">15</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Diterima</td>
                    <td style="padding: 10px 20px;">13</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Digunakan</td>
                    <td style="padding: 10px 20px;">10</td>
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
            <th rowspan="2">Kabupaten</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Usulan Pompa ABT</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Aksi</th>
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
            <td>Bandung</td>
            <td>Arcamanik</td>
            <td>Babakan</td>
            <td>5</td>
            <td>2</td>
            <td>1</td>
            <td>1</td>
            <td>08123456789</td>
            <td><a href="{{ route('provinsi.detailkabupaten') }}" class="detail-button">Detail</a></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Bogor</td>
            <td>Ciomas</td>
            <td>Cisarua</td>
            <td>10</td>
            <td>3</td>
            <td>2</td>
            <td>1</td>
            <td>08123456789</td>
            <td><button class="detail-button">Detail</button></td>
        </tr>
        </tbody>
    </table>

    <h5><b>Pompa ABT Diterima</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kabupaten</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa ABT Diterima</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Aksi</th>
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
            <td>Bandung</td>
            <td>Arcamanik</td>
            <td>Babakan</td>
            <td>5</td>
            <td>2</td>
            <td>1</td>
            <td>1</td>
            <td>08123456789</td>
            <td><a href="{{ route('provinsi.detailkabupaten') }}" class="detail-button">Detail</a></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Bogor</td>
            <td>Ciomas</td>
            <td>Cisarua</td>
            <td>10</td>
            <td>3</td>
            <td>2</td>
            <td>1</td>
            <td>08123456789</td>
            <td><button class="detail-button">Detail</button></td>
        </tr>
        </tbody>
    </table>

    <h5><b>Pompa ABT Digunakan</b></h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kabupaten</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kel</th>
            <th rowspan="2">Luas lahan (ha)</th>
            <th colspan="3" class="text-center">Pompa ABT Digunakan</th>
            <th rowspan="2">No HP Poktan (jika ada)</th>
            <th rowspan="2">Aksi</th>
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
            <td>Bandung</td>
            <td>Arcamanik</td>
            <td>Babakan</td>
            <td>5</td>
            <td>2</td>
            <td>1</td>
            <td>1</td>
            <td>08123456789</td>
            <td><button class="detail-button">Detail</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Bogor</td>
            <td>Ciomas</td>
            <td>Cisarua</td>
            <td>10</td>
            <td>3</td>
            <td>2</td>
            <td>1</td>
            <td>08123456789</td>
            <td><button class="detail-button">Detail</button></td>
        </tr>
        </tbody>
    </table>
</div>

<br><br>

<div class="container mt-4">
    <h2>Luas tanam harian</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kab/Kota</th>
                <th>Kec.</th>
                <th>Desa</th>
                <th>Kelompok Tani</th>
                <th>Luas Tanam (ha)</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Garut</td>
                <td>Banyuresmi</td>
                <td>Kotanagara</td>
                <td>Mekar Jaya</td>
                <td>7</td>
                <td>2024-07-01</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Sumedang</td>
                <td>Jatinangor</td>
                <td>Cikeruh</td>
                <td>Harapan Baru</td>
                <td>5</td>
                <td>2024-07-02</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Ciamis</td>
                <td>Panumbangan</td>
                <td>Payungagung</td>
                <td>Subur Makmur</td>
                <td>6</td>
                <td>2024-07-03</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Majalengka</td>
                <td>Kertajati</td>
                <td>Sukamulya</td>
                <td>Mandiri Tani</td>
                <td>8</td>
                <td>2024-07-04</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Kuningan</td>
                <td>Cilimus</td>
                <td>Sidaraja</td>
                <td>Sejahtera</td>
                <td>9</td>
                <td>2024-07-05</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari tabel
    var refocusingUsulan = 10;
    var refocusingDiterima = 8;
    var refocusingDigunakan = 7;

    var abtUsulan = 15;
    var abtDiterima = 13;
    var abtDigunakan = 10;

    // Menghitung persentase baru
    var refocusingDiterimaPercent = (refocusingDiterima / refocusingUsulan) * 100;
    var refocusingDigunakanPercent = (refocusingDigunakan / refocusingUsulan) * 100;

    var abtDiterimaPercent = (abtDiterima / abtUsulan) * 100;
    var abtDigunakanPercent = (abtDigunakan / abtUsulan) * 100;

    var ctx = document.getElementById('rekapDataChart').getContext('2d');
    var rekapDataChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Refocusing', 'ABT'],
            datasets: [
                {
                    label: 'Diterima (%)',
                    data: [refocusingDiterimaPercent, abtDiterimaPercent],
                    backgroundColor: '#2ecc71', // Hijau
                },
                {
                    label: 'Digunakan (%)',
                    data: [refocusingDigunakanPercent, abtDigunakanPercent],
                    backgroundColor: '#e74c3c', // Merah
                }
            ]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Persentase (%)'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase CPCL Pompa Refocusing dan ABT',
                    font: {
                        size: 18
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.x + '%';
                        }
                    }
                }
            }
        }
    });
</script>

@endsection

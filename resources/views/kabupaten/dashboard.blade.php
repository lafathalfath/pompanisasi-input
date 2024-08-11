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
    <!-- Grafik -->
<div class="container mt-4">
    <div class="chart-container">
        <canvas id="rekapDataChart" width="400" height="200"></canvas>
    </div>
    <!-- Akhir Grafik Risqi -->

    <div class="row" style="margin-left: 3px">
        <h2>Rekap Data Kabupaten</h2>
        <table class="table table-bordered table-custom" style="width: 45%; margin-right: 20px; display: inline-table;">
            <thead>
                <tr>
                    <th colspan="2">CPCL Pompa Refocusing</th>
                </tr>
            </thead>
            <tbody>
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
        <table class="table table-bordered table-custom" style="width: 45%;">
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
        <h5><b>Luas Tanam Harian</b></h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Luas Tanam (ha)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($luas_tanam_harian as $lt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lt->tanggal }}</td>
                        <td>{{ $lt->desa->kecamatan->nama }}</td>
                        <td>{{ $lt->desa->nama }}</td>
                        <td>{{ $lt->luas_tanam }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
                @endforelse
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
</script>
<script>

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
                    label: 'Diterima (unit)',
                    data: [refocusingDiterimaPercent, abtDiterimaPercent],
                    backgroundColor: '#18a4bc', // Hijau
                },
                {
                    label: 'Digunakan (unit)',
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
                        text: 'unit'
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

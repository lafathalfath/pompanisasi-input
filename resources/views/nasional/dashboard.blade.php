@extends('layouts.nasional')
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
        background-color: #c8dce4;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 7px;
        text-decoration: none !important;
        color: black;
    }
</style>

    <!-- Grafik -->
    <div class="container mt-4">
    <div class="chart-container">
        <canvas id="rekapDataChart" width="400" height="200"></canvas>
    </div>
    <!-- Akhir Grafik -->

    <div class="row" style="margin-left: 3px">
        <h2>Rekap Data Nasional</h2>
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

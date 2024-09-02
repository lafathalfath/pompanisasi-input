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
    {{-- <!-- Grafik -->
<div class="container mt-4">
    <div class="chart-container">
        <canvas id="rekapDataChart" width="400" height="200"></canvas>
    </div>
    <!-- Akhir Grafik Risqi --> --}}
    <div class="row ms-5" style="margin-left: 3px">
        <h2>Rekapitulasi Data Provinsi</h2>
        <table class="table table-bordered table-custom" style="width: 45%; margin-right: 20px; display: inline-table;">
            <thead>
                <tr>
                    <th>Pompa Refocusing</th>
                    <th>Satuan <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Refocusing Diterima</td>
                    <td style="padding: 10px 20px;" id="ref_diterima">{{ $pompanisasi->ref_diterima }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Digunakan</td>
                    <td style="padding: 10px 20px;" id="ref_digunakan">{{ $pompanisasi->ref_dimanfaatkan }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-custom" style="width: 45%;">
            <thead>
                <tr>
                    <th>Pompa ABT</th>
                    <th>Satuan <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">ABT Usulan</td>
                    <td style="padding: 10px 20px;" id="abt_usulan">{{ $pompanisasi->abt_usulan }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Diterima</td>
                    <td style="padding: 10px 20px;" id="abt_diterima">{{ $pompanisasi->abt_diterima }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Digunakan</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompanisasi->abt_dimanfaatkan }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-custom" style="width: 45%;">
            <thead>
                <tr>
                    <th>Luas Tanam</th>
                    <th>Satuan <br>(ha)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Luas Tanam</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompanisasi->luas_tanam }}</td>
                </tr>
            </tbody>
        </table>
    </div>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    // Data dari tabel
    // var refocusingUsulan = 10;
    var refocusingDiterima = parseInt(document.getElementById('ref_diterima').innerHTML)
    var refocusingDigunakan = parseInt(document.getElementById('ref_digunakan').innerHTML)

    var abtUsulan = parseInt(document.getElementById('abt_usulan').innerHTML)
    var abtDiterima = parseInt(document.getElementById('abt_diterima').innerHTML)
    var abtDigunakan = parseInt(document.getElementById('abt_digunakan').innerHTML)

    // Menghitung persentase baru

    // var refocusingDiterimaPercent = (refocusingDiterima / refocusingUsulan) * 100;
    // var refocusingDigunakanPercent = (refocusingDigunakan / refocusingUsulan) * 100;
    var refocusingDiterimaPercent = (refocusingDiterima / (refocusingDiterima + refocusingDigunakan)) * 100
    var refocusingDigunakanPercent = (refocusingDigunakan / (refocusingDiterima + refocusingDigunakan)) * 100

    // var abtDiterimaPercent = (abtDiterima / abtUsulan) * 100;
    // var abtDigunakanPercent = (abtDigunakan / abtUsulan) * 100;
    var abtUsulanPercent = (abtUsulan / (abtUsulan + abtDiterima + abtDigunakan)) * 100
    var abtDiterimaPercent = (abtDiterima / (abtUsulan + abtDiterima + abtDigunakan)) * 100
    var abtDigunakanPercent = (abtDigunakan / (abtUsulan + abtDiterima + abtDigunakan)) * 100

    var ctx = document.getElementById('rekapDataChart').getContext('2d');
    var rekapDataChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Refocusing', 'ABT'],
            datasets: [
                {
                    label: 'Usulan (unit)',
                    data: [null, abtUsulanPercent],
                    backgroundColor: '#ffff22', // Kuning
                },
                {
                    label: 'Diterima (unit)',
                    data: [refocusingDiterimaPercent, abtDiterimaPercent],
                    backgroundColor: '#00aa00', // Hijau
                },
                {
                    label: 'Digunakan (unit)',
                    data: [refocusingDigunakanPercent, abtDigunakanPercent],
                    backgroundColor: '#18a4bc', // Biru
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
</script> --}}

@endsection

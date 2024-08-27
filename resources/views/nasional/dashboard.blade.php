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
        background-color: yellow;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .chart-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
    }

    .content {
        margin-left: 180px;
    }

    canvas {
        max-width: 300px; /* Mengatur ukuran maksimal canvas */
        max-height: 200px; /* Mengatur tinggi maksimal canvas */
    }
</style>

<div class="container mt-4">
    <div class="chart-container">
        <canvas id="refocusingChart" width="300" height="200"></canvas>
        <canvas id="abtChart" width="300" height="200"></canvas>
    </div>

    <div class="row" style="margin-left: 3px">
        <h2>Rekapitulasi Data Nasional</h2>
        <table class="table table-bordered table-custom" style="width: 45%; margin-right: 20px; display: inline-table;">
            <thead>
                <tr>
                    <th>Pompa Refocusing</th>
                    <th>Satuan <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Refocusing Usulan</td>
                    <td style="padding: 10px 20px;" id="ref_usulan">15000</td> <!-- Data dummy -->
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Diterima</td>
                    <td style="padding: 10px 20px;" id="ref_diterima">10000</td> <!-- Data dummy -->
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Digunakan</td>
                    <td style="padding: 10px 20px;" id="ref_digunakan">8000</td> <!-- Data dummy -->
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
                    <td style="padding: 10px 20px;" id="abt_usulan">20000</td> <!-- Data dummy -->
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Diterima</td>
                    <td style="padding: 10px 20px;" id="abt_diterima">15000</td> <!-- Data dummy -->
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Digunakan</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">12000</td> <!-- Data dummy -->
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
                    <td style="padding: 10px 20px;" id="luas_tanam">5000</td> <!-- Data dummy -->
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-4">
    <h3>Rekapitulasi Perluasan Areal Tanam dan Pompanisasi Nasional</h3>
    <div class="row">

        <div class="col">
            <div class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
                <a href="{{ url('/export-luastanamharian') }}" class="d-flex align-items-center btn btn-secondary">
                    <i class="fa fa-download me-2"></i> Excel
                </a>
                <select name="provinsi_id" class="form-control" id="provinsi">
                <option value="" disabled selected>Pilih Provinsi</option>
                </select>
                <select name="kabupaten_id" class="form-control" id="kabupaten">
                <option value="" disabled selected>Pilih Kabupaten</option>
                </select>
                <select name="kecamatan_id" class="form-control" id="kecamatan">
                <option value="" disabled selected>Pilih Kecamatan</option>
                </select>
            </div>
                <table class="table table-bordered table-custom">
                <thead>
                    <tr>
                        <th rowspan="2" class="merged-cell">No</th>
                        <th rowspan="2" class="merged-cell">Provinsi</th>
                        <th colspan="2" class="merged-cell">Pompa Refocusing</th>
                        <th colspan="4" class="merged-cell">Pompa ABT</th>
                        <th rowspan="2" class="merged-cell">Luas Tanam (ha)</th>
                    </tr>
                    <tr>
                        <th>Digunakan</th>
                        <th>Diterima</th>
                        <th>Usulan</th>
                        <th>Diterima</th>
                        <th>Digunakan</th>
                        <th>Luas Tanam (ha)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Jawa Barat</td>
                        <td>1000</td>
                        <td>1200</td>
                        <td>500</td>
                        <td>700</td>
                        <td>600</td>
                        <td>2500</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var refocusingTarget = 25771;
    var abtTarget = 37607;

    var refocusingUsulan = parseInt(document.getElementById('ref_usulan').innerHTML);
    var refocusingDiterima = parseInt(document.getElementById('ref_diterima').innerHTML);
    var refocusingDigunakan = parseInt(document.getElementById('ref_digunakan').innerHTML);

    var abtUsulan = parseInt(document.getElementById('abt_usulan').innerHTML);
    var abtDiterima = parseInt(document.getElementById('abt_diterima').innerHTML);
    var abtDigunakan = parseInt(document.getElementById('abt_digunakan').innerHTML);

    // Menghitung persentase berdasarkan target
    var refocusingUsulanPercent = (refocusingUsulan / refocusingTarget) * 100;
    var refocusingDiterimaPercent = (refocusingDiterima / refocusingTarget) * 100;
    var refocusingDigunakanPercent = (refocusingDigunakan / refocusingTarget) * 100;

    var abtUsulanPercent = (abtUsulan / abtTarget) * 100;
    var abtDiterimaPercent = (abtDiterima / abtTarget) * 100;
    var abtDigunakanPercent = (abtDigunakan / abtTarget) * 100;

    // Grafik Refocusing
    var ctxRefocusing = document.getElementById('refocusingChart').getContext('2d');
    var refocusingChart = new Chart(ctxRefocusing, {
        type: 'bar',
        data: {
            labels: ['Usulan', 'Diterima', 'Digunakan'],
            datasets: [{
                label: 'Refocusing (25.771)',
                data: [refocusingUsulanPercent, refocusingDiterimaPercent, refocusingDigunakanPercent],
                backgroundColor: ['#ffff22', '#00aa00', '#18a4bc'],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Percent (%)'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase Refocusing',
                    font: {
                        size: 16
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + '%';
                        }
                    }
                }
            }
        }
    });

    // Grafik ABT
    var ctxAbt = document.getElementById('abtChart').getContext('2d');
    var abtChart = new Chart(ctxAbt, {
        type: 'bar',
        data: {
            labels: ['Usulan', 'Diterima', 'Digunakan'],
            datasets: [{
                label: 'ABT (37.607)',
                data: [abtUsulanPercent, abtDiterimaPercent, abtDigunakanPercent],
                backgroundColor: ['#ffff22', '#00aa00', '#18a4bc'],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Percent (%)'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase ABT',
                    font: {
                        size: 16
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + '%';
                        }
                    }
                }
            }
        }
    });

</script>

@endsection

@extends('layouts.kecamatan')
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
    .mt-4 {
    margin-left: px;
    }
    .detail-button {
        background-color: #c8dce4;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 7px;
        text-decoration: none !important;
        color: black;
    }

    .card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-bottom: 20px;
        padding: 20px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
    }

    /* Membatasi ukuran grafik donat agar tetap di dalam box */
    .chart-container canvas {
        max-width: 150px;
        max-height: 150px;
    }

    /* Kustomisasi untuk grafik Luas Tanam agar mengikuti ukuran card */
    .luas-tanam-container canvas {
        max-width: 100%;
        max-height: 600px;
    }

    .custom-header {
        background-color: #6f42c1;
        color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        text-align: center;
    }

    .custom-header h1 {
        margin: 0;
        font-size: 1.8rem;
    }

    /* Flexbox untuk mengatur card Pompa Refocusing dan Pompa ABT secara horizontal */
    .card-group {
        display: flex;
        justify-content: space-between;
    }

    .card-group .card {
        flex: 1;
        margin: 0 10px;
    }
</style>

{{-- <div class="container mt-4">
    <div class="row" style="margin-left: 3px">
        <h2>Rekapitulasi Data Kecamatan</h2>
        <table class="table table-bordered table-custom" style="width: 45%; margin-right: 20px; display: inline-table;">
            <thead>
                <tr>
                    <th>Pompa Refocusing</th>
                    <th>Total <br>(Unit)</th>
                    <th>Terverifikasi <br>(Unit)</th>
                    <th>Belum <br>Diverifikasi <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Refocusing Diterima</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_diterima->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_diterima->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_diterima->belum_verifikasi }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Digunakan</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_digunakan->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_digunakan->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_digunakan->belum_verifikasi }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-custom" style="width: 45%;">
            <thead>
                <tr>
                    <th>Pompa ABT</th>
                    <th>Total <br>(Unit)</th>
                    <th>Terverifikasi <br>(Unit)</th>
                    <th>Belum <br>Diverifikasi <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">ABT Usulan</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_usulan->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_usulan->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_usulan->belum_verifikasi }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Diterima</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_diterima->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_diterima->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_diterima->belum_verifikasi }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Digunakan</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_digunakan->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_digunakan->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_digunakan->belum_verifikasi }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-custom" style="width: 45%;">
            <thead>
                <tr>
                    <th>Luas Tanam</th>
                    <th>Total <br>(Unit)</th>
                    <th>Terverifikasi <br>(Unit)</th>
                    <th>Belum <br>Diverifikasi <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Luas Tanam</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompa->luas_tanam->total }}</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompa->luas_tanam->terverifikasi }}</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompa->luas_tanam->belum_verifikasi }}</td>
                </tr>
            </tbody>
        </table>
</div> --}}

<div class="container my-4">
    <div class="custom-header">
        <h1>Kinerja Satgas Pompa</h1>
    </div>

    <!-- Row 1: Pompa Refocusing & Pompa ABT -->
    <div class="card-group mb-4">
        <!-- Pompa Refocusing -->
        <div class="card">
            <h5 class="text-center">Pompa Refocusing</h5>
            <div class="d-flex">
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="refocusingChart"></canvas>
                    </div>
                    <div class="stat-value" id="ref-diterima">{{ $pompa->ref_diterima->total }}</div>
                    <div class="stat-label">Diterima</div>
                </div>
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="refocusingUsedChart"></canvas>
                    </div>
                    <div class="stat-value" id="ref-dimanfaatkan">{{ $pompa->ref_digunakan->total }}</div>
                    <div class="stat-label">Dimanfaatkan</div>
                </div>
            </div>
            <h4 class="text-center">Usulan : <div id="ref-target">25771</div></h4>
        </div>

        <!-- Pompa ABT -->
        <div class="card">
            <h5 class="text-center">Pompa ABT</h5>
            <div class="d-flex">
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="abtProposalChart"></canvas>
                    </div>
                    <div class="stat-value" id="abt-usulan">{{ $pompa->abt_usulan->total }}</div>
                    <div class="stat-label">Diusulkan</div>
                </div>
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="abtUsedChart"></canvas>
                    </div>
                    <div class="stat-value" id="abt-diterima">{{ $pompa->abt_diterima->total }}</div>
                    <div class="stat-label">Diterima</div>
                </div>
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="abtDimanfaatkanChart"></canvas>
                    </div>
                    <div class="stat-value" id="abt-dimanfaatkan">{{ $pompa->abt_digunakan->total }}</div>
                    <div class="stat-label">Dimanfaatkan</div>
                </div>
            </div>
            <h4 class="text-center">Target : <div id="abt-target">37607</div></h4>
        </div>
    </div>

    <!-- Row 2: Luas Tanam Harian -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <h5 class="text-center">Luas Tanam Harian</h5>
                <p class="text-center text-muted">Total Luas Tanam: <span class="stat-value"><span id="luas-tanam">{{ $pompa->luas_tanam->total }}</span> ha</span></p>
                <div class="chart-container luas-tanam-container">
                    <canvas id="tanamChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart.js Script -->
<script>
    const ref_target = document.getElementById('ref-target').innerHTML
    const ref_diterima = parseInt(document.getElementById('ref-diterima').innerHTML)
    const ref_dimanfaatkan = parseInt(document.getElementById('ref-dimanfaatkan').innerHTML)
    const abt_target = parseInt(document.getElementById('abt-target').innerHTML)
    const abt_usulan = parseInt(document.getElementById('abt-usulan').innerHTML)
    const abt_diterima = parseInt(document.getElementById('abt-diterima').innerHTML)
    const abt_dimanfaatkan = parseInt(document.getElementById('abt-dimanfaatkan').innerHTML)
    const luas_tanam = parseInt(document.getElementById('luas-tanam').innerHTML)

    const ctxRefocusing = document.getElementById('refocusingChart').getContext('2d');
    const refocusingChart = new Chart(ctxRefocusing, {
        type: 'doughnut',
        data: {
            labels: ['Diterima', 'Belum Diterima'],
            datasets: [{
                data: [ref_diterima, ref_diterima>ref_target ? 0 : ref_target - ref_diterima],
                backgroundColor: ['#4caf50', '#e0e0e0'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const ctxRefocusingUsed = document.getElementById('refocusingUsedChart').getContext('2d');
    const refocusingUsedChart = new Chart(ctxRefocusingUsed, {
        type: 'doughnut',
        data: {
            labels: ['Dimanfaatkan', 'Belum Dimanfaatkan'],
            datasets: [{
                data: [ref_dimanfaatkan, ref_dimanfaatkan>ref_target ? 0 : ref_target - ref_dimanfaatkan],
                backgroundColor: ['#ff9800', '#e0e0e0'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const ctxAbtProposal = document.getElementById('abtProposalChart').getContext('2d');
    const abtProposalChart = new Chart(ctxAbtProposal, {
        type: 'doughnut',
        data: {
            labels: ['Diusulkan', 'Belum Diusulkan'],
            datasets: [{
                data: [abt_usulan, abt_usulan>abt_target ? 0 : abt_target - abt_usulan],
                backgroundColor: ['#2196f3', '#e0e0e0'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const ctxAbtUsed = document.getElementById('abtUsedChart').getContext('2d');
    const abtUsedChart = new Chart(ctxAbtUsed, {
        type: 'doughnut',
        data: {
            labels: ['Diterima', 'Belum Diterima'],
            datasets: [{
                data: [abt_diterima, abt_diterima>abt_target ? 0 : abt_target - abt_diterima],
                backgroundColor: ['#4caf50', '#e0e0e0'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const ctxAbtDimanfaatkan = document.getElementById('abtDimanfaatkanChart').getContext('2d');
    const abtDimanfaatkanChart = new Chart(ctxAbtDimanfaatkan, {
        type: 'doughnut',
        data: {
            labels: ['Dimanfaatkan', 'Belum Dimanfaatkan'],
            datasets: [{
                data: [abt_dimanfaatkan, abt_dimanfaatkan>abt_target ? 0 : abt_target - abt_dimanfaatkan],
                backgroundColor: ['#ff9800', '#e0e0e0'], //dimanfaatkan
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const ctx = document.getElementById('tanamChart').getContext('2d');
    const tanamChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($luas_tanam)) !!},
            datasets: [{
                label: 'Luas Tanam Harian (ha)',
                data: {!! json_encode(array_values($luas_tanam)) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
</script>
@endsection

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
                    <td style="font-weight: bold;">Refocusing Diterima</td>
                    <td style="padding: 10px 20px;" id="ref_diterima">{{ $pompanisasi->ref_diterima }}</td> <!-- Data dummy -->
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Digunakan</td>
                    <td style="padding: 10px 20px;" id="ref_digunakan">{{ $pompanisasi->ref_dimanfaatkan }}</td> <!-- Data dummy -->
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
                    <td style="padding: 10px 20px;" id="abt_usulan">{{ $pompanisasi->abt_usulan }}</td> <!-- Data dummy -->
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Diterima</td>
                    <td style="padding: 10px 20px;" id="abt_diterima">{{ $pompanisasi->abt_diterima }}</td> <!-- Data dummy -->
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Digunakan</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompanisasi->abt_dimanfaatkan }}</td> <!-- Data dummy -->
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
                    <td style="padding: 10px 20px;" id="luas_tanam">{{ $pompanisasi->luas_tanam }}</td> <!-- Data dummy -->
                </tr>
            </tbody>
        </table>
    </div>
</div> --}}
<div class="container mt-4">
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
                    <div class="stat-value" id="ref-diterima">{{ $pompanisasi->ref_diterima }}</div>
                    <div class="stat-label">Diterima</div>
                </div>
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="refocusingUsedChart"></canvas>
                    </div>
                    <div class="stat-value" id="ref-dimanfaatkan">{{ $pompanisasi->ref_dimanfaatkan }}</div>
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
                    <div class="stat-value" id="abt-usulan">{{ $pompanisasi->abt_usulan }}</div>
                    <div class="stat-label">Diusulkan</div>
                </div>
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="abtUsedChart"></canvas>
                    </div>
                    <div class="stat-value" id="abt-diterima">{{ $pompanisasi->abt_diterima }}</div>
                    <div class="stat-label">Diterima</div>
                </div>
                <div class="text-center flex-fill">
                    <div class="chart-container">
                        <canvas id="abtDimanfaatkanChart"></canvas>
                    </div>
                    <div class="stat-value" id="abt-dimanfaatkan">{{ $pompanisasi->abt_dimanfaatkan }}</div>
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
                <p class="text-center text-muted">Total Luas Tanam: <span class="stat-value"><span id="luas-tanam">{{ $pompanisasi->luas_tanam }}</span> ha</span></p>
                <div class="chart-container luas-tanam-container">
                    <canvas id="tanamChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h3>Rekapitulasi Perluasan Areal Tanam dan Pompanisasi Nasional</h3>
    <div class="row">

        <div class="col">
            {{-- <form action="{{ route('nasional.dashboard') }}" method="GET" class="mb-3" id="form-filter" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
                <select name="provinsi" class="form-control" id="filter-provinsi" onchange="handleFilter(this)">
                    <option value="" disabled selected>Pilih Provinsi</option>
                    @foreach ($provinsi as $prov)
                        <option value="{{ $prov->id }}" {{ request()->provinsi==$prov->id?'selected':'' }}>{{ $prov->nama }}</option>
                    @endforeach
                </select>
                <select name="kabupaten" class="form-control" id="filter-kabupaten" onchange="handleFilter(this)" {{ !request()->provinsi?'disabled':'' }}>
                    <option value="" disabled selected>Pilih Kabupaten</option>
                    @foreach ($kabupaten as $kab)
                        <option value="{{ $kab->id }}" {{ request()->kabupaten==$kab->id?'selected':'' }}>{{ $kab->nama }}</option>
                    @endforeach
                </select>
                <select name="kecamatan" class="form-control" id="filter-kecamatan" onchange="handleFilter(this)" {{ !request()->kabupaten?'disabled':'' }}>
                    <option value="" disabled selected>Pilih Kecamatan</option>
                    @foreach ($kecamatan as $kec)
                        <option value="{{ $kec->id }}" {{ request()->kecamatan==$kec->id?'selected':'' }}>{{ $kec->nama }}</option>
                    @endforeach
                </select>
                <select name="desa" class="form-control" id="filter-desa" onchange="handleFilter(this)" {{ !request()->kecamatan?'disabled':'' }}>
                    <option value="" disabled selected>Pilih Desa</option>
                    @foreach ($desa as $des)
                        <option value="{{ $des->id }}" {{ request()->desa==$des->id?'selected':'' }}>{{ $des->nama }}</option>
                    @endforeach
                </select>
                <a href="{{ route('nasional.dashboard') }}" class="btn btn-secondary">Reset</a>
            </form> --}}
                <table class="table table-bordered table-custom">
                <thead>
                    <tr>
                        <th rowspan="2" class="merged-cell">No</th>
                        <th rowspan="2" class="merged-cell">
                            {{-- @if (request()->kecamatan)
                                Desa
                            @elseif (request()->kabupaten)
                                Kecamatan
                            @elseif (request()->provinsi)
                                Kabupaten
                            @else --}}
                                Provinsi
                            {{-- @endif --}}
                        </th>
                        <th rowspan="2" class="merged-cell">Luas Tanam (ha)</th>
                        <th colspan="2" class="merged-cell">Pompa Refocusing</th>
                        <th colspan="4" class="merged-cell">Pompa ABT</th>
                    </tr>
                    <tr>
                        <th>Digunakan</th>
                        <th>Diterima</th>
                        <th>Usulan</th>
                        <th>Diterima</th>
                        <th>Digunakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekap as $rk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- @if (request()->kecamatan)
                                    {{ $rk->desa->nama }}
                                @elseif (request()->kabupaten)
                                    {{ $rk->kecamatan->nama }}
                                @elseif (request()->provinsi)
                                    {{ $rk->kabupaten->nama }}
                                @else --}}
                                    {{ $rk->provinsi->nama }}
                                {{-- @endif --}}
                            </td>
                            <td>{{ $rk->luas_tanam }}</td>
                            <td>{{ $rk->pompa_ref_diterima }}</td>
                            <td>{{ $rk->pompa_ref_dimanfaatkan }}</td>
                            <td>{{ $rk->pompa_abt_usulan }}</td>
                            <td>{{ $rk->pompa_abt_diterima }}</td>
                            <td>{{ $rk->pompa_abt_dimanfaatkan }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item {{ $rekap->currentPage()==1?'disabled':'' }}">
                            <a class="page-link" href="{{ route('nasional.dashboard', [...request()->query(), 'page' => $rekap->currentPage()-1]) }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item {{ $rekap->currentPage()==1?'disabled':'' }}">
                            <a class="page-link" href="{{ route('nasional.dashboard', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $rekap->lastPage(); $i++)
                            @if ($i>($rekap->currentPage()-5) && $i<($rekap->currentPage()+5))
                                <li class="page-item {{ $rekap->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('nasional.dashboard', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                            @endif
                        @endfor
                        <li class="page-item {{ $rekap->currentPage()==$rekap->lastPage()?'disabled':'' }}">
                            <a class="page-link" href="{{ route('nasional.dashboard', [...request()->query(), 'page' => $rekap->lastPage()]) }}" aria-label="Next">
                            <span aria-hidden="true">Last</span>
                            </a>
                        </li>
                        <li class="page-item {{ $rekap->currentPage()==$rekap->lastPage()?'disabled':'' }}">
                            <a class="page-link" href="{{ route('nasional.dashboard', [...request()->query(), 'page' => $rekap->currentPage()+1]) }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var refocusingTarget = 25771;
    var abtTarget = 37607;

    var refocusingDiterima = parseInt(document.getElementById('ref_diterima').innerHTML);
    var refocusingDigunakan = parseInt(document.getElementById('ref_digunakan').innerHTML);

    var abtUsulan = parseInt(document.getElementById('abt_usulan').innerHTML);
    var abtDiterima = parseInt(document.getElementById('abt_diterima').innerHTML);
    var abtDigunakan = parseInt(document.getElementById('abt_digunakan').innerHTML);

    // Menghitung persentase berdasarkan target
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
            labels: ['Diterima', 'Digunakan'],
            datasets: [{
                label: 'Refocusing (25.771)',
                data: [refocusingDiterimaPercent, refocusingDigunakanPercent],
                backgroundColor: ['#00aa00', '#18a4bc'],
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

    const handleFilter = (e) => {
        if (e.id == 'filter-provinsi') {
            document.getElementById('filter-kabupaten').value = ''
            document.getElementById('filter-kecamatan').value = ''
            document.getElementById('filter-desa').value = ''
        } else if (e.id == 'filter-kabupaten') {
            document.getElementById('filter-kecamatan').value = ''
            document.getElementById('filter-desa').value = ''
        } else if (e.id == 'filter-kecamatan') {
            document.getElementById('filter-desa').value = ''
        }
        document.getElementById('form-filter').submit()
    }
</script> --}}

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

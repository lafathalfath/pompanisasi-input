<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinerja Satgas Pompa</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f0f2f5;
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
</head>

<body>

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
                        <div class="stat-value">200</div>
                        <div class="stat-label">Diterima</div>
                    </div>
                    <div class="text-center flex-fill">
                        <div class="chart-container">
                            <canvas id="refocusingUsedChart"></canvas>
                        </div>
                        <div class="stat-value">200</div>
                        <div class="stat-label">Dimanfaatkan</div>
                    </div>
                </div>
                <h4 class="text-center">Usulan : ...</h4>
            </div>

            <!-- Pompa ABT -->
            <div class="card">
                <h5 class="text-center">Pompa ABT</h5>
                <div class="d-flex">
                    <div class="text-center flex-fill">
                        <div class="chart-container">
                            <canvas id="abtProposalChart"></canvas>
                        </div>
                        <div class="stat-value">200</div>
                        <div class="stat-label">Diusulkan</div>
                    </div>
                    <div class="text-center flex-fill">
                        <div class="chart-container">
                            <canvas id="abtUsedChart"></canvas>
                        </div>
                        <div class="stat-value">200</div>
                        <div class="stat-label">Diterima</div>
                    </div>
                    <div class="text-center flex-fill">
                        <div class="chart-container">
                            <canvas id="abtDimanfaatkanChart"></canvas>
                        </div>
                        <div class="stat-value">200</div>
                        <div class="stat-label">Dimanfaatkan</div>
                    </div>
                </div>
                <h4 class="text-center">Target : 100</h4>
            </div>
        </div>

        <!-- Row 2: Luas Tanam Harian -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="text-center">Luas Tanam Harian</h5>
                    <p class="text-center text-muted">Total Luas Tanam: <span class="stat-value">200 ha</span></p>
                    <div class="chart-container luas-tanam-container">
                        <canvas id="tanamChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        const ctxRefocusing = document.getElementById('refocusingChart').getContext('2d');
        const refocusingChart = new Chart(ctxRefocusing, {
            type: 'doughnut',
            data: {
                labels: ['Diterima', 'Belum Diterima'],
                datasets: [{
                    data: [200, 100 - 200],
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
                    data: [200, 100 - 200],
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
                    data: [200, 100 - 200],
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
                    data: [200, 100 - 200],
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
                    data: [200, 100 - 200],
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
                // labels: {--!! json_encode(array_keys($data['luas_tanam_harian']['harian'])) !!--},
                labels: 200,
                datasets: [{
                    label: 'Luas Tanam Harian (ha)',
                    // data: {--!! json_encode(array_values($data['luas_tanam_harian']['harian'])) !!--},
                    data: 200,
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

</body>

</html>

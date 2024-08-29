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
</style>
<div class="d-flex flex-col justify-content-center">
    <div>
        {{-- <div>
            <a href="{{ route('kecamatan.abt.usulan.input') }}" type="submit" class="btn btn-success">Input Data</a>
            <a href="{{ url('/export-pompa-abt-usulan') }}" class="btn btn-secondary"><i class="fa fa-download"></i> Excel</a>
        </div><br> --}}
        <form action="{{ route('kecamatan.pompa.abt.usulan') }}" method="GET" id="form-filter" class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ route('kecamatan.abt.usulan.input') }}" type="submit" class="d-flex align-items-center btn btn-success" style="white-space: nowrap;">Input Data</a>
            <a href="{{ url('/export-pompa-abt-usulan') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" name="tanggal" class="form-control" id="date" onchange="handleFilter()" value="{{ request()->tanggal }}">
            <select name="desa" class="form-control" id="desa" onchange="handleFilter()">
                <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                @foreach ($desa as $des)
                    <option value="{{ $des->id }}" {{ request()->desa==$des->id?'selected':'' }}>{{ $des->nama }}</option>
                @endforeach
            </select>
            <a href="{{ route('kecamatan.pompa.abt.usulan') }}" role="button" id="resetButton" class="btn btn-secondary">Reset</a>
        </form>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Desa/Kel</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Kelompok <br>tani</th>
                    <th rowspan="2">Luas lahan <br>(ha)</th>
                    <th colspan="3" class="text-center">Usulan Pompa ABT</th>
                    <th rowspan="2">Total <br>diusulkan</th>
                    <th rowspan="2">No HP Poktan <br>(jika ada)</th>
                    {{-- <th rowspan="2">Aksi</th> --}}
                </tr>
                <tr>
                    <th>3 inch <br>(unit)</th>
                    <th>4 inch <br>(unit)</th>
                    <th>6 inch <br>(unit)</th> 
                </tr>
            </thead>
            <tbody>
                @forelse ($abt_usulan as $au)
                <tr data-date="{{ $au->tanggal }}" data-desa-id="{{ $au->desa->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $au->desa->nama }}</td>
                    <td>{{ $au->tanggal }}</td>
                    <td>{{ $au->nama_poktan }}</td>
                    <td>{{ $au->luas_lahan }}</td>
                    <td>{{ $au->pompa_3_inch }}</td>
                    <td>{{ $au->pompa_4_inch }}</td>
                    <td>{{ $au->pompa_6_inch }}</td>
                    <td>{{ $au->total_unit }}</td>
                    <td>{{ $au->no_hp_poktan ? $au->no_hp_poktan : '-' }}</td>
                    {{-- <td><a href="" class="btn btn-sm btn-info">Detail</a></td> --}}
                </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $abt_usulan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kecamatan.pompa.abt.usulan', [...request()->query(), 'page' => $abt_usulan->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_usulan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kecamatan.pompa.abt.usulan', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $abt_usulan->lastPage(); $i++)
                        @if ($i>($abt_usulan->currentPage()-5) && $i<($abt_usulan->currentPage()+5))
                            <li class="page-item {{ $abt_usulan->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('kecamatan.pompa.abt.usulan', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $abt_usulan->currentPage()==$abt_usulan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kecamatan.pompa.abt.usulan', [...request()->query(), 'page' => $abt_usulan->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_usulan->currentPage()==$abt_usulan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kecamatan.pompa.abt.usulan', [...request()->query(), 'page' => $abt_usulan->currentPage()+1]) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

</div>

<script>
    const handleFilter = () => {
        document.getElementById('form-filter').submit()
    }

document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const desaSelect = document.getElementById('desa');
    const rows = document.querySelectorAll('tbody tr');
    const resetButton = document.getElementById('resetButton');

    function filterTable() {
        const selectedDate = dateInput.value;
        const selectedDesa = desaSelect.value;

        rows.forEach(row => {
            const rowDate = row.getAttribute('data-date');
            const rowDesaId = row.getAttribute('data-desa-id');

            const dateMatches = selectedDate === '' || rowDate === selectedDate;
            const desaMatches = selectedDesa === '' || rowDesaId === selectedDesa;

            if (dateMatches && desaMatches) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function resetFilters() {
        dateInput.value = '';
        desaSelect.value = '';
        rows.forEach(row => {
            row.style.display = '';
        });
    }

    dateInput.addEventListener('change', filterTable);
    desaSelect.addEventListener('change', filterTable);
    resetButton.addEventListener('click', resetFilters);
});

    </script>
    
@endsection
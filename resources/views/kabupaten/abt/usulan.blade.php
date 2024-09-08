@extends('layouts.kabupaten')
@section('content')
<style>
        .table thead th {
        vertical-align: middle;
        text-align: center;
        background-color: #c8dce4;
    }

    .content{
        margin-left: 200px;
    }

    .merged-cell {
        background-color: #d9ead3;
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="d-flex flex-col justify-content-center">
    <div>
        <br>
        <form action="{{ route('kabupaten.pompa.abt.usulan') }}" method="GET" id="form-filter" class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ url('/export-pompa-abt-usulan') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" name="tanggal" class="form-control" id="date" onchange="handleFilter(this)" value="{{ request()->tanggal }}">
            <select name="kecamatan" class="form-control" id="kecamatan" onchange="handleFilter(this)">
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
            <a href="{{ route('kabupaten.pompa.abt.usulan') }}" role="button" class="btn btn-secondary">Reset</a>
        </form>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Desa/Kelurahan</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Kelompok <br> tani</th>
                    <th rowspan="2">Luas lahan <br> (ha)</th>
                    <th colspan="3" class="text-center">Usulan Pompa ABT</th>
                    <th rowspan="2">Total diusulkan <br> (unit)</th>
                    <th rowspan="2">No HP Poktan <br> (jika ada)</th>
                </tr>
                <tr>
                    <th>3 inch <br> (unit)</th>
                    <th>4 inch <br> (unit)</th>
                    <th>6 inch <br> (unit)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($abt_usulan as $au)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $au->desa->kecamatan->nama }}</td>
                        <td>{{ $au->desa->nama }}</td>
                        <td>{{ $au->tanggal }}</td>
                        <td>{{ $au->nama_poktan }}</td>
                        <td>{{ $au->luas_lahan }}</td>
                        <td>{{ $au->pompa_3_inch }}</td>
                        <td>{{ $au->pompa_4_inch }}</td>
                        <td>{{ $au->pompa_6_inch }}</td>
                        <td>{{ $au->total_unit }}</td>
                        <td>{{ $au->no_hp_poktan ? $au->no_hp_poktan : '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="11" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $abt_usulan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.usulan', [...request()->query(), 'page' => $abt_usulan->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_usulan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.usulan', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $abt_usulan->lastPage(); $i++)
                        @if ($i>($abt_usulan->currentPage()-5) && $i<($abt_usulan->currentPage()+5))
                            <li class="page-item {{ $abt_usulan->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('kabupaten.pompa.abt.usulan', ['nama' => request()->query('nama'), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $abt_usulan->currentPage()==$abt_usulan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.usulan', ['nama' => request()->query('nama'), 'page' => $abt_usulan->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_usulan->currentPage()==$abt_usulan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.usulan', ['nama' => request()->query('nama'), 'page' => $abt_usulan->currentPage()+1]) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>

<script>
    const handleFilter = (e) => {
        if (e.id == 'filter-kecamatan') {
            document.getElementById('filter-desa').value = ''
        } 
        document.getElementById('form-filter').submit()
    }
</script>
@endsection
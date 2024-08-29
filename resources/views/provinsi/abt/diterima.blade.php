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
</style>
<div class="d-flex flex-col justify-content-center">
    <div>
        <br>
        <form action="{{ route('provinsi.pompa.abt.diterima') }}" method="GET" id="form-filter" class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ url('/export-pompa-ref-diterima') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" name="tanggal" class="form-control" id="date" onchange="handleFilter()" value="{{ request()->tanggal }}">
            <select name="kabupaten" class="form-control" id="kecamatan" onchange="handleFilter()">
                <option value="" disabled selected>Pilih Kabupaten</option>
                @foreach ($kabupaten as $kab)
                    <option value="{{ $kab->id }}" {{ request()->kabupaten==$kab->id?'selected':'' }}>{{ $kab->nama }}</option>
                @endforeach
            </select>
            <a href="{{ route('provinsi.pompa.abt.diterima') }}" role="button" class="btn btn-secondary">Reset</a>
        </form>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kabupaten/Kota</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Desa/Kel</th>
                    <th rowspan="2">Kelompok Tani</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Luas lahan (ha)</th>
                    <th colspan='3' class="text-center">Pompa ABT Diterima</th>
                    <th rowspan="2">Total Diterima<br>(unit)</th>
                    <th rowspan="2">No HP Poktan</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>3 inch <br>(unit)</th>
                    <th>4 inch <br>(unit)</th>
                    <th>6 inch <br>(unit)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($abt_diterima as $ad)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ad->desa->kecamatan->kabupaten->nama }}</td>
                        <td>{{ $ad->desa->kecamatan->nama }}</td>
                        <td>{{ $ad->desa->nama }}</td>
                        <td>{{ $ad->nama_poktan }}</td>
                        <td>{{ $ad->tanggal }}</td>
                        <td>{{ $ad->luas_lahan }}</td>
                        <td>{{ $ad->pompa_3_inch }}</td>
                        <td>{{ $ad->pompa_4_inch }}</td>
                        <td>{{ $ad->pompa_6_inch }}</td>
                        <td>{{ $ad->total_unit }}</td>
                        <td>{{ $ad->no_hp_poktan ? $ad->no_hp_poktan : '-' }}</td>
                        <td>
                            <a href="{{ route('provinsi.pompa.abt.diterima.detail', Crypt::encryptString($ad->id)) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="13" class="text-center">Belum ada Data</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $abt_diterima->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('provinsi.pompa.abt.diterima', [...request()->query(), 'page' => $abt_diterima->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_diterima->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('provinsi.pompa.abt.diterima', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $abt_diterima->lastPage(); $i++)
                        @if ($i>($abt_diterima->currentPage()-5) && $i<($abt_diterima->currentPage()+5))
                            <li class="page-item {{ $abt_diterima->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('provinsi.pompa.abt.diterima', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $abt_diterima->currentPage()==$abt_diterima->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('provinsi.pompa.abt.diterima', [...request()->query(), 'page' => $abt_diterima->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_diterima->currentPage()==$abt_diterima->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('provinsi.pompa.abt.diterima', [...request()->query(), 'page' => $abt_diterima->currentPage()+1]) }}" aria-label="Next">
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
</script>
@endsection

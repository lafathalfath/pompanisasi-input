@extends('layouts.wilayah')
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
        <form action="{{ route('wilayah.pompa.abt.digunakan') }}" method="GET" id="form-filter" class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ url('/export-pompa-abt-dimanfaatkan') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" name="tanggal" class="form-control" id="date" onchange="handleFilter(this)" value="{{ request()->tanggal }}">
            <select name="provinsi" class="form-control" id="provinsi" onchange="handleFilter(this)">
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
            <a href="{{ route('wilayah.pompa.abt.digunakan') }}" class="btn btn-secondary">Reset</a>
        </form>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Provinsi</th>
                    <th rowspan="2">Kabupaten</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Desa</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Kelompok <br>tani</th>
                    <th rowspan="2">Luas <br>lahan <br>(ha)</th>
                    <th colspan="3" class="text-center">Pompa ABT Dimanfaatkan</th>
                    <th rowspan="2">Total <br>dimafaatkan <br>(unit)</th>
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
                @forelse ($abt_dimanfaatkan as $ad)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ad->desa->kecamatan->kabupaten->provinsi->nama }}</td>
                        <td>{{ $ad->desa->kecamatan->kabupaten->nama }}</td>
                        <td>{{ $ad->desa->kecamatan->nama }}</td>
                        <td>{{ $ad->desa->nama }}</td>
                        <td>{{ $ad->tanggal }}</td>
                        <td>{{ $ad->nama_poktan }}</td>
                        <td>{{ $ad->luas_lahan }}</td>
                        <td>{{ $ad->pompa_3_inch }}</td>
                        <td>{{ $ad->pompa_4_inch }}</td>
                        <td>{{ $ad->pompa_6_inch }}</td>
                        <td>{{ $ad->total_unit }}</td>
                        <td>{{ $ad->no_hp_poktan ? $ad->no_hp_poktan : '-' }}</td>
                        <td><a href="{{ route('wilayah.pompa.abt.digunakan.detail', Crypt::encryptString($ad->id)) }}" class="btn btn-sm btn-info">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="14" class="text-center">Belum ada Data</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $abt_dimanfaatkan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('wilayah.pompa.abt.digunakan', [...request()->query(), 'page' => $abt_dimanfaatkan->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_dimanfaatkan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('wilayah.pompa.abt.digunakan', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $abt_dimanfaatkan->lastPage(); $i++)
                        @if ($i>($abt_dimanfaatkan->currentPage()-5) && $i<($abt_dimanfaatkan->currentPage()+5))
                            <li class="page-item {{ $abt_dimanfaatkan->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('wilayah.pompa.abt.digunakan', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $abt_dimanfaatkan->currentPage()==$abt_dimanfaatkan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('wilayah.pompa.abt.digunakan', [...request()->query(), 'page' => $abt_dimanfaatkan->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_dimanfaatkan->currentPage()==$abt_dimanfaatkan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('wilayah.pompa.abt.digunakan', [...request()->query(), 'page' => $abt_dimanfaatkan->currentPage()+1]) }}" aria-label="Next">
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
        if (e.id == 'filter-wilayah') {
            document.getElementById('filter-provinsi').value = ''
            document.getElementById('filter-kabupaten').value = ''
            document.getElementById('filter-kecamatan').value = ''
            document.getElementById('filter-desa').value = ''
        } else if (e.id == 'filter-provinsi') {
            document.getElementById('filter-kabupaten').value = ''
            document.getElementById('filter-kecamatan').value = ''
            document.getElementById('filter-desa').value = ''
        } else if (e.id == 'filter-kabupaten') {
            document.getElementById('filter-kecamatan').value = ''
            document.getElementById('filter-desa').value = ''
        } else if (e.id == 'filter-kecamatan') {
            document.getElementById('filter-desa').value = ''
        }
    }
</script>
@endsection

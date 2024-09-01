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
</style>
<div class="mx-5 d-flex flex-col justify-content-center">
    <div>
        <br>
        <form action="{{ route('luasTanamHarianNas') }}" method="GET" class="mb-3" id="form-filter" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ url('/export-luas-tanam-harian') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <input type="date" name="tanggal" id="" class="form-control" onchange="handleFilter(this)" value="{{ request()->tanggal }}">
            <select name="wilayah" class="form-control" id="filter-wilayah" onchange="handleFilter(this)">
                <option value="" disabled selected>Pilih Wilayah</option>
                @foreach ($wilayah as $wil)
                    <option value="{{ $wil->id }}" {{ request()->wilayah==$wil->id?'selected':'' }}>{{ $wil->nama }}</option>
                @endforeach
            </select>
            <select name="provinsi" class="form-control" id="filter-provinsi" onchange="handleFilter(this)" {{ !request()->wilayah?'disabled':'' }}>
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
            <a href="{{ route('luasTanamHarianNas') }}" class="btn btn-secondary">Reset</a>
        </form>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Wilayah</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Kelompok Tani</th>
                    <th>Luas Tanam (ha)</th>
                    <th>No Hp Poktan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($luas_tanam as $lt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lt->tanggal }}</td>
                        <td>{{ $lt->desa->kecamatan->kabupaten->provinsi->wilayah->nama }}</td>
                        <td>{{ $lt->desa->kecamatan->kabupaten->provinsi->nama }}</td>
                        <td>{{ $lt->desa->kecamatan->kabupaten->nama }}</td>
                        <td>{{ $lt->desa->kecamatan->nama }}</td>
                        <td>{{ $lt->desa->nama }}</td>
                        <td>{{ $lt->nama_poktan }}</td>
                        <td>{{ $lt->luas_tanam }}</td>
                        <td>{{ $lt->no_hp_poktan ? $lt->no_hp_poktan : '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center">Belum ada Data</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $luas_tanam->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('luasTanamHarianNas', [...request()->query(), 'page' => $luas_tanam->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $luas_tanam->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('luasTanamHarianNas', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $luas_tanam->lastPage(); $i++)
                        @if ($i>($luas_tanam->currentPage()-5) && $i<($luas_tanam->currentPage()+5))
                            <li class="page-item {{ $luas_tanam->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('luasTanamHarianNas', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $luas_tanam->currentPage()==$luas_tanam->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('luasTanamHarianNas', [...request()->query(), 'page' => $luas_tanam->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $luas_tanam->currentPage()==$luas_tanam->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('luasTanamHarianNas', [...request()->query(), 'page' => $luas_tanam->currentPage()+1]) }}" aria-label="Next">
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
        document.getElementById('form-filter').submit()
    }
</script>
@endsection
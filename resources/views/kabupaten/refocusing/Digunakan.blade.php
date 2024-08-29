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
        <form action="{{ route('kabupaten.pompa.ref.digunakan') }}" method="GET" id="form-filter" class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ url('/export-pompa-ref-dimanfaatkan') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" name="tanggal" class="form-control" id="date" onchange="handleFilter()" value="{{ request()->tanggal }}">
            <select name="kecamatan" class="form-control" id="kecamatan" onchange="handleFilter()">
                <option value="" disabled selected>Pilih Kecamatan</option>
                @foreach ($kecamatan as $kec)
                    <option value="{{ $kec->id }}" {{ request()->kecamatan==$kec->id?'selected':'' }}>{{ $kec->nama }}</option>
                @endforeach
            </select>
            <a href="{{ route('kabupaten.pompa.ref.digunakan') }}" role="button" class="btn btn-secondary">Reset</a>
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
                    <th colspan="3" class="text-center">Pompa refocusing Dimanfaatkan</th>
                    <th rowspan="2">Total digunakan <br> (unit)</th>
                    <th rowspan="2">No HP Poktan <br> (jika ada)</th>
                </tr>
                <tr>
                    <th>3 inch <br> (unit)</th>
                    <th>4 inch <br> (unit)</th>
                    <th>6 inch <br> (unit)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ref_digunakan as $rd)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rd->desa->kecamatan->nama }}</td>
                        <td>{{ $rd->desa->nama }}</td>
                        <td>{{ $rd->tanggal }}</td>
                        <td>{{ $rd->nama_poktan }}</td>
                        <td>{{ $rd->luas_lahan }}</td>
                        <td>{{ $rd->pompa_3_inch }}</td>
                        <td>{{ $rd->pompa_4_inch }}</td>
                        <td>{{ $rd->pompa_6_inch }}</td>
                        <td>{{ $rd->total_unit }}</td>
                        <td>{{ $rd->no_hp_poktan }}</td>
                    </tr>
                @empty
                    <tr><td colspan="11" class="text-center">Belum ada Data</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $ref_digunakan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.ref.digunakan', [...request()->query(), 'page' => $ref_digunakan->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $ref_digunakan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.ref.digunakan', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $ref_digunakan->lastPage(); $i++)
                        @if ($i>($ref_digunakan->currentPage()-5) && $i<($ref_digunakan->currentPage()+5))
                            <li class="page-item {{ $ref_digunakan->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('kabupaten.pompa.ref.digunakan', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $ref_digunakan->currentPage()==$ref_digunakan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.ref.digunakan', [...request()->query(), 'page' => $ref_digunakan->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $ref_digunakan->currentPage()==$ref_digunakan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.ref.digunakan', [...request()->query(), 'page' => $ref_digunakan->currentPage()+1]) }}" aria-label="Next">
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

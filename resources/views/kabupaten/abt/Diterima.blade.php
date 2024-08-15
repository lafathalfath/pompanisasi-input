@extends('layouts.kabupaten')
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
        <div class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ url('/export-pompa-abt-diterima') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" class="form-control" id="date">
            <select name="kota_kabupaten" class="form-control" id="kota-kabupaten">
                <option value="" disabled selected>Pilih Kecamatan</option>
                <option value="Bogor Utara">Bogor Utara</option>
                <option value="Bogor Tengah">Bogor Tengah</option>
                <!-- Tambahkan opsi kota/kabupaten lainnya -->
            </select>
        </div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Desa/Kelurahan</th>
                    <th colspan="3" class="text-center">Pompa ABT Diterima</th>
                    <th rowspan="2">Total diterima (unit)</th>
                </tr>
                <tr>
                    <th>3 inch (unit)</th>
                    <th>4 inch (unit)</th>
                    <th>6 inch (unit)</th>
                </tr>

            </thead>
            <tbody>
                @forelse ($abt_diterima as $ad)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ad->pompa_abt_usulan->pompanisasi->desa->kecamatan->nama }}</td>
                        <td>{{ $ad->pompa_abt_usulan->pompanisasi->desa->nama }}</td>
                        <td>{{ $ad->pompa_3_inch }}</td>
                        <td>{{ $ad->pompa_4_inch }}</td>
                        <td>{{ $ad->pompa_6_inch }}</td>
                        <td>{{ $ad->total_unit }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $abt_diterima->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.diterima', ['nama' => request()->query('nama'), 'page' => $abt_diterima->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_diterima->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.diterima', ['nama' => request()->query('nama'), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $abt_diterima->lastPage(); $i++)
                        @if ($i>($abt_diterima->currentPage()-5) && $i<($abt_diterima->currentPage()+5))
                            <li class="page-item {{ $abt_diterima->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('kabupaten.pompa.abt.diterima', ['nama' => request()->query('nama'), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $abt_diterima->currentPage()==$abt_diterima->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.diterima', ['nama' => request()->query('nama'), 'page' => $abt_diterima->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $abt_diterima->currentPage()==$abt_diterima->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.pompa.abt.diterima', ['nama' => request()->query('nama'), 'page' => $abt_diterima->currentPage()+1]) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>
@endsection

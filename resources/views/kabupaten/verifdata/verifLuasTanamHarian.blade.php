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

    .btn btn-sm btn-info {
        background-color: yellow;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
    }

    .content {
        margin-left: 180px;
    }
</style>
<div class="d-flex flex-col justify-content-center">
    <div>
        <h2>Verifikasi Data Luas Tanam Harian</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Kelompok Tani</th>
                    <th>Luas Tanam (ha)</th>
                    <th>No Hp Poktan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($luas_tanam as $lt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lt->tanggal }}</td>
                        <td>{{ $lt->desa->kecamatan->nama }}</td>
                        <td>{{ $lt->desa->nama }}</td>
                        <td>{{ $lt->nama_poktan }}</td>
                        <td>{{ $lt->luas_tanam }}</td>
                        <td>{{ $lt->no_hp_poktan ? $lt->no_hp_poktan : '-' }}</td>
                        <td>
                            @if ($lt->verified_at)
                                <span class="badge text-bg-success fs-6 fw-normal">Terverifikasi</span>
                            @else
                                <span class="badge text-bg-danger fs-6 fw-normal">Belum diverifikasi</span>
                            @endif
                        </td>
                        <td>
                            @if ($lt->verified_at)
                                <button title="batalkan verifikasi" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#unverifModal" onclick="handleUnverif('{{ route('kabupaten.verif.luasTanam.unverif', Crypt::encryptString($lt->id)) }}')"><span>&#10005;</span></button>
                            @elseif (!$lt->verified_at)
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#verifModal" onclick="handleClick('{{ route('kabupaten.verif.luasTanam.verif', Crypt::encryptString($lt->id)) }}')"><span>&#10003;</span></button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $luas_tanam->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.verif.luasTanam.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $luas_tanam->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $luas_tanam->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.verif.luasTanam.view', ['kecamatan' => request()->query('kecamatan'), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $luas_tanam->lastPage(); $i++)
                        @if ($i>($luas_tanam->currentPage()-5) && $i<($luas_tanam->currentPage()+5))
                            <li class="page-item {{ $luas_tanam->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('kabupaten.verif.luasTanam.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $luas_tanam->currentPage()==$luas_tanam->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.verif.luasTanam.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $luas_tanam->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $luas_tanam->currentPage()==$luas_tanam->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('kabupaten.verif.luasTanam.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $luas_tanam->currentPage()+1]) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

</div>

{{-- modals --}}
<div class="modal fade" id="verifModal" tabindex="-1" aria-labelledby="verifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="verifModalLabel">Konfirmasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Pastikan Anda telah mengkonfirmasi bahwa data ini valid.
            Lanjutkan Verifikasi?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form method="POST" class="p-0 m-0" id="verifForm">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Verifikasi</button>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unverifModal" tabindex="-1" aria-labelledby="unverifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="unverifModalLabel">Konfirmasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Apakah Anda yakin ingin membatalkan verifikasi data ini?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            <form method="POST" class="p-0 m-0" id="unverifForm">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger">Batalkan Verifikasi</button>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- end modals --}}

<script>
    const handleClick = (route) => {
        const form = document.getElementById('verifForm')
        form.action = route
    }
    const handleUnverif = (route) => {
        const form = document.getElementById('unverifForm')
        form.action = route
    }
</script>

@endsection
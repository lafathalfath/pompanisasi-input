@extends('layouts.kabupaten')
@section('content')
  <style>
    .content{
      margin-left: 180px;
    }

    .table thead th {
    vertical-align: middle;
    text-align: center;
    background-color: #c8dce4;
}
  </style>

  <script>
    const title = document.getElementsByTagName('title')[0]
    title.innerHTML += ' | Verifikasi Data'
  </script>

  <div class="container mt-4">
    <h2>Verifikasi Data Pompa ABT Diterima</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th rowspan="2">No</th>
          <th rowspan="2">Kecamatan</th>
          <th rowspan="2">Desa/Kelurahan</th>
          <th rowspan="2">Tanggal</th>
          <th rowspan="2">Kelompok<br>tani</th>
          <th rowspan="2">Luas lahan<br>(ha)</th>
          <th colspan="3">Pompa ABT Diterima</th>
          <th rowspan="2">Total Diterima<br>(unit)</th>
          <th rowspan="2">No HP Poktan<br>(jika ada)</th>
          <th rowspan="2">Detail</th>
          <th rowspan="2">Status</th>
          <th rowspan="2">Action</th>
      </tr>
      <tr>
          <th>3 inch<br>(unit)</th>
          <th>4 inch<br>(unit)</th>
          <th>6 inch<br>(unit)</th>
      </tr>
      </thead>
        <tbody>
          @forelse ($abt_diterima as $ad)
            <tr>
                <td>{{ $loop->iteration }}</td>
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
                <td>
                    <a href="{{ route('kabupaten.pompa.abt.diterima.detail', Crypt::encryptString($ad->id)) }}" class="btn btn-sm btn-info">Detail</a>
                </td>
                <td>
                  @if ($ad->verified_at)
                    <span class="badge text-bg-success fs-6 fw-normal">Terverifikasi</span>
                  @else
                    <span class="badge text-bg-danger fs-6 fw-normal">Belum diverifikasi</span>
                  @endif
                </td>
                <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                  @if ($ad->verified_at)
                    <button title="batalkan verifikasi" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#unverifModal" onclick="handleUnverif('{{ route('kabupaten.verif.abt.diterima.unverif', Crypt::encryptString($ad->id)) }}')"><span>&#10005;</span></button>
                  @elseif (!$ad->verified_at)
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#verifModal" onclick="handleClick('{{ route('kabupaten.verif.abt.diterima.verif', Crypt::encryptString($ad->id)) }}')"><span>&#10003;</span></button>
                  @endif
                </td>
            </tr>
          @empty
            <tr><td colspan="13" class="text-center">Belum ada data</td></tr>
          @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ $abt_diterima->currentPage()==1?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verif.abt.diterima.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $abt_diterima->currentPage()-1]) }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item {{ $abt_diterima->currentPage()==1?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verif.abt.diterima.view', ['kecamatan' => request()->query('kecamatan'), 'page' => 1]) }}" aria-label="Previous">
                <span aria-hidden="true">First</span>
                </a>
            </li>
            @for ($i = 1; $i <= $abt_diterima->lastPage(); $i++)
                @if ($i>($abt_diterima->currentPage()-5) && $i<($abt_diterima->currentPage()+5))
                    <li class="page-item {{ $abt_diterima->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('kabupaten.verif.abt.diterima.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $i]) }}">{{ $i }}</a></li>
                @endif
            @endfor
            <li class="page-item {{ $abt_diterima->currentPage()==$abt_diterima->lastPage()?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verif.abt.diterima.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $abt_diterima->lastPage()]) }}" aria-label="Next">
                <span aria-hidden="true">Last</span>
                </a>
            </li>
            <li class="page-item {{ $abt_diterima->currentPage()==$abt_diterima->lastPage()?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verif.abt.diterima.view', ['kecamatan' => request()->query('kecamatan'), 'page' => $abt_diterima->currentPage()+1]) }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
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


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
    <h2>Verifikasi Data Pompa Refocusing Diterima</h2>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Desa/Kelurahan</th>
            {{-- <th rowspan="2">Tanggal</th> --}}
            <th rowspan="2">Kelompok <br> Tani</th>
            <th rowspan="2">Luas <br> Tanam</th>
            <th colspan="2">Refocusing <br> Diterima</th>
            <th rowspan="2">Status</th>
            <th rowspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>
                    <span class="badge text-bg-danger fs-6 fw-normal">Belum diverifikasi</span>
                </td>
                <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                    <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                    <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
                </td>
            </tr>
          {{-- @empty
            <tr><td colspan="11" class="text-center">Belum ada data</td></tr>
          @endforelse --}}
        </tbody>
    </table>

    {{-- <div class="d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ $pompanisasi->currentPage()==1?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verifikasi.data', ['kecamatan' => request()->query('kecamatan'), 'page' => $pompanisasi->currentPage()-1]) }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item {{ $pompanisasi->currentPage()==1?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verifikasi.data', ['kecamatan' => request()->query('kecamatan'), 'page' => 1]) }}" aria-label="Previous">
                <span aria-hidden="true">First</span>
                </a>
            </li>
            @for ($i = 1; $i <= $pompanisasi->lastPage(); $i++)
                @if ($i>($pompanisasi->currentPage()-5) && $i<($pompanisasi->currentPage()+5))
                    <li class="page-item {{ $pompanisasi->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('kabupaten.verifikasi.data', ['kecamatan' => request()->query('kecamatan'), 'page' => $i]) }}">{{ $i }}</a></li>
                @endif
            @endfor
            <li class="page-item {{ $pompanisasi->currentPage()==$pompanisasi->lastPage()?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verifikasi.data', ['kecamatan' => request()->query('kecamatan'), 'page' => $pompanisasi->lastPage()]) }}" aria-label="Next">
                <span aria-hidden="true">Last</span>
                </a>
            </li>
            <li class="page-item {{ $pompanisasi->currentPage()==$pompanisasi->lastPage()?'disabled':'' }}">
                <a class="page-link" href="{{ route('kabupaten.verifikasi.data', ['kecamatan' => request()->query('kecamatan'), 'page' => $pompanisasi->currentPage()+1]) }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    </div> --}}

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
  {{-- end modals --}}

  <script>
    const handleClick = (route) => {
      const form = document.getElementById('verifForm')
      form.action = route
    }
  </script>

@endsection


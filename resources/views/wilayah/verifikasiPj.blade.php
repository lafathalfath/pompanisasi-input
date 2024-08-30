@extends('layouts.wilayah')
@section('content')
<style>
    .search-bar {
        margin-bottom: 30px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .search-bar input, .search-bar select {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 0px;
    }
    .search-bar input {
        flex: 1;
    }
    .content{
        margin-left: 180px;
    }
</style>
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Verifikasi Data';
</script>

<div class="container mt-4">
    <h2>Verifikasi Penanggungjawab</h2>

    <div class="search-bar">
        <b>Cari Berdasarkan:</b>
        <select id="filter-category" style="border-radius: 5px">
            {{-- <option value="name">Semua</option> --}}
            <option value="name">Nama</option>
            <option value="email">Email</option>
            <option value="phone">No Telpon</option>
            <option value="role">Role</option>
            <option value="assignment">Daerah Assignee</option>
            <option value="status">Status</option>
        </select>
        <input type="text" id="filter-input" placeholder="Cari" style="border-radius: 5px">
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telpon</th>
                <th>Role</th>
                <th>Daerah Assignee</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="data-table-body">
            @foreach ($users as $key=>$user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>PJ {{ $user->role->nama }}</td>
                    <td>
                        @php
                            $region = $user->region;
                        @endphp
                        {{ $region ? $region->nama : '-' }}
                        @if ($user->role_id == 5)
                            {{ '- '.$region->kabupaten->nama }}
                            {{ '-'.$region->kabupaten->provinsi->nama }}
                        @elseif ($user->role_id == 4)
                            {{ '-'.$region->provinsi->nama }}
                        @endif
                    </td>
                    <td>
                            <div class="badge
                            @if ($user->status_verifikasi == 'proses')
                                text-bg-warning
                            @elseif ($user->status_verifikasi == 'terverifikasi')
                                text-bg-success
                            @elseif ($user->status_verifikasi == 'ditolak')
                                text-bg-danger
                            @endif
                            fs-6 fw-normal text-capitalize">{{ $user->status_verifikasi }}</div>
                    </td>
                    <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                        @if ($user->status_verifikasi == 'proses')
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#verifModal" onclick="handleVerifikasi('{{ route('wilayah.verifikasi.pj.verif', Crypt::encryptString($user->id)) }}')"><span>&#10003;</span></button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolakModal" onclick="handleTolak('{{ route('wilayah.verifikasi.pj.tolak', Crypt::encryptString($user->id)) }}')"><span>&#x292C;</span></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item {{ $users->currentPage()==1?'disabled':'' }}">
                    <a class="page-link" href="{{ route('wilayah.verifikasi.pj', [...request()->query(), 'page' => $users->currentPage()-1]) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item {{ $users->currentPage()==1?'disabled':'' }}">
                    <a class="page-link" href="{{ route('wilayah.verifikasi.pj', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                    <span aria-hidden="true">First</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    @if ($i>($users->currentPage()-5) && $i<($users->currentPage()+5))
                        <li class="page-item {{ $users->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('wilayah.verifikasi.pj', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                <li class="page-item {{ $users->currentPage()==$users->lastPage()?'disabled':'' }}">
                    <a class="page-link" href="{{ route('wilayah.verifikasi.pj', [...request()->query(), 'page' => $users->lastPage()]) }}" aria-label="Next">
                    <span aria-hidden="true">Last</span>
                    </a>
                </li>
                <li class="page-item {{ $users->currentPage()==$users->lastPage()?'disabled':'' }}">
                    <a class="page-link" href="{{ route('wilayah.verifikasi.pj', [...request()->query(), 'page' => $users->currentPage()+1]) }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="verifModal" tabindex="-1" aria-labelledby="verifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="verif-form" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="verifModalLabel">Konfirmasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengverifikasi penanggungjawab ini?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Verifikasi</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="tolak-form" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="tolakModalLabel">Konfirmasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menolak verifikasi penanggungjawab ini?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-danger">Tolak</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('filter-input').addEventListener('input', () => {
        let category = document.getElementById('filter-category').value;
        let filterValue = document.getElementById('filter-input').value.toLowerCase();
        let rows = document.querySelectorAll('#data-table-body tr');
        
        rows.forEach(row => {
            let cellValue = row.cells[{
                semua: 1,
                name: 2,
                email: 3,
                phone: 4,
                role: 5,
                Assignment: 6,
                status: 7
            }[category]].innerText.toLowerCase();
            
            if (cellValue.includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    const handleVerifikasi = (route) => {
        const form = document.getElementById('verif-form')
        form.action = route
        // console.log(form.action);
        
    }
    const handleTolak = (route) => {
        const form = document.getElementById('tolak-form')
        form.action = route
    }
</script>
@endsection
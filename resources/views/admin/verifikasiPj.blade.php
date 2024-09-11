@extends('layouts.admin')
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

    {{-- <div class="search-bar">
        <b>Cari Berdasarkan:</b>
        <select id="filter-category" style="border-radius: 5px">
            <option value="name">Nama</option>
            <option value="email">Email</option>
            <option value="phone">No Telpon</option>
            <option value="role">Role</option>
            <option value="assignment">Daerah Assignee</option>
            <option value="status">Status</option>
        </select>
        <input type="text" id="filter-input" placeholder="Cari" style="border-radius: 5px">
    </div> --}}
    <form action="{{ route('admin.verifikasiPj') }}" method="GET" id="form-filter">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center">
                <span>Status :&ensp;</span>
                <span>
                    <select name="status" id="" class="form-control" id="filter-status" onchange="handleFilter(this)">
                        <option value="" selected>Semua</option>
                        <option value="proses" {{ request()->status=='proses'?'selected':'' }}>Proses</option>
                        <option value="terverifikasi" {{ request()->status=='terverifikasi'?'selected':'' }}>Terverifikasi</option>
                        <option value="ditolak" {{ request()->status=='ditolak'?'selected':'' }}>Ditolak</option>
                    </select>
                </span>
            </div>
            <div class="d-flex align-items-center">
                <span>PJ level :&ensp;</span>
                <span>
                    <select name="level" id="" class="form-control" id="filter-level" onchange="handleFilter(this)">
                        <option value="" selected>Semua</option>
                        <option value="6" {{ request()->level=='6'?'selected':'' }}>Nasional</option>
                        <option value="2" {{ request()->level=='2'?'selected':'' }}>Wilayah</option>
                        <option value="3" {{ request()->level=='3'?'selected':'' }}>Provinsi</option>
                        <option value="4" {{ request()->level=='4'?'selected':'' }}>Kabupaten</option>
                        <option value="5" {{ request()->level=='5'?'selected':'' }}>Kecamatan</option>
                    </select>
                </span>
            </div>
        </div>
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <div class="w-fit">
                <span>Daerah :&ensp;</span>
                <span>
                    <select name="daerah" id="" class="form-control js-example-templating" id="filter-daerah" onchange="handleFilter(this)" {{ !request()->level?'disabled':'' }}>
                        <option value="" selected>Semua</option>
                        @foreach ($daerah as $dr)
                            <option value="{{ $dr->id }}" {{ request()->daerah==$dr->id?'selected':'' }}>
                                {{ $dr->nama }}
                                @if (request()->level==4)
                                    - {{ $dr->provinsi->nama }}
                                @elseif (request()->level==5)
                                    - {{ $dr->kabupaten->nama }}
                                    - {{ $dr->kabupaten->provinsi->nama }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </span>
            </div>
            <a href="{{ route('admin.verifikasiPj') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

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
                            {{ '- '.$region->kabupaten->provinsi->wilayah->nama }}
                        @elseif ($user->role_id == 4)
                            {{ '-'.$region->provinsi->nama }}
                            {{ '- '.$region->provinsi->wilayah->nama }}
                        @elseif ($user->role_id == 3)
                            {{ '- '.$region->wilayah->nama }}
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
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#verifModal" onclick="handleVerifikasi('{{ route('admin.verifikasiPj.verifikasi', Crypt::encryptString($user->id)) }}')"><span>&#10003;</span></button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolakModal" onclick="handleTolak('{{ route('admin.verifikasiPj.tolak', Crypt::encryptString($user->id)) }}')"><span>&#x292C;</span></button>
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
                    <a class="page-link" href="{{ route('admin.verifikasiPj', ['page' => $users->currentPage()-1]) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item {{ $users->currentPage()==1?'disabled':'' }}">
                    <a class="page-link" href="{{ route('admin.verifikasiPj', ['page' => 1]) }}" aria-label="Previous">
                    <span aria-hidden="true">First</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    @if ($i>($users->currentPage()-5) && $i<($users->currentPage()+5))
                        <li class="page-item {{ $users->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('admin.verifikasiPj', ['page' => $i]) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                <li class="page-item {{ $users->currentPage()==$users->lastPage()?'disabled':'' }}">
                    <a class="page-link" href="{{ route('admin.verifikasiPj', ['page' => $users->lastPage()]) }}" aria-label="Next">
                    <span aria-hidden="true">Last</span>
                    </a>
                </li>
                <li class="page-item {{ $users->currentPage()==$users->lastPage()?'disabled':'' }}">
                    <a class="page-link" href="{{ route('admin.verifikasiPj', ['page' => $users->currentPage()+1]) }}" aria-label="Next">
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



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".js-example-templating").select2();

    const handleFilter = (e) => {
        if (e.id == 'filter-level') document.getElementById('filter-daerah').value = ''
        document.getElementById('form-filter').submit()
    }

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

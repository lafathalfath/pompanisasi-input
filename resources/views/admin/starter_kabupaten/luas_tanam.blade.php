@extends('layouts.admin')
@section('content')
    <div class="p-5">
        <h3>Starter Total Pompa Luas Tanam Harian Kabupaten</h3>
        <div class="d-flex align-items-center justify-content-between">
            <form action="{{ route('admin.starter.kabupaten.luas_tanam') }}" method="GET" class="w-75 d-flex align-items-center gap-2 mb-3">
                <input type="search" name="kabupaten" id="cari" class="form-control w-25" value="{{ request()->kabupaten }}" placeholder="Cari kabupaten">
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </form>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kabupaten</th>
                    <th>Luas Tanam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($luas_tanam as $lt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lt->kabupaten->nama }}</td>
                        <td>{{ $lt->luas_tanam }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="handleEdit('{{ route('admin.starter.kabupaten.luas_tanam.update', Crypt::encryptString($lt->id)) }}', '{{ $lt->kabupaten->nama }}', {{ $lt->luas_tanam }})" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td  colspan="4">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- pagination --}}
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $luas_tanam->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.starter.kabupaten.luas_tanam', [...request()->query(), 'page' => $luas_tanam->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $luas_tanam->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.starter.kabupaten.luas_tanam', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $luas_tanam->lastPage(); $i++)
                        @if ($i>($luas_tanam->currentPage()-5) && $i<($luas_tanam->currentPage()+5))
                            <li class="page-item {{ $luas_tanam->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('admin.starter.kabupaten.luas_tanam', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $luas_tanam->currentPage()==$luas_tanam->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.starter.kabupaten.luas_tanam', [...request()->query(), 'page' => $luas_tanam->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $luas_tanam->currentPage()==$luas_tanam->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.starter.kabupaten.luas_tanam', [...request()->query(), 'page' => $luas_tanam->currentPage()+1]) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        {{-- modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="edit-form" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah jumlah pompa starter</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" >Kabupaten/Kota :</label>
                        <div id="nama-kabupaten" class="py-1 fw-bold"></div>
                        <label for="" class="mt-2">Jumlah :</label>
                        <input type="number" name="luas_tanam" id="luas_tanam" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.starter.kabupaten.luas_tanam.store') }}" method="POST" id="edit-form" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addModalLabel">Ubah jumlah pompa starter</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" >Kabupaten/Kota :</label><br>
                        <select name="kabupaten_id" id="input-kabupaten" class="form-control">
                            <option value="" disabled selected>Pilih Kabupaten</option>
                            @foreach ($kabupaten as $kab)
                                <option value="{{ $kab->id }}">{{ $kab->nama }} - {{ $kab->provinsi->nama }}</option>
                            @endforeach
                        </select><br>
                        <label for="add_total">Jumlah :</label>
                        <input type="number" name="luas_tanam" id="add_total" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const handleEdit = (route, kabupaten, value) => {
            document.getElementById('edit-form').action = route
            document.getElementById('nama-kabupaten').innerHTML = kabupaten
            document.getElementById('luas_tanam').value = value
        }
    </script>
@endsection
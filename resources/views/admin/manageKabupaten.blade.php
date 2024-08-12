@extends('layouts.admin')
@section('content')
    <style>
        .search-bar {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search-bar input, .search-bar select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 0px;
        }
        .search-bar input {
            margin-right: 10px;
        }
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
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
        <h2>Manage Wilayah Kabupaten</h2>
        
        <div class="d-flex align-items-center justify-content-between">
            <form class="search-bar" method="GET">
                <input type="text" name="nama" value="{{ request()->nama }}" id="search-input" placeholder="Cari" style="border-radius: 5px">
            </form>
            <div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Tambah</button>
            </div>
        </div>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Wilayah</th>
                    <th>Provinsi</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kabupaten as $kb)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kb->provinsi->wilayah->nama }}</td>
                        <td>{{ $kb->provinsi->nama }}</td>
                        <td>{{ $kb->nama }}</td>
                        <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="handleEdit({{ $kb }})">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $kabupaten->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kabupaten', ['nama' => request()->query('nama'), 'page' => $kabupaten->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $kabupaten->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kabupaten', ['nama' => request()->query('nama'), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $kabupaten->lastPage(); $i++)
                        @if ($i>($kabupaten->currentPage()-5) && $i<($kabupaten->currentPage()+5))
                            <li class="page-item {{ $kabupaten->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('admin.manage.kabupaten', ['nama' => request()->query('nama'), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $kabupaten->currentPage()==$kabupaten->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kabupaten', ['nama' => request()->query('nama'), 'page' => $kabupaten->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $kabupaten->currentPage()==$kabupaten->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kabupaten', ['nama' => request()->query('nama'), 'page' => $kabupaten->currentPage()+1]) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.manage.kecamatan.store') }}" class="modal-content" method="POST">
                @csrf
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah Kecamatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="nama" placeholder="Nama Kecamatan" required><br>
                    <select name="kabupaten_id" class="form-control js-example-templating" id="kabupaten" required>
                        <option value="" disabled selected>Pilih Provinsi</option>
                        @foreach ($kabupaten as $kab)
                            <option value="{{ $kab->id }}">{{ $kab->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="nameInput">Nama</label>
                            <input type="text" class="form-control" id="nameInput" name="name">
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="formEdit">
                @csrf
                @method('PUT')
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Kabupaten</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="editNama" class="form-control" name="nama" placeholder="Nama Kabupaten" required><br>
                    <select name="provinsi_id" class="form-control js-example-templating" id="editProvinsi" required>
                        <option value="" disabled selected>Pilih Provinsi</option>
                        @foreach ($provinsi as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // $('.js-example-templating').select2();

        const handleEdit = (kabupaten) => {
            const form = document.getElementById('formEdit')
            const inputNama = document.getElementById('editNama')
            const inputProvinsi = document.getElementById('editProvinsi')
            form.action = `/admin/manage/kabupaten/${kabupaten.id}`
            inputNama.value = kabupaten.nama
            inputProvinsi.value = kabupaten.provinsi_id
        }

        // $('#editModal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget);
        //     var name = button.data('name');
        //     var modal = $(this);
        //     modal.find('.modal-body input').val(name);
        // });
        
        // $('#editForm').on('submit', function (event) {
        //     event.preventDefault();
        //     var name = $('#nameInput').val();
        //     console.log('Nama baru:', name);
        //     $('#editModal').modal('hide');
        // });
    </script>
@endsection

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
        <h2>Manage Wilayah Kecamatan</h2>
        
        <div class="d-flex align-items-center justify-content-between">
            <form method="GET" class="search-bar">
                <input type="text" name="nama" value="{{ request()->nama }}" id="search-input" placeholder="Cari" style="border-radius: 5px">
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </form>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Tambah</button>
            </div>
        </div>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Wilayah</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kecamatan as $kec)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kec->kabupaten->provinsi->wilayah->nama }}</td>
                        <td>{{ $kec->kabupaten->provinsi->nama }}</td>
                        <td>{{ $kec->kabupaten->nama }}</td>
                        <td>{{ $kec->nama }}</td>
                        <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="handleEdit({{ $kec }})">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="handleDelete('{{ route('admin.manage.kecamatan.destroy', Crypt::encryptString($kec->id)) }}')">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $kecamatan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kecamatan', ['nama' => request()->query('nama'), 'page' => $kecamatan->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $kecamatan->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kecamatan', ['nama' => request()->query('nama'), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $kecamatan->lastPage(); $i++)
                        @if ($i>($kecamatan->currentPage()-5) && $i<($kecamatan->currentPage()+5))
                            <li class="page-item {{ $kecamatan->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('admin.manage.kecamatan', ['nama' => request()->query('nama'), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $kecamatan->currentPage()==$kecamatan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kecamatan', ['nama' => request()->query('nama'), 'page' => $kecamatan->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $kecamatan->currentPage()==$kecamatan->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.kecamatan', ['nama' => request()->query('nama'), 'page' => $kecamatan->currentPage()+1]) }}" aria-label="Next">
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
            <form action="{{ route('admin.manage.kecamatan.store') }}" id="form-modal" class="modal-content" method="POST">
                @csrf
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah Kecamatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="nama" placeholder="Nama kecamatan" required><br>
                    <select name="kabupaten_id" class="form-control js-example-templating" id="kabupaten" required>
                        <option value="" disabled selected>Pilih Kabupaten</option>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="formEdit">
                @csrf
                @method('PUT')
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Kecamatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="editNama" class="form-control" name="nama" placeholder="Nama Kecamatan" required><br>
                    <select name="kabupaten_id" class="form-control js-example-templating2" id="editKabupaten" required>
                        <option value="" disabled selected>Pilih Kabupaten</option>
                        @foreach ($kabupaten as $kab)
                            <option value="{{ $kab->id }}">{{ $kab->nama }}</option>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="formDelete">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Kecamatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus kecamatan ini?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".js-example-templating").select2({
            dropdownParent: $('#form-modal'),
            width: '100%',
        });
        $(".js-example-templating2").select2({
            dropdownParent: $('#formEdit'),
            width: '100%',
        });
        const handleEdit = (kecamatan) => {
            const form = document.getElementById('formEdit')
            const inputNama = document.getElementById('editNama')
            const inputKabupaten = document.getElementById('editKabupaten')
            form.action = `/admin/manage/kecamatan/${kecamatan.id}`
            inputNama.value = kecamatan.nama
            inputKabupaten.value = kecamatan.kabupaten_id
        }

        const handleDelete = (route) => {
            const form = document.getElementById('formDelete')
            form.action = route
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

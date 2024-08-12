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
    </style>
    <script>
        const title = document.getElementsByTagName('title')[0];
        title.innerHTML += ' | Verifikasi Data';
    </script>

    <div class="container mt-4">
        <h2>Manage Wilayah Provinsi</h2>
        
        <div class="d-flex align-items-center justify-content-between">
            <form class="search-bar" method="GET">
                <input type="text" name="nama" value="{{ request()->nama }}" id="search-input" placeholder="Cari">
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
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($provinsi as $prov)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $prov->wilayah->nama }}</td>
                        <td>{{ $prov->nama }}</td>
                        <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="handleEdit({{ $prov }})">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $provinsi->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.provinsi', ['nama' => request()->query('nama'), 'page' => $provinsi->currentPage()-1]) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item {{ $provinsi->currentPage()==1?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.provinsi', ['nama' => request()->query('nama'), 'page' => 1]) }}" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $provinsi->lastPage(); $i++)
                        @if ($i>($provinsi->currentPage()-5) && $i<($provinsi->currentPage()+5))
                            <li class="page-item {{ $provinsi->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('admin.manage.provinsi', ['nama' => request()->query('nama'), 'page' => $i]) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    <li class="page-item {{ $provinsi->currentPage()==$provinsi->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.provinsi', ['nama' => request()->query('nama'), 'page' => $provinsi->lastPage()]) }}" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                    <li class="page-item {{ $provinsi->currentPage()==$provinsi->lastPage()?'disabled':'' }}">
                        <a class="page-link" href="{{ route('admin.manage.provinsi', ['nama' => request()->query('nama'), 'page' => $provinsi->currentPage()+1]) }}" aria-label="Next">
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
        <form action="{{ route('admin.manage.provinsi.store') }}" class="modal-content" method="POST">
            @csrf
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah Provinsi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="nama" placeholder="Nama provinsi" required><br>
                <select name="wilayah_id" class="form-control js-example-templating" id="wilayah" required>
                    <option value="" disabled selected>Pilih Wilayah</option>
                    @foreach ($wilayah as $wil)
                        <option value="{{ $wil->id }}">{{ $wil->nama }}</option>
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
{{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" id="formEdit">
            @csrf
            @method('PUT')
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="editModalLabel">Edit Provinsi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="editNama" class="form-control" name="nama" placeholder="Nama provinsi" required><br>
                <select name="wilayah_id" class="form-control js-example-templating" id="editWilayah" required>
                    <option value="" disabled selected>Pilih Wilayah</option>
                    @foreach ($wilayah as $wil)
                        <option value="{{ $wil->id }}">{{ $wil->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Edit</button>
            </div>
        </form>
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
                <input type="text" id="editNama" class="form-control" name="nama" placeholder="Nama provinsi" required><br>
                <select name="wilayah_id" class="form-control js-example-templating" id="editWilayah" required>
                    <option value="" disabled selected>Pilih Wilayah</option>
                    @foreach ($wilayah as $wil)
                        <option value="{{ $wil->id }}">{{ $wil->nama }}</option>
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
        // $(document).ready(() => {
            // $(".js-example-templating").select2();   
    
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
        // })

        const handleEdit = (provinsi) => {
            // console.log(provinsi.nama);
            
            const form = document.getElementById('formEdit')
            const editNama =  document.getElementById('editNama')
            const editWilayah = document.getElementById('editWilayah')
            form.action = `/admin/manage/provinsi/${provinsi.id}`
            editNama.value = provinsi.nama
            editWilayah.value = provinsi.wilayah_id
            
        //     editNama.value = provinsi.nama
        //     editWilayah.value = provinsi.wilayah_id
        }
    </script>
@endsection

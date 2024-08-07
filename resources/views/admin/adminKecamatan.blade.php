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
        <h2>Manage Wilayah Kecamatan</h2>
        
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Cari">
        </div>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jawa Tengah</td>
                    <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-name="Jawa Tengah">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jawa Timur</td>
                    <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-name="Jawa Timur">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
    </div>

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var modal = $(this);
            modal.find('.modal-body input').val(name);
        });
        
        $('#editForm').on('submit', function (event) {
            event.preventDefault();
            var name = $('#nameInput').val();
            console.log('Nama baru:', name);
            $('#editModal').modal('hide');
        });
    </script>
@endsection

@extends('layouts.admin')
@section('content')
    <style>
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
        title.innerHTML += ' | Kelola Akun';
    </script>

    <div class="container mt-4">
        <h2>Kelola Akun</h2>
        
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
                    <td>Salsi Kirana</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal1">
                            Detail
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>John Doe</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal2">
                            Detail
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Jane Smith</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal3">
                            Detail
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal 1 -->
        <div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" value="Salsi Kirana" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="phone" value="081234567890" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="salsi@example.com" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" value="User" readonly>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="isAdmin1">
                                <label class="form-check-label" for="isAdmin1">Sebagai Admin</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 2 -->
        <div class="modal fade" id="detailModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" value="John Doe" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="phone" value="089876543210" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="john.doe@example.com" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" value="User" readonly>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="isAdmin2">
                                <label class="form-check-label" for="isAdmin2">Sebagai Admin</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 3 -->
        <div class="modal fade" id="detailModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" value="Jane Smith" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="phone" value="085678901234" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="jane.smith@example.com" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" value="User" readonly>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="isAdmin3">
                                <label class="form-check-label" for="isAdmin3">Sebagai Admin</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
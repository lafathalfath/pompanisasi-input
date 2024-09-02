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
        th {
            text-align: center;
        }
    </style>
    <script>
        const title = document.getElementsByTagName('title')[0];
        title.innerHTML += ' | Kelola Akun';
    </script>

    <div class="container mt-4">
        <h2>Kelola Akun</h2>

        <form action="{{ route('admin.kelolaAkun') }}" id="form-filter" class="mb-3 d-flex align-items-end justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <label for="filter-status">Status :</label>
                    <select name="status" class="form-control" id="filter-status" onchange="handleFilter()">
                        <option value="" selected>Semua</option>
                        <option value="terverifikasi" {{ request()->status=='terverifikasi'?'selected':'' }}>Terverifikasi</option>
                        <option value="proses" {{ request()->status=='proses'?'selected':'' }}>Proses</option>
                        <option value="ditolak" {{ request()->status=='ditolak'?'selected':'' }}>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label for="filter-role">Role :</label>
                    <select name="role" class="form-control" id="filter-role" onchange="handleFilter()">
                        <option value="" selected>Semua</option>
                        <option value="1" {{ request()->role==1?'selected':'' }}>Admin</option>
                        <option value="6" {{ request()->role==6?'selected':'' }}>PJ Nasional</option>
                        <option value="2" {{ request()->role==2?'selected':'' }}>PJ Wilayah</option>
                        <option value="3" {{ request()->role==3?'selected':'' }}>PJ Provinsi</option>
                        <option value="4" {{ request()->role==4?'selected':'' }}>PJ Kabupaten</option>
                        <option value="5" {{ request()->role==5?'selected':'' }}>PJ Kecamatan</option>
                    </select>
                </div>
            </div>
            <a href="{{ route('admin.kelolaAkun') }}" class="btn btn-secondary">Reset</a>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $us)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $us->nama }}</td>
                        <td class="text-center">
                            <div class="badge 
                            @if ($us->status_verifikasi == 'proses')
                                text-bg-warning
                            @elseif ($us->status_verifikasi == 'terverifikasi')
                                text-bg-success
                            @elseif ($us->status_verifikasi == 'ditolak')
                                text-bg-danger
                            @endif
                            fs-6">
                                {{ $us->status_verifikasi }}
                            </div>
                        </td>
                        <td>
                            <button onclick="viewDetail({{ $us }}, {{ $us->role }}, 
                            @if ($us->role_id == 2 && $us->wilayah)
                            '{{ $us->wilayah->nama }}'
                            @elseif ($us->role_id == 3 && $us->provinsi)
                            '{{ $us->provinsi->nama }}'
                            @elseif ($us->role_id == 4 && $us->kabupaten)
                            '{{ $us->kabupaten->nama }} - {{ $us->kabupaten->provinsi->nama }}'
                            @elseif ($us->role_id == 5 && $us->kecamatan)
                            '{{ $us->kecamatan->nama }} - {{ $us->kecamatan->kabupaten->nama }} - {{ $us->kecamatan->kabupaten->provinsi->nama }}'
                            @else
                            null
                            @endif, '{{ route('admin.kelolaAkun.update', Crypt::encryptString($us->id)) }}')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal1">
                                Detail
                            </button>
                            <button onclick="confirmDelete('{{ Crypt::encryptString($us->id) }}', '{{ $us->nama }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item {{ $users->currentPage()==1?'disabled':'' }}">
                    <a class="page-link" href="{{ route('admin.kelolaAkun', [...request()->query(), 'page' => $users->currentPage()-1]) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item {{ $users->currentPage()==1?'disabled':'' }}">
                    <a class="page-link" href="{{ route('admin.kelolaAkun', [...request()->query(), 'page' => 1]) }}" aria-label="Previous">
                    <span aria-hidden="true">First</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    @if ($i>($users->currentPage()-5) && $i<($users->currentPage()+5))
                        <li class="page-item {{ $users->currentPage()==$i?'active':'' }}"><a class="page-link" href="{{ route('admin.kelolaAkun', [...request()->query(), 'page' => $i]) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                <li class="page-item {{ $users->currentPage()==$users->lastPage()?'disabled':'' }}">
                    <a class="page-link" href="{{ route('admin.kelolaAkun', [...request()->query(), 'page' => $users->lastPage()]) }}" aria-label="Next">
                    <span aria-hidden="true">Last</span>
                    </a>
                </li>
                <li class="page-item {{ $users->currentPage()==$users->lastPage()?'disabled':'' }}">
                    <a class="page-link" href="{{ route('admin.kelolaAkun', [...request()->query(), 'page' => $users->currentPage()+1]) }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

        <!-- Modal 1 -->
        <div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form method="POST" class="modal-content" id="update-user-form">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Akun</h5>
                        <button type="button" onclick="clearInput()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <div class="form-control" id="user-name"></div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No HP</label>
                                <div class="form-control" id="user-phone"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="form-control" id="user-email"></div>
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" name="" id="edit-check" onchange="handleEdit(this)">
                                <label for="edit-check">Ubah Role dan Region</label>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <div class="form-control" id="user-role"></div>
                                <select name="role_id" class="form-control" id="input-role" style="display: none;">
                                    <option value="" disabled selected>Pilih role</option>
                                    <option value="1">Admin</option>
                                    <option value="6">PJ Nasional</option>
                                    <option value="2">PJ Wilayah</option>
                                    <option value="3">PJ Provinsi</option>
                                    <option value="4">PJ Kabupaten</option>
                                    <option value="5">PJ Kecamatan</option>
                                </select>
                            </div>
                            <div class="mb-3" id="select2-parent">
                                <label for="role" class="form-label">Region</label>
                                <div class="form-control" id="user-region"></div>
                                <select name="region_id" class="form-control" id="input-region" style="display: none" disabled>
                                    <option value="" disabled selected>Pilih region</option>
                                </select>
                            </div>
                            {{-- <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="isAdmin1">
                                <label class="form-check-label" for="isAdmin1">Sebagai Admin</label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="clearInput()" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submit-edit" disabled>Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Delete Akun -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus akun <span id="delete-user-name"></span>?
                    </div>
                    <div class="modal-footer">
                        <form id="delete-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <script>
        const handleFilter = () => {
            document.getElementById('form-filter').submit()
        }

        const viewDetail = (user, role, regionName, route) => {
            document.getElementById('user-name').innerHTML = user.nama
            document.getElementById('user-phone').innerHTML = user.no_hp
            document.getElementById('user-email').innerHTML = user.email
            document.getElementById('user-role').innerHTML = role.id == 1 ? role.nama : `PJ ${role.nama}`
            document.getElementById('user-region').innerHTML = regionName || '-'
            document.getElementById('update-user-form').action = route
        }
        
        const handleEdit = (e) => {
            document.getElementById('submit-edit').disabled = !e.checked
            document.getElementById('user-role').style.display = !e.checked ? 'block' : 'none'
            document.getElementById('user-region').style.display = !e.checked ? 'block' : 'none'
            document.getElementById('input-role').style.display = e.checked ? 'block' : 'none'
            // document.getElementById('input-region').style.display = e.checked ? 'block' : 'none'
            if (e.checked) {
                $('#input-region').next('.select2-container').show()
            } else {
                $('#input-region').next('.select2-container').hide()
            }
        }

        const clearInput = () => {
            document.getElementById('edit-check').checked = false
            document.getElementById('input-role').value = ''
            document.getElementById('input-region').value = ''
            document.getElementById('user-role').style.display = 'block'
            document.getElementById('user-region').style.display = 'block'
            document.getElementById('input-role').style.display = 'none'
            $('#input-region').next('.select2-container').hide()
        }

        $(document).ready(() => {
            $('#input-region').select2({
                dropdownParent: $('#select2-parent'),
                width: '100%',
            })
            $('#input-region').next('.select2-container').hide()

            $('#input-role').on('change', (e) => {
                if (e.target.value == 1 || e.target.value == 6) {
                    document.getElementById('input-region').disabled = true
                    document.getElementById('input-region').value = ''
                } else {
                    document.getElementById('input-region').disabled = false
                    document.getElementById('input-region').required = true
                    
                    $.ajax({
                        type: 'GET',
                        url: `/api/get-region/${e.target.value}`,
                        beforeSend: () => {
                            $('#pj_region').html('<option disabled selected>Waiting...</option>');
                        },
                        success: ({data}) => {
                            let options = '<option selected>Pilih Region</option>';
                            data.forEach((region) => {
                                options += `<option value="${region.id}">
                                    ${region.nama}
                                    ${region.nama_kabupaten ? `- ${region.nama_kabupaten}` : ''}
                                    ${region.nama_provinsi ? `- ${region.nama_provinsi}` : ''}
                                </option>`;
                            });
                            $('#input-region').html(options);
                            console.log(data);
                            
                        },
                        error: (err) => {
                            console.error(err)
                        },
                    })
                }
            });
        })

        const confirmDelete = (id, name) => {
            document.getElementById('delete-user-name').innerText = name;
            document.getElementById('delete-form').action = `/admin/kelolaAkun/delete/${id}`;
        }
    </script>
@endsection
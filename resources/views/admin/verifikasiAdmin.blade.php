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
</style>
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Verifikasi Data';
</script>

<div class="container mt-4">
    <h2>Verifikasi Data</h2>

    <div class="search-bar">
        <select id="filter-category">
            <option value="name">Semua</option>
            <option value="name">Nama</option>
            <option value="email">Email</option>
            <option value="phone">No Telpon</option>
            <option value="role">Role</option>
            <option value="assignment">Daerah Assignment</option>
            <option value="status">Status</option>
        </select>
        <input type="text" id="filter-input" placeholder="Cari">
    </div>

    <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No Telpon</th>
            <th>Role</th>
            <th>Daerah Assignment</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="data-table-body">
          <tr>
              <td>1</td>
              <td>Bambang Rahmadi</td>
              <td>bambangrahmadi@gmail.com</td>
              <td>089876543210</td>
              <td>Provinsi</td>
              <td>Simeulue Timur</td>
              <td><button class="btn btn-warning btn-sm">Proses</button></td>
              <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                  <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                  <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
              </td>
          </tr>
          <tr>
              <td>2</td>
              <td>Ahyu Puspita Sari, SP</td>
              <td>AhyuPuspita@gmail.com</td>
              <td>087896543210</td>
              <td>Wilayah</td>
              <td>Jawa Barat</td>
              <td><button class="btn btn-success btn-sm">Terverifikasi</button></td>
              <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                  <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                  <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
              </td>
          </tr>
        </tbody>
    </table>
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
</script>
@endsection

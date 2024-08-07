@extends('layouts.kabupaten')
@section('content')
  <style>
    .content{
      margin-left: 180px;
    }
  </style>

  <script>
    const title = document.getElementsByTagName('title')[0]
    title.innerHTML += ' | Verifikasi Data'
  </script>

  <div class="container mt-4">
    <h2>Verifikasi Data</h2>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Nama Poktan</th>
            <th rowspan="2">Luas <br> Tanam</th>
            <th colspan="3">Pompa Refocusing</th>
            <th colspan="3">Pompa ABT</th>
            <th rowspan="2">Action</th>
          </tr>
          <tr>
            <th>Usulan</th>
            <th>Diterima</th>
            <th>Digunakan</th>
            <th>Usulan</th>
            <th>Diterima</th>
            <th>Digunakan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td>1</td>
              <td>Teupah Selatan</td>
              <td>Bambang Rahmadi</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                  <button class="btn btn-warning btn-sm">Edit</button>
                  <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                  <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
              </td>
          </tr>
          <tr>
              <td>2</td>
              <td>Simeulue Timur</td>
              <td>Ahyu Puspita Sari, SP</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td class="border-0 d-flex align-items-center justify-content-center gap-2">
                  <button class="btn btn-warning btn-sm">Edit</button>
                  <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                  <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
              </td>
          </tr>
        </tbody>
    </table>
  </div>
@endsection

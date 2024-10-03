@extends('layouts.admin')
@section('content')
    <div>
        <h3>Import Starter Data Pompa Kabupaten ABT Diterima</h3>
        <img src="/assets/img/starter-file-example.png" alt="example">
        <br>
        <div class="text-secondary" style="font-size: 14px;">* Contoh struktur tabel yang diimport</div>
        <br>
        <a href="/assets/doc/ID%20Kabupaten.xlsx" class="btn btn-primary"><i class="bi bi-download"></i>&ensp;List ID Kabupaten</a>
        <br>
        <br>
        <form action="{{ route('admin.starter.kabupaten.import.abt_diterima.store') }}" method="POST" class="d-flex align-items-center gap-3" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx, .xls, xlsm" class="form-control">
            <button type="submit" class="btn btn-success">Import</button>
        </form>
        <div class="text-secondary" style="font-size: 14px;">* File diizinkan: .xlsx, xls, xlsm</div>
    </div>
@endsection
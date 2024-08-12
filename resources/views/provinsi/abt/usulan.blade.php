@extends('layouts.provinsi')
@section('content')
<style>
        .table thead th {
        vertical-align: middle;
        text-align: center;
        background-color: #c8dce4;
    }

    .merged-cell {
        background-color: #d9ead3;
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="d-flex flex-col justify-content-center">
    <div>
        <br>
        <div class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <i class="fa-solid fa-sliders"></i>
            <input type="date" class="form-control" id="date">
            <select name="kota_kabupaten" class="form-control" id="kota-kabupaten">
                <option value="" disabled selected>Pilih Kecamatan</option>
                <option value="Bogor Utara">Bogor Utara</option>
                <option value="Bogor Selatan">Bogor Selatan</option>
                <!-- Tambahkan opsi kota/kabupaten lainnya -->
            </select>
        </div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kabupaten</th>
                    {{-- <th>Tanggal</th> --}}
                    <th>Kelompok tani</th>
                    <th>Luas lahan (ha)</th>
                    <th class="text-center">Usulan Pompa ABT</th>
                    {{-- <th>No HP Poktan (jika ada)</th> --}}
                    <th>Aksi</th>
                    {{-- <th>Total diusulkan (unit)</th> --}}
                </tr>
                {{-- <tr>
                    <th>3 inch (unit)</th>
                    <th>4 inch (unit)</th>
                    <th>6 inch (unit)</th>
                </tr> --}}
            </thead>
            <tbody>
                {{-- @forelse ($abt_usulan as $au) --}}
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        {{-- <td><a href="{{ route('kabupaten.pompa.abt.usulan.detail', Crypt::encryptString($au->kecamatan->id)) }}" class="btn btn-sm btn-info">Detail</a></td> --}}
                    </tr>
                {{-- @empty --}}
                    <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
                {{-- @endforelse --}}
            </tbody>
        </table>

    </div>

</div>
@endsection

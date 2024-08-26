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
            <a href="{{ url('/export-pompa-ref-diterima') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
            <i class="fa-solid fa-sliders"></i>
            <input type="date" class="form-control" id="date">
            <select name="kecamatan_id" class="form-control" id="kecamatan">
                <option value="" disabled selected>Pilih Kabupaten</option>
                {{-- @foreach ($kecamatan as $kec)
                    <option value="{{ $kec->id }}">{{ $kec->nama }}</option>
                @endforeach --}}
            </select>
        </div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kabupaten/Kota</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Desa/Kel</th>
                    <th rowspan="2">Kelompok Tani</th>
                    {{-- <th>Tanggal</th> --}}
                    {{-- <th>Luas lahan (ha)</th> --}}
                    <th colspan='3' class="text-center">Usulan Pompa ABT</th>
                    {{-- <th>No HP Poktan <br>(jika ada)</th> --}}
                    <th rowspan="2">Total diusulkan <br>(unit)</th>
                </tr>
                <tr>
                    <th>3 inch <br>(unit)</th>
                    <th>4 inch <br>(unit)</th>
                    <th>6 inch <br>(unit)</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse ($ref_diterima as $rd) --}}
                    {{-- <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr> --}}
                {{-- @empty --}}
                    <tr><td colspan="10" class="text-center">Belum ada Data</td></tr>
                {{-- @endforelse --}}
            </tbody>
        </table>

    </div>

</div>
@endsection

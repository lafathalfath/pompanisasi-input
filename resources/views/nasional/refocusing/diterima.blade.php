@extends('layouts.nasional')
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
            <select name="wilayah_id" class="form-control" id="wilayah">
                <option value="" disabled selected>Pilih Wilayah</option>

            </select>
        </div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Wilayah</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    {{-- <th>Tanggal</th> --}}
                    <th>Kelompok tani</th>
                    <th>Luas lahan (ha)</th>
                    <th class="text-center">Pompa Refocusing Diterima</th>
                    {{-- <th>No HP Poktan <br>(jika ada)</th> --}}
                    <th>Aksi</th>
                    {{-- <th rowspan="2">Total diusulkan <br>(unit)</th> --}}

                </tr>
                {{-- <tr>
                    <th>3 inch <br>(unit)</th>
                    <th>4 inch <br>(unit)</th>
                    <th>6 inch <br>(unit)</th> 
                </tr> --}}
            </thead>
            <tbody>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td><a href="" class="btn btn-sm btn-info">Detail</a></td>
                    </tr>
            </tbody>
        </table>

    </div>

</div>
@endsection
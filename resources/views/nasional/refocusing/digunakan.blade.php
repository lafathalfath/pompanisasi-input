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
            <select name="wilayaj_id" class="form-control" id="wilayah">
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
                    <th>Kelompok tani</th>
                    <th>Luas lahan (ha)</th>
                    <th class="text-center">Pompa Refocusing Digunakan</th>
                    <th>Aksi</th>
                </tr>
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
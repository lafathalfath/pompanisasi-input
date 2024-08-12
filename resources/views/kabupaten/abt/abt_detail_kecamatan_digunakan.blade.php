@extends('layouts.kabupaten')
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
            <select name="desa_id" class="form-control" id="desa">
                <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                @foreach ($desa as $des)
                    <option value="{{ $des->id }}">{{ $des->nama }}</option>
                @endforeach
            </select>
        </div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Desa/Kel</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Kelompok <br>tani</th>
                    <th rowspan="2">Luas lahan <br>(ha)</th>
                    <th colspan="3" class="text-center">Pompa ABT Dimanfaatkan</th>
                    <th rowspan="2">Total <br>Dimanfaatkan</th>
                    <th rowspan="2">No HP Poktan <br>(jika ada)</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>3 inch <br>(unit)</th>
                    <th>4 inch <br>(unit)</th>
                    <th>6 inch <br>(unit)</th> 
                </tr>
            </thead>
            <tbody>
                @forelse ($abt_dimanfaatkan as $ad)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ad->pompa_abt_diterima->pompa_abt_usulan->pompanisasi->desa->nama }}</td>
                        <td>{{ $ad->tanggal }}</td>
                        <td>{{ $ad->nama_poktan }}</td>
                        <td>{{ $ad->luas_lahan }}</td>
                        <td>{{ $ad->pompa_3_inch }}</td>
                        <td>{{ $ad->pompa_4_inch }}</td>
                        <td>{{ $ad->pompa_6_inch }}</td>
                        <td>{{ $ad->total_unit }}</td>
                        <td>08123456789</td>
                        <td><a href="{{ route('kabupaten.pompa.abt.digunakan.detail.detail', Crypt::encryptString($ad->id)) }}" class="btn btn-sm btn-info">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="11" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection
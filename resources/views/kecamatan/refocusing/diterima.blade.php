@extends('layouts.kecamatan')
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
        {{-- <div>
            <a href="{{ route('kecamatan.refocusing.digunakan.input') }}" type="submit" class="btn btn-success">Input Data</a>
            <a href="{{ url('/export-pompa-ref-dimanfaatkan') }}" class="btn btn-secondary"><i class="fa fa-download"></i> Excel</a>
        </div><br> --}}
        <div class="mb-3" style="display: flex; justify-content: space-between; gap: 10px; align-items: center;" >
            <a href="{{ route('kecamatan.refocusing.diterima.input') }}" type="submit" class="d-flex align-items-center btn btn-success" style="white-space: nowrap;">Input Data</a>
            <a href="{{ url('/export-pompa-ref-diterima') }}" class="d-flex align-items-center btn btn-secondary">
                <i class="fa fa-download me-2"></i> Excel
            </a>
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
                    <th rowspan="2">Kelompok tani</th>
                    <th rowspan="2">Luas lahan <br>(ha)</th>
                    <th colspan="3" class="text-center">Pompa Refocusing Diterima</th>
                    <th rowspan="2">Total diterima</th>
                    <th rowspan="2">No HP Poktan <br>(jika ada)</th>
                    {{-- <th rowspan="2">Aksi</th> --}}
                    {{-- <th rowspan="2">Total diusulkan (unit)</th> --}}
                </tr>
                <tr>
                    <th>3 inch <br>(unit)</th>
                    <th>4 inch <br>(unit)</th>
                    <th>6 inch <br>(unit)</th> 
                </tr>
            </thead>
            <tbody>
                @forelse ($ref_diterima as $rd)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rd->desa->nama }}</td>
                        <td>{{ $rd->tanggal }}</td>
                        <td>{{ $rd->nama_poktan }}</td>
                        <td>{{ $rd->luas_lahan }}</td>
                        <td>{{ $rd->pompa_3_inch }}</td>
                        <td>{{ $rd->pompa_4_inch }}</td>
                        <td>{{ $rd->pompa_6_inch }}</td>
                        <td>{{ $rd->total_unit }}</td>
                        <td>{{ $rd->no_hp_poktan ? $rd->no_hp_poktan : '-' }}</td>
                        {{-- <td><a href="" class="btn btn-sm btn-info">Detail</a></td> --}}
                    </tr>
                @empty
                    <tr><td colspan="11" class="text-center">Belum ada data</td></tr>
                @endforelse
                {{-- <tr>
                    <td>1</td>
                    <td>Babakan</td>
                    <td>4-08-2024</td>
                    <td>Kelompok tani 1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>08123456789</td>
                    <td><a href="" class="btn btn-sm btn-info">Detail</a></td>
                </tr> --}}
            </tbody>
        </table>

    </div>

</div>
@endsection
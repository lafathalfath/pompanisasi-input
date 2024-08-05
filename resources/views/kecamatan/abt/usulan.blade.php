@extends('layouts.kecamatan')
@section('content')
<div class="d-flex flex-col justify-content-center">
    <div>
        <div>
            <a href="{{ route('kecamatan.abt.usulan.input') }}" type="submit" class="btn btn-success">Input Data</a>
        </div><br>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kabupaten/Kota</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Desa/Kel</th>
                    <th rowspan="2">Kelompok tani</th>
                    <th rowspan="2">Luas lahan (ha)</th>
                    <th colspan="3" class="text-center">Usulan Pompa ABT</th>
                    <th rowspan="2">No HP Poktan (jika ada)</th>
                    {{-- <th rowspan="2">Total diusulkan (unit)</th> --}}
                </tr>
                <tr>
                    <th>3 inch (unit)</th>
                    <th>4 inch (unit)</th>
                    <th>6 inch (unit)</th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td> 
                    <td>Kota Bogor</td>
                    <td>Bogor Tengah</td>
                    <td>Babakan</td>
                    <td>Kelompok tani 1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>08123456789</td>
                    {{-- <td>0</td> --}}
                </tr>
            </tbody>
        </table>

    </div>

</div>
@endsection
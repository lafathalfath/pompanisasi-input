@extends('layouts.nasional')
@section('content')
<div class="d-flex flex-col justify-content-center">
    <div>
        <table class="w-100 table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Wilayah</th>
                    <th rowspan="2">Kelompok tani</th>
                    <th rowspan="2">Luas lahan (ha)</th>
                    <th colspan="3" class="text-center">Pompa ABT Dimanfaatkan</th>
                    <th rowspan="2">No HP Poktan (jika ada)</th>
                    <th rowspan="2">Aksi</th>
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
                    <td>Wilayah 1</td>
                    <td>Kelompok tani 1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>08123456789</td>
                    <td><a href="{{ route('wilayah.detailprovinsi') }}" class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            </tbody>
        </table>

    </div>

</div>
@endsection

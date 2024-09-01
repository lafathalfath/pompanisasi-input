@extends('layouts.admin')
@section('content')
    <style>
        table {
            width: 500px;
        }
        .table-head {
            background-color: #6ed8da;
        }
        th {
            background-color: #eee;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
    <div class="m-5">
        <h3>Rekap Daerah Nasional</h3>
        <table style="width: 500px;">
            <tr>
                <th class="table-head">Daerah</th>
                <th class="table-head">Total</th>
            </tr>
            <tr>
                <th>Wilayah</th>
                <td>{{ $daerah->wilayah }}</td>
            </tr>
            <tr>
                <th>Provinsi</th>
                <td>{{ $daerah->provinsi }}</td>
            </tr>
            <tr>
                <th>Kabupaten</th>
                <td>{{ $daerah->kabupaten }}</td>
            </tr>
            <tr>
                <th>Kecamatan</th>
                <td>{{ $daerah->kecamatan }}</td>
            </tr>
            <tr>
                <th>Desa</th>
                <td>{{ $daerah->desa }}</td>
            </tr>
        </table>
        <br>
        <br>
        <h3>Rekap User</h3>
        <div class="d-flex align-items-start gap-3">
            <div>
                <table>
                    <tr>
                        <th class="table-head">Role</th>
                        <th class="table-head">Total</th>
                    </tr>
                    <tr>
                        <th>Admin</th>
                        <td>{{ $user_role->admin }}</td>
                    </tr>
                    <tr>
                        <th>PJ Nasional</th>
                        <td>{{ $user_role->nasional }}</td>
                    </tr>
                    <tr>
                        <th>PJ Wilayah</th>
                        <td>{{ $user_role->wilayah }}</td>
                    </tr>
                    <tr>
                        <th>PJ Provinsi</th>
                        <td>{{ $user_role->provinsi }}</td>
                    </tr>
                    <tr>
                        <th>PJ Kabupaten</th>
                        <td>{{ $user_role->kabupaten }}</td>
                    </tr>
                    <tr>
                        <th>PJ Kecamatan</th>
                        <td>{{ $user_role->kecamatan }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <th class="table-head">Status</th>
                        <th class="table-head">Total</th>
                    </tr>
                    <tr>
                        <th>Proses</th>
                        <td>{{ $user_status->proses }}</td>
                    </tr>
                    <tr>
                        <th>Diverifikasi</th>
                        <td>{{ $user_status->terverifikasi }}</td>
                    </tr>
                    <tr>
                        <th>Ditolak</th>
                        <td>{{ $user_status->ditolak }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
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
    .mt-4 {
    margin-left: px;
    }
    .detail-button {
        background-color: #c8dce4;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 7px;
        text-decoration: none !important;
        color: black;
    }

</style>

<div class="container mt-4">
    <div class="row" style="margin-left: 3px">
        <h2>Rekapitulasi Data Kecamatan</h2>
        <table class="table table-bordered table-custom" style="width: 45%; margin-right: 20px; display: inline-table;">
            <thead>
                <tr>
                    <th>Pompa Refocusing</th>
                    <th>Total <br>(Unit)</th>
                    <th>Terverifikasi <br>(Unit)</th>
                    <th>Belum <br>Diverifikasi <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                {{-- buat sidebar di halaman dashboard --}}
                {{-- <tr>
                    <td style="font-weight: bold;">Refocusing Usulan</td>
                    <td style="padding: 10px 20px;">0</td>
                </tr> --}}
                <tr>
                    <td style="font-weight: bold;">Refocusing Diterima</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_diterima->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_diterima->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_diterima->belum_verifikasi }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Refocusing Digunakan</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_digunakan->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_digunakan->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->ref_digunakan->belum_verifikasi }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-custom" style="width: 45%;">
            <thead>
                <tr>
                    <th>Pompa ABT</th>
                    <th>Total <br>(Unit)</th>
                    <th>Terverifikasi <br>(Unit)</th>
                    <th>Belum <br>Diverifikasi <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">ABT Usulan</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_usulan->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_usulan->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_usulan->belum_verifikasi }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Diterima</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_diterima->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_diterima->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_diterima->belum_verifikasi }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">ABT Digunakan</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_digunakan->total }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_digunakan->terverifikasi }}</td>
                    <td style="padding: 10px 20px;">{{ $pompa->abt_digunakan->belum_verifikasi }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-custom" style="width: 45%;">
            <thead>
                <tr>
                    <th>Luas Tanam</th>
                    <th>Total <br>(Unit)</th>
                    <th>Terverifikasi <br>(Unit)</th>
                    <th>Belum <br>Diverifikasi <br>(Unit)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Luas Tanam</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompa->luas_tanam->total }}</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompa->luas_tanam->terverifikasi }}</td>
                    <td style="padding: 10px 20px;" id="abt_digunakan">{{ $pompa->luas_tanam->belum_verifikasi }}</td>
                </tr>
            </tbody>
        </table>
</div>
@endsection

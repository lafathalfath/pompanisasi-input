@extends('layouts.kecamatan')
@section('content')
<style>
    .content {
        margin-left: 180px;
    }
</style>
<div class="container mt-5">
    <form action="pompaAbtDiterimaForm" method="POST" enctype="multipart/form-data">
        <!-- Pompa ABT Usulan -->
        <h4>Input Luas Tanam</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanDesa">Desa</label>
                <input type="text" name="pompa_abt_usulan_desa" class="form-control" id="pumpaABTUsulanDesa" placeholder="Desa" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanPoktan">Nama Poktan</label>
                <input type="text" name="pompa_abt_usulan_poktan" class="form-control" id="pumpaABTUsulanPoktan" placeholder="Nama Poktan" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanLuas">Luas Tanam (ha)</label>
                <input type="number" name="pompa_abt_usulan_luas" class="form-control" id="pumpaABTUsulanLuas" placeholder="Luas Lahan (ha)" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanNoHP">No HP Poktan (Opsional)</label>
                <input type="text" name="pompa_abt_usulan_no_hp" class="form-control" id="pumpaABTUsulanNoHP" placeholder="No HP">
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanTanggal">Tanggal</label>
                <input type="date" name="pompa_abt_usulan_tanggal" class="form-control" id="pumpaABTUsulanTanggal" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="margin-top: 10px;">Submit</button>
        </div>
    </form>
</div>
@endsection


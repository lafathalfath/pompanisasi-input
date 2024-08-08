@extends('layouts.inputPompa')
@section('content')
<div class="container mt-5">
    <form action="#" method="POST" enctype="multipart/form-data">
        <!-- Pompa Refocusing Digunakan -->
        <h4>Pompa Refocusing Digunakan</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanDesa">Desa</label>
                <input type="text" name="pompa_abt_digunakan_desa" class="form-control" id="pumpaABTDigunakanDesa" placeholder="Desa" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanPoktan">Nama Poktan</label>
                <input type="text" name="pompa_abt_digunakan_poktan" class="form-control" id="pumpaABTDigunakanPoktan" placeholder="Nama Poktan" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanLuas">Luas Lahan (ha)</label>
                <input type="number" name="pompa_abt_digunakan_luas" class="form-control" id="pumpaABTDigunakanLuas" placeholder="Luas Lahan (ha)" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_3inch">Pompa (3 inch)</label>
                <input type="number" name="pilihan_spesifikasi_pompa_3inch" class="form-control" id="pilihan_spesifikasi_pompa_3inch" placeholder="Unit" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_4inch">Pompa (4 Inch)</label>
                <input type="number" name="pilihan_spesifikasi_pompa_4inch" class="form-control" id="pilihan_spesifikasi_pompa_4inch" placeholder="Unit" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_6inch">Pompa (6 Inch)</label>
                <input type="number" name="pilihan_spesifikasi_pompa_6inch" class="form-control" id="pilihan_spesifikasi_pompa_6inch" placeholder="Unit" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanJumlah">Jumlah yang Digunakan</label>
                <input type="number" name="pompa_abt_digunakan_jumlah" class="form-control" id="pumpaABTDigunakanJumlah" placeholder="Jumlah" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanNoHP">No HP Poktan (Opsional)</label>
                <input type="text" name="pompa_abt_digunakan_no_hp" class="form-control" id="pumpaABTDigunakanNoHP" placeholder="No HP">
            </div>
            <!-- <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanLuasTerairi">Luas Lahan Terairi (ha)</label>
                <input type="number" name="pompa_abt_digunakan_luas_terairi" class="form-control" id="pumpaABTDigunakanLuasTerairi" placeholder="Luas Terairi (ha)" required>
            </div> -->
            <div class="form-group col-md-4">
                <label for="farmerGroup">Foto Bukti</label>
                <input type="file" name="gambar" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
        </div>
            <button type="submit" class="btn btn-success" style="margin-top: 10px;">Submit</button>
    </form>
</div>
@endsection


@extends('layouts.inputPompa')
@section('content')
<div class="container mt-5">
    <form action="pompaAbtDigunakanForm" method="POST" enctype="multipart/form-data">
        <!-- Pompa Diterima -->
        <h4>Pompa ABT Diterima</h4>
        {{-- <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanDesa">Desa</label>
                <input type="text" name="pompa_abt_usulan_desa" class="form-control" id="pumpaABTUsulanDesa" placeholder="Desa" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanPoktan">Nama Poktan</label>
                <input type="text" name="pompa_abt_usulan_poktan" class="form-control" id="pumpaABTUsulanPoktan" placeholder="Nama Poktan" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanLuas">Luas Lahan (ha)</label>
                <input type="number" name="pompa_abt_usulan_luas" class="form-control" id="pumpaABTUsulanLuas" placeholder="Luas Lahan (ha)" required>
            </div>
        </div> --}}

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_3inch">Pompa 3 inch</label>
                <input type="number" name="pilihan_spesifikasi_pompa_3inch" class="form-control" id="pilihan_spesifikasi_pompa_3inch" placeholder="Unit" oninput="updateJumlahDiterima()" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_4inch">Pompa 4 Inch</label>
                <input type="number" name="pilihan_spesifikasi_pompa_4inch" class="form-control" id="pilihan_spesifikasi_pompa_4inch" placeholder="Unit" oninput="updateJumlahDiterima()" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_6inch">Pompa 6 Inch</label>
                <input type="number" name="pilihan_spesifikasi_pompa_6inch" class="form-control" id="pilihan_spesifikasi_pompa_6inch" placeholder="Unit" oninput="updateJumlahDiterima()" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanJumlah">Jumlah yang Diterima</label>
                <input type="number" name="pompa_abt_usulan_jumlah" class="form-control" id="pumpaABTDiterimaJumlah" placeholder="Jumlah" readonly>
            </div>
            {{-- <div class="form-group col-md-4">
                <label for="pumpaABTUsulanNoHP">No HP Poktan (Opsional)</label>
                <input type="text" name="pompa_abt_usulan_no_hp" class="form-control" id="pumpaABTUsulanNoHP" placeholder="No HP">
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanTanggal">Tanggal</label>
                <input type="date" name="pompa_abt_usulan_tanggal" class="form-control" id="pumpaABTUsulanTanggal" required>
            </div>
            <div class="form-group col-md-4">
                <label for="farmerGroup">Foto Bukti</label>
                <input type="file" name="gambar" class="form-control" id="foto" name="foto" accept="image/*">
            </div> --}}
        </div>
            <button type="submit" class="btn btn-success" style="margin-top: 10px;">Submit</button>
    </form>
</div>

<script>
    function updateJumlahDiterima() {
        var spesifikasi3Inch = parseInt(document.getElementById('pilihan_spesifikasi_pompa_3inch').value) || 0;
        var spesifikasi4Inch = parseInt(document.getElementById('pilihan_spesifikasi_pompa_4inch').value) || 0;
        var spesifikasi6Inch = parseInt(document.getElementById('pilihan_spesifikasi_pompa_6inch').value) || 0;
        var totalJumlah = spesifikasi3Inch + spesifikasi4Inch + spesifikasi6Inch;
        document.getElementById('pumpaABTDiterimaJumlah').value = totalJumlah;
    }
</script>
@endsection


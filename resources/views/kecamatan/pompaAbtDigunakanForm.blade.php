@extends('layouts.inputPompa')
@section('content')
<div class="container mt-5">
    <form action="{{ route('kecamatan.abt.usulan.store') }}" method="POST">
        @csrf
        <!-- Pompa Digunakan -->
        <h4>Pompa ABT Digunakan</h4>
        <div class="form-row">
            {{-- <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanDesa">Desa</label>
                <input type="text" name="pompa_abt_digunakan_desa" class="form-control" id="pumpaABTDigunakanDesa" placeholder="Desa" required>
            </div> --}}
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanPoktan">Nama Poktan</label>
                <input type="text" name="nama_poktan" class="form-control" id="pumpaABTDigunakanPoktan" placeholder="Nama Poktan" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanLuas">Luas Lahan (ha)</label>
                <input type="number" name="luas_lahan" class="form-control" id="pumpaABTDigunakanLuas" placeholder="Luas Lahan (ha)" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_3inch">Pilihan Spesifikasi Pompa (3 inch)</label>
                <input type="number" name="pompa_3_inch" class="form-control" id="pilihan_spesifikasi_pompa_3inch" placeholder="Unit" oninput="updateJumlahDigunakan()" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_4inch">Pilihan Spesifikasi Pompa (4 Inch)</label>
                <input type="number" name="pompa_4_inch" class="form-control" id="pilihan_spesifikasi_pompa_4inch" placeholder="Unit" oninput="updateJumlahDigunakan()" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_6inch">Pilihan Spesifikasi Pompa (6 Inch)</label>
                <input type="number" name="pompa_6_inch" class="form-control" id="pilihan_spesifikasi_pompa_6inch" placeholder="Unit" oninput="updateJumlahDigunakan()" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanJumlah">Jumlah yang Digunakan</label>
                <input type="number" name="pompa_abt_digunakan_jumlah" class="form-control" id="pumpaABTDigunakanJumlah" placeholder="Jumlah" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanNoHP">No HP Poktan (Opsional)</label>
                <input type="text" name="pompa_abt_digunakan_no_hp" class="form-control" id="pumpaABTDigunakanNoHP" placeholder="No HP">
            </div>
            {{-- <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanLuasTerairi">Luas Lahan Terairi (ha)</label>
                <input type="number" name="pompa_abt_digunakan_luas_terairi" class="form-control" id="pumpaABTDigunakanLuasTerairi" placeholder="Luas Terairi (ha)" required>
            </div> --}}
            <div class="form-group col-md-4">
                <label for="farmerGroup">Foto Bukti</label>
                <input type="file" name="gambar" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTDigunakanTanggal">Tanggal</label>
                <input type="date" name="pompa_abt_digunakan_tanggal" class="form-control" id="pumpaABTDigunakanTanggal" required>
            </div>
        </div>
            <button type="submit" class="btn btn-success" style="margin-top: 10px;">Submit</button>
    </form>
</div>

<script>
    function updateJumlahDigunakan() {
        var spesifikasi3Inch = parseInt(document.getElementById('pilihan_spesifikasi_pompa_3inch').value) || 0;
        var spesifikasi4Inch = parseInt(document.getElementById('pilihan_spesifikasi_pompa_4inch').value) || 0;
        var spesifikasi6Inch = parseInt(document.getElementById('pilihan_spesifikasi_pompa_6inch').value) || 0;
        var totalJumlah = spesifikasi3Inch + spesifikasi4Inch + spesifikasi6Inch;
        document.getElementById('pumpaABTDigunakanJumlah').value = totalJumlah;
    }
</script>
@endsection


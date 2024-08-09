@extends('layouts.inputPompa')
@section('content')
<div class="container mt-5">
    <form action="{{ route('kecamatan.refocusing.diterima.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Pompa Refocusing Diterima -->
        <h4>Pompa Refocusing Diterima</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumparefUsulanDesa">Desa</label>
                {{-- <input type="text" name="pompa_ref_usulan_desa" class="form-control" id="pumparefUsulanDesa" placeholder="Desa" required> --}}
                <select name="desa_id" class="form-control" id="pumparefUsulanDesa" required>
                    <option value="" disabled selected>Pilih Desa</option>
                    @foreach ($desa as $des)
                        <option value="{{ $des->id }}">{{ $des->nama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group col-md-4">
                <label for="pumparefUsulanPoktan">Nama Poktan</label>
                <input type="text" name="pompa_ref_usulan_poktan" class="form-control" id="pumparefUsulanPoktan" placeholder="Nama Poktan" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumparefUsulanLuas">Luas Lahan (ha)</label>
                <input type="number" name="pompa_ref_usulan_luas" class="form-control" id="pumparefUsulanLuas" placeholder="Luas Lahan (ha)" required>
            </div> --}}
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_3inch">Pompa 3 inch</label>
                <input type="number" name="pompa_3_inch" class="form-control" id="pilihan_spesifikasi_pompa_3inch" placeholder="Unit" oninput="updateJumlahDiterima()" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_4inch">Pompa 4 Inch</label>
                <input type="number" name="pompa_4_inch" class="form-control" id="pilihan_spesifikasi_pompa_4inch" placeholder="Unit" oninput="updateJumlahDiterima()" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pilihan_spesifikasi_pompa_6inch">Pompa 6 Inch</label>
                <input type="number" name="pompa_6_inch" class="form-control" id="pilihan_spesifikasi_pompa_6inch" placeholder="Unit" oninput="updateJumlahDiterima()" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaRefDiterimaJumlah">Jumlah yang Diterima</label>
                <input type="number" name="total_unit" class="form-control" id="pumpaRefDiterimaJumlah" placeholder="Jumlah" readonly>
            </div>
            {{-- <div class="form-group col-md-4">
                <label for="pumparefUsulanNoHP">No HP Poktan (Opsional)</label>
                <input type="text" name="pompa_ref_usulan_no_hp" class="form-control" id="pumparefUsulanNoHP" placeholder="No HP">
            </div>
            <div class="form-group col-md-4">
                <label for="pumparefUsulanTanggal">Tanggal</label>
                <input type="date" name="pompa_ref_usulan_tanggal" class="form-control" id="pumparefUsulanTanggal" required>
            </div>
            <div class="form-group col-md-4">
                <label for="farmerGroup">Foto Bukti</label>
                <input type="file" name="gambar" class="form-control" id="foto" name="foto" accept="image/*" required>
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
        document.getElementById('pumpaRefDiterimaJumlah').value = totalJumlah;
    }
</script>
@endsection


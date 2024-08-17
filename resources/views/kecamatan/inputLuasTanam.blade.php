@extends('layouts.kecamatan')
@section('content')
<style>
    .content {
        margin-left: 180px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<div class="container mt-5">
    <form action="{{ route('kecamatan.inputLuasTanam.store') }}" method="POST">
        @csrf
        <!-- Pompa ABT Usulan -->
        <h4>Luas Tanam</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanDesa">Desa</label>
                <select name="desa_id" class="form-control" id="pumpaABTUsulanDesa" required>
                    <option value="" disabled selected>Pilih Desa</option>
                    @foreach ($desa as $des)
                        <option value="{{ $des->id }}">{{ $des->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanPoktan">Nama Poktan</label>
                <input type="text" name="nama_poktan" class="form-control" id="pumpaABTUsulanPoktan" placeholder="Nama Poktan" required>
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanLuas">Luas Tanam (ha)</label>
                <input type="number" step="0.0001" name="luas_tanam" class="form-control" id="pumpaABTUsulanLuas" placeholder="Luas Tanam (ha)" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanNoHP">No HP Poktan (Opsional)</label>
                <input type="text" name="no_hp_poktan" class="form-control" id="pumpaABTUsulanNoHP" placeholder="No HP">
            </div>
            <div class="form-group col-md-4">
                <label for="pumpaABTUsulanTanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="pumpaABTUsulanTanggal" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="margin-top: 10px;">Submit</button>
        </div>
    </form>
</div>
@endsection


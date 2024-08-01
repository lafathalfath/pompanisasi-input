<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string'
        ], [
            'nama.required' => 'nama cannot be null'
        ]);
        Wilayah::create($request->except('_token'));
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}

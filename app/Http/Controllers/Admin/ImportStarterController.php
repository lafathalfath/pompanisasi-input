<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StarterAbtDimanfaatkanKabupaten;
use App\Models\StarterAbtDiterimaKabupaten;
use App\Models\StarterAbtUsulanKabupaten;
use App\Models\StarterLuasTanamKabupaten;
use App\Models\StarterRefDimanfaatkanKabupaten;
use App\Models\StarterRefDiterimaKabupaten;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportStarterController extends Controller
{
    // import starter pompa kabupaten with excel

    public function ref_diterima_view() {
        return view('admin.import_starter.ref_diterima');
    }
    public function ref_dimanfaatkan_view() {
        return view('admin.import_starter.ref_dimanfaatkan');
    }
    public function abt_usulan_view() {
        return view('admin.import_starter.abt_usulan');
    }
    public function abt_diterima_view() {
        return view('admin.import_starter.abt_diterima');
    }
    public function abt_dimanfaatkan_view() {
        return view('admin.import_starter.abt_dimanfaatkan');
    }
    public function luas_tanam_view() {
        return view('admin.import_starter.luas_tanam');
    }

    // store
    public function ref_diterima(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,xlsm',
        ], [
            'file.required' => 'file required',
            'file.mimes' => 'file not supported',
        ]);
        if (!$request->hasFile('file')) return back()->withErrors('file not found');
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $workspace = $spreadsheet->getActiveSheet();
        $data = [];
        foreach ($workspace->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $rowData = [];
            if ($rowIndex > 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($rowData[0] && $rowData[2]) {
                    $data[] = [
                        'kabupaten_id' => $rowData[0],
                        'total_unit' => $rowData[2],
                    ];
                }
            }
        }
        StarterRefDiterimaKabupaten::upsert($data, ['kabupaten_id'], ['total_unit']);
        return redirect()->route('admin.starter.kabupaten.ref_diterima')->with('success', 'berhasil import data starter');
    }
    public function ref_dimanfaatkan(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,xlsm',
        ], [
            'file.required' => 'file required',
            'file.mimes' => 'file not supported',
        ]);
        if (!$request->hasFile('file')) return back()->withErrors('file not found');
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $workspace = $spreadsheet->getActiveSheet();
        $data = [];
        foreach ($workspace->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $rowData = [];
            if ($rowIndex > 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($rowData[0] && $rowData[2]) {
                    $data[] = [
                        'kabupaten_id' => $rowData[0],
                        'total_unit' => $rowData[2],
                    ];
                }
            }
        }
        StarterRefDimanfaatkanKabupaten::upsert($data, ['kabupaten_id'], ['total_unit']);
        return redirect()->route('admin.starter.kabupaten.ref_dimanfaatkan')->with('success', 'berhasil import data starter');
    }
    public function abt_usulan(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,xlsm',
        ], [
            'file.required' => 'file required',
            'file.mimes' => 'file not supported',
        ]);
        if (!$request->hasFile('file')) return back()->withErrors('file not found');
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $workspace = $spreadsheet->getActiveSheet();
        $data = [];
        foreach ($workspace->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $rowData = [];
            if ($rowIndex > 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($rowData[0] && $rowData[2]) {
                    $data[] = [
                        'kabupaten_id' => $rowData[0],
                        'total_unit' => $rowData[2],
                    ];
                }
            }
        }
        StarterAbtUsulanKabupaten::upsert($data, ['kabupaten_id'], ['total_unit']);
        return redirect()->route('admin.starter.kabupaten.abt_usulan')->with('success', 'berhasil import data starter');
    }
    public function abt_diterima(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,xlsm',
        ], [
            'file.required' => 'file required',
            'file.mimes' => 'file not supported',
        ]);
        if (!$request->hasFile('file')) return back()->withErrors('file not found');
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $workspace = $spreadsheet->getActiveSheet();
        $data = [];
        foreach ($workspace->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $rowData = [];
            if ($rowIndex > 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($rowData[0] && $rowData[2]) {
                    $data[] = [
                        'kabupaten_id' => $rowData[0],
                        'total_unit' => $rowData[2],
                    ];
                }
            }
        }
        StarterAbtDiterimaKabupaten::upsert($data, ['kabupaten_id'], ['total_unit']);
        return redirect()->route('admin.starter.kabupaten.abt_diterima')->with('success', 'berhasil import data starter');
    }
    public function abt_dimanfaatkan(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,xlsm',
        ], [
            'file.required' => 'file required',
            'file.mimes' => 'file not supported',
        ]);
        if (!$request->hasFile('file')) return back()->withErrors('file not found');
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $workspace = $spreadsheet->getActiveSheet();
        $data = [];
        foreach ($workspace->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $rowData = [];
            if ($rowIndex > 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($rowData[0] && $rowData[2]) {
                    $data[] = [
                        'kabupaten_id' => $rowData[0],
                        'total_unit' => $rowData[2],
                    ];
                }
            }
        }
        StarterAbtDimanfaatkanKabupaten::upsert($data, ['kabupaten_id'], ['total_unit']);
        return redirect()->route('admin.starter.kabupaten.abt_dimanfaatkan')->with('success', 'berhasil import data starter');
    }
    public function luas_tanam(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,xlsm',
        ], [
            'file.required' => 'file required',
            'file.mimes' => 'file not supported',
        ]);
        if (!$request->hasFile('file')) return back()->withErrors('file not found');
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $workspace = $spreadsheet->getActiveSheet();
        $data = [];
        foreach ($workspace->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $rowData = [];
            if ($rowIndex > 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($rowData[0] && $rowData[2]) {
                    $data[] = [
                        'kabupaten_id' => $rowData[0],
                        'luas_tanam' => $rowData[2],
                    ];
                }
            }
        }
        StarterLuasTanamKabupaten::upsert($data, ['kabupaten_id'], ['luas_tanam']);
        return redirect()->route('admin.starter.kabupaten.luas_tanam')->with('success', 'berhasil import data starter');
    }
}

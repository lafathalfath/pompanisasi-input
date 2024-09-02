<?php

namespace App\Http\Controllers\Nasional;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\LuasTanam;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use App\Models\Provinsi;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasionalController extends Controller
{
    use ArrayPaginator;

    public function index(Request $request) {
        $user = Auth::user();
        $provinsi = Provinsi::get();
        $kabupaten = [];
        $kecamatan = [];
        $region_desa = [];
        $pompanisasi = (object) [
            'luas_tanam' => 0,
            'ref_diterima' => 0,
            'ref_dimanfaatkan' => 0,
            'abt_usulan' => 0,
            'abt_diterima' => 0,
            'abt_dimanfaatkan' => 0,
        ];
        $rekap = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $pompanisasi = (object) [
                'luas_tanam' => LuasTanam::where('verified_at', '!=', null)->sum('luas_tanam'),
                'ref_diterima' => PompaRefDiterima::where('verified_at', '!=', null)->sum('total_unit'),
                'ref_dimanfaatkan' => PompaRefDimanfaatkan::where('verified_at', '!=', null)->sum('total_unit'),
                'abt_usulan' => PompaAbtUsulan::where('verified_at', '!=', null)->sum('total_unit'),
                'abt_diterima' => PompaAbtDiterima::where('verified_at', '!=', null)->sum('total_unit'),
                'abt_dimanfaatkan' => PompaAbtDimanfaatkan::where('verified_at', '!=', null)->sum('total_unit'),
            ];
            // if (!$request->provinsi && !$request->kabupaten && !$request->kecamatan) {
            //     $rekap = [];
                foreach (Provinsi::get() as $prov) {
                    $desa = [];
                    foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
                    $rekap_row = (object) [
                        'provinsi' => $prov,
                        'luas_tanam' => LuasTanam::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('luas_tanam'),
                        'pompa_ref_diterima' => PompaRefDiterima::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
                        'pompa_ref_dimanfaatkan' => PompaRefDimanfaatkan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
                        'pompa_abt_usulan' => PompaAbtUsulan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
                        'pompa_abt_diterima' => PompaAbtDiterima::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
                        'pompa_abt_dimanfaatkan' => PompaAbtDimanfaatkan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
                    ];
                    if ($rekap_row->luas_tanam || $rekap_row->pompa_ref_diterima || $rekap_row->pompa_ref_dimanfaatkan || $rekap_row->pompa_abt_usulan || $rekap_row->pompa_abt_diterima || $rekap_row->pompa_abt_dimanfaatkan) $rekap[] = $rekap_row;
                }
            // } elseif ($request->provinsi) {
            //     $kabupaten = Kabupaten::where('provinsi_id', $request->provinsi)->get();
            //     if ($request->kabupaten) {
            //         $kecamatan = Kecamatan::where('kabupaten_id', $request->kabupaten)->get();
            //         if ($request->kecamatan) {
            //             $region_desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
            //             if ($request->desa) {
            //                 $data_desa = Desa::find($request->desa);
            //                 $rekap = [(object) [
            //                     'desa' => $data_desa,
            //                     'luas_tanam' => LuasTanam::where('verified_at', '!=', null)->where('desa_id', $data_desa->id)->sum('luas_tanam'),
            //                     'pompa_ref_diterima' => PompaRefDiterima::where('verified_at', '!=', null)->where('desa_id', $data_desa->id)->sum('total_unit'),
            //                     'pompa_ref_dimanfaatkan' => PompaRefDimanfaatkan::where('verified_at', '!=', null)->where('desa_id', $data_desa->id)->sum('total_unit'),
            //                     'pompa_abt_usulan' => PompaAbtUsulan::where('verified_at', '!=', null)->where('desa_id', $data_desa->id)->sum('total_unit'),
            //                     'pompa_abt_diterima' => PompaAbtDiterima::where('verified_at', '!=', null)->where('desa_id', $data_desa->id)->sum('total_unit'),
            //                     'pompa_abt_dimanfaatkan' => PompaAbtDimanfaatkan::where('verified_at', '!=', null)->where('desa_id', $data_desa->id)->sum('total_unit'),
            //                 ]];
            //             } else {
            //                 $rekap = [];
            //                 foreach (Desa::where('kecamatan_id', $request->kecamatan)->get() as $des) {
            //                     $rekap_row = (object) [
            //                         'desa' => $des,
            //                         'luas_tanam' => LuasTanam::where('verified_at', '!=', null)->where('desa_id', $des->id)->sum('luas_tanam'),
            //                         'pompa_ref_diterima' => PompaRefDiterima::where('verified_at', '!=', null)->where('desa_id', $des->id)->sum('total_unit'),
            //                         'pompa_ref_dimanfaatkan' => PompaRefDimanfaatkan::where('verified_at', '!=', null)->where('desa_id', $des->id)->sum('total_unit'),
            //                         'pompa_abt_usulan' => PompaAbtUsulan::where('verified_at', '!=', null)->where('desa_id', $des->id)->sum('total_unit'),
            //                         'pompa_abt_diterima' => PompaAbtDiterima::where('verified_at', '!=', null)->where('desa_id', $des->id)->sum('total_unit'),
            //                         'pompa_abt_dimanfaatkan' => PompaAbtDimanfaatkan::where('verified_at', '!=', null)->where('desa_id', $des->id)->sum('total_unit'),
            //                     ];
            //                     if ($rekap_row->luas_tanam || $rekap_row->pompa_ref_diterima || $rekap_row->pompa_ref_dimanfaatkan || $rekap_row->pompa_abt_usulan || $rekap_row->pompa_abt_diterima || $rekap_row->pompa_abt_dimanfaatkan) $rekap[] = $rekap_row;
            //                 }
            //             }
            //         } else {
            //             $rekap = [];
            //             foreach ($kecamatan as $kec) {
            //                 $desa = [];
            //                 foreach ($kec->desa as $des) $desa[] = $des->id;
            //                 $rekap_row = (object) [
            //                     'kecamatan' => $kec,
            //                     'luas_tanam' => LuasTanam::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('luas_tanam'),
            //                     'pompa_ref_diterima' => PompaRefDiterima::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                     'pompa_ref_dimanfaatkan' => PompaRefDimanfaatkan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                     'pompa_abt_usulan' => PompaAbtUsulan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                     'pompa_abt_diterima' => PompaAbtDiterima::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                     'pompa_abt_dimanfaatkan' => PompaAbtDimanfaatkan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                 ];
            //                 if ($rekap_row->luas_tanam || $rekap_row->pompa_ref_diterima || $rekap_row->pompa_ref_dimanfaatkan || $rekap_row->pompa_abt_usulan || $rekap_row->pompa_abt_diterima || $rekap_row->pompa_abt_dimanfaatkan) $rekap[] = $rekap_row;
            //             }
            //         }
            //     } else {
            //         $rekap = [];
            //         foreach ($kabupaten as $kab) {
            //             $desa = [];
            //             foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            //             $rekap_row = (object) [
            //                 'kabupaten' => $kab,
            //                 'luas_tanam' => LuasTanam::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('luas_tanam'),
            //                 'pompa_ref_diterima' => PompaRefDiterima::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                 'pompa_ref_dimanfaatkan' => PompaRefDimanfaatkan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                 'pompa_abt_usulan' => PompaAbtUsulan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                 'pompa_abt_diterima' => PompaAbtDiterima::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //                 'pompa_abt_dimanfaatkan' => PompaAbtDimanfaatkan::where('verified_at', '!=', null)->whereIn('desa_id', $desa)->sum('total_unit'),
            //             ];
            //             if ($rekap_row->luas_tanam || $rekap_row->pompa_ref_diterima || $rekap_row->pompa_ref_dimanfaatkan || $rekap_row->pompa_abt_usulan || $rekap_row->pompa_abt_diterima || $rekap_row->pompa_abt_dimanfaatkan) $rekap[] = $rekap_row;
            //         }
            //     }
            // }
        }
        $rekap = $this->paginate($rekap, 10);
        return view('nasional.dashboard', ['pompanisasi' => $pompanisasi, 'rekap' => $rekap, 'provinsi' => $provinsi, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $region_desa]);
    }
}

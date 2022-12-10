<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class apiSimrsku extends Controller
{
    public function apirm($rm)
    {
        $data = DB::table('DAT_PASIEN')
        ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        ->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
        ->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA')
        ->where('DAT_PASIEN.DAT_PASIEN', $rm)
        ->orderBy('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', 'DESC')
        ->first();

        return response()->json($data, 200);
    }
}

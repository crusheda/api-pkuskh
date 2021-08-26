<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class PelayananController extends Controller
{
    //
    public function obatLisinopril()
    {
        // $rm= $request->query('rm');
        $lisinopril10 = "SELECT ta.DAT_PASIEN,ta.REG_KUNJUNGANPASIEN,ta.TGL_DISCHARGE,do.DAT_OBATALKES,tj.TRANS_JNSPELAYANAN FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES = '1081000017' ORDER BY ta.TGL_DISCHARGE DESC";
        $lisinopril5 = "SELECT ta.DAT_PASIEN,ta.REG_KUNJUNGANPASIEN,ta.TGL_DISCHARGE,do.DAT_OBATALKES,tj.TRANS_JNSPELAYANAN FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES = '1081000018' ORDER BY ta.TGL_DISCHARGE DESC";
        $all = "SELECT * FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES IN ('1081000018','1081000017')";

        $query_lisinopril10 = DB::select($lisinopril10);
        $query_lisinopril5 = DB::select($lisinopril5);
        $query_all = DB::select($all);

        // foreach ($query_all as $key => $value) {
        //     # code...
        //     print_r($value->DAT_OBATALKES);
        //     die();
        // }

        $showdata = [
            // 'idpasien' => $value['DAT_PASIEN'],
            'lisinopril10' => $query_lisinopril10,
            'lisinopril5' => $query_lisinopril5,
            'all' => $query_all
        ];

        return view('page.farmasi.obat-lisinopril')->with('list', $showdata);
    }

    public function obatTanapres()
    {
        // $rm= $request->query('rm');
        $tanapres10 = "SELECT ta.DAT_PASIEN,ta.REG_KUNJUNGANPASIEN,ta.TGL_DISCHARGE,do.DAT_OBATALKES,tj.TRANS_JNSPELAYANAN FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES = '1052000005' ORDER BY ta.TGL_DISCHARGE DESC";
        $tanapres5 = "SELECT ta.DAT_PASIEN,ta.REG_KUNJUNGANPASIEN,ta.TGL_DISCHARGE,do.DAT_OBATALKES,tj.TRANS_JNSPELAYANAN FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES = '1052000002' ORDER BY ta.TGL_DISCHARGE DESC";
        $all = "SELECT * FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES IN ('1052000005','1052000002')";

        $query_tanapres10 = DB::select($tanapres10);
        $query_tanapres5 = DB::select($tanapres5);
        $query_all = DB::select($all);

        $showdata = [
            'tanapres10' => $query_tanapres10,
            'tanapres5' => $query_tanapres5,
            'all' => $query_all
        ];

        return view('page.farmasi.obat-tanapres')->with('list', $showdata);
    }

    public function obatCaptopril()
    {
        // $rm= $request->query('rm');
        $captopril125 = "SELECT ta.DAT_PASIEN,ta.REG_KUNJUNGANPASIEN,ta.TGL_DISCHARGE,do.DAT_OBATALKES,tj.TRANS_JNSPELAYANAN FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES = '1025000034' ORDER BY ta.TGL_DISCHARGE DESC";
        $captopril25 = "SELECT ta.DAT_PASIEN,ta.REG_KUNJUNGANPASIEN,ta.TGL_DISCHARGE,do.DAT_OBATALKES,tj.TRANS_JNSPELAYANAN FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES = '1025000036' ORDER BY ta.TGL_DISCHARGE DESC";
        $captopril50 = "SELECT ta.DAT_PASIEN,ta.REG_KUNJUNGANPASIEN,ta.TGL_DISCHARGE,do.DAT_OBATALKES,tj.TRANS_JNSPELAYANAN FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES = '1025000035' ORDER BY ta.TGL_DISCHARGE DESC";
        $all = "SELECT * FROM REG_KUNJUNGANPASIEN ta
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN TRANS_JNSPELAYANAN tj ON ak.TRANS_AKOMODASI = tj.TRANS_AKOMODASI
                JOIN DETAIL_TRANSOBATALKES dt ON tj.TRANS_JNSPELAYANAN = dt.TRANS_JNSPELAYANAN
                JOIN DAT_OBATALKES do ON dt.DAT_OBATALKES = do.DAT_OBATALKES

                WHERE dt.DAT_OBATALKES IN ('1025000034','1025000036','1025000035')";

        $query_captopril125 = DB::select($captopril125);
        $query_captopril25 = DB::select($captopril25);
        $query_captopril50 = DB::select($captopril50);
        $query_all = DB::select($all);

        $showdata = [
            'captopril125' => $query_captopril125,
            'captopril25' => $query_captopril25,
            'captopril50' => $query_captopril50,
            'all' => $query_all
        ];

        return view('page.farmasi.obat-captopril')->with('list', $showdata);
    }
}

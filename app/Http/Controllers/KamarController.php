<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KamarController extends Controller
{
    //
    public function index()
    {
        # code...
        header( "refresh:500;url=kamar" );
        $now = Carbon::now()->addHours(7);
        $kamar_terisi = "SELECT * FROM SET_TMPTIDUR st JOIN REF_SUBINSTALASI rs ON st.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
        WHERE REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' ORDER BY SET_TMPTIDUR ASC";
        $jumlah_terisi = "SELECT COUNT(*) as jumlah FROM SET_TMPTIDUR st JOIN REF_SUBINSTALASI rs ON st.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
        WHERE REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1'";

        $kamar_kosong = "SELECT * FROM SET_TMPTIDUR st JOIN REF_SUBINSTALASI rs ON st.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
        WHERE REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' ORDER BY SET_TMPTIDUR ASC";
        $jumlah_kosong = "SELECT COUNT(*) as jumlah FROM SET_TMPTIDUR st JOIN REF_SUBINSTALASI rs ON st.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
        WHERE REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1'";

        // Jumlah Per Kelas Terisi
        $icu = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $lt3 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0401' AND REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $lt4 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $keb = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $iso = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $perin = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";

        // Jumlah Per Kelas Tersedia
        $icu2 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $lt32 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0401' AND REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $lt42 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $keb2 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $iso2 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $perin2 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' GROUP BY st.SET_KELAS";

        // Jumlah Total Per Kelas
        $toticu = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $totlt3 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0401' AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $totlt4 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $totkeb = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $totiso = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND st.AKTIF = '1' GROUP BY st.SET_KELAS";
        $totperin = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND st.AKTIF = '1' GROUP BY st.SET_KELAS";

        // $coba = "SELECT ";

            // TERISI
            $terisi = DB::select($kamar_terisi);
            $jumlaht = DB::select($jumlah_terisi);
            $query_icu = DB::select($icu);
            $query_lt3 = DB::select($lt3);
            $query_lt4 = DB::select($lt4);
            $query_keb = DB::select($keb);
            $query_iso = DB::select($iso);
            $query_perin = DB::select($perin);

            // TERSEDIA
            $kosong = DB::select($kamar_kosong);
            $jumlahk = DB::select($jumlah_kosong);
            $query_icu2 = DB::select($icu2);
            $query_lt32 = DB::select($lt32);
            $query_lt42 = DB::select($lt42);
            $query_keb2 = DB::select($keb2);
            $query_iso2 = DB::select($iso2);
            $query_perin2 = DB::select($perin2);

            // Jumlah TOTAL Per Kelas
            $query_icutot = DB::select($toticu);
            $query_lt3tot = DB::select($totlt3);
            $query_lt4tot = DB::select($totlt4);
            $query_kebtot = DB::select($totkeb);
            $query_isotot = DB::select($totiso);
            $query_perintot = DB::select($totperin);

            // $query_icu = DB::select($icu2);
            // print_r($query_icu);
            // die();

            $datakamar = [
            'terisi' => $terisi,
            'jumlaht' => $jumlaht,
            'icut' => $query_icu,
            'lt3t' => $query_lt3,
            'lt4t' => $query_lt4,
            'kebt' => $query_keb,
            'isot' => $query_iso,
            'perint' => $query_perin,

            'kosong' => $kosong,
            'jumlahk' => $jumlahk,
            'icuk' => $query_icu2,
            'lt3k' => $query_lt32,
            'lt4k' => $query_lt42,
            'kebk' => $query_keb2,
            'isok' => $query_iso2,
            'perink' => $query_perin2,

            'toticu' => $query_icutot,
            'totlt3' => $query_lt3tot,
            'totlt4' => $query_lt4tot,
            'totkeb' => $query_kebtot,
            'totiso' => $query_isotot,
            'totperin' => $query_perintot,
            'now' => $now
        ];

        // print_r($query_keb2);
        // die();

        return view('page.direktur.kamar')->with('list', $datakamar);
    }
}

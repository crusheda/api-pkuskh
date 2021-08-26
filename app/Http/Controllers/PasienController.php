<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		// ini_set('memory_limit', '-1');
        header( "refresh:300;url=" );
        $now = Carbon::now()->addHours(7);
        $now->toDayDateTimeString();

        // BANGSAL LT.3
            $lt3vipt = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
            $lt3kl1t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
            $lt3kl2t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
            $lt3kl3t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

            $lt3vipk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
            $lt3kl1k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
            $lt3kl2k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
            $lt3kl3k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        // BANGSAL LT.4
        $lt4vipt = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
        $lt4kl1t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
        $lt4kl2t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $lt4kl3t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        $lt4vipk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
        $lt4kl1k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
        $lt4kl2k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $lt4kl3k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        // KEBIDANAN
        $kebvipt = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '07'";
        $kebkl1t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '03'";
        $kebkl2t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $kebkl3t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        $kebvipk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '07'";
        $kebkl1k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '03'";
        $kebkl2k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $kebkl3k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        // ICU ISO PERIN
        $icut = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1'";
        $isot = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1'";
        $perint = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1'";

        $icuk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1'";
        $isok = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1'";
        $perink = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1'";

        // Jumlah Total Per Kelas
        $toticu = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totlt3 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0401' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totlt4 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totkeb = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totiso = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totperin = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";

        // Jumlah Terisi
        $query_lt3vipt = DB::select($lt3vipt);
        $query_lt3kl1t = DB::select($lt3kl1t);
        $query_lt3kl2t = DB::select($lt3kl2t);
        $query_lt3kl3t = DB::select($lt3kl3t);

        $query_lt4vipt = DB::select($lt4vipt);
        $query_lt4kl1t = DB::select($lt4kl1t);
        $query_lt4kl2t = DB::select($lt4kl2t);
        $query_lt4kl3t = DB::select($lt4kl3t);

        $query_kebvipt = DB::select($kebvipt);
        $query_kebkl1t = DB::select($kebkl1t);
        $query_kebkl2t = DB::select($kebkl2t);
        $query_kebkl3t = DB::select($kebkl3t);

        $query_icut = DB::select($icut);
        $query_isot = DB::select($isot);
        $query_perint = DB::select($perint);

        // Jumlah Kosong
        $query_lt3vipk = DB::select($lt3vipk);
        $query_lt3kl1k = DB::select($lt3kl1k);
        $query_lt3kl2k = DB::select($lt3kl2k);
        $query_lt3kl3k = DB::select($lt3kl3k);

        $query_lt4vipk = DB::select($lt4vipk);
        $query_lt4kl1k = DB::select($lt4kl1k);
        $query_lt4kl2k = DB::select($lt4kl2k);
        $query_lt4kl3k = DB::select($lt4kl3k);

        $query_kebvipk = DB::select($kebvipk);
        $query_kebkl1k = DB::select($kebkl1k);
        $query_kebkl2k = DB::select($kebkl2k);
        $query_kebkl3k = DB::select($kebkl3k);

        $query_icuk = DB::select($icuk);
        $query_isok = DB::select($isok);
        $query_perink = DB::select($perink);

        // Jumlah TOTAL Per Kelas
        $query_icutot = DB::select($toticu);
        $query_lt3tot = DB::select($totlt3);
        $query_lt4tot = DB::select($totlt4);
        $query_kebtot = DB::select($totkeb);
        $query_isotot = DB::select($totiso);
        $query_perintot = DB::select($totperin);

                // print_r($query_lt4tot);
                // die();

            $datakamar = [
            'lt3vipt' => $query_lt3vipt,
            'lt3kl1t' => $query_lt3kl1t,
            'lt3kl2t' => $query_lt3kl2t,
            'lt3kl3t' => $query_lt3kl3t,

            'lt4vipt' => $query_lt4vipt,
            'lt4kl1t' => $query_lt4kl1t,
            'lt4kl2t' => $query_lt4kl2t,
            'lt4kl3t' => $query_lt4kl3t,

            'kebvipt' => $query_kebvipt,
            'kebkl1t' => $query_kebkl1t,
            'kebkl2t' => $query_kebkl2t,
            'kebkl3t' => $query_kebkl3t,

            'icut' => $query_icut,
            'isot' => $query_isot,
            'perint' => $query_perint,

                'lt3vipk' => $query_lt3vipk,
                'lt3kl1k' => $query_lt3kl1k,
                'lt3kl2k' => $query_lt3kl2k,
                'lt3kl3k' => $query_lt3kl3k,

                'lt4vipk' => $query_lt4vipk,
                'lt4kl1k' => $query_lt4kl1k,
                'lt4kl2k' => $query_lt4kl2k,
                'lt4kl3k' => $query_lt4kl3k,

                'kebvipk' => $query_kebvipk,
                'kebkl1k' => $query_kebkl1k,
                'kebkl2k' => $query_kebkl2k,
                'kebkl3k' => $query_kebkl3k,

                'icuk' => $query_icuk,
                'isok' => $query_isok,
                'perink' => $query_perink,

            'toticu' => $query_icutot,
            'totlt3' => $query_lt3tot,
            'totlt4' => $query_lt4tot,
            'totkeb' => $query_kebtot,
            'totiso' => $query_isotot,
            'totperin' => $query_perintot,
            'now' => $now
            ];

                return view('page.guest.info-kamar')->with('list', $datakamar);
        }

        public function apikamar()
        {
                $now = Carbon::now()->addHours(7);
                $now->toDayDateTimeString();

                // BANGSAL LT.3
            $lt3vipt = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
            $lt3kl1t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
            $lt3kl2t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
            $lt3kl3t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

            $lt3vipk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
            $lt3kl1k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
            $lt3kl2k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
            $lt3kl3k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                    WHERE st.REF_SUBINSTALASI = '0401' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        // BANGSAL LT.4
        $lt4vipt = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
        $lt4kl1t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
        $lt4kl2t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $lt4kl3t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        $lt4vipk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '05'";
        $lt4kl1k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '04'";
        $lt4kl2k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $lt4kl3k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        // KEBIDANAN
        $kebvipt = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '07'";
        $kebkl1t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '03'";
        $kebkl2t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $kebkl3t = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        $kebvipk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '07'";
        $kebkl1k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '03'";
        $kebkl2k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '02'";
        $kebkl3k = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1' AND st.SET_KELAS = '01'";

        // ICU ISO PERIN
        $icut = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1'";
        $isot = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1'";
        $perint = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND st.REG_KUNJUNGANPASIEN is not null AND st.AKTIF = '1'";

        $icuk = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1'";
        $isok = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1'";
        $perink = "SELECT COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND st.REG_KUNJUNGANPASIEN is null AND st.AKTIF = '1'";

        // Jumlah Total Per Kelas
        $toticu = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0400' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totlt3 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0401' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totlt4 = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0402' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totkeb = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0403' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totiso = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0405' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";
        $totperin = "SELECT st.SET_KELAS , COUNT(st.SET_KELAS) as jumlah FROM SET_TMPTIDUR st
                WHERE st.REF_SUBINSTALASI = '0406' AND st.AKTIF = '1' GROUP BY st.SET_KELAS ORDER BY st.SET_KELAS DESC";

        // Jumlah Terisi
        $query_lt3vipt = DB::select($lt3vipt);
        $query_lt3kl1t = DB::select($lt3kl1t);
        $query_lt3kl2t = DB::select($lt3kl2t);
        $query_lt3kl3t = DB::select($lt3kl3t);

        $query_lt4vipt = DB::select($lt4vipt);
        $query_lt4kl1t = DB::select($lt4kl1t);
        $query_lt4kl2t = DB::select($lt4kl2t);
        $query_lt4kl3t = DB::select($lt4kl3t);

        $query_kebvipt = DB::select($kebvipt);
        $query_kebkl1t = DB::select($kebkl1t);
        $query_kebkl2t = DB::select($kebkl2t);
        $query_kebkl3t = DB::select($kebkl3t);

        $query_icut = DB::select($icut);
        $query_isot = DB::select($isot);
        $query_perint = DB::select($perint);

        // Jumlah Kosong
        $query_lt3vipk = DB::select($lt3vipk);
        $query_lt3kl1k = DB::select($lt3kl1k);
        $query_lt3kl2k = DB::select($lt3kl2k);
        $query_lt3kl3k = DB::select($lt3kl3k);

        $query_lt4vipk = DB::select($lt4vipk);
        $query_lt4kl1k = DB::select($lt4kl1k);
        $query_lt4kl2k = DB::select($lt4kl2k);
        $query_lt4kl3k = DB::select($lt4kl3k);

        $query_kebvipk = DB::select($kebvipk);
        $query_kebkl1k = DB::select($kebkl1k);
        $query_kebkl2k = DB::select($kebkl2k);
        $query_kebkl3k = DB::select($kebkl3k);

        $query_icuk = DB::select($icuk);
        $query_isok = DB::select($isok);
        $query_perink = DB::select($perink);

        // Jumlah TOTAL Per Kelas
        $query_icutot = DB::select($toticu);
        $query_lt3tot = DB::select($totlt3);
        $query_lt4tot = DB::select($totlt4);
        $query_kebtot = DB::select($totkeb);
        $query_isotot = DB::select($totiso);
        $query_perintot = DB::select($totperin);

                // print_r($query_lt4tot);
                // die();

            $datakamar = [
            'lt3vipt' => $query_lt3vipt,
            'lt3kl1t' => $query_lt3kl1t,
            'lt3kl2t' => $query_lt3kl2t,
            'lt3kl3t' => $query_lt3kl3t,

            'lt4vipt' => $query_lt4vipt,
            'lt4kl1t' => $query_lt4kl1t,
            'lt4kl2t' => $query_lt4kl2t,
            'lt4kl3t' => $query_lt4kl3t,

            'kebvipt' => $query_kebvipt,
            'kebkl1t' => $query_kebkl1t,
            'kebkl2t' => $query_kebkl2t,
            'kebkl3t' => $query_kebkl3t,

            'icut' => $query_icut,
            'isot' => $query_isot,
            'perint' => $query_perint,

                'lt3vipk' => $query_lt3vipk,
                'lt3kl1k' => $query_lt3kl1k,
                'lt3kl2k' => $query_lt3kl2k,
                'lt3kl3k' => $query_lt3kl3k,

                'lt4vipk' => $query_lt4vipk,
                'lt4kl1k' => $query_lt4kl1k,
                'lt4kl2k' => $query_lt4kl2k,
                'lt4kl3k' => $query_lt4kl3k,

                'kebvipk' => $query_kebvipk,
                'kebkl1k' => $query_kebkl1k,
                'kebkl2k' => $query_kebkl2k,
                'kebkl3k' => $query_kebkl3k,

                'icuk' => $query_icuk,
                'isok' => $query_isok,
                'perink' => $query_perink,

            'toticu' => $query_icutot,
            'totlt3' => $query_lt3tot,
            'totlt4' => $query_lt4tot,
            'totkeb' => $query_kebtot,
            'totiso' => $query_isotot,
            'totperin' => $query_perintot,
            'now' => $now
            ];

            return response()->json($datakamar, 200);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

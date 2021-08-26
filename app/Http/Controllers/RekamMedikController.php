<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use \PDF;

class RekamMedikController extends Controller
{
    //
    public function index()
    {
        return view('page.rm.dashboard');
    }

    public function rekapUsia()
    {
        $kunjunganPasien = $this->kunjunganPasien();

        $showdata = [
            'kp' => $kunjunganPasien
        ];

        // print_r($showdata);
        // die();

        return view('page.rm.rekapusia')->with('list', $showdata);
    }

    public function kunjunganPasien()
    {
        // $tgl = substr(Carbon::now(),8,2);
        $bln1 = substr(Carbon::now(),5,2)-1+1;
        $bln2 = (substr(Carbon::now(),5,2))-1;
        $bln3 = (substr(Carbon::now(),5,2))-2;
        $thn = substr(Carbon::now(),0,4);
        $thnold = (substr(Carbon::now(),0,4))-1;

        $query_all = "SELECT * FROM DAT_PASIEN dt JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN ($bln1,$bln2,$bln3)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)";

        $query_total = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)";
                // ,4,5,6,7,8,9,10,11,12

        $query_1 = "SELECT rk.KELUMUR, COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
            --     AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
            --     AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
            --     AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_2 = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                -- AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                -- AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                -- AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_3 = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                -- AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                -- AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                -- AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_4 = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                -- AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                -- AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                -- AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_detail = "SELECT dt.DAT_PASIEN FROM DAT_PASIEN dt
        JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
        JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
        WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
        AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
        --     AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
        --     AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
        --     AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
        ";

        $queryku = DB::select($query_detail);

        $all = DB::select($query_all);
        $total = DB::select($query_total);
        $triwulan1 = DB::select($query_1);
        $triwulan2 = DB::select($query_2);
        $triwulan3 = DB::select($query_3);
        $triwulan4 = DB::select($query_4);

        //  print_r($queryku);
        //  die();

        $query_kunjungan =[
            'thn' => $thn,
            'thnold' => $thnold,
            'all' => $all,
            'total' => $total,
            'triwulan1' => $triwulan1,
            'triwulan2' => $triwulan2,
            'triwulan3' => $triwulan3,
            'triwulan4' => $triwulan4
        ];

        return $query_kunjungan;
    }

    public function kunjunganPasienOld()
    {
        // $tgl = substr(Carbon::now(),8,2);
        $bln1 = substr(Carbon::now(),5,2)-1+1;
        $bln2 = (substr(Carbon::now(),5,2))-1;
        $bln3 = (substr(Carbon::now(),5,2))-2;
        $thn = (substr(Carbon::now(),0,4))-1;

        $query_all = "SELECT * FROM DAT_PASIEN dt JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN ($bln1,$bln2,$bln3)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)";

        $query_total = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3,4,5,6,7,8,9,10,11,12)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)";

        $query_1 = "SELECT rk.KELUMUR, COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_2 = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_3 = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_4 = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $all = DB::select($query_all);
        $total = DB::select($query_total);
        $triwulan1 = DB::select($query_1);
        $triwulan2 = DB::select($query_2);
        $triwulan3 = DB::select($query_3);
        $triwulan4 = DB::select($query_4);

        // print_r($triwulan1);
        // die();

        $showdata =[
            'thn' => $thn,
            'all' => $all,
            'total' => $total,
            'triwulan1' => $triwulan1,
            'triwulan2' => $triwulan2,
            'triwulan3' => $triwulan3,
            'triwulan4' => $triwulan4
        ];

        return view('page.rm.rekapusiaold')->with('list', $showdata);
    }

    public function cetakRekapUsia()
    {
        $filename = 'Triwulan '.substr(Carbon::now(),0,4);
        $thn = substr(Carbon::now(),0,4);

        $kunjunganPasien = $this->kunjunganPasien();

        $data = [
            'kp' => $kunjunganPasien,
            'tahun' => $thn
        ];

        // print_r($yest2);
        // die();

        $pdf = PDF::loadView('page.rm.cetakRekapUsia', $data);
        // return $pdf->download();
        return $pdf->stream($filename);
    }

    public function cetakRekapUsiaold()
    {
        $filename = 'Triwulan '.((substr(Carbon::now(),0,4))-1);

        $bln1 = substr(Carbon::now(),5,2)-1+1;
        $bln2 = (substr(Carbon::now(),5,2))-1;
        $bln3 = (substr(Carbon::now(),5,2))-2;
        $thn = (substr(Carbon::now(),0,4))-1;

        $query_all = "SELECT * FROM DAT_PASIEN dt JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN ($bln1,$bln2,$bln3)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)";

        $query_total = "SELECT COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3,4,5,6,7,8,9,10,11,12)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)";

        $query_1 = "SELECT rk.KELUMUR, COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_2 = "SELECT rk.KELUMUR, COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_3 = "SELECT rk.KELUMUR, COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $query_4 = "SELECT rk.KELUMUR, COUNT(dt.DAT_PASIEN) as jumlah FROM DAT_PASIEN dt
            JOIN REG_KUNJUNGANPASIEN ta ON dt.DAT_PASIEN = ta.DAT_PASIEN
            JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
            WHERE left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
            GROUP BY rk.KELUMUR";

        $all = DB::select($query_all);
        $total = DB::select($query_total);
        $triwulan1 = DB::select($query_1);
        $triwulan2 = DB::select($query_2);
        $triwulan3 = DB::select($query_3);
        $triwulan4 = DB::select($query_4);

        // print_r($triwulan1);
        // die();

        $data =[
            'tahun' => $thn,
            'all' => $all,
            'total' => $total,
            'triwulan1' => $triwulan1,
            'triwulan2' => $triwulan2,
            'triwulan3' => $triwulan3,
            'triwulan4' => $triwulan4
        ];

        $pdf = PDF::loadView('page.rm.cetakRekapUsiaold', $data);
        // return $pdf->download();
        return $pdf->stream($filename);
    }

    public function rekapUsiaPoli(Request $request)
    {
        $poli= $request->query('poli');

        $thn = substr(Carbon::now(),0,4);
        // $filename = 'Rekap Jumlah Pasien Poli '.$poli.' Triwulan Tahun '.$thn;
        $thnold = (substr(Carbon::now(),0,4))-1;

        if($poli == 'Umum'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301' ,'0299')  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301' ,'0299')  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301' ,'0299')  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301' ,'0299')  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Anak'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0304'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0304'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0304'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0304'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Bedah'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0305'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0305'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0305'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0305'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Gigi'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN = '0310'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0310'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0310'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0310'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Dalam'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0303'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0303'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0303'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0303'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Ortopedi'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0319'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0319'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0319'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0319'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Jiwa'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0318'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0318'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0318'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0318'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Kulit'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0309'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0309'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0309'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0309'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'THT'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0306'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0306'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0306'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0306'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Paru'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0313'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0313'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0313'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0313'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        if($poli == 'Syaraf'){
            $query_1 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0312'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (1,2,3)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_2 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0312'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (4,5,6)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_3 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0312'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (7,8,9)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";

            $query_4 = "SELECT rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_PASIEN dt ON dt.DAT_PASIEN = ta.DAT_PASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                JOIN REF_KELUMUR rk ON ta.REF_KELUMUR = rk.REF_KELUMUR
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0312'  AND ta.BATAL = '0'
                AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) IN (10,11,12)
                    AND right(left(convert(varchar, dt.LAST_UPDATE, 112),6),2) = right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2)
                    AND right(convert(varchar, dt.LAST_UPDATE, 112),2) = right(convert(varchar, ta.TGL_DISCHARGE, 112),2)
                    AND left(convert(varchar, dt.LAST_UPDATE, 112),4) = left(convert(varchar, ta.TGL_DISCHARGE, 112),4)
                GROUP BY rk.KELUMUR, dt.DAT_PASIEN, dt.NAMAPASIEN, ta.UMUR, ta.TGL_DISCHARGE";
        }

        $querypoli1 = DB::select($query_1);
        $querypoli2 = DB::select($query_2);
        $querypoli3 = DB::select($query_3);
        $querypoli4 = DB::select($query_4);

        // print_r($querypoli1);
        // die();
        $data =[
            'poli' => $poli,
            'tahun' => $thn,
            'tahunold' => $thnold,
            'triwulan1' => $querypoli1,
            'triwulan2' => $querypoli2,
            'triwulan3' => $querypoli3,
            'triwulan4' => $querypoli4
        ];

        // $pdf = PDF::loadView('page.rm.rekapusiapoli', $data);
        // return $pdf->download();
        // return $pdf->stream($filename);
        return view('page.rm.rekapusiapoli')->with('list', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kunjungan;
use App\Models\pasien;
use App\Models\akomodasi;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use \PDF;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        header( "refresh:300;url=rekapharian" );
        // ini_set('memory_limit', '-1');
        $showdata = [];

        $kunjungan = $this->kunjungan();
        $akomodasi = $this->akomodasi();

        $showdata = [
            // 'idpasien' => $value['DAT_PASIEN'],
            'kunjungan' => $kunjungan,
            'akomodasi' => $akomodasi
        ];


        // print_r($showdata);
        // die();

        return view('page.direktur.rekap-harian')->with('list', $showdata);
    }

    public function apikunjungan()
    {
        $showdata = [];

        $kunjungan = $this->kunjungan();
        $akomodasi = $this->akomodasi();

        $showdata = [
            // 'idpasien' => $value['DAT_PASIEN'],
            'kunjungan' => $kunjungan,
            'akomodasi' => $akomodasi
        ];

        return response()->json($showdata, 200);
    }

    public function apirm($rm)
    {
        $data = DB::table('DAT_PASIEN')
        ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        ->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
        // ->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA')
        ->where('DAT_PASIEN.DAT_PASIEN', $rm)
        ->orderBy('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', 'DESC')
        ->first();
        
        if (!empty($data)) {
            $logic = 1;
        } else {
            $logic = 0;
        }
        

        $showdata = [
            // 'idpasien' => $value['DAT_PASIEN'],
            'data' => $data,
            'logic' => $logic
        ];

        return response()->json($showdata, 200);
    }

    public function apirmpoli($rm)
    {
        $data = DB::table('DAT_PASIEN')
        ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        ->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
        ->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA')
        ->where('DAT_PASIEN.DAT_PASIEN', $rm)
        ->orderBy('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', 'DESC')
        ->first();

        $poli = DB::table('DAT_PASIEN')
        ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        ->join('TRANS_AKOMODASI','REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN','=','TRANS_AKOMODASI.REG_KUNJUNGANPASIEN')
        ->join('REF_SUBINSTALASI','TRANS_AKOMODASI.REF_SUBINSTALASI_POLIKLINIK','=','REF_SUBINSTALASI.REF_SUBINSTALASI')
        ->whereIn('REF_SUBINSTALASI.REF_INSTALASI', ['02','03'])
        ->where('DAT_PASIEN.DAT_PASIEN', $rm)
        ->select('REF_SUBINSTALASI.SUBINSTALASI')
        ->groupBy('REF_SUBINSTALASI.SUBINSTALASI')
        // ->orderBy('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', 'DESC')
        ->get();

        $bayar = DB::table('DAT_PASIEN')
        ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        ->join('REF_CARABAYAR','REG_KUNJUNGANPASIEN.REF_CARABAYAR','=','REF_CARABAYAR.REF_CARABAYAR')
        ->join('TRANS_AKOMODASI','REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN','=','TRANS_AKOMODASI.REG_KUNJUNGANPASIEN')
        ->join('REF_SUBINSTALASI','TRANS_AKOMODASI.REF_SUBINSTALASI_POLIKLINIK','=','REF_SUBINSTALASI.REF_SUBINSTALASI')
        ->whereIn('REF_SUBINSTALASI.REF_INSTALASI', ['02','03'])
        ->where('DAT_PASIEN.DAT_PASIEN', $rm)
        ->select('REF_CARABAYAR.CARABAYAR')
        ->groupBy('REF_CARABAYAR.CARABAYAR')
        // ->orderBy('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', 'DESC')
        ->get();
        
        if (!empty($data)) {
            $logic = 1;
        } else {
            $logic = 0;
        }
        

        $showdata = [
            // 'idpasien' => $value['DAT_PASIEN'],
            'data' => $data,
            'poli' => $poli,
            'bayar' => $bayar,
            'logic' => $logic
        ];

        return response()->json($showdata, 200);
    }

    public function apiAll($rm)
    {
        // $showdata = [];

        // $getall = "SELECT dp.DAT_PASIEN as RM, dp.NAMAPASIEN, ta.UMUR, ak.REF_SUBINSTALASI_POLIKLINIK FROM DAT_PASIEN dp 
        // JOIN REG_KUNJUNGANPASIEN ta ON ta.DAT_PASIEN = dp.DAT_PASIEN
        // JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN = ta.REG_KUNJUNGANPASIEN
        // WHERE ta.UMUR = '50 TAHUN'";
        // $data = DB::select($getall);
        $data = DB::table('DAT_PASIEN')
        ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        ->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
        // ->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA') //Ref_Desa ada yg kosong!!
        ->join('REF_KODEWILAYAH','REF_KODEWILAYAH.REF_KODEWILAYAH','=','DAT_PASIEN.REF_KODEWILAYAH') //Ref_Desa ada yg kosong!!
        ->where('DAT_PASIEN.DAT_PASIEN', $rm)
        ->orderBy('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', 'DESC')
        ->first();
        // ->get();

        // print_r($data);
        // die();

        return response()->json($data, 200);
    }

    public function apiCariRM($rm)
    {
        $dat_pasien = substr(strval($rm),0,8);
        $show = DB::table('DAT_PASIEN')
                ->join('REG_KUNJUNGANPASIEN','REG_KUNJUNGANPASIEN.DAT_PASIEN','=','DAT_PASIEN.DAT_PASIEN')
                // ->join('TRANS_AKOMODASI','REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN','=','TRANS_AKOMODASI.REG_KUNJUNGANPASIEN')
                ->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
                ->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA')
                ->where('DAT_PASIEN.DAT_PASIEN', $dat_pasien)
                ->select('DAT_PASIEN.DAT_PASIEN','DAT_PASIEN.NAMAPASIEN','REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN','REG_KUNJUNGANPASIEN.UMUR','REF_JNSKELAMIN.JNSKELAMIN','REG_KUNJUNGANPASIEN.TGL_REGISTRASI','REG_KUNJUNGANPASIEN.TGL_DISCHARGE')
                ->orderBy('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', 'DESC')
                ->get();

        if ($show == '') {
            $title = 'Mohon Maaf!!';
            $icon = 'error';
            $msg = 'Data RM '.$dat_pasien.' Tidak Ditemukan';
        }else {
            $title = 'Yeayyyy!!!';
            $icon = 'success';
            $msg = 'Pasien ditemukan : '.$show[0]->NAMAPASIEN;
        }

        $data = [
            'show' => $show,
            'title' => $title,
            'icon' => $icon,
            'msg' => $msg
        ];

        return response()->json($data, 200);
    }
    
    public function apiBatalPeriksa($rm)
    {
        $dat_pasien = substr(strval($rm),0,8);
        $reg_kunjunganpasien = substr(strval($rm),0,12);
        // print_r($reg_kunjunganpasien);
        // die();
        $get_data = DB::table('DAT_PASIEN')
            ->join('REG_KUNJUNGANPASIEN','REG_KUNJUNGANPASIEN.DAT_PASIEN','=','DAT_PASIEN.DAT_PASIEN')
            ->where('REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN', $reg_kunjunganpasien)
            ->get();

        // GET TOTAL ARRAY TRANS_JNSPELAYANAN
        $getJP = DB::table('TRANS_JNSPELAYANAN')
            ->select('TRANS_JNSPELAYANAN.TRANS_JNSPELAYANAN as kode')
            ->join('TRANS_AKOMODASI','TRANS_JNSPELAYANAN.TRANS_AKOMODASI','=','TRANS_AKOMODASI.TRANS_AKOMODASI')
            ->where('TRANS_AKOMODASI.REG_KUNJUNGANPASIEN', $reg_kunjunganpasien)
            ->groupBy('TRANS_JNSPELAYANAN.TRANS_JNSPELAYANAN')
            ->get();

        // GET TOTAL ARRAY TRANS_AKOMODASI
        $getTA = DB::table('TRANS_AKOMODASI')
            ->select('TRANS_AKOMODASI as kode', 'TGLKELUAR as pulang')
            ->where('REG_KUNJUNGANPASIEN', $reg_kunjunganpasien)
            ->groupBy('TRANS_AKOMODASI','TGLKELUAR')
            ->get();

        // Verify Pasien Sudah Dipulangkan Belum [TRANS_AKOMODASI]    
        foreach ($getTA as $key => $value) {
            if ($value->pulang == null) {
                // $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');
                // DB::table('TRANS_AKOMODASI')->where('TRANS_AKOMODASI', $value->kode)->update(array('TGLKELUAR' => $now));
                
                $title = 'Mohon Maaf!!!';
                $icon = 'error';
                $msg = 'Kunjungan Kode '.$reg_kunjunganpasien.' belum dipulangkan.';
        
                $data = [
                    'dat_pasien' => $dat_pasien,
                    'reg_kunjunganpasien' => $reg_kunjunganpasien,
                    'title' => $title,
                    'icon' => $icon,
                    'msg' => $msg
                ];
        
                return response()->json($data, 200);
            }
        }
        
        DB::table('DAT_ASSEMBLING')->where('REG_KUNJUNGANPASIEN', $reg_kunjunganpasien)->delete();
        DB::table('DAT_DIGITALRM')->where('REG_KUNJUNGANPASIEN', $reg_kunjunganpasien)->delete();
        // DB::table('TRANS_JNSPELAYANAN')->where('TRANS_AKOMODASI', $rm)->delete();
        foreach ($getJP as $key => $value) {
            DB::table('DETAIL_TRANSOBATALKES')->where('TRANS_JNSPELAYANAN', $value->kode)->delete();
            DB::table('TRANS_JNSPELAYANAN')->where('TRANS_JNSPELAYANAN', $value->kode)->delete();
        }
        // DB::table('TRANS_AKOMODASI')->where('REG_KUNJUNGANPASIEN', $reg_kunjunganpasien)->delete();
        foreach ($getTA as $key => $value) {
            // Add Tgl in TRANS_AKOMODASI->TGLKELUAR
            // if ($value->pulang == null) {
            //     $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');
            // }
            DB::table('DAT_PASIENBOOK')->where('TRANS_AKOMODASI_CHECKIN', $value->kode)->delete();
            DB::table('TRANS_DIETMAKAN')->where('TRANS_AKOMODASI', $value->kode)->delete();
            DB::table('TRANS_PEMBAYARANPASIEN')->where('TRANS_AKOMODASI', $value->kode)->delete();
            DB::table('TRANS_AKOMODASI')->where('TRANS_AKOMODASI', $value->kode)->delete();
        }
        DB::table('REG_KUNJUNGANPASIEN')->where('REG_KUNJUNGANPASIEN', $reg_kunjunganpasien)->delete();

        //$data = pasien::
        //->join('DAT_ASSEMBLING','DAT_ASSEMBLING.REG_KUNJUNGANPASIEN','=','REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN')
        //->join('DAT_DIGITALRM','DAT_ASSEMBLING.REG_KUNJUNGANPASIEN','=','DAT_DIGITALRM.REG_KUNJUNGANPASIEN')
        //->join('REG_KUNJUNGANPASIEN','DAT_ASSEMBLING.REG_KUNJUNGANPASIEN','=','REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN')
        //->join('TRANS_AKOMODASI','REG_KUNJUNGANPASIEN.REG_KUNJUNGANPASIEN','=','TRANS_AKOMODASI.REG_KUNJUNGANPASIEN')
        //->join('TRANS_JNSPELAYANAN','TRANS_AKOMODASI.TRANS_AKOMODASI','=','TRANS_JNSPELAYANAN.TRANS_AKOMODASI')
        //->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
        //->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA')
        //->where('DAT_ASSEMBLING.REG_KUNJUNGANPASIEN', $rm)
        //->get();

        //->delete();

        $title = 'Yeayyyy!!!';
        $icon = 'success';
        $msg = 'Berhasil Menghapus '.$reg_kunjunganpasien.'.';

        $data = [
            'show' => $get_data,
            'dat_pasien' => $dat_pasien,
            'reg_kunjunganpasien' => $reg_kunjunganpasien,
            'title' => $title,
            'icon' => $icon,
            'msg' => $msg
        ];
        // print_r($data);
        // die();

        return response()->json($data, 200);
    }

    public function kunjungan()
    {
        # code...
        // DATE CARBON : 2020-01-28 00:00:00.000000
        $yest = substr(Carbon::yesterday(),0,10);
        // TGL : Dec 19, 2015 (FORMATED DATE STRING)
        $tgl = substr(Carbon::yesterday(),8,2);
        $bln = substr(Carbon::yesterday(),5,2);
        $thn = substr(Carbon::yesterday(),0,4);

        $igd = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301' ,'0299')  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $anak = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0304'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $bedah = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0305'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $gigi = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0310'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $dalam = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0303'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $orto = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0319'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $jiwa = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0318'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $kulit = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0309'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $tht = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0306'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $rehab ="SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0394'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $keb = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0302'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $mata = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0308'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $paru = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0313'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $syaraf = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0312'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";

        $inap = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
                    WHERE ak.REF_CARAMASUK = '3' AND ta.BATAL = '0' AND ak.TERAKHIR = '1'
                    AND right(left(convert(varchar, ak.TGLKELUAR, 112),6),2) = $bln AND right(convert(varchar, ak.TGLKELUAR, 112),2) = $tgl AND left(convert(varchar, ak.TGLKELUAR, 112),4) = $thn";

        $tot = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301','0299','0304','0305','0310','0303','0319','0318','0309','0306','0394','0302','0312','0313')  AND ta.BATAL = '0'
                AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";

        $lab = "SELECT tj.TRANS_AKOMODASI, COUNT(tj.TGLTRANS_JNSPELAYANAN) as jumlah FROM TRANS_JNSPELAYANAN tj
                FULL JOIN DAT_JNSPELAYANAN dj ON tj.DAT_JNSPELAYANAN = dj.DAT_JNSPELAYANAN
                FULL JOIN REF_KTGPELAYANAN rk ON dj.REF_KTGPELAYANAN = rk.REF_KTGPELAYANAN
                FULL JOIN REF_SUBINSTALASI rs ON rk.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
                FULL JOIN REF_INSTALASI ri ON rs.REF_INSTALASI = ri.REF_INSTALASI
                WHERE rs.REF_INSTALASI = '06'
                AND right(left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),6),2) = $bln AND right(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),2) = $tgl AND left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),4) = $thn
                GROUP BY tj.TRANS_AKOMODASI, tj.TGLTRANS_JNSPELAYANAN";
        $rad = "SELECT tj.TRANS_AKOMODASI, COUNT(tj.TGLTRANS_JNSPELAYANAN) as jumlah FROM TRANS_JNSPELAYANAN tj
                FULL JOIN DAT_JNSPELAYANAN dj ON tj.DAT_JNSPELAYANAN = dj.DAT_JNSPELAYANAN
                FULL JOIN REF_KTGPELAYANAN rk ON dj.REF_KTGPELAYANAN = rk.REF_KTGPELAYANAN
                FULL JOIN REF_SUBINSTALASI rs ON rk.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
                FULL JOIN REF_INSTALASI ri ON rs.REF_INSTALASI = ri.REF_INSTALASI
                WHERE rs.REF_INSTALASI = '07'
                AND right(left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),6),2) = $bln AND right(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),2) = $tgl AND left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),4) = $thn
                GROUP BY tj.TRANS_AKOMODASI, tj.TGLTRANS_JNSPELAYANAN";

        // PASIEN PULANG
        $bayarumum = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_ASSEMBLING asm ON ta.REG_KUNJUNGANPASIEN = asm.REG_KUNJUNGANPASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_CARAMASUK = '3' AND ta.TGL_DISCHARGE is not null AND ta.REF_CARABAYAR = '01' AND ta.BATAL = '0' AND ak.TERAKHIR = '1'
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $bayarbpjs = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_ASSEMBLING asm ON ta.REG_KUNJUNGANPASIEN = asm.REG_KUNJUNGANPASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_CARAMASUK = '3' AND ta.TGL_DISCHARGE is not null AND ta.REF_CARABAYAR IN ('02','03') AND ak.TERAKHIR = '1'
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";

        $query_igd = DB::select($igd);
        $query_anak = DB::select($anak);
        $query_bedah = DB::select($bedah);
        $query_gigi = DB::select($gigi);
        $query_dalam = DB::select($dalam);
        $query_orto = DB::select($orto);
        $query_jiwa = DB::select($jiwa);
        $query_kulit = DB::select($kulit);
        $query_tht = DB::select($tht);
        $query_rehab = DB::select($rehab);
        $query_keb = DB::select($keb);
        $query_mata = DB::select($mata);
        $query_paru = DB::select($paru);
        $query_syaraf = DB::select($syaraf);
        $query_inap = DB::select($inap);
        $query_lab = DB::select($lab);
        $query_rad = DB::select($rad);
        $query_total = DB::select($tot);
        $query_umum = DB::select($bayarumum);
        $query_bpjs = DB::select($bayarbpjs);

        // print_r($query_bpjs);
        // die();

        $query_kunjungan =[
            'igd' => $query_igd,
            'anak' => $query_anak,
            'bedah' => $query_bedah,
            'gigi' => $query_gigi,
            'dalam' => $query_dalam,
            'orto' => $query_orto,
            'jiwa' => $query_jiwa,
            'kulit' => $query_kulit,
            'tht' => $query_tht,
            'rehab' => $query_rehab,
            'keb' => $query_keb,
            'mata' => $query_mata,
            'paru' => $query_paru,
            'syaraf' => $query_syaraf,
            'inap' => $query_inap,
            'lab' => $query_lab,
            'rad' => $query_rad,
            'total' => $query_total,
            'umum' => $query_umum,
            'bpjs' => $query_bpjs,
            'yest' => $yest
        ];

        return $query_kunjungan;
    }

    public function akomodasi()
    {
        # code...
        $now = Carbon::now();
        // TGL : Dec 19, 2015 (FORMATED DATE STRING)
        $tgl = substr(Carbon::now(),8,2);
        $bln = substr(Carbon::now(),5,2);
        $thn = substr(Carbon::now(),0,4);

        $lt3 = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0401' AND ak.REF_CARAMASUK = '3' AND ak.TGLKELUAR is null";
        $lt4 = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0402' AND ak.REF_CARAMASUK = '3' AND ak.TGLKELUAR is null";
        $keb = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0403' AND ak.REF_CARAMASUK = '3' AND ak.TGLKELUAR is null AND ta.REF_KELUMUR <> '1'";
        $per = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0406' AND ak.REF_CARAMASUK = '3' AND ak.TGLKELUAR is null";
        $iso = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0405' AND ak.REF_CARAMASUK = '3' AND ak.TGLKELUAR is null";
        $icu = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0400' AND ak.REF_CARAMASUK = '3' AND ak.TGLKELUAR is null";

        $tot = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0400','0401','0402','0403','0405','0406') AND ak.REF_CARAMASUK = '3' AND ak.TGLKELUAR is null";

        $query_lt3 = DB::select($lt3);
        $query_lt4 = DB::select($lt4);
        $query_keb = DB::select($keb);
        $query_per = DB::select($per);
        $query_iso = DB::select($iso);
        $query_icu = DB::select($icu);
        $query_total = DB::select($tot);

        // print_r($query_per);
        // die();

        $query_akomodasi =[
            'lt3' => $query_lt3,
            'lt4' => $query_lt4,
            'keb' => $query_keb,
            'per' => $query_per,
            'iso' => $query_iso,
            'icu' => $query_icu,
            'total' => $query_total,
            'now' => $now
        ];

        return $query_akomodasi;
    }

    public function filterKunjungan(Request $request)
    {
        # code...
        $tgl= $request->query('tanggal');
        $bln = $request->query('bulan');
        $thn = $request->query('tahun');
        $now= $tgl.'-'.$bln.'-'.$thn;

        $igd = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301' ,'0299')  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $anak = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0304'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $bedah = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0305'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $gigi = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0310'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $dalam = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0303'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $orto = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0319'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $jiwa = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0318'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $kulit = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0309'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $tht = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0306'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $rehab ="SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0394'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $keb = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0302'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $mata = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0308'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $paru = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0313'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $syaraf = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0312'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";

        $inap = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
                    WHERE ak.REF_CARAMASUK = '3' AND ta.BATAL = '0' AND ak.TERAKHIR = '1'
                    AND right(left(convert(varchar, ak.TGLKELUAR, 112),6),2) = $bln AND right(convert(varchar, ak.TGLKELUAR, 112),2) = $tgl AND left(convert(varchar, ak.TGLKELUAR, 112),4) = $thn";

        $tot = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301','0299','0304','0305','0310','0303','0319','0318','0309','0306','0394','0302','0312','0313')  AND ta.BATAL = '0'
                AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";

        $lab = "SELECT tj.TRANS_AKOMODASI, COUNT(tj.TGLTRANS_JNSPELAYANAN) as jumlah FROM TRANS_JNSPELAYANAN tj
                FULL JOIN DAT_JNSPELAYANAN dj ON tj.DAT_JNSPELAYANAN = dj.DAT_JNSPELAYANAN
                FULL JOIN REF_KTGPELAYANAN rk ON dj.REF_KTGPELAYANAN = rk.REF_KTGPELAYANAN
                FULL JOIN REF_SUBINSTALASI rs ON rk.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
                FULL JOIN REF_INSTALASI ri ON rs.REF_INSTALASI = ri.REF_INSTALASI
                WHERE rs.REF_INSTALASI = '06'
                AND right(left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),6),2) = $bln AND right(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),2) = $tgl AND left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),4) = $thn
                GROUP BY tj.TRANS_AKOMODASI, tj.TGLTRANS_JNSPELAYANAN";
        $rad = "SELECT tj.TRANS_AKOMODASI, COUNT(tj.TGLTRANS_JNSPELAYANAN) as jumlah FROM TRANS_JNSPELAYANAN tj
                FULL JOIN DAT_JNSPELAYANAN dj ON tj.DAT_JNSPELAYANAN = dj.DAT_JNSPELAYANAN
                FULL JOIN REF_KTGPELAYANAN rk ON dj.REF_KTGPELAYANAN = rk.REF_KTGPELAYANAN
                FULL JOIN REF_SUBINSTALASI rs ON rk.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
                FULL JOIN REF_INSTALASI ri ON rs.REF_INSTALASI = ri.REF_INSTALASI
                WHERE rs.REF_INSTALASI = '07'
                AND right(left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),6),2) = $bln AND right(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),2) = $tgl AND left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),4) = $thn
                GROUP BY tj.TRANS_AKOMODASI, tj.TGLTRANS_JNSPELAYANAN";

        // PASIEN PULANG
        $bayarumum = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_ASSEMBLING asm ON ta.REG_KUNJUNGANPASIEN = asm.REG_KUNJUNGANPASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_CARAMASUK = '3' AND asm.TGL_PULANG is not null AND ta.REF_CARABAYAR = '01' AND ta.BATAL = '0' AND ak.TERAKHIR = '1'
                AND right(left(convert(varchar, asm.TGL_PULANG, 112),6),2) = $bln AND right(convert(varchar, asm.TGL_PULANG, 112),2) = $tgl AND left(convert(varchar, asm.TGL_PULANG, 112),4) = $thn";
        $bayarbpjs = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_ASSEMBLING asm ON ta.REG_KUNJUNGANPASIEN = asm.REG_KUNJUNGANPASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_CARAMASUK = '3' AND asm.TGL_PULANG is not null AND ta.REF_CARABAYAR IN ('02','03') AND ak.TERAKHIR = '1'
                AND right(left(convert(varchar, asm.TGL_PULANG, 112),6),2) = $bln AND right(convert(varchar, asm.TGL_PULANG, 112),2) = $tgl AND left(convert(varchar, asm.TGL_PULANG, 112),4) = $thn";

        $query_igd = DB::select($igd);
        $query_anak = DB::select($anak);
        $query_bedah = DB::select($bedah);
        $query_gigi = DB::select($gigi);
        $query_dalam = DB::select($dalam);
        $query_orto = DB::select($orto);
        $query_jiwa = DB::select($jiwa);
        $query_kulit = DB::select($kulit);
        $query_tht = DB::select($tht);
        $query_rehab = DB::select($rehab);
        $query_keb = DB::select($keb);
        $query_mata = DB::select($mata);
        $query_paru = DB::select($paru);
        $query_syaraf = DB::select($syaraf);
        $query_inap = DB::select($inap);
        $query_lab = DB::select($lab);
        $query_rad = DB::select($rad);
        $query_total = DB::select($tot);
        $query_umum = DB::select($bayarumum);
        $query_bpjs = DB::select($bayarbpjs);

        $query_kunjungan =[
            'igd' => $query_igd,
            'anak' => $query_anak,
            'bedah' => $query_bedah,
            'gigi' => $query_gigi,
            'dalam' => $query_dalam,
            'orto' => $query_orto,
            'jiwa' => $query_jiwa,
            'kulit' => $query_kulit,
            'tht' => $query_tht,
            'rehab' => $query_rehab,
            'keb' => $query_keb,
            'mata' => $query_mata,
            'paru' => $query_paru,
            'syaraf' => $query_syaraf,
            'inap' => $query_inap,
            'lab' => $query_lab,
            'rad' => $query_rad,
            'total' => $query_total,
            'umum' => $query_umum,
            'bpjs' => $query_bpjs,
            'now' => $now
            ];

            // print_r($now);
            // die();
        return view('page.direktur.rekap-harian-cari')->with('list', $query_kunjungan);
    }

    public function generatePDF()
    {
        # code...
        $now = Carbon::now();
        $yest = substr(Carbon::yesterday(),0,10);
        $filename = substr(Carbon::now(),0,10);

        $kunjungan = $this->kunjungan();
        $akomodasi = $this->akomodasi();

        $data = [
            'title' => $now,
            'now' => $now,
            'yest' => $yest,
            'kunjungan' => $kunjungan,
            'akomodasi' => $akomodasi
        ];

        // print_r($yest2);
        // die();

        $pdf = PDF::loadView('page.direktur.cetak', $data);
        // return $pdf->download();
        return $pdf->stream($filename);
    }

    public function generatePDFold(Request $request)
    {
        # code...
        $tgl= $request->query('tanggal');
        $bln = $request->query('bulan');
        $thn = $request->query('tahun');
        $yest= $tgl.'-'.$bln.'-'.$thn;

        $igd = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301' ,'0299')  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $anak = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0304'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $bedah = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0305'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $gigi = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0310'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $dalam = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0303'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $orto = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0319'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $jiwa = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0318'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $kulit = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0309'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $tht = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0306'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $rehab ="SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0394'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $keb = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0302'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $mata = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0308'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $paru = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0313'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";
        $syaraf = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
            WHERE ak.REF_SUBINSTALASI_POLIKLINIK = '0312'  AND ta.BATAL = '0'
            AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
            AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";

        $inap = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta JOIN TRANS_AKOMODASI ak ON ak.REG_KUNJUNGANPASIEN =  ta.REG_KUNJUNGANPASIEN
                    WHERE ak.REF_CARAMASUK = '3' AND ta.BATAL = '0' AND ak.TERAKHIR = '1'
                    AND right(left(convert(varchar, ak.TGLKELUAR, 112),6),2) = $bln AND right(convert(varchar, ak.TGLKELUAR, 112),2) = $tgl AND left(convert(varchar, ak.TGLKELUAR, 112),4) = $thn";

        $tot = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM TRANS_AKOMODASI ak JOIN REG_KUNJUNGANPASIEN ta ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_SUBINSTALASI_POLIKLINIK IN ('0301','0299','0304','0305','0310','0303','0319','0318','0309','0306','0394','0302','0312','0313')  AND ta.BATAL = '0'
                AND right(left(convert(varchar, ta.TGL_REGISTRASI, 112),6),2) = right(left(convert(varchar, ak.TGLMASUK, 112),6),2) AND right(convert(varchar, ta.TGL_REGISTRASI, 112),2) = right(convert(varchar, ak.TGLMASUK, 112),2) AND left(convert(varchar, ta.TGL_REGISTRASI, 112),4) = left(convert(varchar, ak.TGLMASUK, 112),4)
                AND right(left(convert(varchar, ta.TGL_DISCHARGE, 112),6),2) = $bln AND right(convert(varchar, ta.TGL_DISCHARGE, 112),2) = $tgl AND left(convert(varchar, ta.TGL_DISCHARGE, 112),4) = $thn";

        $lab = "SELECT tj.TRANS_AKOMODASI, COUNT(tj.TGLTRANS_JNSPELAYANAN) as jumlah FROM TRANS_JNSPELAYANAN tj
                FULL JOIN DAT_JNSPELAYANAN dj ON tj.DAT_JNSPELAYANAN = dj.DAT_JNSPELAYANAN
                FULL JOIN REF_KTGPELAYANAN rk ON dj.REF_KTGPELAYANAN = rk.REF_KTGPELAYANAN
                FULL JOIN REF_SUBINSTALASI rs ON rk.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
                FULL JOIN REF_INSTALASI ri ON rs.REF_INSTALASI = ri.REF_INSTALASI
                WHERE rs.REF_INSTALASI = '06'
                AND right(left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),6),2) = $bln AND right(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),2) = $tgl AND left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),4) = $thn
                GROUP BY tj.TRANS_AKOMODASI, tj.TGLTRANS_JNSPELAYANAN";
        $rad = "SELECT tj.TRANS_AKOMODASI, COUNT(tj.TGLTRANS_JNSPELAYANAN) as jumlah FROM TRANS_JNSPELAYANAN tj
                FULL JOIN DAT_JNSPELAYANAN dj ON tj.DAT_JNSPELAYANAN = dj.DAT_JNSPELAYANAN
                FULL JOIN REF_KTGPELAYANAN rk ON dj.REF_KTGPELAYANAN = rk.REF_KTGPELAYANAN
                FULL JOIN REF_SUBINSTALASI rs ON rk.REF_SUBINSTALASI = rs.REF_SUBINSTALASI
                FULL JOIN REF_INSTALASI ri ON rs.REF_INSTALASI = ri.REF_INSTALASI
                WHERE rs.REF_INSTALASI = '07'
                AND right(left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),6),2) = $bln AND right(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),2) = $tgl AND left(convert(varchar, tj.TGLTRANS_JNSPELAYANAN, 112),4) = $thn
                GROUP BY tj.TRANS_AKOMODASI, tj.TGLTRANS_JNSPELAYANAN";

        // PASIEN PULANG
        $bayarumum = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_ASSEMBLING asm ON ta.REG_KUNJUNGANPASIEN = asm.REG_KUNJUNGANPASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_CARAMASUK = '3' AND asm.TGL_PULANG is not null AND ta.REF_CARABAYAR = '01' AND ta.BATAL = '0' AND ak.TERAKHIR = '1'
                AND right(left(convert(varchar, asm.TGL_PULANG, 112),6),2) = $bln AND right(convert(varchar, asm.TGL_PULANG, 112),2) = $tgl AND left(convert(varchar, asm.TGL_PULANG, 112),4) = $thn";
        $bayarbpjs = "SELECT COUNT(ta.REG_KUNJUNGANPASIEN) as jumlah FROM REG_KUNJUNGANPASIEN ta
                JOIN DAT_ASSEMBLING asm ON ta.REG_KUNJUNGANPASIEN = asm.REG_KUNJUNGANPASIEN
                JOIN TRANS_AKOMODASI ak ON ta.REG_KUNJUNGANPASIEN = ak.REG_KUNJUNGANPASIEN
                WHERE ak.REF_CARAMASUK = '3' AND asm.TGL_PULANG is not null AND ta.REF_CARABAYAR IN ('02','03') AND ak.TERAKHIR = '1'
                AND right(left(convert(varchar, asm.TGL_PULANG, 112),6),2) = $bln AND right(convert(varchar, asm.TGL_PULANG, 112),2) = $tgl AND left(convert(varchar, asm.TGL_PULANG, 112),4) = $thn";

        $query_igd = DB::select($igd);
        $query_anak = DB::select($anak);
        $query_bedah = DB::select($bedah);
        $query_gigi = DB::select($gigi);
        $query_dalam = DB::select($dalam);
        $query_orto = DB::select($orto);
        $query_jiwa = DB::select($jiwa);
        $query_kulit = DB::select($kulit);
        $query_tht = DB::select($tht);
        $query_rehab = DB::select($rehab);
        $query_keb = DB::select($keb);
        $query_mata = DB::select($mata);
        $query_paru = DB::select($paru);
        $query_syaraf = DB::select($syaraf);
        $query_inap = DB::select($inap);
        $query_lab = DB::select($lab);
        $query_rad = DB::select($rad);
        $query_total = DB::select($tot);
        $query_umum = DB::select($bayarumum);
        $query_bpjs = DB::select($bayarbpjs);

        $data =[
            'igd' => $query_igd,
            'anak' => $query_anak,
            'bedah' => $query_bedah,
            'gigi' => $query_gigi,
            'dalam' => $query_dalam,
            'orto' => $query_orto,
            'jiwa' => $query_jiwa,
            'kulit' => $query_kulit,
            'tht' => $query_tht,
            'rehab' => $query_rehab,
            'keb' => $query_keb,
            'mata' => $query_mata,
            'paru' => $query_paru,
            'syaraf' => $query_syaraf,
            'inap' => $query_inap,
            'lab' => $query_lab,
            'rad' => $query_rad,
            'total' => $query_total,
            'umum' => $query_umum,
            'bpjs' => $query_bpjs,
            'yest' => $yest
            ];

        // print_r($data);
        // die();

        $pdf = PDF::loadView('page.direktur.cetakold', $data);
        // return $pdf->download();
        return $pdf->stream($yest);
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

    public function apiAntrol()
    {
        $from = Carbon::now()->subDays(30)->isoFormat('YYYY-MM-DD');
        $to = Carbon::now()->isoFormat('YYYY-MM-DD');
        $tomorow = Carbon::now()->addDays(1)->isoFormat('YYYY-MM-DD');
        $data = DB::table('DAT_PASIENBOOK')
        // ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        // ->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
        // ->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA')
        ->where('TASKID_99', null)
        ->whereNotNull('TASKID_01')
        ->whereNotNull('TASKID_02')
        ->whereNotNull('TASKID_03')
        // ->whereNotNull('TASKID_06')
        ->whereBetween('TGL_KUNJUNGAN',[$to,$tomorow])
        ->orderBy('TGL_CHECKIN', 'DESC')
        ->get();

        return response()->json($data, 200);
    }

    public function apiDisplayAntrol()
    {
        $from = Carbon::now()->subDays(30)->isoFormat('YYYY-MM-DD');
        $to = Carbon::now()->isoFormat('YYYY-MM-DD');
        $tomorow = Carbon::now()->addDays(1)->isoFormat('YYYY-MM-DD');
        $data = DB::table('DAT_PASIENBOOK')
        // ->join('REG_KUNJUNGANPASIEN','DAT_PASIEN.DAT_PASIEN','=','REG_KUNJUNGANPASIEN.DAT_PASIEN')
        // ->join('REF_JNSKELAMIN','REF_JNSKELAMIN.REF_JNSKELAMIN','=','DAT_PASIEN.REF_JNSKELAMIN')
        // ->join('REF_DESA','REF_DESA.REF_DESA','=','DAT_PASIEN.REF_DESA')
        ->select('DAT_PASIENBOOK','DAT_PASIEN','NAMAPASIEN','ALAMAT','TGL_CHECKIN','TASKID_04','TASKID_05','TASKID_06','TASKID_07')
        ->where('TASKID_99', null)
        ->whereNotNull('TASKID_01')
        ->whereNotNull('TASKID_02')
        ->whereNotNull('TASKID_03')
        ->whereNotNull('TASKID_06')
        // ->where('TASKID_07', null)
        ->whereBetween('TGL_KUNJUNGAN',[$to,$tomorow])
        ->orderBy('TASKID_04', 'ASC')
        ->limit(20)
        ->get();

        return response()->json($data, 200);
    }

    public function apiJadwalDokter()
    {
        // 03900103
        $data = DB::table('SET_JAGAKLINIK')
        ->join('DAT_KARYAWAN','SET_JAGAKLINIK.DAT_KARYAWAN','=','DAT_KARYAWAN.DAT_KARYAWAN')
        ->join('REF_SUBINSTALASI','SET_JAGAKLINIK.REF_SUBINSTALASI','=','REF_SUBINSTALASI.REF_SUBINSTALASI')
        ->select('DAT_KARYAWAN.NAMA','REF_SUBINSTALASI.SUBINSTALASI','REF_SUBINSTALASI.REF_POLIBPJS','SET_JAGAKLINIK.*')
        ->whereIn('SET_JAGAKLINIK.DAT_JNSPELAYANAN', ['03900103','03900108'])
        ->where('SET_JAGAKLINIK.JAGA', '1')
        ->where('SET_JAGAKLINIK.REF_SUBINSTALASI', '<>', '0396')
        ->orderBy('SET_JAGAKLINIK.REF_SUBINSTALASI', 'ASC')
        // ->limit(20)
        ->get();
        
        return response()->json($data, 200);
    }
}

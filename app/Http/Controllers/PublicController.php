<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index (){
        return view('public.index');
    }

    public function buatPermohonan (){
        $jenisPerizinanOptions = DB::table('surat_jenis')
        ->get();
        return view('public.buat-permohonan',compact('jenisPerizinanOptions'));
    }

    public function getDataByJenis(Request $request)
    {
        $jenisPerizinan = $request->input('jenis_perizinan');
        $dataPerizinan = DB::table('surat_syarat')->where('surat_jenis_id', $jenisPerizinan)->get();
    
        return response()->json($dataPerizinan);
    }

    public function ajukanPerizinan(){
        return view('public.perizinan.form-pengajuan-perizinan');
    }

    public function ajukanSyaratPerizinan(){
        return view('public.perizinan.form-pengajuan-syarat');
    }

    public function success(){
        return view('public.perizinan.success');
    }

    public function permohonanSaya(){
        return view('public.perizinan.list-perizinan');
    }

    public function lacakPerizinan(){
        return view('public.lacak-perizinan.form-lacak');
    }

    public function detailPerizinan(){
        return view('public.lacak-perizinan.detail');
    }
    
}

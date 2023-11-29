<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index (){
        return view('public.index');
    }

    public function buatPermohonan (){
        return view('public.buat-permohonan');
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

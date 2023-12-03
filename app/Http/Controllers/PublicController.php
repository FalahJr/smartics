<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function ajukanPerizinan(Request $request){
        $perizinan = DB::table('surat_jenis')->find($request->jenis);
        return view('public.perizinan.form-pengajuan-perizinan',compact('perizinan'));
    }

    public function ajukanSyaratPerizinan(){
        return view('public.perizinan.form-pengajuan-syarat');
    }

    public function createPerizinan(Request $req){
        $tgl = Carbon::now('Asia/Jakarta');

        $surat = DB::table('surat')->insertGetId([
            'user_id' => Auth::user()->id,
            'surat_jenis_id' => $req['surat_jenis_id'],
            'nama' => $req['nama'],
            'kategori' => $req['kategori'],
            'alamat_lokasi' => $req['alamat_lokasi'],
            'longitude' => $req['longitude'],
            'latitude' => $req['latitude'],
            "created_at" => $tgl,
            "updated_at" => $tgl
        ]);

        $surat = DB::table('surat')->where('id', $surat)->first();

        $syarat = DB::table('surat_syarat')->where('surat_jenis_id', $req['surat_jenis_id'])->get();
        $path = public_path('uploads/dokumen-syarat-pemohon');
        $i = 1;
        foreach ($syarat as $syaratId) {
            
            $file = $req->file('syarat'.$i);
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $imgPath = 'uploads/dokumen-syarat-pemohon/' . $name;

            DB::table('surat_dokumen')->insert([
                'surat_id' => $surat->id,
                'surat_syarat_id' => $syaratId->id,
                'dokumen_upload' => $imgPath,
                "created_at" => $tgl,
                "updated_at" => $tgl
            ]);   

            $i++;
        }

        return response()->json(['suratId' => $surat->id]);
    }

    public function cetakRegisPdf(Request $req)
    {
        $data = DB::table('surat')->where('id',$req->dataId)->first();
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $namaPerizinan=DB::table('surat_jenis')->where('id',$data->surat_jenis_id)->first()->nama;
        $pdf = \PDF::loadView('public.perizinan.cetak-regis', compact('data','qrcode','namaPerizinan'));
        return $pdf->stream();
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

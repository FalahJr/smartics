<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mMember;

use App\Authentication;

use Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Session;


use Yajra\Datatables\Datatables;

class ArsipController extends Controller
{
    public function index() {
  //     $tes =  "<select class='custom-select float-right bg-warning' id='statusFilter' onchange='handleFilter()'>
  //     <option value='' selected disabled>Select Status</option>
  //     <option value='approved'>Approved</option>
  //     <option value='rejected'>Rejected</option>
  // </select>";

      return view('arsip.index');
    }

    public function datatable($surat_jenis) {
      // $data = DB::table('surat')->get();

      if($surat_jenis !== 'Semua'){
      $data = DB::table('surat')->where('surat.surat_jenis_id', $surat_jenis)->where(function ($query) {
        $query->whereIn('status', ['Selesai', 'Ditolak']);
    })->get();

      // $surat_dokumen = DB::table("surat_dokumen")->join('surat_syarat', 'surat_syarat.id', '=', 'surat_dokumen.surat_syarat_id')
      // ->where('surat_dokumen.surat_id', $surat->id)->get();
    }else{
      // $data;
      $data = DB::table('surat')->whereIn('status', ['Selesai', 'Ditolak'])->get();
    }


        // return $data;
        // $xyzab = collect($data);
        // return $xyzab;
        // return $xyzab->i_price;
        return Datatables::of($data)
        ->addColumn("surat_jenis", function($data) {
          $surat_jenis = DB::table('surat_jenis')->where('id', $data->surat_jenis_id)->first();
          return $surat_jenis->nama;
        })
        ->addColumn('jadwal_survey', function ($data) {
          if($data->jadwal_survey !== null){
            return Carbon::parse($data->jadwal_survey)->format('d F Y');

          }else{
            return '<div><i>Belum Tersedia</i></div>';
          }
        })
        ->addColumn("user", function($data) {
          $user = DB::table('user')->where('id', $data->user_id)->first();
          return $user->nama_lengkap;
        })
        ->addColumn('status', function ($data) {
          $color = '<div><strong class="text-warning">' . $data->status . '</strong></div>';
      
          if ($data->status == "Selesai") {
              // Tombol "Approve" hanya muncul jika is_active == 1
              $color =  '<div><strong class="text-success">' . $data->status . '</strong></div>';
          } else if ($data->status == "Ditolak"){
            $color = '<div><strong class="text-danger">' . $data->status . '</strong></div>';
          }else{
            $color;
          }
          return $color;
      })
      ->addColumn('tanggal_pengajuan', function ($data) {
        return Carbon::parse($data->created_at)->format('d F Y');

      })
          ->addColumn('aksi', function ($data) {
            $aksi = '';

            if($data->status == "Selesai"){
              if(Auth::user()->role_id == 9){
                if ($data->status == "Selesai" && $data->is_ulasan == "N") {
                  $aksi =  $aksi .'<div class="btn-group">'.
                            '<button type="button" onclick="ulasan('.$data->id.')" class="btn btn-warning btn-lg pt-2" title="ulasan">'.
                            '<label class="fa fa-commenting w-100"></label></button>'.
                            '</div>';
                }
              $aksi = $aksi . '<div class="btn-group">'.
                        '<button type="button" onclick="edit('.$data->id.')" class="btn btn-success btn-lg pt-2" title="edit">'.
                        '<label class="fa fa-eye w-100"></label></button>'.
                        '&nbsp;'.
                        '<a href="cetak-perizinan?dataId='.$data->id.'" class="btn btn-primary btn-lg pt-2" target="_blank" title="cetak perizinan">'.
                        '<label class="fa fa-print w-100"></label></a>'.
                    '</div>';
            }else{
              $aksi = $aksi . '<div class="btn-group">'.
              '<button type="button" onclick="edit('.$data->id.')" class="btn btn-success btn-lg pt-2" title="edit">'.
              '<label class="fa fa-eye w-100"></label></button>'.
              '&nbsp;'.
          '</div>';
            }
            }else{
              $aksi = $aksi . '<div class="btn-group border-0">'.
              '<button type="button" onclick="edit('.$data->id.')" class="btn btn-success btn-lg pt-2 m-0" title="edit">'.
              '<label class="fa fa-eye w-100"></label></button>'.
              '&nbsp;'.
            '</div>';
            }
            
           

            return $aksi;
          })
          ->rawColumns(['aksi','jadwal_survey','user', 'tanggal_pengajuan','status'])
          ->addIndexColumn()
          // ->setTotalRecords(2)
          ->make(true);
    }

    public function simpan(Request $req) {
     
      if ($req->id == null) {
        DB::beginTransaction();
        try {

        DB::table("surat")
              ->insertGetId([
              "nama" => $req->nama,
              "user_id" => $req->user_id,
              "surat_jenis_id" => $req->surat_jenis_id,
              "status" => 'Pengisian Dokumen',
              "kategori" => $req->kategori,
              "alamat_lokasi" => $req->alamat_lokasi,
              "longitude" => $req->longitude,
              "latitude" => $req->latitude,
              "created_at" => Carbon::now("Asia/Jakarta"),
              "updated_at" => Carbon::now("Asia/Jakarta")
            ]);

          DB::commit();
          return response()->json(["status" => 1,'message' => 'success']);
        } catch (\Exception $e) {
          DB::rollback();
          return response()->json(["status" => 2, "message" =>$e->getMessage()]);
        }
      } else {
        DB::beginTransaction();
        try {

          DB::table("surat_jenis")
            ->where("id", $req->id)
            ->update([
              "nama" => $req->nama,
              "updated_at" => Carbon::now("Asia/Jakarta")
            ]);

         
          DB::commit();
          return response()->json(["status" => 3]);
        } catch (\Exception $e) {
          DB::rollback();
          return response()->json(["status" => 4, "message" =>$e->getMessage()]);
        }
      }

    }

    public function uploadDokumenSyarat(Request $req)
    {
        try {
          $imgPath = null;
          $tgl = Carbon::now('Asia/Jakarta');
          $folder = $tgl->year . $tgl->month . $tgl->timestamp;
          $childPath ='file/uploads/dokumen-syarat-pemohon/';
          $path = $childPath;
          $cekDataSurat = DB::table("surat")->where("id", $req->surat_id)->first();
          $cekDataSuratDokumen = DB::table("surat_dokumen")->where("surat_syarat_id", $req->surat_syarat_id)->first();
          if ($cekDataSurat == null ) {
          return response()->json(["status" => 2, "message" => 'Data Surat Tidak Ditemukan']);

          }
          else if($cekDataSuratDokumen != null){
          return response()->json(["status" => 2, "message" => 'Data Dokumen Sudah Ada']);

          }
          else{
          $file = $req->file('dokumen_syarat_pemohon');
          $name = null;
          if ($file != null) {
            $name = $folder . '.' . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $imgPath = $childPath . $name;
          } else {
              return 'error';
          }
  
         
          DB::table("surat_dokumen")
          ->insertGetId([
            // "id" => $max,
            "surat_id" => $req->surat_id,
            "surat_syarat_id" => $req->surat_syarat_id,
            "dokumen_upload"=>$imgPath,
            "created_at" => $tgl,
            "updated_at" => $tgl
          ]);
            
            DB::commit();
        }
  
          return response()->json(["status" => 1, "message" => "Sukses Upload Dokumen Syarat"]);
        } catch (\Exception $e) {
          DB::rollback();
          return response()->json(["status" => 2, "message" => $e]);
        }
    }

    public function kirimSuratPengajuan(Request $req) {
     $cekJumlahSuratSyarat = DB::table("surat_syarat")->where("surat_jenis_id", $req->surat_jenis_id)->count();
     $cekJumlahSuratDokumen = DB::table("surat_dokumen")->where("surat_id", $req->surat_id)->count();
     $cekDataUser = DB::table("surat")->join('user', 'user.id', '=', 'surat.user_id')
     ->where('surat.id', $req->surat_id)->first();
     $operator = DB::table('user')->where('role_id', '5')->first(); 

    //  if($cekDataUser){
    //   return $cekDataUser->user_id;
    //  }

     if($cekJumlahSuratDokumen < $cekJumlahSuratSyarat){
      return response()->json(["status" => 2, "message" => "Dokumen Syarat Mohon Dilengkapi Terlebih Dahulu"]);

     }else{
        DB::beginTransaction();
     try {

        DB::table("surat")
              ->where("id", $req->surat_id)
              ->update([
                "status" => 'Validasi Operator',
                "updated_at" => Carbon::now("Asia/Jakarta")
              ]);

          DB::commit();
          SendemailController::Send($cekDataUser->nama_lengkap, "Selamat! Pengajuan surat Anda telah sukses diajukan. Kami akan melakukan Validasi Operator, mohon tunggu pemberitahuan selanjutnya yaa","Permohonan Perizinan Berhasil Diajukan", $cekDataUser->email);
          PushNotifController::sendMessage($cekDataUser->user_id,'Permohonan Perizinan Berhasil Diajukan','Selamat! Pengajuan surat Anda telah sukses diajukan. Kami akan melakukan Validasi Operator, mohon tunggu pemberitahuan selanjutnya yaa' );

          PushNotifController::sendMessage($operator->id,'Hai Operator, Anda memiliki tugas baru menanti dengan nomor surat #'.$req->surat_id.' !','Ada surat dari pemohon yang perlu segera divalidasi. Silakan akses tugas Anda sekarang dan lakukan validasi. Terima kasih!' );
          
          return response()->json(["status" => 1,'message' => 'Surat Berhasil Diajukan']);
        } catch (\Exception $e) {
          DB::rollback();
          return response()->json(["status" => 2, "message" =>$e->getMessage()]);
        }
     }

    }

    public function hapus(Request $req) {
      DB::beginTransaction();
      try {

        DB::table("surat_jenis")
            ->where("id", $req->id)
            ->delete();

        DB::commit();
        return response()->json(["status" => 3]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json(["status" => 4]);
      }

    }

    public function edit(Request $req) {
      $surat = DB::table("surat")
              ->where("id", $req->id)
              ->first();

      $user = DB::table("user")
              ->where("id", $surat->user_id)
              ->first();
      $surat_jenis = DB::table("surat_jenis")
              ->where("id", $surat->surat_jenis_id)
              ->first();

      $surat_dokumen = DB::table("surat_dokumen")->join('surat_syarat', 'surat_syarat.id', '=', 'surat_dokumen.surat_syarat_id')
      ->where('surat_dokumen.surat_id', $surat->id)->get();

      

      $data = [
       'surat' => $surat,
       'user' => $user,
       'surat_jenis' => $surat_jenis,
       'tanggal_pengajuan' => Carbon::parse($surat->created_at)->format('d F Y'),
       'jadwal_survey' => $surat->jadwal_survey ? Carbon::parse($surat->jadwal_survey)->format('d F Y') : 'Belum Tersedia',
       'surat_dokumen' => $surat_dokumen
      ];
      // $data->created_at = Carbon::parse($data->created_at)->format("d-m-Y");

      return response()->json($data);
    }

    public function simpanulasan(Request $req) {
      DB::beginTransaction();
      try {
        
        $cekulasan = DB::table("ulasan")->where("surat_id", $req->id)->first();

        if ($cekulasan == null) {
          DB::table("ulasan")
          ->insert([
            "surat_id" => $req->id,
            "isi" => $req->ulasan,
            "created_at" => Carbon::now("Asia/Jakarta")
          ]);

          DB::table("surat")
              ->where("id", $req->id)
              ->update([
                "is_ulasan" => "Y"
              ]);
        } else {
          return response()->json(["status" => 2, "message" => "Sudah pernah diulas!"]);
        }

        DB::commit();
        return response()->json(["status" => 1, "message" => "Ulasan Anda Diterima Terimakasih Telah Memberikan Ulasan"]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json(["status" => 2 , 'message' => $e->getMessage()]);
      }
    }
}

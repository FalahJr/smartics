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

class SuratController extends Controller
{
    public function index() {

      return view('surat.index');
    }

    public function datatable() {
      $data = DB::table('surat')
        ->get();


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
            return Carbon::CreateFromFormat('Y-m-d',$data->jadwal_survey)->format('d M Y');
          }else{
            return '<div><i>Belum Tersedia</i></div>';
          }
        })
        ->addColumn('status', function ($data) {
          $color = '<div><strong class="text-warning">' . $data->status . '</strong></div>';
      
          if ($data->status == "Selesai") {
              // Tombol "Approve" hanya muncul jika is_active == 1
              $color .=  '<div><strong class="text-success">' . $data->status . '</strong></div>';
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
            return  '<div class="btn-group">'.
                     '<button type="button" onclick="edit('.$data->id.')" class="btn btn-success btn-lg pt-2" title="edit">'.
                     '<label class="fa fa-eye w-100"></label></button>'.
                  '</div>';
          })
          ->rawColumns(['aksi','jadwal_survey','status', 'tanggal_pengajuan'])
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

    //  if($cekDataUser){
    //   return $cekDataUser->nama_lengkap;
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
      $data = DB::table("surat_jenis")
              ->where("id", $req->id)
              ->first();

      // $petugas = [
      //   "id" => $data->id,
      //   "nama_lengkap" => $data->nama_lengkap,
      //   "username" => $data->username,
      //   "password" => Crypt::decryptString($data->password),
      //   "role_id" => $data->role_id,
      // ];
      // $data->created_at = Carbon::parse($data->created_at)->format("d-m-Y");

      return response()->json($data);
    }
}

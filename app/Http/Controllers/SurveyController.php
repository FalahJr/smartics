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

class SurveyController extends Controller
{
    public function index() {
    // $roles = DB::table("role")->get();

      return view('survey-penugasan.index');
    }

    public function datatable() {
      $data = DB::table('surat')
        ->where("status",'Penjadwalan Survey')
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
          // if(Auth::user()->role_id === 1){
  
            if($data->jadwal_survey !== null){
              return Carbon::parse($data->jadwal_survey)->format('d F Y');
  
            }else{
              return '<div><i>Belum Tersedia</i></div>';
            }
          // }else{
          //   return null;
          // }
          })
        ->addColumn('status', function ($data) {
          $color = '<div><strong class="text-success">Acc Jadwal Survey</strong></div>';
      
          if ($data->is_acc_penjadwalan == "N" && $data->is_reschedule == "N" && $data->jadwal_survey == NULL) {
              // Tombol "Approve" hanya muncul jika is_active == 1
              $color =  '<div><strong class="text-warning"> Menunggu Jadwal</strong></div>';
          } else if ($data->is_acc_penjadwalan == "N" && $data->is_reschedule == "Y" && $data->jadwal_survey != NULL){
            $color = '<div><strong class="text-danger">Penjadwalan Ulang</strong></div>';
          }else if ($data->is_acc_penjadwalan == "Y" && $data->is_reschedule == "N" && $data->jadwal_survey != NULL){
            $color;
          }
          return $color;
      })
      ->addColumn('tanggal_pengajuan', function ($data) {
        return Carbon::parse($data->created_at)->format('d F Y');

      })
          ->addColumn('aksi', function ($data) {
            $aksi = '<div class="btn-group">'.
            '<button type="button" onclick="edit('.$data->id.')" class="btn btn-info btn-lg pt-2" title="lihat detail penugasan">'.
            '<label class="fa fa-calendar-check-o w-100" style="padding:0 2px"></label></button>'.
         '</div>';
         if ($data->is_acc_penjadwalan == "Y" && $data->is_reschedule == "N" && $data->jadwal_survey != NULL) {
          $aksi = '<div class="btn-group">'.
            '<button type="button" onclick="edit('.$data->id.')" class="btn btn-success btn-lg pt-2" title="penjadwalan survey">'.
            '<label class="fa fa-eye w-100" ></label></button>'.
         '</div>';
         }
         else{
          $aksi;
         }
            return $aksi;
          })
          ->rawColumns(['aksi','status','surat_jenis','jadwal_survey','tanggal_pengajuan'])
          ->addIndexColumn()
          ->make(true);
    }

    public function getData(Request $req){
      try{
        if($req->id){
          $data = DB::table('user')->where("id",$req->id)->first();
        }else{
          $data = DB::table('user')
             ->where("role_id",'like', '9')->get();
        }
  
        return response()->json(["status" => 1, "data" => $data]);
      }catch(\Exception $e){
        return response()->json(["status" => 2, "message" => $e->getMessage()]);
      }
    }

    public function simpan(Request $req) {
     
      if ($req->id == null) {
        DB::beginTransaction();
        try {
          $cekusername= DB::table("user")->where("username",$req->username)->first();
          $cekemail= DB::table("user")->where("email",$req->email)->first();

          if($cekemail !== null){
            return response()->json(["status" => 2, "message" => "Email Sudah Terdaftar"]);
          }else if($cekusername !== null){
            return response()->json(["status" => 2, "message" => "Username Sudah Digunakan"]);
          }
          else{
        DB::table("user")
              ->insertGetId([
              "nama_lengkap" => $req->nama_lengkap,
              "username" => $req->username,
              "email" => $req->email,
              "password" => Crypt::encryptString($req->password),
              "role_id" => "9",
              "alamat" => $req->alamat,
              "provinsi" => $req->provinsi,
              "kabupaten_kota" => $req->kabupaten_kota,
              "kecamatan" => $req->kecamatan,
              "kelurahan" => $req->kelurahan,
              "jenis_kelamin" => $req->jenis_kelamin,
              "jenis_identitas" => $req->jenis_identitas,
              "nomor_identitas" => $req->nomor_identitas,
              "tanggal_lahir" => $req->tanggal_lahir,
              "tempat_lahir" => $req->tempat_lahir,
              "pekerjaan" => $req->pekerjaan,
              "is_active" => "N",
              "created_at" => Carbon::now("Asia/Jakarta"),
              "updated_at" => Carbon::now("Asia/Jakarta")
            ]);

          DB::commit();
          return response()->json(["status" => 1,'message' => 'Berhasil Registrasi Tunggu Admin Mengaktivasi Akun Anda dan Mengirimkan Email'  ]);
          }
        } catch (\Exception $e) {
          DB::rollback();
          return response()->json(["status" => 2, "message" =>$e->getMessage()]);
        }
        
      } else {
        DB::beginTransaction();
        try {

          DB::table("user")
            ->where("id", $req->id)
            ->update([
              "nama_lengkap" => $req->nama_lengkap,
              "username" => $req->username,
              "email" => $req->email,
              "password" => Crypt::encryptString($req->password),
              "alamat" => $req->alamat,
              "provinsi" => $req->provinsi,
              "kabupaten_kota" => $req->kabupaten_kota,
              "kecamatan" => $req->kecamatan,
              "kelurahan" => $req->kelurahan,
              "jenis_kelamin" => $req->jenis_kelamin,
              "jenis_identitas" => $req->jenis_identitas,
              "nomor_identitas" => $req->nomor_identitas,
              "tanggal_lahir" => $req->tanggal_lahir,
              "tempat_lahir" => $req->tempat_lahir,
              "pekerjaan" => $req->pekerjaan,
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

    public function hapus(Request $req) {
      DB::beginTransaction();
      try {

        DB::table("user")
            ->where("id", $req->id)
            ->delete();

        DB::commit();
        return response()->json(["status" => 3]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json(["status" => 4]);
      }

    }

    public function tolak(Request $req) {
      $data = DB::table("user")
              ->where("id", $req->id)
              ->first();

      // $data->created_at = Carbon::parse($data->created_at)->format("d-m-Y");

      return response()->json($data);
    }

    public function tolakprocess(Request $req) {
      DB::beginTransaction();
      try {
        $data = DB::table("user")
        ->where("id", $req->id)
        ->first();
        SendemailController::Send($data->nama_lengkap,"Alasan : ".$req->alasan_ditolak." . Silahkan lakukan Registrasi Kembali dengan data yang sesuai", "Akun Anda Gagal Diaktifkan",  $data->email);

        DB::table("user")
            ->where("id", $req->id)
            ->delete();

        DB::commit();
        return response()->json(["status" => 1]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json(["status" => 2, 'error' => $e->getMessage()]);
      }

    }

    public function approve(Request $req) {
      DB::beginTransaction();
      try {
        $data = DB::table("user")
        ->where("id", $req->id)
        ->first();

        DB::table("user")
            ->where("id", $req->id)
            ->update([
              "is_active" => "Y"
            ]);
            
            SendemailController::Send($data->nama_lengkap, "Silahkan Login ke akun anda","Selamat Akun Anda Sudah di Aktivasi", $data->email);
        DB::commit();
        return response()->json(["status" => 3]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json(["status" => 4]);
      }

    }

    public function edit(Request $req) {
      $data = DB::table("user")
              ->where("id", $req->id)
              ->first();

      $petugas = [
        "id" => $data->id,
        "nama_lengkap" => $data->nama_lengkap,
        "username" => $data->username,
        "password" => Crypt::decryptString($data->password),
      ];
      // $data->created_at = Carbon::parse($data->created_at)->format("d-m-Y");

      return response()->json($petugas);
    }
}

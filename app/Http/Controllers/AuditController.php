<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mMember;

use App\Authentication;

use Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\DB;
use Session;


use Yajra\Datatables\Datatables;

class AuditController extends Controller
{
    public function index() {
    // $roles = DB::table("role")->where('id', 'not like', '9')->get();

      return view('audit.index');
    }

    public function datatable() {
      $data = DB::table('audit')
        // ->where("role_id",'not like', '9')
        ->get();


        // return $data;
        // $xyzab = collect($data);
        // return $xyzab;
        // return $xyzab->i_price;
        return Datatables::of($data)
          // ->addColumn("nominal", function($data) {
          //   return FormatRupiah($data->uangkeluar_nominal);
          // })
         
          ->addColumn('periode', function ($data) {
            // if(Auth::user()->role_id === 1){
    
              if($data->periode !== null){
                return Carbon::parse($data->periode)->format('F Y');
    
              }else{
                return '<div><i>Belum Tersedia</i></div>';
              }
          
            })
            ->addColumn('created_at', function ($data) {
              // if(Auth::user()->role_id === 1){
      
                if($data->created_at !== null){
                  return Carbon::parse($data->periode)->format('d F Y');
      
                }else{
                  return '<div><i>Belum Tersedia</i></div>';
                }
            
              })
              ->addColumn("dokumen_audit", function($data) {
                return '<div class="btn-group">'.
                 '<a href='.asset($data->file_upload).' class="btn btn-success btn-lg px-4 py-2" title="Lihat Video" target="_blank" style="color:white;">'.
                 'Lihat Laporan</a>
              </div>';
               })
          ->addColumn('aksi', function ($data) {
            return  '<div class="btn-group">'.
                     '<button type="button" onclick="edit('.$data->id.')" class="btn btn-info btn-lg" title="edit">'.
                     '<label class="fa fa-pencil-alt"></label></button>'.
                     '<button type="button" onclick="hapus('.$data->id.')" class="btn btn-danger btn-lg" title="hapus">'.
                     '<label class="fa fa-trash"></label></button>'.
                  '</div>';
          })
          ->rawColumns(['aksi', 'dokumen_audit'])
          ->addIndexColumn()
          ->make(true);
    }

    public function getData(Request $req){
      try{
        // if($req->id){
          $data = DB::table('audit')->get();
        // }else{
        //   $data = DB::table('user')
        //      ->where("role_id",'not like', '9')->get();
        // }
  
        return response()->json(["status" => 1, "data" => $data]);
      }catch(\Exception $e){
        return response()->json(["status" => 2, "message" => $e->getMessage()]);
      }
    }

    // public function getDetailData(Request $req){
    //   try{
    //     // if($req->id){
    //       $data = DB::table('audit')->where("id",$req->id)->first();
    //     // }else{
    //     //   $data = DB::table('user')
    //     //      ->where("role_id",'not like', '9')->get();
    //     // }
  
    //     return response()->json(["status" => 1, "data" => $data]);
    //   }catch(\Exception $e){
    //     return response()->json(["status" => 2, "message" => $e->getMessage()]);
    //   }
    // }

    public function simpan(Request $request) {
      try {
        //code...
        $imgPath = null;
        $tgl = Carbon::now('Asia/Jakarta');
        $folder = $tgl->year . $tgl->month;
        $childPath ='file/uploads/audit/';
        $path = $childPath;

        $file = $request->file('file_upload');
        $name = null;
        if ($file != null) {
          $name = $folder . '.' . $file->getClientOriginalExtension();
          $file->move($path, $name);
          $imgPath = $childPath . $name;
        } else {
          return response()->json(["status" => 2, "message" => 'Dokumen Belum Di upload']);

        }

       
          if($request->id){
            DB::table('audit')->where('id', $request->id)->update([
              'periode' => $request->periode,
              "file_upload" => $imgPath,
              "updated_at" => $tgl,
             
          ]);
    }else{
      DB::table('audit')->insertGetId([
        'periode' => $request->periode,
        "file_upload" => $imgPath,
        "updated_at" => $tgl,
        "created_at" => $tgl
       
    ]);
    }
    // }

      DB::commit();

        return response()->json(["status" => 1,'message' => 'Sukses membuat file audit']);
       } catch (\Exception $e) {
        return response()->json(["status" => 2, "message" => $e]);

       }

    }

    public function hapus(Request $req) {
      DB::beginTransaction();
      try {

        DB::table("audit")
            ->where("id", $req->id)
            ->delete();

        DB::commit();
        return response()->json(["status" => 1]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json(["status" => 2]);
      }

    }

    public function edit(Request $req) {
      $data = DB::table("audit")
              ->where("id", $req->id)
              ->first();

    
      // $data->created_at = Carbon::parse($data->created_at)->format("d-m-Y");

      return response()->json($data);
    }
}

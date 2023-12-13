<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mMember;

use App\Authentication;

use Auth;

use Carbon\Carbon;

use Session;

use DB;

use Crypt;

class ForgotpasswordController extends Controller
{
    public function index() {
      return view("auth.forgotpassword");
    }

    public function doforgot(Request $req) {
      if ($req->password != $req->confirmpassword) {
        Session::flash('confirmpassword','Berhasil');
        return back();
      }

      $cekemail = DB::table("user")
                    ->where("email", $req->email)
                    ->first();

      if ($cekemail != null) {
        DB::table("user")
          ->where("id", $cekemail->id)
          ->update([
            "password" => Crypt::encryptString($req->password),
          ]);

        Session::flash('sukses','Berhasil');
        return back();
      } else {
        Session::flash('email','Berhasil');
        return back();
      }
    }

    public function apidoforgot(Request $req) {
      if ($req->password != $req->confirmpassword) {
        return response()->json(["status" => 2, "message" => "Password tidak sama"]);
      }

      $cekemail = DB::table("user")
                    ->where("email", $req->email)
                    ->first();

      if ($cekemail != null) {
        DB::table("user")
          ->where("id", $cekemail->id)
          ->update([
            "password" => Crypt::encryptString($req->password),
          ]);

          return response()->json(["status" => 1, "message" => "Berhasil update password"]);
      } else {
        return response()->json(["status" => 2, "message" => "Akun tidak ditemukan"]);
        return back();
      }
    }

    public function forgotlink($id, $accesstoken) {
        $ceklink = DB::table("users")->where("users_id", $id)->first();

        if ($ceklink->users_accesstoken != $accesstoken) {
          return view("errors.404");
        } else{
          return view("auth.forgotlink", compact("id"));
        }
    }

    public function doforgotlink(Request $req) {
      DB::beginTransaction();
      try {

        if ($req->password != $req->confirmpass) {
          Session::flash('password','Berhasil');
          return back();
        } else {
          DB::table("users")
                ->where("users_id", decrypt($req->id))
                ->update([
                  "users_password" => sha1(md5('passwordAllah').$req->password),
                ]);
        }
        DB::commit();
        Session::flash('sukses','Berhasil');
        return back();
      } catch (\Exception $e) {
        DB::rollback();
        Session::flash('gagal','Berhasil');
        return back();
      }

    }

    public function forgotlogin($id){
      $iddecrypt = decrypt($id);

      $users = mMember::where("users_id", $iddecrypt)->first();

      Auth::login($users);
      return redirect('/home');
    }
}

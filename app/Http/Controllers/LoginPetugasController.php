<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\mMember;
use Validator;
use Carbon\Carbon;
use Session;
use DB;
use App\Http\Controllers\logController;

class loginController extends Controller
{

    public function __construct(){
        $this->middleware('guest');
    }

    public function admin() {
        return view('auth.login');
    }

    public function login(Request $req) {
        $username = $req->username;
        $password = $req->password;
        $user = mMember::where("users_username", $username)->first();
        if ($user && $user->m_passwd == sha1(md5('passwordAllah') + $req->password)) {
            return response()->json([
                        'success' => 'succes',
            ]);
        } else {
            return response()->json([
                        'success' => 'gagal',
            ]);
        }
    }

    public function authenticate(Request $req) {

        $rules = array(
            'username' => 'required|min:3', // make sure the email is an actual email
            'password' => 'required|min:2' // password can only be alphanumeric and has to be greater than 3 characters
        );
    	// dd($req->all());
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return Redirect('/')
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput($req->except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            $username  = $req->username;
            $password  = $req->password;
           	$pass_benar=sha1(md5('passwordAllah').$password);
            // $pass_benar=$password;
            // $username = str_replace('\'', '', $username);

            $user = mMember::where("users_username", $username)->first();

            $user_valid = [];
            // dd($req->all());

           	if ($user != null) {
           		$user_pass = mMember::where('users_username',$username)
	            			          ->where('users_password',$pass_benar)
	            			          ->first();

            	if ($user_pass != null) {
           			mMember::where('users_username',$username)->update([
                     'users_lastlogin'=>Carbon::now(),
                 	  ]);

                    // mMember::where('users_username',$username)->update([
                    //      'm_statuslogin'=>'Y',
                    //  	  ]);
                if ($user_pass->users_verification == "Y") {
                  Auth::login($user);
                  // logController::inputlog('Login', 'Login', $username);
                  return Redirect('/home');
                } else {
                  $id = $user_pass->users_id;
                  return redirect("/verification/".encrypt($id)."");
                }
            	}else{
                Session::flash('password','Password Yang Anda Masukan Salah!');
                return back()->with('password','username');
            	}
           	}else{
           		Session::flash('username','Username Tidak Ada');
           		return back()->with('password','username');
           	}


        }
    }

}

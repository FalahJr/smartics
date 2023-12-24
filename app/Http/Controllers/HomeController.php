<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Account;

use App\Authentication;

// use Auth;

use Carbon\Carbon;


// use Session;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function index() {

        $currentYear = now()->year;
        // basic column chart
        $columnchart = DB::table('surat')
        ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month'), DB::raw('COUNT(*) as total'))
        ->whereYear('created_at', $currentYear)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        // pie chart
    $rejectedCount = DB::table('surat')->where('status', 'Ditolak')->count();
    $acceptedCount = DB::table('surat')->where('status', '!=', 'Ditolak')->count();

    $total = $acceptedCount + $rejectedCount;

    $piechart = [
        'acceptedPercentage' => ($acceptedCount / $total) * 100,
        'rejectedPercentage' => ($rejectedCount / $total) * 100,
        'acceptedColor' => '#1CC88A', 
        'rejectedColor' => '#FF8D8D', 
    ];

       return view("home", compact('piechart','columnchart'));
     }

     public function logout(){
        $role = Auth::user()->role_id;
        Session::flush();
        Account::where('id', Auth::user()->id)->update([
             'updated_at' => Carbon::now('Asia/Jakarta'),
             'is_login' => "N",
             "SubID" => null,
            //  "users_accesstoken" => md5(uniqid(Auth::user()->users_username, true)),
        ]);

        // Account::where('m_id', Auth::user()->m_id)->update([
        //      'm_statuslogin' => 'N'
        //     ]);

        // logController::inputlog('Logout', 'Logout', Auth::user()->m_username);
        Auth::logout();

        Session::forget('key');
        
        // if($role == "9") {
            return Redirect('/');
        // } else {
        //     return Redirect('/admin');
        // }
    }

}

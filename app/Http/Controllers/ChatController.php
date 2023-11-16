<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;

use App\Authentication;

use Auth;

use Carbon\Carbon;

use Session;

use DB;

use File;

use Yajra\Datatables\Datatables;

use Response;

class ChatController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index() {
      return view('chat.index');
    }

    public function newchat(Request $req) {
      DB::beginTransaction();
      try {

          $cek = DB::table("roomchat")
                  ->Orwhere("account", Auth::user()->id_account . "-" . $req->idtoko)
                  ->Orwhere('account', $req->idtoko . "-" . Auth::user()->id_account)
                  ->first();

          if ($cek != null) {
            DB::table('roomchat')
             ->where("id_roomchat", $cek->id_roomchat)
             ->update([
               'last_message' => $req->message,
               'counter2' => $cek->counter2 + 1,
               'created_at' => Carbon::now('Asia/Jakarta'),
             ]);

            DB::table("listchat")
               ->insert([
                 'id_roomchat' => $cek->id_roomchat,
                 'account' => Auth::user()->id_account . "-" . $req->idtoko,
                 'message' => $req->message,
                 'created_at' => Carbon::now('Asia/Jakarta'),
               ]);
          } else {
              $id = DB::table('roomchat')
                    ->insertGetId([
                      'account' => Auth::user()->id_account . "-" . $req->idtoko,
                      'last_message' => $req->message,
                      'counter2' => 1,
                      'created_at' => Carbon::now('Asia/Jakarta'),
                    ]);

              DB::table("listchat")
                 ->insert([
                   'id_roomchat' => $id,
                   'account' => Auth::user()->id_account . "-" . $req->idtoko,
                   'message' => $req->message,
                   'created_at' => Carbon::now('Asia/Jakarta'),
                 ]);
          }
          // dd($req);
           DB::commit();
      } catch (\Exception $e) {
           DB::rollback();
      }
    }

    public function apinewchat(Request $req) {
      DB::beginTransaction();
      try {

          $cek = DB::table("roomchat")
                  ->Orwhere("account", $req->id_account . "-" . $req->idtoko)
                  ->Orwhere('account', $req->idtoko . "-" . $req->id_account)
                  ->first();

          if ($cek != null) {
            DB::table('roomchat')
             ->where("id_roomchat", $cek->id_roomchat)
             ->update([
               'last_message' => $req->message,
               'counter2' => $cek->counter2 + 1,
               'created_at' => Carbon::now('Asia/Jakarta'),
             ]);

            DB::table("listchat")
               ->insert([
                 'id_roomchat' => $cek->id_roomchat,
                 'account' => $req->id_account . "-" . $req->idtoko,
                 'message' => $req->message,
                 'created_at' => Carbon::now('Asia/Jakarta'),
               ]);
          } else {
              $id = DB::table('roomchat')
                    ->insertGetId([
                      'account' => $req->id_account . "-" . $req->idtoko,
                      'last_message' => $req->message,
                      'counter2' => 1,
                      'created_at' => Carbon::now('Asia/Jakarta'),
                    ]);

              DB::table("listchat")
                 ->insert([
                   'id_roomchat' => $id,
                   'account' => $req->id_account . "-" . $req->idtoko,
                   'message' => $req->message,
                   'created_at' => Carbon::now('Asia/Jakarta'),
                 ]);
          }
           DB::commit();
      } catch (\Exception $e) {
           DB::rollback();
      }
    }

    public function countchat() {
      $chat = DB::table('roomchat')
               ->where('account', 'like', '%' . Auth::user()->id_account . '%')
               ->get();

       $count = 0;

       foreach ($chat as $key => $value) {
         $account = explode("-",$value->account);

         if ($account[0] == Auth::user()->id_account) {
             $count += $value->counter1;
         } else {
             $count += $value->counter2;
         }
       }

       return Response()->json($count);
    }

    public function apicountchat(Request $req) {
      $chat = DB::table('roomchat')
               ->where('account', 'like', '%' . $req->id_account . '%')
               ->get();

       $count = 0;

       foreach ($chat as $key => $value) {
         $account = explode("-",$value->account);

         if ($account[0] == $req->id_account) {
             $count += $value->counter1;
         } else {
             $count += $value->counter2;
         }
       }

       return Response()->json($count);
    }

    public function listroom(Request $req) {
        $chat = DB::table('roomchat')
                 ->where('account', 'like', '%' . Auth::user()->id_account . '%')
                 ->orderby("created_at", "DESC")
                 ->get();

        foreach ($chat as $key => $value) {
          $account = explode("-",$value->account);

          if ($account[0] != Auth::user()->id_account) {
            $value->account = DB::table("account")
                                ->where("id_account", $account[0])
                                ->first();
          } else if ($account[1] != Auth::user()->id_account) {
            $value->account = DB::table("account")
                                ->where("id_account", $account[1])
                                ->first();
          }

          $value->created_at = Carbon::parse($value->created_at)->diffForHumans();
        }

         return Response()->json($chat);
    }

    public function apilistroom(Request $req) {
        $chat = DB::table('roomchat')
                 ->where('account', 'like', '%' . $req->id_account . '%')
                 ->orderby("created_at", "DESC")
                 ->get();

        foreach ($chat as $key => $value) {
          $account = explode("-",$value->account);

          if ($account[0] != $req->id_account) {
            $value->account = DB::table("account")
                                ->where("id_account", $account[0])
                                ->first();
          } else if ($account[1] != $req->id_account) {
            $value->account = DB::table("account")
                                ->where("id_account", $account[1])
                                ->first();
          }

          $value->created_at = Carbon::parse($value->created_at)->diffForHumans();
        }

         return Response()->json($chat);
    }

    public function listchat(Request $req) {

        if (Auth::user()->role_id == 9) {
          $chat = DB::table('listchat')
                 ->where("account", Auth::user()->id . "-admindinas")
                 ->get();

          $allchat = DB::table('listchat')
          ->where("roomchat_id", $chat[0]->roomchat_id)
          ->get();

          DB::table('listchat')
          ->where("roomchat_id", $chat[0]->roomchat_id)
          ->update([
            'read' => 1,
          ]);

          $room = DB::table('roomchat')
              ->where("id", $chat[0]->roomchat_id)
              ->first();
          // foreach ($chat as $key => $value) {
          $account = explode("-",$room->account);

          if ($account[0] == Auth::user()->id_account) {

            DB::table('roomchat')
                 ->where("id", $chat[0]->roomchat_id)
                 ->update([
                   'counter_satu' => 0,
                 ]);

          } else {

            DB::table('roomchat')
                 ->where("id", $chat[0]->roomchat_id)
                 ->update([
                   'counter_kedua' => 0,
                 ]);
          }

        }
         
         foreach ($allchat as $key => $value) {
           $value->created_at = Carbon::parse($value->created_at)->diffForHumans();
         }

         return Response()->json($allchat);
    }

    public function apilistchat(Request $req) {
         $chat = DB::table('listchat')
                 ->where("id_roomchat", $req->id)
                 ->get();

         DB::table('listchat')
                 ->where("id_roomchat", $req->id)
                 ->update([
                   'read' => 1,
                 ]);

         $room = DB::table('roomchat')
              ->where("id_roomchat", $req->id)
              ->first();
          // foreach ($chat as $key => $value) {
          $account = explode("-",$room->account);

          if ($account[0] == $req->id_account) {

            DB::table('roomchat')
                 ->where("id_roomchat", $req->id)
                 ->update([
                   'counter1' => 0,
                 ]);

          } else {

            DB::table('roomchat')
                 ->where("id_roomchat", $req->id)
                 ->update([
                   'counter2' => 0,
                 ]);
          }

         foreach ($chat as $key => $value) {
           $value->created_at = Carbon::parse($value->created_at)->diffForHumans();
         }

         return Response()->json($chat);
    }

    public function sendchat(Request $req) {
      DB::beginTransaction();
      try {

          if (Auth::user()->role_id == 9) {
            $getadmindinas = DB::table('user')
            ->where("role_id", 2)
            ->get();

              $cek = DB::table("roomchat")
              ->Orwhere("account", Auth::user()->id . "-admindinas")
              ->Orwhere('account', "admindinas-" . Auth::user()->id)
              ->first();

              if ($cek != null) {
                DB::table('roomchat')
                ->where("id", $cek->id)
                ->update([
                  'last_message' => $req->message,
                  'counter_kedua' => $cek->counter_kedua + 1,
                  'created_at' => Carbon::now('Asia/Jakarta'),
                ]);
   
               DB::table("listchat")
                  ->insert([
                    'roomchat_id' => $cek->id,
                    'account' => Auth::user()->id . "-admindinas",
                    'message' => $req->message,
                    'created_at' => Carbon::now('Asia/Jakarta'),
                  ]);

                  $botchat = DB::table("chatbot")->where("id", 1)->first();
                  if ($botchat->is_active == "Y") {
                    $now = Carbon::now('Asia/Jakarta');
                    $time = $now->format('H:i'); 

                    if ($time >= $botchat->jam_active && $time <= $botchat->jam_selesai) {
                      DB::table("listchat")
                        ->insert([
                          'roomchat_id' => $cek->id,
                          'account' => "admindinas-" . Auth::user()->id,
                          'message' => "Mohon maaf saat ini kami sedang offline, akan kita balas dijam aktif kami, terima kasih",
                          'created_at' => Carbon::now('Asia/Jakarta'),
                        ]);
                    }
                  }
              } else {
                $id = DB::table('roomchat')
                      ->insertGetId([
                        'account' => Auth::user()->id . "-admindinas",
                        'last_message' => $req->message,
                        'counter_kedua' => 1,
                        'created_at' => Carbon::now('Asia/Jakarta'),
                      ]);

                DB::table("listchat")
                  ->insert([
                    'roomchat_id' => $id,
                    'account' => Auth::user()->id . "-admindinas",
                    'message' => $req->message,
                    'created_at' => Carbon::now('Asia/Jakarta'),
                  ]);

                  $botchat = DB::table("chatbot")->where("id", 1)->first();
                  if ($botchat->is_active == "Y") {
                    $now = Carbon::now('Asia/Jakarta');
                    $time = $now->format('H:i');
  
                    if ($time >= $botchat->jam_active && $time <= $botchat->jam_selesai) {
                      DB::table("listchat")
                        ->insert([
                          'roomchat_id' => $id,
                          'account' => "admindinas-" . Auth::user()->id,
                          'message' => "Mohon maaf saat ini kami sedang offline, akan kita balas dijam aktif kami, terima kasih",
                          'created_at' => Carbon::now('Asia/Jakarta'),
                        ]);
                    }
                  }
              }
          }

           DB::commit();
      } catch (\Exception $e) {
           DB::rollback();
      }
    }

    public function apisendchat(Request $req) {
      DB::beginTransaction();
      try {

          // $chat = DB::table('listchat')
          //         ->where("id_roomchat", $req->id)
          //         ->get();

           DB::table("listchat")
              ->insert([
                'id_roomchat' => $req->id,
                'account' => $req->id_account . "-" . $req->penerima,
                'message' => $req->message,
                'created_at' => Carbon::now('Asia/Jakarta'),
              ]);

          $count = 0;
          $room = DB::table('roomchat')
               ->where("id_roomchat", $req->id)
               ->first();
           // foreach ($chat as $key => $value) {
             $account = explode("-",$room->account);

             if ($account[0] == $req->id_account) {

               $count = $room->counter1;

               DB::table('roomchat')
                    ->where("id_roomchat", $req->id)
                    ->update([
                      'last_message' => $req->message,
                      'counter1' => $count + 1,
                      'created_at' => Carbon::now('Asia/Jakarta'),
                    ]);
             } else {

               $count = $room->counter2;

               DB::table('roomchat')
                    ->where("id_roomchat", $req->id)
                    ->update([
                      'last_message' => $req->message,
                      'counter2' => $count + 1,
                      'created_at' => Carbon::now('Asia/Jakarta'),
                    ]);
             }
           // }

           DB::commit();
      } catch (\Exception $e) {
           DB::rollback();
      }
    }

    public function sendimgchat(Request $req) {

        DB::beginTransaction();
        try {

            $room = DB::table('roomchat')
                 ->where("id_roomchat", $req->id)
                 ->first();
              // dd($req);
              $imgPath = null;
              $tgl = Carbon::now('Asia/Jakarta');
              $folder = $tgl->year . $tgl->month . $tgl->timestamp;
              $dir = 'image/uploads/Chat/' . $req->id;
              $childPath = $dir . '/';
              $path = $childPath;

              $file = $req->file('image');
              $name = null;
              if ($file != null) {
                  $this->deleteDir($dir);
                  $name = $folder . '.' . $file->getClientOriginalExtension();
                  if (!File::exists($path)) {
                      if (File::makeDirectory($path, 0777, true)) {
                        if ($_FILES['image']['type'] == 'image/webp' || $_FILES['image']['type'] == 'image/jpeg') {

                        } else if ($_FILES['image']['type'] == 'webp' || $_FILES['image']['type'] == 'jpeg') {

                        } else {
                          compressImage($_FILES['image']['type'],$_FILES['image']['tmp_name'],$_FILES['image']['tmp_name'],75);
                        }
                          $file->move($path, $name);
                          $imgPath = $childPath . $name;
                      } else
                          $imgPath = null;
                  } else {
                      return 'already exist';
                  }
                }

                  if ($imgPath != null) {
                      $chat = DB::table('listchat')
                              ->where("id_roomchat", $req->id)
                              ->get();

                       DB::table("listchat")
                          ->insert([
                            'id_roomchat' => $req->id,
                            'account' => Auth::user()->id_account . "-" . $req->penerima,
                            'photourl' => $imgPath,
                            'created_at' => Carbon::now('Asia/Jakarta'),
                          ]);

                       $count = 0;
                       foreach ($chat as $key => $value) {
                         $account = explode("-",$value->account);

                         if ($account[0] == $req->id_account) {

                           $count = $room->counter1;

                           DB::table('roomchat')
                                ->where("id_roomchat", $req->id)
                                ->update([
                                  'last_message' => "Sending Photo",
                                  'counter1' => $count + 1,
                                  'created_at' => Carbon::now('Asia/Jakarta'),
                                ]);
                         } else {

                           $count = $room->counter2;

                           DB::table('roomchat')
                                ->where("id_roomchat", $req->id)
                                ->update([
                                  'last_message' => "Sending Photo",
                                  'counter2' => $count + 1,
                                  'created_at' => Carbon::now('Asia/Jakarta'),
                                ]);
                         }
                       }
                  }

              DB::commit();
            } catch (\Exception $e) {
              DB::rollback();
            }

    }

    public function apisendimgchat(Request $req) {

        DB::beginTransaction();
        try {
              // dd($req);

              $room = DB::table('roomchat')
                   ->where("id_roomchat", $req->id)
                   ->first();

              $imgPath = null;
              $tgl = Carbon::now('Asia/Jakarta');
              $folder = $tgl->year . $tgl->month . $tgl->timestamp;
              $dir = 'image/uploads/Chat/' . $req->id;
              $childPath = $dir . '/';
              $path = $childPath;

              $file = $req->file('image');
              $name = null;
              if ($file != null) {
                  $this->deleteDir($dir);
                  $name = $folder . '.' . $file->getClientOriginalExtension();
                  if (!File::exists($path)) {
                      if (File::makeDirectory($path, 0777, true)) {
                        if ($_FILES['image']['type'] == 'image/webp' || $_FILES['image']['type'] == 'image/jpeg') {

                        } else if ($_FILES['image']['type'] == 'webp' || $_FILES['image']['type'] == 'jpeg') {

                        } else {
                          compressImage($_FILES['image']['type'],$_FILES['image']['tmp_name'],$_FILES['image']['tmp_name'],75);
                        }
                          $file->move($path, $name);
                          $imgPath = $childPath . $name;
                      } else
                          $imgPath = null;
                  } else {
                      return 'already exist';
                  }
                }

                if ($imgPath != null) {
                    $chat = DB::table('listchat')
                            ->where("id_roomchat", $req->id)
                            ->get();

                     DB::table("listchat")
                        ->insert([
                          'id_roomchat' => $req->id,
                          'account' => $req->id_account . "-" . $req->penerima,
                          'photourl' => $imgPath,
                          'created_at' => Carbon::now('Asia/Jakarta'),
                        ]);

                     $count = 0;
                     foreach ($chat as $key => $value) {
                       $account = explode("-",$value->account);

                       if ($account[0] == $req->id_account) {

                         $count = $room->counter1;

                         DB::table('roomchat')
                              ->where("id_roomchat", $req->id)
                              ->update([
                                'last_message' => "Sending Photo",
                                'counter1' => $count + 1,
                                'created_at' => Carbon::now('Asia/Jakarta'),
                              ]);
                       } else {

                         $count = $room->counter2;

                         DB::table('roomchat')
                              ->where("id_roomchat", $req->id)
                              ->update([
                                'last_message' => "Sending Photo",
                                'counter2' => $count + 1,
                                'created_at' => Carbon::now('Asia/Jakarta'),
                              ]);
                       }
                     }
                }

              DB::commit();
            } catch (\Exception $e) {
              DB::rollback();
            }

    }

    public function deleteDir($dirPath)
   {
       if (!is_dir($dirPath)) {
           return false;
       }
       if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
           $dirPath .= '/';
       }
       $files = glob($dirPath . '*', GLOB_MARK);
       foreach ($files as $file) {
           if (is_dir($file)) {
               self::deleteDir($file);
           } else {
               unlink($file);
           }
       }
       rmdir($dirPath);
   }
}

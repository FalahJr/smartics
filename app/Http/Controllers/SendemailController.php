<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class SendemailController extends Controller
{
    public static function Send($nama, $pesan, $deskripsi, $email) {
      try {

        Mail::send('email', ['nama' => $nama, 'pesan' => $pesan, 'deskripsi' => $deskripsi], function ($message) use ($email, $deskripsi)
        {
            $message->subject($deskripsi);
            $message->from('solitsosmed@gmail.com', 'Javasolit (DompetQu)');
            $message->to($email);
        });

        return true;
      } catch (\Exception $e) {
        return false;
      }
    }
}

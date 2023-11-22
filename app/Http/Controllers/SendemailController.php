<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
use Mail;


class SendemailController extends Controller
{
    public static function Send($nama, $pesan, $deskripsi, $email) {
        try {
            // Pastikan $deskripsi sudah berisi HTML
            // Contoh:
            // $deskripsi = '<p>Ini adalah teks dengan tag HTML</p>';

            Mail::send([], [], function ($message) use ($email, $deskripsi, $nama, $pesan) {
                $message->subject($deskripsi);
                $message->from('smartics@gmail.com', 'Smartics');
                $message->to($email);

                // Set konten HTML langsung ke dalam pesan
                $message->setBody(
                    "<p>Halo $nama,</p>" .
                    "<p>$pesan</p>",
                    'text/html'
                );
            });

            return true;
        } catch (\Exception $e) {
            return false;
        }

        // try {

        //     Mail::send('email', ['nama' => $nama, 'pesan' => $pesan, 'deskripsi' => $deskripsi], function ($message) use ($email, $deskripsi)
        //     {
        //         $message->subject($deskripsi);
        //         $message->from('smartics@gmail.com', 'smartics');
        //         $message->to($email);
        //     });
    
        //     return true;
        //   } catch (\Exception $e) {
        //     return false;
        //   }
    }
}

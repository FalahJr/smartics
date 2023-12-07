<?php

use App\Http\Controllers\SuratController;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {

    // Route::any('/notif', 'HomeController@apinotif');


    // User Petugas
    Route::get('/petugas', 'PetugasController@getData');
    
    // pemohon
    Route::post('pemohon/register', 'PemohonController@simpan');
    Route::post('login', 'loginController@loginApi');


    // Surat
    Route::get('list-surat', [SuratController::class, 'getData']);
    Route::get('surat/detail', 'SuratController@edit');
    Route::post('surat/create', 'SuratController@simpan');
    Route::post('surat/upload-dokumen', 'SuratController@uploadDokumenSyarat');
    Route::post('surat/kirim-surat', 'SuratController@kirimSuratPengajuan');
    Route::post('surat/validasi-surat', 'SuratController@validasi');
    Route::post('surat/verifikasi-surat', 'SuratController@validasi');
    Route::post('surat/kembalikan', 'SuratController@kembalikan');
    Route::get('generate-pdf', 'PublicController@cetakRegisPdf');

    // monitoring
    Route::get('list-semua-perizinan', 'SuratController@listSemuaPerizinan');
    Route::get('list-perizinan-masuk', 'SuratController@listPerizinanMasuk');
    Route::get('list-perizinan-terlambat', 'SuratController@listPerizinanTerlambat');

    // ulasan
    Route::get('list-ulasan', 'UlasanController@getData');
    Route::get('detail-ulasan', 'UlasanController@getDetailData');



    // Surat Jenis
    Route::get('surat-jenis/', 'SuratJenisController@getData');

    // Surat Syarat
    Route::get('surat-syarat/', 'SuratSyaratController@getData');

    // Survey
    Route::get('list-survey', [SurveyController::class, 'getData']);



    Route::any('/listroom', 'ChatController@apilistroom');
    Route::any('/listchat', 'ChatController@apilistchat');
    Route::any('/sendchat', 'ChatController@apisendchat');
    Route::any('/countchat', 'ChatController@apicountchat');

    Route::any('loginpemohon', 'LoginPemohonController@loginApi');
    Route::any('registerpemohon', 'RegisterPemohonController@apiregister');

    Route::any('simpanulasan', 'ArsipController@simpanulasan');
});

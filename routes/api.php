<?php

use App\Http\Controllers\RiwayatSurveyController;
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
    Route::any('login', 'loginController@loginApi');
    Route::get('logout', 'loginController@logout');
    Route::get('profil', 'loginController@getProfil');


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
    Route::get('cetak-perizinan', 'PerizinanPemohonController@cetakPerizinan');


    // Penjadwalan ulang pemohon
    Route::post('acc-jadwal-survey', 'PerizinanPemohonController@pemohonAccJadwalSurvey');
    Route::post('tolak-jadwal-survey', 'PerizinanPemohonController@jadwalulang');

    // Verifikasi Hasil Survey
    Route::post('surat/verifikasi-survey', 'SuratController@approveHasilSurvey');
    Route::post('surat/tolak-survey', 'SuratController@tolakHasilSurvey');

    // monitoring
    Route::get('list-semua-perizinan', 'SuratController@listSemuaPerizinan');
    Route::get('list-perizinan-masuk', 'SuratController@listPerizinanMasuk');
    Route::get('list-perizinan-terlambat', 'SuratController@listPerizinanTerlambat');

    // ulasan
    Route::get('list-ulasan', 'UlasanController@getData');
    Route::get('detail-ulasan', 'UlasanController@getDetailData');

    // arsip
    Route::get('surat/arsip', 'SuratController@getDataArsip');


    // Surat Jenis
    Route::get('surat-jenis/', 'SuratJenisController@getData');

    // Surat Syarat
    Route::get('surat-syarat/', 'SuratSyaratController@getData');

    // Survey
    Route::get('list-survey', [SurveyController::class, 'getData']);
    Route::get('jadwal-penugasan/{id}', 'SurveyController@getDataBySurveyorId');
    Route::get('detail-form-laporan-survey/{id}', 'SurveyController@getDetailLaporanSurvey');
    Route::get('list-pertanyaan-survey', [SurveyController::class, 'getDataPertanyaanSurvey']);
    Route::post('kirim-laporan', 'SurveyController@submitFormLaporanPertama');
    Route::post('isi-survey', [SurveyController::class, 'isiSurvey']);

    // Riwayat Survey
    Route::get('jadwal-survey/{id}', 'RiwayatSurveyController@getDataBySurveyorId');
    Route::get('riwayat-penugasan/{id}', 'RiwayatSurveyController@getDataBySurveyorId');
    Route::get('detail-riwayat-penugasan/{id}', 'RiwayatSurveyController@getDetailData');
    Route::get('list-jawaban-survey/{id}', [RiwayatSurveyController::class, 'getDataJawabanSurvey']);
    Route::get('detail-hasil-survey/{id}', 'RiwayatSurveyController@getDetailDataHasilSurvey');


    // notification
    Route::get('/notifikasi', 'NotifikasiController@getData');
    Route::get('/detail-notifikasi', 'NotifikasiController@geDetailData');
    Route::get('/total-notifikasi', 'NotifikasiController@count_notifikasi');

    
    // audit
    Route::get('/list-audit', 'AuditController@getData');
    // Route::get('/detail-audit', 'AuditController@geDetailData');

    // terbitkan surat 
    Route::post('surat/terbitkan', 'SuratController@terbitkanSurat');

    






    Route::any('/listroom', 'ChatController@apilistroom');
    Route::any('/listchat', 'ChatController@apilistchat');
    Route::any('/sendchat', 'ChatController@apisendchat');
    Route::any('/countchat', 'ChatController@apicountchat');

    Route::any('loginpemohon', 'LoginPemohonController@loginApi');
    Route::any('registerpemohon', 'RegisterPemohonController@apiregister');

    Route::post('simpanulasan', 'ArsipController@simpanulasan');

    Route::post("apidoforgot", 'ForgotpasswordController@apidoforgot');

    Route::get("sendnotif", 'PushNotifController@apinotif');
});

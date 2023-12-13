<?php

use App\Http\Controllers\PenugasanSurveyController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'PublicController@index')->name('homepage');

Route::get('/buat-permohonan', 'PublicController@buatPermohonan')->name('buat-perizinan');
Route::get('/ajukan-perizinan', 'PublicController@ajukanPerizinan')->name('ajukan-perizinan');
Route::get('/ajukan-syarat-perizinan', 'PublicController@ajukanSyaratPerizinan')->name('ajukan-syarat-perizinan');
Route::post('/create-perizinan', 'PublicController@createPerizinan');
Route::get('/perizinan-berhasil-diajukan', 'PublicController@success')->name('pengajuan-berhasil');
Route::get('/generate-pdf', 'PublicController@cetakRegisPdf');
Route::get('/cetak-perizinan', 'PerizinanPemohonController@cetakPerizinan');

Route::get('/lacak-perizinan', 'PublicController@lacakPerizinan')->name('lacak-perizinan');
Route::post('/detail-perizinan', 'PublicController@detailPerizinan')->name('detail-perizinan');

Route::get('/permohonan-saya', 'PerizinanPemohonController@index')->name('list-perizinan');
Route::get('/get-data-perizinan', 'PublicController@getDataByJenis');

Route::get('perizinan', 'PerizinanPemohonController@index');
Route::get('perizinantable/{status}', 'PerizinanPemohonController@datatable');
Route::get('editperizinan', 'PerizinanPemohonController@edit');
Route::get('pemohonaccjadwalperizinan', 'PerizinanPemohonController@pemohonAccJadwalSurvey');
Route::get('jadwalulang', 'PerizinanPemohonController@jadwalulang');

Route::get('profil-pengguna', 'PublicController@profilPengguna');
Route::put('/profil-pengguna/{id}', 'PublicController@profilPenggunaUpdate')->name('profil-pengguna.update');

Route::get('ubah-password-pengguna', 'PublicController@indexUbahPassword');
Route::post('ubah-password-pengguna', 'PublicController@updatePassword');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/admin', 'loginController@admin')->name('admin');

    Route::get('login', 'loginController@authenticate')->name('login');
    Route::get('register', 'RegisterController@index')->name('register');
    Route::get('doregister', 'RegisterController@doregister')->name('doregister');
    Route::get("verification/{id}", 'VerificationController@index');
    Route::get("resendverification/{id}", 'VerificationController@resend');
    Route::get("doverification", 'VerificationController@doverification');
    Route::get("forgotpassword", 'ForgotpasswordController@index');
    Route::get("doforgot", 'ForgotpasswordController@doforgot');
    Route::get("forgotlink/{id}/{accesstoken}", 'ForgotpasswordController@forgotlink');
    Route::get("doforgotlink", 'ForgotpasswordController@doforgotlink');
    Route::get("forgotlogin/{id}", 'ForgotpasswordController@forgotlogin');

    Route::get("generatetagihan", 'TagihanController@generatetagihan');

    Route::get("tesemail", 'VerificationController@tesemail');
    // Route::post('login', 'loginController@authenticate')->name('login');

    Route::get('loginpemohon', 'LoginPemohonController@index');
    Route::get('loginpemohon/auth', 'LoginPemohonController@authenticate');
    Route::get('registerpemohon', 'RegisterPemohonController@index');
    Route::post('registerpemohon/register', 'RegisterPemohonController@register');
    Route::get('loginGoogle', 'LoginPemohonController@google');
});


Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'HomeController@index')->name('index');
Route::get('/pie-chart-data', 'HomeController@getPieChartData');

Route::get('logout', 'HomeController@logout')->name('logout');

Route::get('mastertagihan', 'MastertagihanController@index');
Route::get('mastertagihantable', 'MastertagihanController@datatable');
Route::get('simpanmastertagihan', 'MastertagihanController@simpan');
Route::get('hapusmastertagihan', 'MastertagihanController@hapus');
Route::get('editmastertagihan', 'MastertagihanController@edit');

Route::get('tagihan', 'TagihanController@index');
Route::get('tagihantable', 'TagihanController@datatable');
Route::get('bayartagihan', 'TagihanController@bayar');

Route::get('uangmasuk', 'UangmasukController@index');
Route::get('uangmasuktable', 'UangmasukController@datatable');
Route::get('simpanuangmasuk', 'UangmasukController@simpan');
Route::get('hapusuangmasuk', 'UangmasukController@hapus');
Route::get('edituangmasuk', 'UangmasukController@edit');

Route::get('uangkeluar', 'UangkeluarController@index');
Route::get('uangkeluartable', 'UangkeluarController@datatable');
Route::get('simpanuangkeluar', 'UangkeluarController@simpan');
Route::get('hapusuangkeluar', 'UangkeluarController@hapus');
Route::get('edituangkeluar', 'UangkeluarController@edit');

// Route::get("mutasi", "MutasiController@index");

Route::get("statistik", "StatistikController@index");
Route::get("getstatistik", "StatistikController@get");

Route::get('petugas', 'PetugasController@index');
Route::get('petugastable', 'PetugasController@datatable');
Route::get('editpetugas', 'PetugasController@edit');
Route::get('simpanpetugas', 'PetugasController@simpan');
Route::get('hapuspetugas', 'PetugasController@hapus');

Route::get('pemohon', 'PemohonController@index');
Route::get('pemohontable', 'PemohonController@datatable');
Route::get('editpemohon', 'PemohonController@edit');
Route::get('simpanpemohon', 'PemohonController@simpan');
Route::get('hapuspemohon', 'PemohonController@hapus');
Route::get('approvepemohon', 'PemohonController@approve');
Route::get('tolakpemohon', 'PemohonController@tolak');
Route::get('tolakprocesspemohon', 'PemohonController@tolakprocess');

Route::get('surat-jenis', 'SuratJenisController@index');
Route::get('suratjenistable', 'SuratJenisController@datatable');
Route::get('editsuratjenis', 'SuratJenisController@edit');
Route::get('simpansuratjenis', 'SuratJenisController@simpan');
Route::get('hapussuratjenis', 'SuratJenisController@hapus');

Route::get('surat-syarat', 'SuratSyaratController@index');
Route::get('suratsyarattable/{surat_jenis_id}', 'SuratSyaratController@datatable');
Route::get('suratsyarattableall', 'SuratSyaratController@datatableNoFilter');
Route::get('editsuratsyarat', 'SuratSyaratController@edit');
Route::get('simpansuratsyarat', 'SuratSyaratController@simpan');
Route::get('hapussuratsyarat', 'SuratSyaratController@hapus');

Route::get('chatbot', 'ChatbotController@index');
Route::post('chatbot/save', 'ChatbotController@save');


Route::get('surat', 'SuratController@index');
Route::get('surattable/{status}', 'SuratController@datatable');
Route::get('editsurat', 'SuratController@edit');
Route::get('validasisurat', 'SuratController@validasi');
Route::get('kembalikansurat', 'SuratController@kembalikan');
Route::get('pemohonaccjadwalsurat', 'SuratController@pemohonAccJadwalSurvey');

// Route::get('simpansuratsyarat', 'SuratSyaratController@simpan');
// Route::get('hapussuratsyarat', 'SuratSyaratController@hapus');

// Survey
Route::get('survey/jadwal', 'SurveyController@index');
Route::get('surveyjadwaltable', 'SurveyController@datatable');
Route::get('simpansurveyjadwal', 'SurveyController@simpan');
Route::get('editsurveyjadwal', 'SurveyController@edit');

Route::get('survey/penugasan', 'PenugasanSurveyController@index');
Route::get('surveypenugasantable', 'PenugasanSurveyController@datatable');
Route::get('simpansurveypenugasan', 'PenugasanSurveyController@simpan');
Route::get('editsurveypenugasan', 'PenugasanSurveyController@edit');
Route::get('survey/penugasan/laporan/{id}',  [PenugasanSurveyController::class, 'laporan']);
Route::post('kirim-laporan', 'SurveyController@submitFormLaporanPertama');

Route::get('survey/penugasan/laporan/{id}/form-pertanyaan-survey', 'PenugasanSurveyController@laporanPertanyaanSurvey');
Route::post('isi-survey', [SurveyController::class, 'isiSurvey']);

Route::get('detail-form-laporan-survey/{id}', 'SurveyController@getDetailLaporanSurvey');



// Arsip
Route::get('arsip', 'ArsipController@index');
Route::get('arsiptable/{jenis_surat}', 'ArsipController@datatable');
Route::get('editarsip', 'ArsipController@edit');

//Ulasan
Route::get('simpanulasan', 'ArsipController@simpanulasan');
Route::get('ulasan', 'UlasanController@index');
Route::get('ulasantable', 'UlasanController@datatable');

//audit
Route::get('simpanaudit', 'AuditController@simpan');
Route::get('audit', 'AuditController@index');
Route::get('audittable', 'AuditController@datatable');



Route::get('/chat', 'ChatController@index');
Route::get('/listroom', 'ChatController@listroom');
Route::get('/listchat', 'ChatController@listchat');
Route::get('/sendchat', 'ChatController@sendchat');

}); // End Route Groub middleware auth

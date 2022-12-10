<?php

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
// Route::get('sismadak', function () {   return view('sismadak');   });
// Route::get('eklaim', function () {   return view('eklaim');   });

Route::get('admin/charts', function () {   return view('page.admin.charts');   });
Route::get('admin/elements', function () {   return view('page.admin.elements');   });
Route::get('admin/icons', function () {   return view('page.admin.icons');   });
Route::get('admin/notifications', function () {   return view('page.admin.notifications');   });
Route::get('admin/page-lockscreen', function () {   return view('page.admin.page-lockscreen');   });
Route::get('admin/page-login', function () {   return view('page.admin.page-login');   });
Route::get('admin/page-profil', function () {   return view('page.admin.page-profil');   });
Route::get('admin/panels', function () {   return view('page.admin.panels');   });
Route::get('admin/tables', function () {   return view('page.admin.tables');   });
Route::get('admin/typography', function () {   return view('page.admin.typography');   });

// Login GET
Route::get('/admin/login', 'Auth\LoginController@showAdminLoginForm')->name('view.login.admin');
Route::get('/direktur/login', 'Auth\LoginController@showDirekturLoginForm')->name('view.login.direktur');
Route::get('/farmasi/login', 'Auth\LoginController@showFarmasiLoginForm')->name('view.login.farmasi');
Route::get('/kantor/login', 'Auth\LoginController@showKantorLoginForm')->name('view.login.kantor');
Route::get('/rm/login', 'Auth\LoginController@showRMLoginForm')->name('view.login.rm');
Route::get('/keuangan/login', 'Auth\LoginController@showKeuanganLoginForm')->name('view.login.keuangan');
Route::get('/kebidanan/login', 'Auth\LoginController@showKebidananLoginForm')->name('view.login.kebidanan');
Route::get('/other_role/login', 'Auth\LoginController@showOtherRoleLoginForm')->name('view.login.other.role');

// Login POST
Route::post('/admin/login', 'Auth\LoginController@loginAdmin')->name('post.login.admin');
Route::post('/direktur/login', 'Auth\LoginController@loginDirektur')->name('post.login.direktur');
Route::post('/farmasi/login', 'Auth\LoginController@loginFarmasi')->name('post.login.farmasi');
Route::post('/kantor/login', 'Auth\LoginController@loginKantor')->name('post.login.kantor');
Route::post('/rm/login', 'Auth\LoginController@loginRM')->name('post.login.rm');
Route::post('/keuangan/login', 'Auth\LoginController@loginKeuangan')->name('post.login.keuangan');
Route::post('/kebidanan/login', 'Auth\LoginController@loginKebidanan')->name('post.login.kebidanan');
Route::post('/other_role/login', 'Auth\LoginController@loginOtherRole')->name('post.login.other.role');

// Logout PASS
Route::post('/logout', 'Auth\LoginController@logout')->name('post.logout');

// Home Default Laravel
Route::get('/home', 'HomeController@index')->name('home');

// API
    // ANTROL
    Route::get('/api/antrol','KunjunganController@apiAntrol')->name('api.antrol');
    Route::get('/api/antrol/display','KunjunganController@apiDisplayAntrol')->name('api.displayAntrol');
    Route::get('/api/jadwaldokter','KunjunganController@apiJadwalDokter')->name('api.jadwaldokter');
    // LAB
    Route::get('/api/all/{rm}','KunjunganController@apiAll')->name('all.api');
    // CEKLIST IBS
    Route::get('/api/pilar/{rm}','KunjunganController@apiCariRM')->name('carirm.api');
    Route::get('/api/pilar/batalperiksa/{rm}','KunjunganController@apiBatalPeriksa')->name('batalperiksa.api');
    Route::get('/api/kunjungan','KunjunganController@apikunjungan')->name('kunjungan.api');
    Route::get('/api/kamar','PasienController@apikamar')->name('kamar.api');
    // PPI
    Route::get('/api/rm/{rm}','KunjunganController@apirm')->name('api.rm');
    Route::get('/api/rmpoli/{rm}','KunjunganController@apirmpoli')->name('api.rmpoli');
    // Route::get('/api/rmpoli/{rm}/poli/{poli}','KunjunganController@apigetrmpoli')->name('api.getrmpoli');

// Page Admin
Route::middleware(['auth'])->prefix('admin')->group(function (){
    Route::get('/', function(){return view('page.admin.dashboard');})->name('admin.dashboard');
    Route::get('/dashboard', function(){return view('page.admin.dashboard');})->name('admin.dashboard');
});


// Page Direktur
Route::middleware(['auth:direktur'])->prefix('direktur')->group(function (){
    // Route::get('/', function(){return view('page.direktur.dashboard');})->name('direktur.dashboard');
    Route::get('/dashboard', function(){return view('page.direktur.dashboard');})->name('direktur.dashboard');
    // Route::get('/dashboard', 'KunjunganController@index')->name('direktur.dashboard');
    Route::get('/rekapharian', 'KunjunganController@index')->name('direktur.rekapharian');
    Route::get('/rekapharian/cari', 'KunjunganController@filterKunjungan')->name('direktur.rekapharian.cari');
    Route::get('/kamar', 'KamarController@index')->name('direktur.kamar');
    Route::get('/cetakpdf','KunjunganController@generatePDF')->name('direktur.cetak');
    Route::get('/cetakpdfold','KunjunganController@generatePDFold')->name('direktur.cetakold');
});

// Page Farmasi
Route::middleware(['auth:farmasi'])->prefix('farmasi')->group(function (){
    Route::get('/', function(){return view('page.farmasi.dashboard');})->name('farmasi.dashboard');
    Route::get('/dashboard', function(){return view('page.farmasi.dashboard');})->name('farmasi.dashboard');
    Route::get('/lisinopril', 'PelayananController@obatLisinopril')->name('farmasi.lisinopril');
    Route::get('/tanapres', 'PelayananController@obatTanapres')->name('farmasi.tanapres');
    Route::get('/captopril', 'PelayananController@obatCaptopril')->name('farmasi.captopril');
});

// Page RM
Route::middleware(['auth:rm'])->prefix('rm')->group(function (){
    // Route::get('/', function(){return view('page.rm.dashboard');})->name('rm.dashboard');
    Route::get('/dashboard', 'RekamMedikController@index')->name('rm.dashboard');
    Route::get('/rekapusia', 'RekamMedikController@rekapUsia')->name('rm.rekapusia');
    Route::get('/rekapusia/poli', 'RekamMedikController@rekapUsiaPoli')->name('rm.rekapusiapoli');
    Route::get('/rekapusia/cetak', 'RekamMedikController@cetakRekapUsia')->name('rm.rekapusia.cetak');
    Route::get('/rekapusia/old', 'RekamMedikController@kunjunganPasienOld')->name('rm.rekapusiaold');
    Route::get('/rekapusia/old/cetak', 'RekamMedikController@cetakRekapUsiaold')->name('rm.rekapusiaold.cetak');
});

// Page Kantor
Route::middleware(['auth:kantor'])->prefix('kantor')->group(function (){
    Route::get('/', function(){return view('page.kantor.dashboard');})->name('kantor.dashboard');
    Route::get('/dashboard', function(){return view('page.kantor.dashboard');})->name('kantor.dashboard');
    Route::resource('/rapat', 'KantorController');
    // Route::get('/download/{id}', 'KantorController@download')->name('rapat.download');
    // Route::post('rapat/create/upload', 'KantorController@upload')->name('rapat.upload');
});

// Page Keuangan
Route::middleware(['auth:keuangan'])->prefix('keuangan')->group(function (){
    Route::get('/', function(){return view('page.keuangan.dashboard');})->name('keuangan.dashboard');
    Route::get('/dashboard', function(){return view('page.keuangan.dashboard');})->name('keuangan.dashboard');
});

// Page Kebidanan
Route::middleware(['auth:kebidanan'])->prefix('kebidanan')->group(function (){
    Route::get('/', function(){return view('page.kebidanan.dashboard');})->name('kebidanan.dashboard');
    Route::get('/dashboard', function(){return view('page.kebidanan.dashboard');})->name('kebidanan.dashboard');
    Route::get('/skl', function(){return view('page.kebidanan.skl');})->name('kebidanan.skl');
});

// Page Other_Role
Route::middleware(['auth:other_role'])->prefix('other_role')->group(function (){
    Route::get('/', function(){return view('page.other-role.dashboard');})->name('other.role.dashboard');
    Route::get('/dashboard', function(){return view('page.other-role.dashboard');})->name('other.role.dashboard');
});

// Page Guest
Route::get('/', function () {
    return view('page.guest.landing-page');
});
Route::get('/infokamar', 'PasienController@index')->name('info.kamar');

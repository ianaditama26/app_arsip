<?php 
use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardAdminController@index');

// * table
Route::resource('master/table', 'm_table\MasterTableController');

// * npwp
Route::resource('master-npwp', 'npwp\NpwpController');
Route::get('dt/npwp', 'npwp\NpwpController@dtNpwp')->name('dt.npwp');
Route::post('/import/npwp', 'npwp\NpwpController@importNpwp')->name('npwp.import');

// * spt
Route::resource('master/spt', 'spt\SptController');
Route::get('/dt-spt', 'spt\SptController@dtSpt')->name('dt.spt');
Route::post('import/spt', 'spt\SptController@import')->name('spt.import');
Route::post('export/spt', 'spt\SptController@export')->name('spt.export');

// * check NPWP
Route::post('/spt/check/npwp', 'npwp\NpwpController@checkNpwp')->name('spt.checkAvailableNpwp');

// * jenis pajak
Route::resource('pajak', 'taxType\TaxTypeController');

// * Non spt
Route::resource('master/non-spt', 'nonSpt\NonSptController');
Route::get('/dt-nonSpt', 'nonSpt\NonSptController@dtNonSpt')->name('dt.nonSpt');
Route::post('import/non-spt', 'nonSpt\NonSptController@importNonSpt')->name('non-spt.import');
Route::post('export/non-spt', 'nonSpt\NonSptController@exportNonSpt')->name('non-spt.export');

// * user
Route::resource('user', 'user\UserController');

// * Peminjaman
Route::resource('peminjaman', 'borrowing\BorrowingController');
Route::delete('/spt/hapus-file/{id}', 'borrowing\BorrowingController@destroyFile');
Route::get('dt/peminjaman', 'borrowing\BorrowingController@dtBorrowing')->name('dt.borrowing');

// * kembalikan
route::get('kembalikan/spt/{id}', 'borrowing\BorrowingController@kembalikanPerSpt')->name('kembalikan.spt');
Route::post('/pengembalian/{id}', 'borrowing\BorrowingController@pengembalian');

// * riwayat
Route::get('riwayat/peminjaman', 'borrowing\BorrowingController@riwayat')->name('riwayat.peminjaman');
Route::get('dt/riwayat/peminjaman', 'borrowing\BorrowingController@dtRiwayat')->name('dt.riwayat');
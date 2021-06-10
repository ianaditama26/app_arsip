<?php  
use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardEmployeeControllrt@index');
Route::resource('master/spt', 'SptController');
Route::get('/dt-spt', 'SptController@dtSpt')->name('dt.spt');
// * check NPWP
Route::post('/spt/check/npwp', 'SptController@checkNpwp')->name('spt.checkAvailableNpwp');

// * Non spt
Route::resource('master/non-spt', 'NonSptController');
Route::get('/dt-nonSpt', 'NonSptController@dtNonSpt')->name('dt.nonSpt');
Route::post('import/non-spt', 'NonSptController@importNonSpt')->name('non-spt.import');
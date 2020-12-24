<?php
use Illuminate\Http\Request;
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

// Route::get('/', 'Backend\WebsiteController@edit')->name('website.edit');
// Route::post('/', 'Backend\WebsiteController@update')->name('website.update');

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/', function () {
//         return view('frontend.index');
//     })->name('home');
//     Route::get('store', function () {
//         return view('frontend.store');
//     })->name('store');
// });
// Route::get('about', function () {
//     return view('frontend.about');
// })->name('about');

// Route::get('products', function () {
//     return redirect()->route('admin::store');
// })->name('products');

// Route::resource('photo', 'PhotoController');

// Route::resource('test', 'TestController');
Route::post('/EN', '_Backstage\EN@index');
Route::get('/EN', '_Backstage\EN@index'); //取XSRF-TOKEN
Route::get('/', '_Backstage\EN@index');
Route::get('/XlMemTzAitUmm77oX0ga/{sn?}',function($sn=""){
    $app=App::make('App\Http\Controllers\_Backstage\Login');
    return $app->index($sn);
});
// Route::get('/XlMemTzAitUmm77oX0gasn/{sn}', "_Backstage\\".$sn."@index");
Route::get('/XlMemTzAitUmm77oX0gasn/{function}-{action}',  function($function,$action,Request $request){
    $app=App::make('App\Http\Controllers\_Backstage\Action\\'.$function.'\\'.$action);
    return $app->index($request,$function,$action);
    //->index(1)
});

//----------------------------
Route::resource('login', 'LoginController');
Route::resource('Main', 'MainController');
Route::get('', function ($n=404,$msg='') {

     return view('errors.errors'.$n,['msg' => $msg]);
})->name('error');;
//---------------------------------



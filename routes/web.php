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

Route::get('/EN', '_Backstage\EN@index'); //取XSRF-TOKEN
//-----------------------------------------------------------------------
Route::post('/EN', '_Backstage\EN@index');

// Route::get('/', '_Backstage\EN@index');
Route::get('/'.config('sys.DIR_CODE').'/{sn?}',function($sn=""){
    $app=App::make('App\Http\Controllers\_Backstage\Login');
    return $app->index($sn);
});
// Route::get(config('sys.DIR_CODE_sn').'/{function}-{action}',  function($function,$action,Request $request){
//     $app=App::make('App\Http\Controllers\_Backstage\Action\\'.$function.'\\'.$action);
//     return $app->index($request,$function,$action);
// })->middleware('CheckAuth');
// Route::post(config('sys.DIR_CODE_sn').'/{function}-{action}',  function($function,$action,Request $request){
//     $app=App::make('App\Http\Controllers\_Backstage\Action\\'.$function.'\\'.$action);
//     return $app->exeAjax($request);
// });

Route::group(['prefix' => config('sys.DIR_CODE_sn').'/{function}-{action}','middleware' => 'CheckAuth'], function () {
    Route::get('/', function($function,$action,Request $request){
        $app=App::make('App\Http\Controllers\_Backstage\Action\\'.$function.'\\'.$action);
        return $app->show($request,$function,$action);
    });
    Route::post('/', function($function,$action,Request $request){
        $app=App::make('App\Http\Controllers\_Backstage\Action\\'.$function.'\\'.$action);
        return $app->exeAjax($request);
    });
});


// Route::get('/XlMemTzAitUmm77oX0gasn/{sn}', "_Backstage\\".$sn."@index");
// Route::get('/XlMemTzAitUmm77oX0gasn/{function}-{action}',  function($function,$action,Request $request){
//     $app=App::make('App\Http\Controllers\_Backstage\Action\\'.$function.'\\'.$action);
//     return $app->index($request,$function,$action);
//     //->index(1)
// });

Route::fallback(function () {
    return view('errors.errors404',['msg' => '']);
})->name('error');

Route::post('error',function ($n,$msg) {
    return view('errors.errors'.$n,['msg' => $msg]);
})->name('error');

//----------------------------


Route::post('', function () {

});
//---------------------------------
Route::get('/test', function(){
    return view('index',['msg' => 1]);
});
Route::get('/test2', function(){
    return view('index2',['msg' => 1]);
});

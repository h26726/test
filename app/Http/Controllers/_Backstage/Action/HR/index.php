<?php
namespace App\Http\Controllers\_Backstage\Action\HR;
use Illuminate\Http\Request;
use App\Models\UserAuth;
use App\Models\UserAccount;
require_once(config('sys.PATH_HOME').'app/Http/base.php');
class Index extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {

    }
    public function index($request,$function,$action)
    {
        $checkData=checkAuth($function,$action); //正確返回 [0,$meun] 錯誤返回 [404,$message]
        if($checkData[0]){
            return abort($checkData[0],$checkData[1]);
        }
        $menu=$checkData[1]; //導入左側選單
        $Auth=0;
        $sign="";
        $_power=true;
        switch ($Auth) {
            case '1':
            case '4':
            case '2':
                $_power=true;
            break;
            default:
                break;
        }
        $_oldsign = $sign;
        $cc=$request->input('cc','');
        if($cc!=''){
            // CleanSign();
            // Redirect('index');
        }else{
            $sign = $request->input('sign','');
            if($sign!=''){
                setcookie("sign", $sign, 0, "/");
                // Redirect('index');
            }
        }
        return view('index',[
            'oldsign' => $_oldsign,
            'power'   => $_power,
        ]);
    }







}



?>

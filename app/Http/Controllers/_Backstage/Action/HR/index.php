<?php
namespace App\Http\Controllers\_Backstage\Action\HR;
use Illuminate\Http\Request;
use App\Models\db\UserAuth;
use App\Models\db\UserAccount;
class index extends \App\Http\Controllers\_Backstage\Action\BaseAction
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function show($request,$function,$action)
    {
        return view('index', $this->assignData());
    }

    function exeAjax($request){
        switch ($request->input('cmd','')) {
            case 'useSign':
                $this->returnData=$this->changeSign($request->input('data',''));
                break;
            case 'clearSign':
                setcookie("sign", '', -3600, "/");
                break;
            default:
                $this->errorCode=1;
                $this->errorMsg='E001';
                break;
        }
        return $this->ReturnJson();
    }

    function changeSign($input){

        if(!array_key_exists('sign',$input) || $input['sign']==='' || $input['sign']===null)
        {
            setcookie("sign", '', -3600, "/");
            $this->errorCode=1;
            $this->errorMsg='E002';
            return array();
        }
        setcookie("sign", $input['sign'], 0, "/");
        return array('sign'=>$input['sign']);
    }








}



?>

<?php
namespace App\Http\Controllers\_Backstage\Action;
use Illuminate\Http\Request;
use App\Models\db\UserAuth;
use App\Models\db\UserAccount;
require_once config('sys.PATH_STAGE').'/base/ServerInfo.php';


abstract class BaseAction extends \App\Http\Controllers\Controller
{
    protected $title="HR System";
    protected $function="";
    protected $action="";
    protected $nickName;
    protected $Uid;
    protected $Uname;
    protected $sn;
    protected $sign="";
    protected $assign=array();
    protected $AUTH;
    protected $powerText;
    protected $errorCode=0;
    protected $errorMsg="";
    protected $returnData=array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(Request $request) {
        $this->function=$request->get('function');  //從通過的中介層撈資料
        $this->action=$request->get('action');
        $this->Uid=$request->get('Uid');
        $this->Uname=$request->get('Uname');
        $this->sn=$request->get('sn');
        $this->AUTH=$request->get('AUTH');
        $this->nickName=$request->get('nickName');
        $this->powerText=$request->get('powerText');
        if(array_key_exists("sign",$_COOKIE)){
			$this->sign = $_COOKIE["sign"];
        }
    }

    abstract function show($request,$function,$action);
    abstract function exeAjax($request);

    function GetAuthorization($power)
	{
		$menu = ServerInfo();
		foreach ($menu as $key => $dir) {

			if(!isset($power[$dir[2]]))
			{
				unset($menu[$key]);
				continue;
			}

			foreach ($dir[0] as $k => $sub)
			{

				if(!isset($power[$dir[2]][$sub[0]]))
				{
					unset($menu[$key][0][$k]);
				}
				elseif(!$sub[2])
					unset($menu[$key][0][$k]);
			}

			if(count($menu[$key][0]) == 0)
				unset($menu[$key]);
		}

		$menu = array_values($menu);
		return $menu;
    }
    function getPowerEnable(){
        $power=false;
        switch ($this->AUTH) {
            case '1':
            case '4':
            case '2':
                $power=true;
            break;
            default:
                break;
        }
        return $power;
    }

    function assignData(){
        $menu=$this->GetAuthorization($this->powerText);
        $powEnable=$this->getPowerEnable();
        $SetData=array(
            "TITLE"=>$this->title,
            "function"=>$this->function,
            "action"=>$this->action,
            "sn"=>$this->sn,
            "nickName"=>$this->nickName,
            "sign"=>$this->sign,
            "AUTH"=>$this->AUTH,
            "menu"=>$menu,
            "powEnable"=>$powEnable,
            "errorCode"=>$this->errorCode,
            "errorMsg"=>$this->errorMsg,
        );
        $this->assign=array_merge($this->assign,$SetData);
        return $this->assign;
    }

    function setInOutstandard($request,&$cmd,&$inputData){
        $cmd=$request->input('cmd','');
        $inputData=$request->input('data','');
    }

    function ReturnJson(){
        return json_encode(array('ErrorCode' => $this->errorCode, 'ErrorMessage' => $this->errorMsg, 'Data' => $this->returnData));
    }

    function isHRSysAUTH(){
        if($this->AUTH===2 || $this->AUTH===4) return true;
    }








}



?>

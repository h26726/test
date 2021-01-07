<?php
namespace App\Http\Controllers\_Backstage;
use Illuminate\Http\Request;

class Outside extends \App\Http\Controllers\Controller
{

    public function index(Request $request)
    {
        $DIR_CODE_sn=config('sys.DIR_CODE_sn');
        $dir=config('sys.HOSTURL').config('sys.DIR_CODE_sn').'/HR-index';
        return view('Outside',['DIR_CODE_sn'=>$DIR_CODE_sn,'dir'=>$dir]);
    }
}

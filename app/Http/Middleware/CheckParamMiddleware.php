<?php

namespace App\Http\Middleware;

use Closure;
class CheckParamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $input = request()->all();
        $check=$this->checkBanWord($input);
        if(!$check)return response()->view('errors.errors403',['msg' => 'CheckERROR']);
        return $next($request);
    }

    private function checkBanWord($input){
        $noword=array('select','insert','update','delete','union','into','load_file','outfile','script','drop','http','truncate','having','shutdown','orderby');
        foreach ($input as $k => $v) {
            if(is_array($v)){
                $this->checkBanWord($v);
            }
            else{
                foreach ($noword as  $e) {
                    $Check=stristr($v,$e);
                    if($Check!=false){
                        return false;
                    }
                }
            }
        }
        return true;
    }
}

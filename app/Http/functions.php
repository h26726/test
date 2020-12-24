<?php

function GetCodeMap()
	{
		$map = array(
			'N','V','a','5','4','1','x','y','Q','b','U','c','M','O','R','J','K','j','C','h','l','S','u','v','w','E','L','6','e','T','Y','F','i','3','G','k','I','f','B','z','W','X','D','A','0','m','n','H','2','P','o','p','q','r','s','t','d','7','Z'
		);
		return $map;
	}
function IntToCodeString20($int){
    $arr = array();
    $bit = 20;
    $map = GetCodeMap();
    $unit = count($map);
    $c = ($int - ( $int % $unit)) / $unit;
    $arr[] = ( $int % $unit);
    while($c){
        $b = $c % $unit;
        $c = ($c - $b) / $unit;
        $arr[] = $b;
    }
    //'4',
    if(count($arr) < $bit)
        $arr[] = -1;
    while(count($arr) < $bit)
        $arr[] = -2;
    $arr = array_reverse($arr);
    $out = '';
    foreach ($arr as &$value)
    {
        if($value==-1){
            $out .= 'g';
        }
        else if($value==-2){
            $out .= $map[rand(0,count($map)-1)];
        }
        else{
            $out .= $map[$value];
        }
    }
    return $out;
}

function GetClientIP(){
    if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $UserIP=$_SERVER["HTTP_X_FORWARDED_FOR"];
        if(strpos($UserIP,',')!==false)
        {
            $UserIP = substr($UserIP,0,strpos($UserIP,','));
        }
    }else if(isset($_SERVER["REMOTE_ADDR"])){
        $UserIP = $_SERVER["REMOTE_ADDR"];
    }
    return trim($UserIP);
}



function abort($n,$msg){
    return view('errors.errors'.$n,['msg' => $msg]);
}
?>

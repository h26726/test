<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('checklogin');
    }
    public function index()
    {
        $data=Main::display();
        return view('test.Main', ['data' =>$data]);
    }


}

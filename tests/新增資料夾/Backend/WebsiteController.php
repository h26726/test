<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Website;

class WebsiteController extends Controller
{



    public function edit()
    {

        $website = Website::acc()->bcc()->get();
        if (empty($website))
            return view('frontend.index');
        else
        {
            // $website->win_rate = 0;
            // $website->save();
            return view('frontend.about', compact('website'));
        }
    }

    public function update(Request $request)
    {
        // ...
    }
}

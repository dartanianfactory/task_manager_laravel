<?php

namespace App\Http\Controllers\Web;

use App\Models\Common\GlobalSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebPagesController extends Controller
{
    public function home(Request $request)
    {
        return view('pages.common.home', []);
    }
}

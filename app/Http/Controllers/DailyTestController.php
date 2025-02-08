<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyTestController extends Controller
{

    public function hhmdLayout()
    {
        return view('daily-test.hhmd');
    }

    public function xraycabinLayout()
    {
        return view('daily-test.xraycabin');
    }

    public function xraybagasiLayout()
    {
        return view('daily-test.xraybagasi');
    }

    public function wtmdLayout()
    {
        return view('daily-test.wtmd');
    }

}

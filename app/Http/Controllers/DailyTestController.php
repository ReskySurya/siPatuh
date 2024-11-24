<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyTestController extends Controller
{
    public function pscpCabinUtara()
    {
        return view('daily-test.x-ray.pscpcabin.pscpcabinutara');
    }

    public function pscpCabinSelatan()
    {
        return view('daily-test.x-ray.pscpcabin.pscpcabinselatan');
    }

    public function hbscpBagasiBarat()
    {
        return view('daily-test.x-ray.hbscpbagasi.hbscpbagasibarat');
    }

    public function hbscpBagasiTimur()
    {
        return view('daily-test.x-ray.hbscpbagasi.hbscpbagasitimur');
    }

    public function wtmdPosTimur()
    {
        return view('daily-test.wtmd.wtmdpostimur');
    }

    public function wtmdPscpUtara()
    {
        return view('daily-test.wtmd.wtmdpscputara');
    }

    public function wtmdPscpSelatan()
    {
        return view('daily-test.wtmd.wtmdpscpselatan');
    }

    public function hhmdLayout()
    {
        return view('daily-test.hhmd');
    }

}

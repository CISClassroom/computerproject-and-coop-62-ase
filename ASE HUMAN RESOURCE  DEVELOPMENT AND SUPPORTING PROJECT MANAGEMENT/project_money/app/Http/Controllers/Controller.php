<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public function newplan ()
{
    return view('newplan');
}
public function document ()
{
    return view('document');
}

public function Budget ()
{
    return view('Budget');
}
public function dean ()
{
    return view('dean');
}

public function detail ()
{
    return view('detail');
}

public function staff()
{
    return view('pages.staff', ['results' => results::all()]);
}

    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}





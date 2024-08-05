<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class StaterkitController extends Controller
{
    // home
    public function home()
    {
        return view('content.home');
    }

    // Empty Layout
    public function layout_empty()
    {
        abort_if(Gate::denies('layout.empty.index'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('/content/layout-empty');
    }

}
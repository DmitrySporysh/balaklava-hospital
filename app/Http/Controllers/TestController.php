<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facade;
use Debugbar;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function test()
    {
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        return "fsdgdf";
    }
}

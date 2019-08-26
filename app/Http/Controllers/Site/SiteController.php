<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index (){

        return view('site.index');
        
    }

    public function contato (){

        return view('site.pages.contato');

    }

    public function empresa (){

        return view('site.pages.empresa');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function getIndexPage(){
    	return view('index');
    }
     public function getAboutPage(){
    	return view('pages.about');
    }
}

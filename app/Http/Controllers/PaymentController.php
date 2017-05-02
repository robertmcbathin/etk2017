<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;

class PaymentController extends Controller
{
    public function getBalancePage(){
      return view('pages.balance');
}
}

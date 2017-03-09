<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;

class PaymentController extends Controller
{

    public function getBalancePage(){
    	$tmp = new Balance('admin','1');
    	$nameSpace = "http://schemas.xmlsoap.org/soap/envelope/";
    	$userT = new \SoapVar($username, XSD_STRING, NULL, $nameSpace, NULL, $nameSpace);
    	$passwT = new \SoapVar($password, XSD_STRING, NULL, $nameSpace, NULL, $nameSpace);
    	$uuT = new \SoapVar($tmp, SOAP_ENC_OBJECT, NULL, $nameSpace, 'UsernameToken', $nameSpace);
      return view('pages.balance');
}
}

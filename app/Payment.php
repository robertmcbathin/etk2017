<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \SoapClient;
use \SoapServer;

class Payment extends SoapClient
{


    function __construct($wsdl, $options) {
    	parent::__construct($wsdl, $options);
        $this->server = new SoapServer($wsdl, $options);
	}
    
	function __doRequest($request, $location, $action, $version, $one_way = 0){
		return parent::__doRequest($request, $location, $action, $version, $one_way = 0);
	}

}

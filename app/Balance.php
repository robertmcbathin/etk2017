<?php

namespace App;

class Balance extends \SoapClient
{
	/*private $username; //Name must be  identical to corresponding XML tag in SOAP header
    private $password; // Name must be  identical to corresponding XML tag in SOAP header 
    function __construct($username, $password) {
 	  $this->username=$username;
 	  $this->password=$password;
    }*/
  function __doRequest($request, $location, $action, $version,$one_way = 0) {
  }
}

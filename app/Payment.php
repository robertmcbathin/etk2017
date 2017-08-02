<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \SoapClient;
use \SoapServer;

class Payment extends SoapClient
{
	protected $request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://umarsh.ru/sdp/servicepojo"> 
   <soapenv:Header> 
         <wsse:Security soapenv:mustUnderstand="0" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"> 
         <wsse:UsernameToken xmlns:wsu="..."> 
            <wsse:Username>admin</wsse:Username> 
            <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">1</wsse:Password> 
         </wsse:UsernameToken> 
      </wsse:Security> 
      </soapenv:Header> 
   <soapenv:Body> 
      <ser:CardInfoRequest> 
         <ser:agentId>7</ser:agentId> 
         <ser:salepointId>7</ser:salepointId> 
         <ser:version>1</ser:version> 
         <ser:sysNum>0100001148</ser:sysNum> 
         <ser:regionId>99</ser:regionId> 
         <!--Optional:--> 
         <ser:deviceId>B9900007</ser:deviceId> 
      </ser:CardInfoRequest> 
   </soapenv:Body> 
</soapenv:Envelope>';

    function __construct($wsdl, $options) {
    	parent::__construct($wsdl, $options);
        $this->server = new SoapServer($wsdl, $options);
	}
    
    function __doRequest($request,$location, $action, $version, $one_way = 0){
   		ob_start();
    	$this->server->handle($request);
    	$response = ob_get_contents();
    	ob_end_clean();
    	return $response;
    }

}

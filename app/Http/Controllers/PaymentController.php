<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;

class PaymentController extends Controller
{

    public function getBalancePage(){
    /*	$username = 'admin';
    	$password = '1';
    	$tmp = new Balance('admin','1');
    	$nameSpace = "http://schemas.xmlsoap.org/soap/envelope/";
    	$userT = new \SoapVar($username, XSD_STRING, NULL, $nameSpace, NULL, $nameSpace);
    	$passwT = new \SoapVar($password, XSD_STRING, NULL, $nameSpace, NULL, $nameSpace);
    	$userToken = new \SoapVar($tmp, SOAP_ENC_OBJECT, NULL, $nameSpace, 
 'UsernameToken', $nameSpace);

    	$secHeaderValue=new \SoapVar($userToken, SOAP_ENC_OBJECT, NULL, $nameSpace, 
                    'Security', $nameSpace);
    	$secHeader = new \SoapHeader($nameSpace, 'Security', $secHeaderValue);*/
 $xml_request =    
    "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://umarsh.ru/sdp/servicepojo\">
<soapenv:Header>
<wsse:Security soapenv:mustUnderstand=\"0\" xmlns:wsse=\"http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd\">
<wsse:UsernameToken xmlns:wsu=\"...\">
<wsse:Username>admin</wsse:Username>
<wsse:Password Type=\"http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText\">1</wsse:Password>
</wsse:UsernameToken>
</wsse:Security>
</soapenv:Header>
<soapenv:Body>
<ser:CardInfoRequest>
<ser:agentId>0036</ser:agentId>
<ser:salepointId>0036</ser:salepointId>
<ser:version>1</ser:version>
<ser:sysNum>023333092</ser:sysNum>
<ser:regionId>21</ser:regionId>
<ser:deviceID>B0000001</ser:deviceID>
</ser:CardInfoRequest>
</soapenv:Body>
</soapenv:Envelope>";
$soap_request = new Balance(NULL, array('location' => "http://umarsh.ru/sdp/servicepojo",
                                     'uri'      => "http://umarsh.ru/sdp/servicepojo"));
$request = $soap_request->__doRequest($xml_request, "http://umarsh.ru/sdp/servicepojo", NULL, NULL, 0);
      return view('pages.balance', [
      	'request' => $xml_request
      	]);

}
}

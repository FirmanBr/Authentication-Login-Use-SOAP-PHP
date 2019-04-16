<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
ini_set("soap.wsdl_cache_enabled", 0);

error_reporting(0);

$context = stream_context_create(array(
  'ssl' => array(
      'verify_peer' => false,
      'allow_self_signed' => true
  )
));

$opt = array(
    "login" => "username",
    "password" => "password",
    "authentication" => SOAP_AUTHENTICATION_BASIC,
    "trace"      => true,
    "exceptions" => 1,
    "cache_wsdl" => WSDL_CACHE_NONE, 
    'stream_context' => $context,
    "connection_timeout" => 30,
    "location" => "header",
    "uri" => "lokasi_wsdl"
);

$url = "lokasi_wsdl";


try { 
  
  $soapClient = new SoapClient($url, $opt); 
  $something =  $soapClient->GetSOAPLPelaut();
  $arr = $something->GetSOAPLPelautResult->PLPelaut;

  foreach ($arr as $i) {
    echo "<br/>".$i->Seafarer ;
  }
  //var_dump($arr);
} 
catch (SoapFault $fault)
{
  var_dump($fault);

  exit;
}

?> 
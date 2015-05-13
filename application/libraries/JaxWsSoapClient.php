<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class JaxWsSoapClient extends SoapClient
{	//10.31.63.65
	private static $WSDL = "http://10.20.17.8:8080/NewWebService/NewWebService?WSDL";
	public function __construct()
	{
		try {
			parent::__construct(self::$WSDL, array('features' => SOAP_SINGLE_ELEMENT_ARRAYS));
		} catch(Exception $e) {
			//var_dump($e);
		}
	}
	
	public function __call($method, $arguments)
	{	
		$response = parent::__call($method, $arguments);
		return $response;
	}
	
	public function __soapCall ($function_name, $arguments, $options, $input_headers, &$output_headers)
	{
		$response = parent::__soapCall($function_name, $arguments, $options, $input_headers, $output_headers);
		return $response;
	}
	
}
?>
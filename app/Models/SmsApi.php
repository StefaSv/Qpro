<?php


namespace App\Models;


use GuzzleHttp\Client;

class SmsApi {

	static public function sendCallTel($phone)
	{
		$data = json_encode([
			"dstNumber" => $phone
		]);

		$time = time();
		$key = self::getKey('call-password/start-password-call',
		$time,"d761aea65257ee7f9905c3ef57eeb3407b810422289e66f9",
		$data,"6ce99ff634f63fe9332332f67a1d73c4938755dc17aac15f");

		$client = new Client();

		$result = $client->request('POST', 'https://api.new-tel.net/call-password/start-password-call', [
			"headers" 	=> ["Authorization" => "Bearer ".$key],
			'debug' 	=> false,
			"json" 		=> json_decode($data)
		]);
	
		$json   = json_decode($result->getBody());

		return $json->data;
	}


	static public function getKey($methodName, $time, $keyNewtel, $params, $writeKey)
	{
		return $keyNewtel.$time.hash("sha256",$methodName."\n".$time."\n".$keyNewtel."\n".$params."\n".$writeKey);
	}
}
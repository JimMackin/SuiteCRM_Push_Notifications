<?php
require 'custom/include/JSMPushNotification/PushService.php';

class PushBulletService implements PushService{
	public function push($subject, $message, $destUrl, SugarBean $recipient){
		
		$url = 'https://api.pushbullet.com/v2/pushes';
		$token = $recipient->pushbullet_token_c;
		$token = preg_replace("/[^A-Za-z0-9 ]/", '', $token);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, true);
		
		//TODO Header injection?
		curl_setopt($ch,CURLOPT_HTTPHEADER, array("Authorization: Bearer $token",'Content-Type: application/json'));
		$post = array(
			'type' => 'link',
			'title' => $subject,
			'body' => $message,
			'url' => $destUrl,
		);
		curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($post));
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
	}
}
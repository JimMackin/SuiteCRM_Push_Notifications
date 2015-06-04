<?php
interface PushService{
	
	public function push($subject, $message, $url, SugarBean $recipient);
}
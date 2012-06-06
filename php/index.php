<?php

require_once 'src/facebook.php';

$app_id = "";
$secret = "";
$app_url = "";

$facebook = new Facebook(array(
	'appid' => $app_id,
	'secret' => $secret		
));

$user = $facebook->getUser();

if(!$user)
{
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri' => $app_url ) );
	echo "<script>top.location.href= '$loginUrl';</script>";
}
else
{
	
}
<?php

require_once 'src/facebook.php';

$app_id = "373627332660806";
$secret = "1210eae527e200e61c65585612e98a38";
$app_url = "http://apps.facebook.com/comquemestudei/";

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
	try
	{
		$user_profile = $facebook->api("/me");
		$user_id =   $user_profile['id'];
		$user_name = $user_profile['name'];
		$user_link = $user_profile['link'];
	}
	catch (FacebookApiException $e)
	{
		echo $e;
		$user = null;
	}
}

?>
<html>
<head>
	<title>Facebook app - Com quem estudei</title>
</head>
<body>
	<pre>
	<?php print_r( $_REQUEST );?>
	</pre>
	<?php if( $user ) { ?>
	<h2>Welcome</h2>
	<a href="<?php echo $user_link; ?>">
	<img src="http://graph.facebook.com/<?php echo $user;?>/picture" alt="<?php echo $user_name; ?>" />
	</a><br />
	<?php echo $user_name; ?>
	<?php } else { ?>
		<strong>Você não aceitou que este app acessasse os seus dados. Redirecionando para a requisição de permissões.</strong>	
	<?php } ?>
</body>
</html>

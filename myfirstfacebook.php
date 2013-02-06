<html>
<head>
<title>Trying a facebook app</title>
</head>
<body>
<h1>Who aam I?</h1>
<?php
require("facebook.php");
define("FACEBOOK_APP_ID", '271737022956930');
define("FACEBOOK_SECRET_KEY", 'f815a0deb83a31f78959bffbecb53698');
$facebook = new Facebook(array('appId' => FACEBOOK_APP_ID, 'secret' => FACEBOOK_SECRET_KEY));
$uid = $facebook->getUser();
if(!$uid)
{$loginUrl = $facebook->getLoginUrl();
	echo "<script type='text/javascript'>top.location.href='$loginUrl';</script>";
	exit;
}

try {$uid = $facebook->getUser();
	print $uid;
	$user_profile = $facebook->api('/me','GET');
	echo "<br>First Name: " . $user_profile['first_name'];
	$profilepic= "https://graph.facebook.com/" . $user_profile['id']."/picture?type=large";
	echo "<p>URL Location of my facebook profile picture: ";
	echo $profilepic;
	$headers = get_headers($profilepic, 1);
	$url = $header['Location'];
	echo "<img src=\" $profilepic \"/>";
	echo "<p>";
	$friends = $facebook->api('/me/friends');
	echo'<ul>';
	foreach ($friends["data"] as $value){
		echo '<li>';
		echo '<div class="picName">'.$value["name"].'</div>';
		echo '</li>';
	}
	echo '</ul>';
} catch (FacebookApiException $e){
	print "in error exception";
	echo ($e);
}
?>
</body>
</html>

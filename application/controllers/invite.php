<?PHP
if(empty($_GET['mail']))
{
}
else
{
	$email = $_GET['mail'];
	$secreturl = MD5($email);
	$base = site_url();
	mysql_query("INSERT INTO invites (invited, invitedurl) VALUES ('$email', '$secreturl')");
	echo 'Generated URL for '.$email.'<br/> '.$base.'registration/index/'.$secreturl;
	//	$results = mysql_query("SELECT email FROM user WHERE email=$email");
}
?>

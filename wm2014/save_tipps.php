<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$spielid = $_POST['spielid'];
$spielzeit = $_POST['spielzeit'];

$tipp_h = $_POST['tipp_h'];
$tipp_g = $_POST['tipp_g'];

$tipp_sonder = $_POST['tipp_sonder'];
$tipp_sonder_text = $_POST['tipp_sonder_text'];

date_default_timezone_set("Europe/Berlin");
$now = date("Y-m-d H:i:s", time());
$timestamp = time();

global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

if($spielzeit > $timestamp)
{
	if ($spielid  < 70)
	{
		$wpdb->query("UPDATE wm2014_tipps SET tipp_h=$tipp_h, tipp_g=$tipp_g, datetime=now() WHERE userid=$userid AND spieleid=$spielid");
		echo $tipp_h.":".$tipp_g; 
	}
	else
	{
		$wpdb->query("UPDATE wm2014_tipps SET tipp_sonder=$tipp_sonder, datetime=now() WHERE userid=$userid AND spieleid=$spielid");
		echo $tipp_sonder_text; 
	}
}
else
{
	echo "zu spät!";
}
?>
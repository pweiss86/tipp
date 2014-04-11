<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$tipp_h = $_POST['tipp_h'];
$tipp_g = $_POST['tipp_g'];
$spielid = $_POST['spielid'];
$spielzeit = $_POST['spielzeit'];

date_default_timezone_set("Europe/Berlin");
$now = date("Y-m-d H:i:s", time());
$timestamp = time();

//echo $now;
//echo "<br>";
//echo $spielzeit;
//echo "<br>";
//echo $timestamp;
//echo "<br>";
//echo $tipp_h;
//echo "<br>";
//echo $tipp_g;
//echo "<br>";
//echo $spielid;
//echo "<br>";

global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

if($spielzeit > $timestamp)
{
	$wpdb->query("UPDATE em2012_tipps SET tipp_h=$tipp_h, tipp_g=$tipp_g, datetime=now() WHERE userid=$userid AND spieleid=$spielid");
	header( 'Location: http://www.pewei.de/?page_id=440' );
} 
else
{ 
	echo 'Das Spiel hat bereits begonnen, Pech gehabt...'; 
} 
?>
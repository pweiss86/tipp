<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$tipp_meister = $_POST['gastgeber'];
$spielid = 54;
$endzeit = 1339171200;

date_default_timezone_set("Europe/Berlin");
$timestamp = time();

//echo $endzeit;
//echo "<br>";
//echo $timestamp;
//echo "<br>";
//echo $tipp_meister;
//echo "<br>";
//echo $spielid;
//echo "<br>";

global $current_user;
get_currentuserinfo();

if($endzeit > $timestamp)
{
	$wpdb->query("REPLACE INTO em2012_tipps (userid, spieleid, tipp_meister, datetime) VALUES ($current_user->ID, $spielid, $tipp_meister, now())");
	header( 'Location: http://www.pewei.de/?page_id=297' );
} 
else
{ 
	echo 'Das erste Spiel hat bereits begonnen, Pech gehabt...'; 
} 
?>
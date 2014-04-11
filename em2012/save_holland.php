<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$tipp_sonder = $_POST['holland'];
$spielid = 71;
$endzeit = 1402603200;

date_default_timezone_set("Europe/Berlin");
$timestamp = time();

global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

if($endzeit > $timestamp)
{
	$wpdb->query("UPDATE em2012_tipps SET tipp_sonder=$tipp_sonder, datetime=now() WHERE userid=$userid AND spieleid=$spielid");
	header( 'Location: http://www.pewei.de/?page_id=440' );
} 
else
{ 
	echo 'Das erste Spiel hat bereits begonnen, Pech gehabt...'; 
} 
?>
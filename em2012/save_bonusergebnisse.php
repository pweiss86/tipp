<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$spielid = $_POST['spielid'];

$tipps=$wpdb->get_results( "SELECT tipp_sonder, userid FROM em2012_tipps WHERE spieleid=$spielid");

foreach ( $tipps as $tipp )
{
if ($tipp->tipp_sonder != null)
{

if ($spielid == '71')
{
$tipp_holland = $_POST['holland'];

if ($tipp->tipp_sonder == $tipp_holland)
	$punkte = '3';
else
	$punkte = '0';
}

if ($spielid == '72')
{
$tipp_torschuetze = $_POST['torschuetze'];

if ($tipp->tipp_sonder == $tipp_torschuetze)
	$punkte = '3';
else
	$punkte = '0';
}

if ($spielid == '73')
{
$tipp_ronaldo = $_POST['ronaldo'];

if ($tipp->tipp_sonder == $tipp_ronaldo)
	$punkte = '3';
else
	$punkte = '0';
}

if ($spielid == '74')
{
$tipp_tippmeister = $_POST['tippmeister'];

if ($tipp->tipp_sonder == $tipp_tippmeister)
	$punkte = '3';
else
	$punkte = '0';
}

$wpdb->query("UPDATE em2012_tipps SET punkte=$punkte WHERE userid=$tipp->userid AND spieleid=$spielid");
}
}

header( 'Location: http://www.pewei.de/?page_id=436' );

?>
<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$land = $_POST['land'];
$land_text = $_POST['land_text'];
$spielid = $_POST['spielid'];
$gruppe = $_POST['gruppe'];

$landnamen=$wpdb->get_results( "SELECT Name FROM wm2014_gruppen WHERE ID=$land");
foreach ( $landnamen as $landname )
{
	$name = $landname->Name;
}
	
if ($gruppe == "H")
{
	$wpdb->query("UPDATE wm2014_spiele SET H=$land, Heim='".$name."' WHERE Nr=$spielid");
}
if ($gruppe == "G")
{
	$wpdb->query("UPDATE wm2014_spiele SET G=$land, Gast='".$name."' WHERE Nr=$spielid");
}

echo $land_text;

?>
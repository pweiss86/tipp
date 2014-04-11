<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$land = $_POST['land'];
$spielid = $_POST['spielid'];
$gruppe = $_POST['gruppe'];

$landnamen=$wpdb->get_results( "SELECT Name FROM em2012_gruppen WHERE ID=$land");
foreach ( $landnamen as $landname )
{
	$name = $landname->Name;
}
	
if ($gruppe == "H")
{
	$wpdb->query("UPDATE em2012_spiele SET H=$land, Heim='".$name."' WHERE Nr=$spielid");
}
if ($gruppe == "G")
{
	$wpdb->query("UPDATE em2012_spiele SET G=$land, Gast='".$name."' WHERE Nr=$spielid");
}

header( 'Location: http://www.pewei.de/?page_id=436' );

?>
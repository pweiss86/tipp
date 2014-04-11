<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$spielid = $_POST['spielid'];

if ($spielid < '70')
{
	$wpdb->query("UPDATE em2012_spiele SET ergebnis_h=NULL, ergebnis_g=NULL WHERE Nr=$spielid");
}

$wpdb->query("UPDATE em2012_tipps SET punkte=NULL WHERE spieleid=$spielid");

header( 'Location: http://www.pewei.de/?page_id=436' );

?>
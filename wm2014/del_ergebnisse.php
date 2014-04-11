<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$spielid = $_POST['spielid'];

if ($spielid < '70')
{
	$wpdb->query("UPDATE wm2014_spiele SET ergebnis_h=NULL, ergebnis_g=NULL WHERE Nr=$spielid");
	
	if ($spielid == '64')
	{
		$wpdb->query("UPDATE wm2014_tipps SET punkte=NULL WHERE spieleid=70");
	}
}
else
{
	$wpdb->query("UPDATE wm2014_bonus SET Ergebnis=NULL WHERE ID=$spielid");
}

$wpdb->query("UPDATE wm2014_tipps SET punkte=NULL WHERE spieleid=$spielid");

echo "";

?>
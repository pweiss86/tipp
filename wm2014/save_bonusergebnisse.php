<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$spielid = $_POST['spielid'];
$bonusergebnis = $_POST['bonusergebnis'];
$bonusergebnis_text = $_POST['bonusergebnis_text'];

//echo $spielid;
//echo $bonusergebnis;

$wpdb->query("UPDATE wm2014_bonus SET Ergebnis=$bonusergebnis WHERE ID=$spielid");
$tipps=$wpdb->get_results( "SELECT tipp_sonder, userid FROM wm2014_tipps WHERE spieleid=$spielid");

foreach ( $tipps as $tipp )
{
	if ($tipp->tipp_sonder != null)
	{
		if ($tipp->tipp_sonder == $bonusergebnis)
			$punkte = '3';
		else
			$punkte = '0';
		
		$wpdb->query("UPDATE wm2014_tipps SET punkte=$punkte WHERE userid=$tipp->userid AND spieleid=$spielid");
		$wpdb->query("UPDATE wm2014_bonus SET Ergebis=$bonusergebnis WHERE ID=$spielid");
	}
}

echo $bonusergebnis_text;

?>
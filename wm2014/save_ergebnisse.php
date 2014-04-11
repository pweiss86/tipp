<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$ergebnis_h = $_POST['ergebnis_h'];
$ergebnis_g = $_POST['ergebnis_g'];
$spielid = $_POST['spielid'];
$gruppe_h = $_POST['gruppe_h'];
$gruppe_g = $_POST['gruppe_g'];

$wpdb->query("UPDATE wm2014_spiele SET ergebnis_h=$ergebnis_h, ergebnis_g=$ergebnis_g WHERE Nr=$spielid");

if ($ergebnis_h > $ergebnis_g)
    $ergebnistendenz = "1";
if ($ergebnis_h < $ergebnis_g)
    $ergebnistendenz = "2";
if ($ergebnis_h == $ergebnis_g)
    $ergebnistendenz = "0";

$tipps=$wpdb->get_results( "SELECT tipp_h, tipp_g, userid FROM wm2014_tipps WHERE spieleid=$spielid");

foreach ( $tipps as $tipp )
{
	if ($tipp->tipp_h != null && $tipp->tipp_g != null)
	{
		if ($tipp->tipp_h > $tipp->tipp_g)
			$tipptendenz = '1';
		if ($tipp->tipp_h < $tipp->tipp_g)
			$tipptendenz = '2';
		if ($tipp->tipp_h == $tipp->tipp_g)
			$tipptendenz = '0';

		if ($tipp->tipp_h == $ergebnis_h && $tipp->tipp_g == $ergebnis_g)
			$punkte = '3';
		elseif ($tipptendenz == $ergebnistendenz)
			$punkte = '1';
		else
			$punkte = '0';

		$wpdb->query("UPDATE wm2014_tipps SET punkte=$punkte WHERE userid=$tipp->userid AND spieleid=$spielid");
	}
}

if ($spielid == '64')
{
	if ($ergebnis_h > $ergebnis_g)
		$meister = $gruppe_h;
	else
		$meister = $gruppe_g;

	$meistertipps=$wpdb->get_results( "SELECT tipp_sonder, userid FROM wm2014_tipps WHERE spieleid=70");

	foreach ( $meistertipps as $meistertipp )
	{
		if ($meistertipp->tipp_sonder != null)
		{
			if ($meistertipp->tipp_sonder == $meister)
				$punkte = '10';
			else
				$punkte = '0';

			$wpdb->query("UPDATE wm2014_tipps SET punkte=$punkte WHERE userid=$meistertipp->userid AND spieleid=70");
			$wpdb->query("UPDATE wm2014_bonus SET Ergebis=$meister WHERE ID=$spielid");
		}
	}
}

$wpdb->query("UPDATE wp_users SET wm2014_platzv=wm2014_platz WHERE wm2014=1");

$plaetze=$wpdb->get_results("SELECT wp_users.id AS ID, wp_users.wm2014_beitrag AS Beitrag, SUM( punkte ) AS Punkte, wm2014_platz AS Platz, wm2014_platzv AS Platzv FROM wm2014_tipps INNER JOIN wp_users ON ( wm2014_tipps.userid = wp_users.id ) WHERE userid>1 AND wm2014='1' GROUP BY userid ORDER BY punkte DESC");
$platznr=1;
$punktevorher=null;

foreach ( $plaetze as $platz )
{
	if ($punktevorher != null)
	{
		if($punktevorher > $platz->Punkte)
		{
			$platznr++;
		}
	}
	$punktevorher=$platz->Punkte;

	$wpdb->query("UPDATE wp_users SET wm2014_platz=$platznr WHERE ID=$platz->ID");
}

echo $ergebnis_h.":".$ergebnis_g; 

?>
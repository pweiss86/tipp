<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$ergebnis_h = $_POST['ergebnis_h'];
$ergebnis_g = $_POST['ergebnis_g'];
$spielid = $_POST['spielid'];
$gruppe_h = $_POST['gruppe_h'];
$gruppe_g = $_POST['gruppe_g'];

//echo $gruppe_h;
//echo "<br>";
//echo $gruppe_g;
//echo "<br>";
//echo $spielid;
//echo "<br>";

$wpdb->query("UPDATE em2012_spiele SET ergebnis_h=$ergebnis_h, ergebnis_g=$ergebnis_g WHERE Nr=$spielid");

if ($ergebnis_h > $ergebnis_g)
    $ergebnistendenz = "1";
if ($ergebnis_h < $ergebnis_g)
    $ergebnistendenz = "2";
if ($ergebnis_h == $ergebnis_g)
    $ergebnistendenz = "0";

//echo "ergebnis_h: ";
//echo $ergebnis_h;
//echo "<br>";
//echo "ergebnis_g: ";
//echo $ergebnis_g;
//echo "<br>";
//echo "ergebnistendenz: ";
//echo $ergebnistendenz;
//echo "<br>";
$tipps=$wpdb->get_results( "SELECT tipp_h, tipp_g, userid FROM em2012_tipps WHERE spieleid=$spielid");

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

//echo "userid: ";
//echo $tipp->userid;
//echo "<br>";
//echo "tipptendenz: ";
//echo $tipptendenz;
//echo "<br>";
//echo "tipp_h: ";
//echo $tipp->tipp_h;
//echo "<br>";
//echo "tipp_g: ";
//echo $tipp->tipp_g;
//echo "<br>";

if ($tipp->tipp_h == $ergebnis_h && $tipp->tipp_g == $ergebnis_g)
	$punkte = '3';
elseif ($tipptendenz == $ergebnistendenz)
	$punkte = '1';
else
	$punkte = '0';

//echo "punkte: ";
//echo $punkte;
//echo "<br>";

$wpdb->query("UPDATE em2012_tipps SET punkte=$punkte WHERE userid=$tipp->userid AND spieleid=$spielid");
}
}

if ($spielid == '64')
{
if ($ergebnis_h > $ergebnis_g)
	$meister = $gruppe_h;
else
	$meister = $gruppe_g;
//echo $meister;

$meistertipps=$wpdb->get_results( "SELECT tipp_sonder, userid FROM em2012_tipps WHERE spieleid=70");

foreach ( $meistertipps as $meistertipp )
{
if ($meistertipp->tipp_sonder != null)
{
	if ($meistertipp->tipp_sonder == $meister)
		$punkte = '10';
	else
		$punkte = '0';

	$wpdb->query("UPDATE em2012_tipps SET punkte=$punkte WHERE userid=$meistertipp->userid AND spieleid=70");
}
}
}

$wpdb->query("UPDATE wp_users SET em2012_platzv=em2012_platz WHERE em2012=1");

$plaetze=$wpdb->get_results("SELECT wp_users.id AS ID, wp_users.em2012_beitrag AS Beitrag, SUM( punkte ) AS Punkte, em2012_platz AS Platz, em2012_platzv AS Platzv FROM em2012_tipps INNER JOIN wp_users ON ( em2012_tipps.userid = wp_users.id ) WHERE userid>1 AND em2012='1' GROUP BY userid ORDER BY punkte DESC");
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

	$wpdb->query("UPDATE wp_users SET em2012_platz=$platznr WHERE ID=$platz->ID");
}

header( 'Location: http://www.pewei.de/?page_id=436' );

?>
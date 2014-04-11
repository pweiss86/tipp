<?php
global $wpdb;
global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

if ($userid <> 0)
{
	
$em2012boolean=$wpdb->get_results( "SELECT em2012 FROM wp_users WHERE ID=$userid");

foreach ( $em2012boolean as $em2012bool )
{
	$generate_tipps = $em2012bool->em2012;
}
//echo $generate_tipps;
if($generate_tipps == '0')
{
	$spielnr = 64;
	while($spielnr > 0)
	{
		$wpdb->query("REPLACE INTO em2012_tipps (userid, spieleid) VALUES ($userid, $spielnr)");
		$spielnr--;
	}
	
	$spielnr = 74;
	while($spielnr > 69)
	{
		$wpdb->query("REPLACE INTO em2012_tipps (userid, spieleid) VALUES ($userid, $spielnr)");
		$spielnr--;
	}
	
	$wpdb->query("UPDATE wp_users SET em2012='1' WHERE ID=$userid");
}

$spiele=$wpdb->get_results( "SELECT Nr, DATE_FORMAT(datum, '%d.%m.%y %H:%i') AS datum, UNIX_TIMESTAMP(datum) as timestamp, CONCAT(Heim, ' : ', Gast) As Spiel, CONCAT(Ergebnis_H, ':', Ergebnis_G) As Ergebnis, CONCAT( tipp_H, ':', tipp_G ) AS Tipp, em2012_tipps.userid FROM em2012_spiele LEFT JOIN em2012_tipps ON ( em2012_spiele.Nr = em2012_tipps.spieleid ) WHERE em2012_tipps.userid=$userid ORDER BY Nr");
$meistertipps=$wpdb->get_results( "SELECT Name FROM em2012_tipps Inner Join em2012_gruppen ON (em2012_gruppen.id=em2012_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='70'");
$hollandtipps=$wpdb->get_results( "SELECT Runde FROM em2012_tipps Inner Join em2012_runden ON (em2012_runden.id=em2012_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='71'");
$schuetzentipps=$wpdb->get_results( "SELECT Name FROM em2012_tipps Inner Join em2012_gruppen ON (em2012_gruppen.id=em2012_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='72'");
$ronaldotipps=$wpdb->get_results( "SELECT tipp_sonder FROM em2012_tipps WHERE userid=$userid AND spieleid='73'");
$tippmeistertipps=$wpdb->get_results( "SELECT display_name FROM em2012_tipps Inner Join wp_users ON (wp_users.id=em2012_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='74'");
$laender=$wpdb->get_results( "SELECT ID, Name FROM em2012_gruppen");
$runden=$wpdb->get_results( "SELECT ID, Runde FROM em2012_runden");
$users=$wpdb->get_results( "SELECT ID, display_name FROM wp_users WHERE em2012='1'");

echo "<style type='text/css'>";
echo "input[type='image']";
echo "{";
echo "border:0px;";
echo "padding:0px;";
echo "margin:0px";
echo "}";
echo "input[type='text']";
echo "{";
echo "width:50px";
echo "}";
echo "</style>";

echo "<br>";
echo  "<table>";
echo "<th nowrap><center>Bonusfrage</center></th>";
echo "<th nowrap><center>Datum</center></th>";
echo "<th nowrap><center>mein Tipp</center></th>";
echo "<th colspan='2'><center>Tipp ändern</center></th>";
echo "</tr>";
echo "<tr>";
echo "<td nowrap>";
echo "Wer wird Weltmeister?";
echo "</td>";
echo "<td nowrap>12.06.2014 22:00";
echo "</td>";
echo "<td align='right'>";
foreach ( $meistertipps as $meistertipp )
{
	echo $meistertipp->Name;
}
echo "</td>";
echo "<form method='post' action='em2012/save_meister.php'>";
echo "<td nowrap>";
echo  "<select name='meister'>";
foreach ( $laender as $land )
{
    echo "<option value=".$land->ID.">";
    echo $land->Name;
    echo "</option>";
} 
echo  "</select>";
echo "</td>";
echo "<td nowrap width='50'>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "</td>";
echo "</form>";
echo "</tr>";

echo "<tr>";
echo "<td nowrap>";
echo "Wann fliegt Holland?";
echo "</td>";
echo "<td nowrap>12.06.2014 22:00";
echo "</td>";
echo "<td align='right'>";
foreach ( $hollandtipps as $hollandtipp )
{
	echo $hollandtipp->Runde;
}
echo "</td>";
echo "<form method='post' action='em2012/save_holland.php'>";
echo "<td nowrap>";
echo  "<select name='holland'>";
foreach ( $runden as $runde )
{
    echo "<option value=".$runde->ID.">";
    echo $runde->Runde;
    echo "</option>";
} 
echo  "</select>";
echo "</td>";
echo "<td nowrap>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "</td>";
echo "</form>";
echo "</tr>";

echo "<tr>";
echo "<td nowrap>";
echo "Welche Nation stellt den Torschützenkönig?";
echo "</td>";
echo "<td nowrap>12.06.2014 22:00";
echo "</td>";
echo "<td align='right'>";
foreach ( $schuetzentipps as $schuetzentipp )
{
	echo $schuetzentipp->Name;
}
echo "</td>";
echo "<form method='post' action='em2012/save_torschuetze.php'>";
echo "<td nowrap>";
echo  "<select name='torschuetze'>";
foreach ( $laender as $land )
{
    echo "<option value=".$land->ID.">";
    echo $land->Name;
    echo "</option>";
} 
echo  "</select>";
echo "</td>";
echo "<td nowrap>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "</td>";
echo "</form>";
echo "</tr>";

echo "<tr>";
echo "<td nowrap>";
echo "Wieviele Tore macht Cristiano Ronaldo?";
echo "</td>";
echo "<td nowrap>12.06.2014 22:00";
echo "</td>";
echo "<td nowrap>";
foreach ( $ronaldotipps as $ronaldotipp )
{
	echo $ronaldotipp->tipp_sonder;
}
echo "</td>";
echo "<form method='post' action='em2012/save_ronaldo.php'>";
echo "<td nowrap>";
echo  "<select name='ronaldo'>";
for($i=0;$i<26;$i++)
{
echo '<option>'.$i.'</option>';
} 
echo  "</select>";
echo "</td>";
echo "<td nowrap>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "</td>";
echo "</form>";
echo "</tr>";

echo "<tr>";
echo "<td nowrap>";
echo "Wer wird Tippmeister?";
echo "</td>";
echo "<td nowrap>28.06.2014 18:00";
echo "</td>";
echo "<td nowrap>";
foreach ( $tippmeistertipps as $tippmeistertipp )
{
	echo $tippmeistertipp->display_name;
}
echo "</td>";
echo "<form method='post' action='em2012/save_tippmeister.php'>";
echo "<td nowrap>";
echo  "<select name='tippmeister'>";
foreach ( $users as $user )
{
    echo "<option value=".$user->ID.">";
    echo $user->display_name;
    echo "</option>";
}
echo  "</select>";
echo "</td>";
echo "<td nowrap>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "</td>";
echo "</form>";
echo "</tr>";

echo "</table>";

echo "<br>";

echo "<table>";
echo "<tr>";
echo "<th colspan='9'><center><b>Spiele</b></center></th>";
echo "</tr>";
echo "<tr>";
echo "<th nowrap><center>Nr</center></th>";
echo "<th nowrap><center>Datum</center></th>";
echo "<th nowrap><center>Spiel</center></th>";
echo "<th nowrap><center>Ergebnis</center></th>";
echo "<th nowrap><center>mein Tipp</center></th>";
echo "<th colspan='4'><center>Tipp ändern</center></th>";
echo "</tr>";
foreach ( $spiele as $spiel )
{
    echo "<tr>";
    echo "<td nowrap>".$spiel->Nr."</td>";
    echo "<td nowrap>".$spiel->datum."</td>";
    echo "<td nowrap>".$spiel->Spiel."</td>";
    echo "<td nowrap><center>".$spiel->Ergebnis."</center></td>";
    echo "<td nowrap><center>".$spiel->Tipp."</center></td>";
    echo "<form method='post' action='em2012/save_tipps.php'>";
	echo "<td nowrap>";
    echo "<input type='text' size='1' maxlength='2' name='tipp_h'>";
	echo "</td>";
	echo "<td nowrap>";
	echo ":";
	echo "</td>";
	echo "<td nowrap>";
    echo "<input type='text' size='1' maxlength='2' name='tipp_g'>";
	echo "</td>";
	//echo "<td nowrap>";
	echo "<td nowrap width='50'>";
    echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
    echo "<input type='hidden' name='spielid' value='$spiel->Nr'>";
    echo "<input type='hidden' name='spielzeit' value='$spiel->timestamp'>";
	echo "</td>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
}
else
{
    echo "<h2><b>Bitte anmelden um Tipps abzugeben!!!</b></h2>";
}

?>
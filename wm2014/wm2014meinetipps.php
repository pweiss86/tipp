<?php
global $wpdb;
global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

echo "<link rel='stylesheet' type='text/css' href='wm2014/style.css'>";
echo "<script src='wm2014/sendtipp.js'></script>";

if ($userid <> 0 && $userid <> 32)
{
	
$wm2014boolean=$wpdb->get_results( "SELECT wm2014 FROM wp_users WHERE ID=$userid");

foreach ( $wm2014boolean as $wm2014bool )
{
	$generate_tipps = $wm2014bool->wm2014;
}
//echo $generate_tipps;
if($generate_tipps == '0')
{
	$spielnr = 64;
	while($spielnr > 0)
	{
		$wpdb->query("REPLACE INTO wm2014_tipps (userid, spieleid) VALUES ($userid, $spielnr)");
		$spielnr--;
	}
	
	$spielnr = 74;
	while($spielnr > 69)
	{
		$wpdb->query("REPLACE INTO wm2014_tipps (userid, spieleid) VALUES ($userid, $spielnr)");
		$spielnr--;
	}
	
	$wpdb->query("UPDATE wp_users SET wm2014='1' WHERE ID=$userid");
}

$bonusfragen=$wpdb->get_results( "SELECT ID, Frage, DATE_FORMAT(datum, '%d.%m.%y %H:%i') AS Datum, UNIX_TIMESTAMP(datum) as timestamp, Ergebnis FROM wm2014_bonus  WHERE wm2014_bonus.ID>='70' ORDER BY ID");
$spiele=$wpdb->get_results( "SELECT Nr, DATE_FORMAT(datum, '%d.%m.%y %H:%i') AS datum, UNIX_TIMESTAMP(datum) as timestamp, CONCAT(Heim, ' : ', Gast) As Spiel, CONCAT(Ergebnis_H, ':', Ergebnis_G) As Ergebnis, CONCAT( tipp_H, ':', tipp_G ) AS Tipp, wm2014_tipps.userid FROM wm2014_spiele LEFT JOIN wm2014_tipps ON ( wm2014_spiele.Nr = wm2014_tipps.spieleid ) WHERE wm2014_tipps.userid=$userid ORDER BY Nr");
$meistertipps=$wpdb->get_results( "SELECT Name FROM wm2014_tipps Inner Join wm2014_gruppen ON (wm2014_gruppen.id=wm2014_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='70'");
$hollandtipps=$wpdb->get_results( "SELECT Runde FROM wm2014_tipps Inner Join wm2014_runden ON (wm2014_runden.id=wm2014_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='71'");
$schuetzentipps=$wpdb->get_results( "SELECT Name FROM wm2014_tipps Inner Join wm2014_gruppen ON (wm2014_gruppen.id=wm2014_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='72'");
$ronaldotipps=$wpdb->get_results( "SELECT tipp_sonder FROM wm2014_tipps WHERE userid=$userid AND spieleid='73'");
$tippmeistertipps=$wpdb->get_results( "SELECT display_name FROM wm2014_tipps Inner Join wp_users ON (wp_users.id=wm2014_tipps.tipp_sonder) WHERE userid=$userid AND spieleid='74'");
$laender=$wpdb->get_results( "SELECT ID, Name FROM wm2014_gruppen");
$runden=$wpdb->get_results( "SELECT ID, Runde FROM wm2014_runden");
$users=$wpdb->get_results( "SELECT ID, display_name FROM wp_users WHERE wm2014='1'");

echo "<br>";
echo  "<table>";

echo "<tr>";
echo "<th colspan='8'><b>Bonusfragen</b></th>";
echo "</tr>";
echo "<tr>";
echo "<th>Bonusfrage</th>";
echo "<th>Datum</th>";
echo "<th>Ergebnis</th>";
echo "<th>mein Tipp</th>";
echo "<th colspan='3'>Tipp ändern</th>";
echo "</tr>";
foreach ( $bonusfragen as $bonusfrage )
{
	$SpielID = $bonusfrage->ID;
	
	echo "<tr>";
    echo "<td>".$bonusfrage->Frage."</td>";
	echo "<td>".$bonusfrage->Datum."</td>";
	echo "<td>".$bonusfrage->Ergebnis."</td>";
	if ($SpielID == '70')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $meistertipps as $meistertipp )
		{
			echo $meistertipp->Name;
		}
		echo "</div>";
		echo "";
		echo "</td>";		
		echo "<td>";
		echo "<select id='".$SpielID."_tipp_sonder'>";
		foreach ( $laender as $land )
		{
			echo "<option value=".$land->ID.">";
			echo $land->Name;
			echo "</option>";
		}
		echo  "</select> ";
		echo "<input type='hidden' id='".$SpielID."_spielzeit' value='$bonusfrage->timestamp'>";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_button' class='saveButton'>Tippen!</a>";
		echo "</td>";
	}
	if ($SpielID == '71')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $hollandtipps as $hollandtipp )
		{
			echo $hollandtipp->Runde;
		}
		echo "</div>";
		echo "";
		echo "</td>";		
		echo "<td>";
		echo "<select id='".$SpielID."_tipp_sonder'>";
		foreach ( $runden as $runde )
		{
			echo "<option value=".$runde->ID.">";
			echo $runde->Runde;
			echo "</option>";
		}
		echo  "</select> ";
		echo "<input type='hidden' id='".$SpielID."_spielzeit' value='$bonusfrage->timestamp'>";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_button' class='saveButton'>Tippen!</a>";
		echo "</td>";
	}
	if ($SpielID == '72')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $schuetzentipps as $schuetzentipp )
		{
			echo $schuetzentipp->Name;
		}
		echo "</div>";
		echo "";
		echo "</td>";		
		echo "<td>";
		echo "<select id='".$SpielID."_tipp_sonder'>";
		foreach ( $laender as $land )
		{
			echo "<option value=".$land->ID.">";
			echo $land->Name;
			echo "</option>";
		} 
		echo  "</select> ";
		echo "<input type='hidden' id='".$SpielID."_spielzeit' value='$bonusfrage->timestamp'>";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_button' class='saveButton'>Tippen!</a>";
		echo "</td>";
	}
	if ($SpielID == '73')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $ronaldotipps as $ronaldotipp )
		{
			echo $ronaldotipp->tipp_sonder;
		}
		echo "</div>";
		echo "";
		echo "</td>";
		echo "<td>";
		echo "<select id='".$SpielID."_tipp_sonder'>";
		for($i=0;$i<26;$i++)
		{
			echo '<option>'.$i.'</option>';
		} 
		echo  "</select> ";
		echo "<input type='hidden' id='".$SpielID."_spielzeit' value='$bonusfrage->timestamp'>";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_button' class='saveButton'>Tippen!</a>";
		echo "</td>";
	}
	if ($SpielID == '74')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $tippmeistertipps as $tippmeistertipp )
		{
			echo $tippmeistertipp->display_name;
		}
		echo "</div>";
		echo "";
		echo "</td>";		
		echo "<td>";
		echo "<select id='".$SpielID."_tipp_sonder'>";
		foreach ( $users as $user )
		{
			echo "<option value=".$user->ID.">";
			echo $user->display_name;
			echo "</option>";
		}
		echo  "</select> ";
		echo "<input type='hidden' id='".$SpielID."_spielzeit' value='$bonusfrage->timestamp'>";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_button' class='saveButton'>Tippen!</a>";
		echo "</td>";
	}

	echo "<td>";
	echo "<a href='#' id='".$SpielID."_delbutton' class='delButton'>Löschen</a>";
	echo "</td>";	
    echo "</tr>";
}
echo "</table>";

echo "<br>";

echo "<table>";
echo "<tr>";
echo "<th colspan='8'><b>Spiele</b></th>";
echo "</tr>";
echo "<tr>";
echo "<th>Nr</th>";
echo "<th>Datum</th>";
echo "<th>Spiel</th>";
echo "<th>Ergebnis</th>";
echo "<th>mein Tipp</th>";
echo "<th colspan='3'>Tipp ändern</th>";
echo "</tr>";
foreach ( $spiele as $spiel )
{
	$SpielID = $spiel->Nr;
	echo "<tr>";
    echo "<td>".$SpielID."</td>";
    echo "<td>".$spiel->datum."</td>";
    echo "<td>".$spiel->Spiel."</td>";
    echo "<td class='centertext'>".$spiel->Ergebnis."</td>";
    echo "<td class='centertext'><div id='".$SpielID."_div'>".$spiel->Tipp."</div></td>";
	echo "<td>";
	echo "<input type='text' maxlength='2' id='".$SpielID."_tipp_h'>";
	echo " : ";
    echo "<input type='text' maxlength='2' id='".$SpielID."_tipp_g'> ";
    echo "<input type='hidden' id='".$SpielID."_spielzeit' value='$spiel->timestamp'>";
    echo "</td>";
	echo "<td>";
	echo "<a href='#' id='".$SpielID."_button' class='saveButton'>Tippen!</a>";
	echo "</td>";
	echo "<td>";
	echo "<a href='#' id='".$SpielID."_delbutton' class='delButton'>Löschen</a>";
	echo "</td>";
    echo "</tr>";
}
	echo "<tr>";
    echo "<td colspan='5'></td>";
	echo "<td class='centertext'><div id='saveAll_div'></div></td>";
	echo "<td colspan='2' class='centertext'>";
	echo "<a href='#' id='save_all_button' class='saveAllButton'>Alle Tippen!</a>";
	echo "</td>";
    echo "</tr>";
echo "</table>";
}
else
{
    echo "<h2><b>Bitte anmelden um Tipps abzugeben!!!</b></h2>";
}

?>
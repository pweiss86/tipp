<?php
global $wpdb;
global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

//include('wm2014/autovote.php');

echo "<link rel='stylesheet' type='text/css' href='wm2014/style.css'>";
echo "<link rel='stylesheet' href='switchery/switchery.css' />";
echo "<script src='wm2014/sendergebnisse.js'></script>";
echo "<script src='switchery/switchery.js'></script>";

if ($userid == 4 or $userid == 5)
{
$spiele=$wpdb->get_results( "SELECT Nr, DATE_FORMAT(datum, '%d.%m.%y %H:%i') AS datum, CONCAT(Heim, ' : ', Gast) As Spiel, CONCAT(Ergebnis_H, ':', Ergebnis_G) As Ergebnis, H, G FROM wm2014_spiele ORDER BY Nr");

echo  "<table>";
echo "<tr>";
echo "<th colspan='9'>Spiele</th>";
echo "</tr>";
echo "<tr>";
echo "<th>Nr</th>";
echo "<th>Datum</th>";
echo "<th>Spiel</th>";
echo "<th>Ergebnis</th>";
echo "<th colspan='3'>Ergebnis ändern</th>";
echo "</tr>";
foreach ( $spiele as $spiel )
{
	$SpielID = $spiel->Nr;
	
    echo "<tr>";
    echo "<td>".$SpielID."</td>";
    echo "<td>".$spiel->datum."</td>";
    echo "<td>".$spiel->Spiel."</td>";
	
	echo "<td class='centertext'><div id='".$SpielID."_div'>".$spiel->Ergebnis."</div></td>";
	echo "<td>";
	echo "<input type='text' maxlength='2' id='".$SpielID."_ergebnis_h'>";
	echo " : ";
    echo "<input type='text' maxlength='2' id='".$SpielID."_ergebnis_g'> ";
	echo "<input type='hidden' id='".$SpielID."_gruppe_h' value='$spiel->H'>";
	echo "<input type='hidden' id='".$SpielID."_gruppe_g' value='$spiel->G'>";
	echo "</td>";
	echo "<td>";
	echo "<a href='#' id='".$SpielID."_button' class='saveButton'>Speichern</a>";
	echo "</td>";
	echo "<td>";
	echo "<a href='#' id='".$SpielID."_delbutton' class='delButton'>Löschen</a>";
	echo "</td>";
    echo "</tr>";
}
echo "</table>";









$endspiele=$wpdb->get_results( "SELECT Nr, Heim, Gast, H, G FROM wm2014_spiele WHERE NR>48 ORDER BY Nr");
$laender=$wpdb->get_results( "SELECT ID, Name FROM wm2014_gruppen");
$runden=$wpdb->get_results( "SELECT ID, Runde FROM wm2014_runden");
$users=$wpdb->get_results( "SELECT ID, display_name FROM wp_users WHERE wm2014='1'");

$bonusfragen=$wpdb->get_results( "SELECT ID, Frage, Ergebnis FROM wm2014_bonus  WHERE wm2014_bonus.ID>'70' ORDER BY ID");
$holland=$wpdb->get_results( "SELECT wm2014_runden.Runde FROM wm2014_bonus Inner Join wm2014_runden ON (wm2014_runden.id=wm2014_bonus.Ergebnis) WHERE wm2014_bonus.ID='71'");
$schuetzen=$wpdb->get_results( "SELECT Name FROM wm2014_bonus Inner Join wm2014_gruppen ON (wm2014_gruppen.id=wm2014_bonus.Ergebnis) WHERE wm2014_bonus.ID='72'");
$tippmeister=$wpdb->get_results( "SELECT display_name FROM wm2014_bonus Inner Join wp_users ON (wp_users.id=wm2014_bonus.Ergebnis) WHERE wm2014_bonus.ID='74'");

echo "<br>";
echo "<table>";
echo "<tr>";
echo "<th colspan='5'>Bonusfragen</th>";
echo "</tr>";
echo "<tr>";
echo "<th>Bonusfrage</th>";
echo "<th>Ergebnis</th>";
echo "<th colspan='3'>Ergebnis ändern</th>";
echo "</tr>";
foreach ( $bonusfragen as $bonusfrage )
{
	$SpielID = $bonusfrage->ID;
	
	echo "<tr>";
    echo "<td>".$bonusfrage->Frage."</td>";
	
	if ($SpielID == '71')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $holland as $h )
		{
			echo $h->Runde;
		}
		echo "</div>";
		echo "";
		echo "</td>";		
		echo "<td>";
		echo "<select id='".$SpielID."_bonusergebnis'>";
		foreach ( $runden as $runde )
		{
			echo "<option value=".$runde->ID.">";
			echo $runde->Runde;
			echo "</option>";
		}
		echo  "</select> ";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_bonbutton' class='saveBonusButton'>Speichern</a>";
		echo "</td>";
	}
	if ($SpielID == '72')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $schuetzen as $s )
		{
			echo $s->Name;
		}
		echo "</div>";
		echo "";
		echo "</td>";		
		echo "<td>";
		echo "<select id='".$SpielID."_bonusergebnis'>";
		foreach ( $laender as $land )
		{
			echo "<option value=".$land->ID.">";
			echo $land->Name;
			echo "</option>";
		} 
		echo  "</select> ";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_bonbutton' class='saveBonusButton'>Speichern</a>";
		echo "</td>";
	}
	if ($SpielID == '73')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		echo $bonusfrage->Ergebnis;
		echo "</div>";
		echo "";
		echo "</td>";
		echo "<td>";
		echo "<select id='".$SpielID."_bonusergebnis'>";
		for($i=0;$i<26;$i++)
		{
			echo '<option>'.$i.'</option>';
		} 
		echo  "</select> ";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_bonbutton' class='saveBonusButton'>Speichern</a>";
		echo "</td>";
	}
	if ($SpielID == '74')
	{
		echo "<td>";
		echo "";
		echo "<div id='".$SpielID."_div'>";
		foreach ( $tippmeister as $t )
		{
			echo $t->display_name;
		}
		echo "</div>";
		echo "";
		echo "</td>";		
		echo "<td>";
		echo "<select id='".$SpielID."_bonusergebnis'>";
		foreach ( $users as $user )
		{
			echo "<option value=".$user->ID.">";
			echo $user->display_name;
			echo "</option>";
		}
		echo  "</select> ";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' id='".$SpielID."_bonbutton' class='saveBonusButton'>Speichern</a>";
		echo "</td>";
	}

	echo "<td>";
	echo "<a href='#' id='".$SpielID."_delbonbutton' class='delButton'>Löschen</a>";
	echo "</td>";	
    echo "</tr>";
}
echo "</table>";










echo  "<br>";
echo  "<table>";
echo "<tr>";
echo "<th colspan='7'>Endrunden</th>";
echo "</tr>";
echo "<tr>";
echo "<th>Nr</th>";
echo "<th>Gruppe</th>";
echo "<th colspan='2'>Ändern</th>";
echo "<th>Gruppe</th>";
echo "<th colspan='2'>Ändern</th>";
echo "</tr>";

foreach ( $endspiele as $endspiel )
{
	$SpielID = $endspiel->Nr;
	
	echo "<tr>";
	echo "<td>";
	echo $SpielID;
	echo "</td>";
	echo "<td>";
	echo "<div id='".$SpielID."_EndrundeDivH'>";
	echo $endspiel->Heim;
	echo "</div>";
	echo "</td>";
	
	echo "<td>";
	echo "<select id='".$SpielID."_landH'>";
	foreach ( $laender as $land )
	{
		echo "<option value=".$land->ID.">";
		echo $land->Name;
		echo "</option>";
	} 
	echo  "</select> ";
	echo "</td>";
	echo "<td>";
	echo "<a href='#' id='".$SpielID."_endrundebuttonH' class='saveEndrundeButtonH'>Speichern</a>";
	echo "</td>";
	
	echo "<td>";
	echo "<div id='".$SpielID."_EndrundeDivG'>";
	echo $endspiel->Gast;
	echo "</div>";
	echo "</td>";
	
	echo "<td>";
	echo "<select id='".$SpielID."_landG'>";
	foreach ( $laender as $land )
	{
		echo "<option value=".$land->ID.">";
		echo $land->Name;
		echo "</option>";
	} 
	echo  "</select> ";
		echo "</td>";
	echo "<td>";
	echo "<a href='#' id='".$SpielID."_endrundebuttonG' class='saveEndrundeButtonG'>Speichern</a>";
	echo "</td>";
	echo "</tr>";
}
echo "</table>";







$users=$wpdb->get_results("SELECT wp_users.display_name AS Name, wp_users.id AS ID, wp_users.wm2014_beitrag AS Beitrag FROM wp_users WHERE ID>1 AND wm2014='1' ORDER BY wp_users.display_name");



	
echo "<br>";
echo "<table class='beitragsliste'>";
echo "<tr>";
echo "<th colspan='4'>Beiträge</th>";
echo "</tr>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Bezahlt</th>";
echo "</tr>";

foreach ( $users as $user )
{
	$UserID = $user->ID;
    echo  "<tr>";
    echo "<td>";
	echo $user->Name;
	echo "</td>";
	echo "<td>";
	if ( $user->Beitrag == '0')
		echo "<input type='checkbox' id='".$UserID."_beitragcheckbox' class='switchery' />";
	if ( $user->Beitrag == '1')
		echo "<input type='checkbox' id='".$UserID."_beitragcheckbox' class='switchery' checked />";
	echo "</td>";
    echo  "</tr>";
}
echo "</table>";

echo "<script type='text/javascript'>";
echo "var Switchery = require('switchery');";
echo "var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));";
echo "elems.forEach(function(html) {";
	echo "var switchery = new Switchery(html);";
echo "});";
echo "</script>";

}
else
{
    echo "<h2><b>Du hast keine Berechtigung</b></h2>";
}
?>
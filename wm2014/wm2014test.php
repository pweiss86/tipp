<?php
global $wpdb;
global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

echo "<link rel='stylesheet' type='text/css' href='wm2014/style.css'>";
echo "<link rel='stylesheet' href='switchery/switchery.css' />";
echo "<script src='switchery/switchery.js'></script>";
echo "<script src='wm2014/sendergebnisse.js'></script>";

if ($userid <> 0)
{
include('wm2014/autovote.php');

$plaetze=$wpdb->get_results("SELECT wp_users.id, wp_users.display_name AS Name, wp_users.wm2014_beitrag AS Beitrag, SUM( punkte ) AS Punkte, wm2014_platz AS Platz, wm2014_platzv AS Platzv FROM wm2014_tipps INNER JOIN wp_users ON ( wm2014_tipps.userid = wp_users.id ) WHERE userid>1 AND wm2014='1' GROUP BY userid ORDER BY punkte DESC");
$countusers=$wpdb->get_results("SELECT COUNT(wm2014) AS Anzahl FROM wp_users WHERE id>1 AND wm2014='1'");

echo "<div class='toprangliste'>";
echo "<div class='rechtsoben'>";
echo "<img title='WM 2014' src='http://www.pewei.de/wp-content/uploads/2014/02/fifa-word-cup-2014-logo.jpg' alt='' />";
echo "</div>";
echo "<table class='rangliste'>";
echo "<tr>";
  echo "<th colspan='2'>Platz</th>";
  echo "<th>Name (";
	foreach ( $countusers as $countuser )
	{
		echo $countuser->Anzahl;
	}
	echo ")</th>";
  echo "<th>bezahlt</th>";
	echo "<th>Punkte</th>";
echo "</tr>";
foreach ( $plaetze as $platz )
{
	echo "<tr>";		
	echo "<td>".$platz->Platz."</td>";
	echo "<td>";
	if($platz->Platz < $platz->Platzv)
		echo "<div class='arrow-up'><div class='arrow-up-inner'>".$platz->Platzv."</div></div>";
	elseif($platz->Platz > $platz->Platzv)
		echo "<div class='arrow-down'><div class='arrow-down-inner'>".$platz->Platzv."</div></div>";
	else
		echo "<div class='noarrow'><div class='noarrow-inner'>".$platz->Platzv."</div></div>";
	echo "</td>";
	
	if ($platz->Platz == 1)
		echo "<td><img title='WM 2014' src='http://www.pewei.de/wm2014/pokal-1.png' alt='' /> ".$platz->Name."</td>";
	elseif ($platz->Platz == 2)
		echo "<td><img title='WM 2014' src='http://www.pewei.de/wm2014/pokal-2.png' alt='' /> ".$platz->Name."</td>";
	else
		echo "<td>".$platz->Name."</td>";

	echo "<td>";
	if ($userid == 4 or $userid == 5)
	{
		if ( $platz->Beitrag == '0')
			echo "<input type='checkbox' id='".$platz->id."_beitragcheckbox' class='switchery' />";
		if ( $platz->Beitrag == '1')
			echo "<input type='checkbox' id='".$platz->id."_beitragcheckbox' class='switchery' checked />";
	}
	else
	{
		if ( $platz->Beitrag == '0')
		echo "<input type='checkbox' class='switchery' disabled />";
		if ( $platz->Beitrag == '1')
		echo "<input type='checkbox' class='switchery' checked disabled />";
	}
	echo "</td>";
	echo "<td>";
	echo $platz->Punkte;
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
echo "</div>";

$spiele=$wpdb->get_results( "SELECT Nr, DATE_FORMAT(datum, '%d.%m.%y %H:%i') AS datum, CONCAT(Heim, ' : ', Gast) As Spiel, CONCAT(Ergebnis_H, ':', Ergebnis_G) As Ergebnis FROM wm2014_tipps inner join wm2014_spiele on (wm2014_tipps.spieleid = wm2014_spiele.nr) WHERE userid='4' ORDER BY Nr");
$users=$wpdb->get_results( "SELECT ID, display_name FROM wp_users WHERE ID<>1 AND wm2014='1' order by id");

$bonusfragen=$wpdb->get_results( "SELECT ID, Frage, Ergebnis FROM wm2014_bonus ORDER BY ID");
$weltmeister=$wpdb->get_results( "SELECT Name FROM wm2014_bonus Inner Join wm2014_gruppen ON (wm2014_gruppen.id=wm2014_bonus.Ergebnis) WHERE wm2014_bonus.ID='70'");
$holland=$wpdb->get_results( "SELECT wm2014_runden.Runde FROM wm2014_bonus Inner Join wm2014_runden ON (wm2014_runden.id=wm2014_bonus.Ergebnis) WHERE wm2014_bonus.ID='71'");
$schuetzen=$wpdb->get_results( "SELECT Name FROM wm2014_bonus Inner Join wm2014_gruppen ON (wm2014_gruppen.id=wm2014_bonus.Ergebnis) WHERE wm2014_bonus.ID='72'");
$tippmeister=$wpdb->get_results( "SELECT display_name FROM wm2014_bonus Inner Join wp_users ON (wp_users.id=wm2014_bonus.Ergebnis) WHERE wm2014_bonus.ID='74'");

echo "<table class='toptippliste'>";
echo "<tr>";
echo "<td>";

echo "<table class='spielliste'>";
echo "<tr>";
echo "<th>Bonusfrage</th>";
echo "<th>Ergebnis</th>";
echo "</tr>";
foreach ( $bonusfragen as $bonusfrage )
{
	$SpielID = $bonusfrage->ID;
	
	echo "<tr>";
    echo "<td>".$bonusfrage->Frage."</td>";
	echo "<td>";
	if ($SpielID == '70')
	{
		foreach ( $weltmeister as $w )
		{
			echo $w->Name;
		}
	}	
	if ($SpielID == '71')
	{
		foreach ( $holland as $h )
		{
			echo $h->Runde;
		}
	}
	if ($SpielID == '72')
	{
		foreach ( $schuetzen as $s )
		{
			echo $s->Name;
		}
	}
	if ($SpielID == '73')
	{
		echo $bonusfrage->Ergebnis;
	}
	if ($SpielID == '74')
	{
		foreach ( $tippmeister as $t )
		{
			echo $t->display_name;
		}
	}
	echo "</td>";
    echo "</tr>";
}
echo "</table>";

echo "</td>";

foreach ($users as $user)
{
	//$color = '#' . strtoupper(dechex(rand(16773077,13486257)));
	$color = '#FFFFFF';
	$tipps = $wpdb->get_results( "SELECT spieleid, tipp_sonder AS Tipp, punkte FROM wm2014_tipps WHERE spieleid>69 AND userid=$user->ID ORDER BY spieleid");
	echo "<td>";
	echo "<table class='tippliste'>";
	echo "<tr>";
	if ($userid == $user->ID)
		echo "<th class='userdata' colspan='2'>";
	else
		echo "<th colspan='2'>";
	echo "".$user->display_name."";
	echo "</th>";
	echo "</tr>";
	foreach ( $tipps as $tipp )
	{
		if ($tipp->spieleid == '70')
		{
			$bonustipps=$wpdb->get_results( "SELECT Name FROM wm2014_gruppen WHERE ID=$tipp->Tipp");

			echo "<tr>";
			
			if ($bonustipps == null)
				echo "<td>&nbsp;</td>";				
			
			else
			{
				foreach ( $bonustipps as $bonustipp )
				{			
					echo "<td>".$bonustipp->Name."</td>";
				}
			}

			if ($tipp->punkte == '10')
				echo "<td class='green'>".$tipp->punkte."</td>";
			elseif ($tipp->punkte == null)
				echo "<td>&nbsp;</td>";
			else
				echo "<td>".$tipp->punkte."</td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '71')
		{
			$bonustipps=$wpdb->get_results( "SELECT Runde FROM wm2014_runden WHERE ID=$tipp->Tipp");

			echo "<tr>";
			
			if ($bonustipps == null)
				echo "<td>&nbsp;</td>";				
			
			else
			{
				foreach ( $bonustipps as $bonustipp )
				{			
					echo "<td>".$bonustipp->Runde."</td>";
				}
			}
			
			if ($tipp->punkte == '3')
				echo "<td class='green'>".$tipp->punkte."</td>";
			elseif ($tipp->punkte == null)
				echo "<td>&nbsp;</td>";
			else
				echo "<td>".$tipp->punkte."</td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '72')
		{
			$bonustipps=$wpdb->get_results( "SELECT Name FROM wm2014_gruppen WHERE ID=$tipp->Tipp");

			echo "<tr>";
			
			if ($bonustipps == null)
				echo "<td>&nbsp;</td>";				
			
			else
			{
				foreach ( $bonustipps as $bonustipp )
				{			
					echo "<td>".$bonustipp->Name."</td>";
				}
			}
			
			if ($tipp->punkte == '3')
				echo "<td class='green'>".$tipp->punkte."</td>";
			elseif ($tipp->punkte == null)
				echo "<td>&nbsp;</td>";
			else
				echo "<td>".$tipp->punkte."</td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '73')
		{			
			echo "<tr>";
			
			
			if ($tipp->Tipp == null)
				echo "<td>&nbsp;</td>";				
			
			else
				echo "<td>".$tipp->Tipp."</td>";

			if ($tipp->punkte == '3')
				echo "<td class='green'>".$tipp->punkte."</td>";
			elseif ($tipp->punkte == null)
				echo "<td>&nbsp;</td>";
			else
				echo "<td>".$tipp->punkte."</td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '74')
		{
			$bonustipps=$wpdb->get_results( "SELECT display_name FROM wp_users WHERE ID=$tipp->Tipp");

			echo "<tr>";
			
			if ($bonustipps == null)
				echo "<td>&nbsp;</td>";				
			
			else
			{
				foreach ( $bonustipps as $bonustipp )
				{			
					echo "<td>".$bonustipp->display_name."</td>";
				}
			}

			if ($tipp->punkte == '3')
				echo "<td class='green'>".$tipp->punkte."</td>";
			elseif ($tipp->punkte == null)
				echo "<td>&nbsp;</td>";
			else
				echo "<td>".$tipp->punkte."</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
	echo "</td>";
}

echo "</tr>";
echo "</table>";

//echo "<br>";

echo "<table class='toptippliste'>";
echo "<tr>";
echo "<td>";
echo "<table class='spielliste'>";
echo "<tr>";
echo "<th>Nr";
echo "</th>";
echo "<th>Datum";
echo "</th>";
echo "<th>Spiel";
echo "</th>";
echo "<th>Ergebnis";
echo "</th>";
echo "</tr>";
foreach ( $spiele as $spiel )
{
	echo "<tr>";
	echo "<td>".$spiel->Nr."</td>";
	echo "<td>".$spiel->datum."</td>";
	echo "<td>".$spiel->Spiel."</td>";
	echo "<td class='centertext'>".$spiel->Ergebnis."</td>";
	echo "</tr>";
}
echo "</table>";
echo "</td>";

foreach ($users as $user)
{
	if ($userid == $user->ID)
	{
		$tipps = $wpdb->get_results( "SELECT CONCAT( tipp_H, ':', tipp_G ) AS Tipp, punkte FROM wm2014_tipps inner join wm2014_spiele on (wm2014_tipps.spieleid = wm2014_spiele.nr) WHERE userid=$user->ID ORDER BY Nr");
		echo "<td>";
		echo "<table class='tippliste'>";
		echo "<tr>";
		echo "<th class='userdata' colspan='2'>";

		echo "".$user->display_name."";
		echo "</th>";
		echo "</tr>";
		foreach ( $tipps as $tipp )
		{
			$Tipp = $tipp->Tipp;
			if ($tipp->Tipp == null)
				$Tipp = "&nbsp;";
			
			$punkte = $tipp->punkte;

			echo "<tr>";
			echo "<td class='userdata'>".$Tipp."</td>";

			if ($punkte == '3')
				echo "<td class='green'>".$punkte."</td>";
			elseif ($punkte == '1')
				echo "<td class='yellow'>".$punkte."</td>";
			elseif ($punkte == null)
				echo "<td>&nbsp;</td>";
			else
				echo "<td>".$punkte."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</td>";
	}
	else	
	{
		$tipps = $wpdb->get_results( "SELECT CONCAT( tipp_H, ':', tipp_G ) AS Tipp, punkte, UNIX_TIMESTAMP(datum) as spielzeit FROM wm2014_tipps inner join wm2014_spiele on (wm2014_tipps.spieleid = wm2014_spiele.nr) WHERE userid=$user->ID ORDER BY Nr");
		
		$timestamp = time();
		
		echo "<td>";
		echo "<table class='tippliste'>";
		echo "<tr>";
		echo "<th colspan='2'>";
			
		echo "".$user->display_name."";
		echo "</th>";
		echo "</tr>";
		foreach ( $tipps as $tipp )
		{
			echo "<tr>";
			
			$Tipp = $tipp->Tipp;
			if ($tipp->Tipp == null)
				$Tipp = "&nbsp;";

			if($tipp->spielzeit < $timestamp)
			{
				echo "<td>".$Tipp."</td>";
			}
			else
			{
				if ($tipp->Tipp == null)
				{
					$Leertipp = "&nbsp;";
				}
				else
				{
					$Leertipp = "<input type='image' src='/wm2014/fussball14.jpg'>";
				}
				echo "<td>".$Tipp."</td>";
			}
			
			$punkte = $tipp->punkte;
						
			if ($punkte == '3')
				echo "<td class='green'>".$punkte."</td>";
			elseif ($punkte == '1')
				echo "<td class='yellow'>".$punkte."</td>";
			elseif ($punkte == null)
				echo "<td>&nbsp;</td>";
			else
				echo "<td>".$punkte."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</td>";
	}
}

echo "</tr>";
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
	echo "<h2><b>Bitte anmelden</b></h2>";
}
?>
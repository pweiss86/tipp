<?php
global $wpdb;
global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

if ($userid <> 0)
{
include('em2012/autovote.php');

$plaetze=$wpdb->get_results("SELECT wp_users.display_name AS Name, wp_users.em2012_beitrag AS Beitrag, SUM( punkte ) AS Punkte, em2012_platz AS Platz, em2012_platzv AS Platzv FROM em2012_tipps INNER JOIN wp_users ON ( em2012_tipps.userid = wp_users.id ) WHERE userid>1 AND em2012='1' GROUP BY userid ORDER BY punkte DESC");

echo "<style type='text/css'>";
echo "input[type='image']";
echo "{";
echo "border:0px;";
echo "padding:0px;";
echo "margin:0px";
echo "}";
echo "</style>";


echo  "<table class='topliste'>";
echo  "<tr>";
echo  "<td nowrap>";
echo  "<table class='rangliste'>";
echo "<tr>";
    echo "<th colspan='2'><center>Platz</center></th>";
    echo "<th nowrap><center>Name</center></th>";
    echo "<th><center>bezahlt</center></th>";
	echo "<th><center>Punkte</center></th>";
echo "</tr>";
foreach ( $plaetze as $platz )
{	
	if ($platz->Platz == 1)
		echo  "<tr style='background-color:green; color:white'>";
	elseif ($platz->Platz == 2)
		echo  "<tr style='background-color:yellow'>";
	else
		echo  "<tr style='background-color:lightyellow'>";
		
    echo "<td nowrap><center>".$platz->Platz."</center></td>";
	echo "<td nowrap><center>";
	if($platz->Platz < $platz->Platzv)
		echo "<input style='outline:0' type='image' src='/wp-admin/images/pfeilo.png'>";
	elseif($platz->Platz > $platz->Platzv)
		echo "<input type='image' src='/wp-admin/images/pfeilu.png'>";
	else
		echo "<input type='image' src='/wp-admin/images/pfeil-.png'>";
	echo "</center></td>";
    echo "<td nowrap><center>".$platz->Name."<center></td>";
	echo "<td nowrap><center>";
	if ( $platz->Beitrag == '0')
		echo "Nein";
	if ( $platz->Beitrag == '1')
		echo "Ja";
	echo "</center></td>";
	echo "<td nowrap><center>";
    echo $platz->Punkte;
	echo "</center></td>";
    echo  "</tr>";
}
echo  "</table>";
echo  "</td>";
echo  "<td align='right' valign='top'>";
echo "<center><img class='wp-image-26' title='WM 2014' src='http://www.pewei.de/wp-content/uploads/2012/03/g1260810902-263x300.jpg' alt='' height='203' /></center>";
echo  "</td>";
echo  "</tr>";
echo  "</table>";

echo "<br>";

$spiele=$wpdb->get_results( "SELECT Nr, DATE_FORMAT(datum, '%d.%m.%y %H:%i') AS datum, CONCAT(Heim, ' : ', Gast) As Spiel, CONCAT(Ergebnis_H, ':', Ergebnis_G) As Ergebnis FROM em2012_tipps inner join em2012_spiele on (em2012_tipps.spieleid = em2012_spiele.nr) WHERE userid='4' ORDER BY Nr");
$users=$wpdb->get_results( "SELECT ID, display_name FROM wp_users WHERE ID<>1 AND em2012='1' order by id");

echo  "<table class='toptd'>";
echo "<tr>";
echo "<td>";
echo  "<table  width='300' class='tippliste'>";
echo "<tr>";
echo "<th colspan='3'>Bonusfrage";
echo "<th>";
echo "</tr>";
echo "<tr>";
echo "<td nowrap>Wer wird Europameister? (10 P.)</td>";
echo "</tr>";
echo "<tr>";
echo "<td nowrap>Wann fliegt Holland? (3 P.)</td>";
echo "</tr>";
echo "<tr>";
echo "<td nowrap>Welche Nation stellt den Torschützenkönig? (3 P.)</td>";
echo "</tr>";
echo "<tr>";
echo "<td nowrap>Schafft Senegal es diesmal? (? P.)</td>";
echo "</tr>";
echo "<tr>";
echo "<td nowrap>Übersteht mindestens einer der Gastgeber die Vorrunden-Phase? (3 P.)</td>";
echo "</tr>";
echo  "</table>";
echo "</td>";

foreach ($users as $user)
{
	//$color = '#' . strtoupper(dechex(rand(16773077,13486257)));
	$color = '#FFFFFF';
	$tipps = $wpdb->get_results( "SELECT spieleid, tipp_meister AS Tipp, punkte FROM em2012_tipps WHERE spieleid>49 AND userid=$user->ID ORDER BY spieleid");
	echo "<td nowrap>";
	echo "<table class='tippliste'>";
    echo "<tr>";
	echo "<th nowrap colspan='2'>";
	echo "<center>".$user->display_name."</center>";
	echo "</th>";
	echo "</tr>";
	foreach ( $tipps as $tipp )
	{
		if ($tipp->spieleid == '50')
		{
			$bonustipps=$wpdb->get_results( "SELECT Name FROM em2012_gruppen WHERE ID=$tipp->Tipp");

			echo "<tr>";
			foreach ( $bonustipps as $bonustipp )
			{
				echo "<td nowrap><center>".$bonustipp->Name."</center></td>";
			}

			if ($tipp->punkte == '10')
				echo "<td nowrap style='background-color:green; color:white'><center>".$tipp->punkte."</center></td>";
			elseif ($tipp->punkte == null)
				echo "<td nowrap style='background-color:white'><center>&nbsp;</center></td>";
			else
				echo "<td nowrap style='background-color:white'><center>".$tipp->punkte."</center></td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '51')
		{
			$bonustipps=$wpdb->get_results( "SELECT Runde FROM em2012_runden WHERE ID=$tipp->Tipp");

			echo "<tr>";
			foreach ( $bonustipps as $bonustipp )
			{
				echo "<td nowrap nowrap><center>".$bonustipp->Runde."</center></td>";
			}
			//echo "<td nowrap><center>".$tipp->Tipp."</center></td>";
			if ($tipp->punkte == '3')
				echo "<td nowrap style='background-color:green; color:white'><center>".$tipp->punkte."</center></td>";
			elseif ($tipp->punkte == null)
				echo "<td nowrap style='background-color:white'><center>&nbsp;</center></td>";
			else
				echo "<td nowrap style='background-color:white'><center>".$tipp->punkte."</center></td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '52')
		{
			$bonustipps=$wpdb->get_results( "SELECT Name FROM em2012_gruppen WHERE ID=$tipp->Tipp");

			echo "<tr>";
			foreach ( $bonustipps as $bonustipp )
			{
				echo "<td nowrap><center>".$bonustipp->Name."</center></td>";
			}
			//echo "<td nowrap><center>".$tipp->Tipp."</center></td>";
			if ($tipp->punkte == '3')
				echo "<td nowrap style='background-color:green; color:white'><center>".$tipp->punkte."</center></td>";
			elseif ($tipp->punkte == null)
				echo "<td nowrap style='background-color:white'><center>&nbsp;</center></td>";
			else
				echo "<td nowrap style='background-color:white'><center>".$tipp->punkte."</center></td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '53')
		{
			$bonustipps=$wpdb->get_results( "SELECT Name FROM em2012_gruppen WHERE ID=$tipp->Tipp");

			echo "<tr>";
			if ( $tipp->Tipp == '0')
				echo "<td nowrap><center>Ja</center></td>";
			if ( $tipp->Tipp == '1')
				echo "<td nowrap><center>Nein</center></td>";
			//echo "<td nowrap><center>".$tipp->Tipp."</center></td>";
			if ($tipp->punkte > '99')
				echo "<td nowrap style='background-color:green; color:white'><center>".$tipp->punkte."</center></td>";
			elseif ($tipp->punkte == null)
				echo "<td nowrap style='background-color:white'><center>&nbsp;</center></td>";
			else
				echo "<td nowrap style='background-color:white'><center>".$tipp->punkte."</center></td>";
			echo "</tr>";
		}
		
		elseif ($tipp->spieleid == '54')
		{
			$bonustipps=$wpdb->get_results( "SELECT Name FROM em2012_gruppen WHERE ID=$tipp->Tipp");

			echo "<tr>";
			if ( $tipp->Tipp == '0')
				echo "<td nowrap><center>Ja</center></td>";
			if ( $tipp->Tipp == '1')
				echo "<td nowrap><center>Nein</center></td>";
			if ($tipp->punkte == '3')
				echo "<td nowrap style='background-color:green; color:white'><center>".$tipp->punkte."</center></td>";
			elseif ($tipp->punkte == null)
				echo "<td nowrap style='background-color:white'><center>&nbsp;</center></td>";
			else
				echo "<td nowrap style='background-color:white'><center>".$tipp->punkte."</center></td>";
			echo "</tr>";
		}
	}
	echo  "</table>";
	echo "</td>";
}

echo "</tr>";
echo "</table>";

echo "<br>";

echo  "<table class='toptd'>";
echo "<tr>";
echo "<td nowrap>";
echo  "<table class='tippliste'>";
echo "<tr>";
echo "<th nowrap>Nr";
echo "</th>";
echo "<th nowrap>Datum";
echo "</th>";
echo "<th nowrap>Spiel";
echo "</th>";
echo "<th nowrap>Ergebnis";
echo "</th>";
echo "</tr>";
foreach ( $spiele as $spiel )
{
	echo "<tr>";
    echo "<td nowrap>".$spiel->Nr."</td>";
    echo "<td nowrap>".$spiel->datum."</td>";
    echo "<td nowrap><center>".$spiel->Spiel."</center></td>";
    echo "<td nowrap><center>".$spiel->Ergebnis."</center></td>";
    echo "</tr>";
}
echo  "</table>";
echo "</td>";

foreach ($users as $user)
{
	if ($userid == $user->ID)
	{
		$tipps = $wpdb->get_results( "SELECT CONCAT( tipp_H, ':', tipp_G ) AS Tipp, punkte FROM em2012_tipps inner join em2012_spiele on (em2012_tipps.spieleid = em2012_spiele.nr) WHERE userid=$user->ID ORDER BY Nr");
		echo "<td nowrap>";
		echo "<table class='tippliste'>";
		echo "<tr>";
		echo "<th nowrap style='background-color:lightblue' colspan='2'>";

		echo "<center>".$user->display_name."</center>";
		echo "</th>";
		echo "</tr>";
		foreach ( $tipps as $tipp )
		{
			$Tipp = $tipp->Tipp;
			if ($tipp->Tipp == null)
				$Tipp = "&nbsp;";
			
			$punkte = $tipp->punkte;

			echo "<tr>";
			echo "<td nowrap style='background-color:lightblue'><center>".$Tipp."</center></td>";

			if ($punkte == '3')
				echo "<td style='background-color:green; color:white'><center>".$punkte."</center></td>";
			elseif ($punkte == '1')
				echo "<td style='background-color:yellow'><center>".$punkte."</center></td>";
			elseif ($punkte == null)
				echo "<td style='background-color:white'><center>&nbsp;</center></td>";
			else
				echo "<td style='background-color:white'><center>".$punkte."</center></td>";
			echo "</tr>";
		}
		echo  "</table>";
		echo "</td>";
	}
	else	
	{
		$tipps = $wpdb->get_results( "SELECT CONCAT( tipp_H, ':', tipp_G ) AS Tipp, punkte, UNIX_TIMESTAMP(datum) as spielzeit FROM em2012_tipps inner join em2012_spiele on (em2012_tipps.spieleid = em2012_spiele.nr) WHERE userid=$user->ID ORDER BY Nr");
		
		$timestamp = time();
		
		echo "<td nowrap>";
		echo "<table class='tippliste'>";
		echo "<tr>";
		echo "<th nowrap colspan='2'>";
			
		echo "<center>".$user->display_name."</center>";
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
				echo "<td nowrap><center>".$Tipp."</center></td>";
			}
			else
			{
				if ($tipp->Tipp == null)
				{
					$Leertipp = "&nbsp;";
				}
				else
				{
					//$Leertipp = "<input type='image' src='/em2012/fussball16.jpg'>";
					$Leertipp = "<input type='image' src='/em2012/fussball14.jpg'>";
					//$Leertipp = "&nbsp;";
				}
				echo "<td nowrap><center>".$Leertipp."</center></td>";
			}
			
			$punkte = $tipp->punkte;
						
			if ($punkte == '3')
				echo "<td style='background-color:green; color:white'><center>".$punkte."</center></td>";
			elseif ($punkte == '1')
				echo "<td style='background-color:yellow'><center>".$punkte."</center></td>";
			elseif ($punkte == null)
				echo "<td style='background-color:white'><center>&nbsp;</center></td>";
			else
				echo "<td style='background-color:white'><center>".$punkte."</center></td>";
			echo "</tr>";
		}
		echo  "</table>";
		echo "</td>";
	}
}

echo "</tr>";
echo "</table>";
}
else
{
    echo "<h2><b>Du kommst hier net rein!!</b></h2>";
}
?>
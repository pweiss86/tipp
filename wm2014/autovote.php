<?php

$timestamp = time();

$tipps=$wpdb->get_results( "SELECT Nr, SUM(tipp_h) as tipp_h, SUM(tipp_g) as tipp_g, COUNT(tipp_h) as Menge, UNIX_TIMESTAMP(datum) as timestamp, Spielende FROM wm2014_spiele inner join wm2014_tipps on (wm2014_spiele.Nr = wm2014_tipps.spieleid) WHERE userid<>'4' group by Nr order by Nr");

foreach ( $tipps as $tipp )
{
	if ($tipp->Spielende == 0)
	{
		$TippNr = $tipp->Nr;
		$TippHeim = $tipp->tipp_h;
		$TippGast = $tipp->tipp_g;
		$Spielmenge = $tipp->Menge;
		
		/*
		if ($TippHeim == null || $TippHeim == '0')
			$TippHeim = '1';
		if ($TippGast == null || $TippGast == '0')
			$TippGast = '1';
		*/
		
		if ($Spielmenge == null || $Spielmenge == '0')
			$Spielmenge = '1';
		
		$ergebnis_h = round($TippHeim / $Spielmenge);
		$ergebnis_g = round($TippGast / $Spielmenge);
		
		/*
		$ergebnisNOTR_h = $TippHeim / $Spielmenge;
		$ergebnisNOTR_g = $TippGast / $Spielmenge;
				
		echo "<table>";
		echo "<tr>";
		echo "<th>";
		echo "Nr";
		echo "</th>";
		echo "<th>";
		echo "H NOTR";
		echo "</th>";
		echo "<th>";
		echo "G NOTR";
		echo "</th>";
		echo "<th>";
		echo "H";
		echo "</th>";
		echo "<th>";
		echo "G";
		echo "</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>";
		echo $tipp->Nr;
		echo "</td>";
		echo "<td>";
		echo $ergebnisNOTR_h;
		echo "</td>";
		echo "<td>";
		echo $ergebnisNOTR_g;
		echo "</td>";
		echo "<td>";
		echo $ergebnis_h;
		echo "</td>";
		echo "<td>";
		echo $ergebnis_g;
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		*/
		
		//Bei Endrundenspiele Unentschieden ausschließen
		if ($TippNr > 48)
		{
			if ($ergebnis_h == $ergebnis_g)
			{
				$ergebnis_h = rand('0','3');
				$ergebnis_g = rand('0','3');
			}
			
			if ($ergebnis_h == $ergebnis_g)
				$ergebnis_h++;	
		}
		
		$start = $tipp->timestamp - 3600;
		$zufallsdatum = rand($start,$tipp->timestamp);
		$tippzeit = date('Y-m-d H:i:s', $zufallsdatum);
		$wpdb->query("UPDATE wm2014_tipps SET tipp_h=$ergebnis_h, tipp_g=$ergebnis_g, datetime='".$tippzeit."' WHERE userid='4' AND spieleid=$tipp->Nr");
		
		if ($tipp->timestamp <= $timestamp)
		{
			$wpdb->query("UPDATE wm2014_spiele SET Spielende='1' WHERE Nr=$tipp->Nr");
		}
	}
}
?>
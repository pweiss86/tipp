<?php

//$timestamp = time();

//$tipps=$wpdb->get_results( "SELECT Nr, SUM(tipp_h) as tipp_h, SUM(tipp_g) as tipp_g, COUNT(tipp_h) as Menge, UNIX_TIMESTAMP(datum) as timestamp, Spielende FROM em2012_spiele inner join em2012_tipps on (em2012_spiele.Nr = em2012_tipps.spieleid) WHERE userid<>'4' group by Nr");

//foreach ( $tipps as $tipp )
//{
	//if ($tipp->timestamp < $timestamp && $tipp->Spielende == 0)
//	if ($tipp->Spielende == 0)
//	{
//		$ergebnis_h = round($tipp->tipp_h / $tipp->Menge);
//		$ergebnis_g = round($tipp->tipp_g / $tipp->Menge);
//		$start = $tipp->timestamp - 3600;
//		$zufall = rand($start,$tipp->timestamp);
//		$tippzeit = date('Y-m-d H:i:s', $zufall);
//		$wpdb->query("UPDATE em2012_tipps SET tipp_h=$ergebnis_h, tipp_g=$ergebnis_g, datetime='".$tippzeit."' WHERE userid='4' AND spieleid=$tipp->Nr");
//		
//		if ($tipp->timestamp <= $timestamp)
//		{
//			$wpdb->query("UPDATE em2012_spiele SET Spielende='1' WHERE Nr=$tipp->Nr");
//		}
//	}
//}
?>
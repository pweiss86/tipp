<?php
global $wpdb;
global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

include('em2012/autovote.php');

if ($userid == 4 or $userid == 5)
{

$spiele=$wpdb->get_results( "SELECT Nr, DATE_FORMAT(datum, '%d.%m.%y %H:%i') AS datum, CONCAT(Heim, ' : ', Gast) As Spiel, CONCAT(Ergebnis_H, ':', Ergebnis_G) As Ergebnis, H, G FROM em2012_spiele ORDER BY Nr");

echo  "<table>";
echo "<tr>";
echo "<th colspan='9'><center><h4><b>Ergebnisse</b></h4></center></th>";
echo "</tr>";
echo "<tr>";
echo "<th><center>Nr</center></th>";
echo "<th><center>Datum</center></th>";
echo "<th><center>Spiel</center></th>";
echo "<th><center>Ergebnis</center></th>";
echo "<th colspan='4'><center>Ergebnis ändern</center></th>";
echo "<th></th>";
echo "</tr>";
foreach ( $spiele as $spiel )
{
    echo "<tr>";
    echo "<td>".$spiel->Nr."</td>";
    echo "<td>".$spiel->datum."</td>";
    echo "<td>".$spiel->Spiel."</td>";
    echo "<td><center>".$spiel->Ergebnis."</center></td>";
    echo "<form method='post' action='em2012/save_ergebnisse.php'>";
    echo "<td>";
	echo "<input type='text' size='1' name='ergebnis_h'>";
	echo "</td>";
	echo "<td>";
	echo ":";
	echo "</td>";
	echo "<td>";
    echo "<input type='text' size='1' name='ergebnis_g'>";
    echo "</td>";
	echo "<td>";
	echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
	echo "</td>";
    echo "<input type='hidden' name='spielid' value='$spiel->Nr'>";
	echo "<input type='hidden' name='gruppe_h' value='$spiel->H'>";
	echo "<input type='hidden' name='gruppe_g' value='$spiel->G'>";
    echo "</form>";
	echo "<form method='post' action='em2012/del_ergebnisse.php'>";
	echo "<td>";
	echo "<input type='image' src='/wp-admin/images/no.png' alt='Löschen'>";
	echo "</td>";
    echo "<input type='hidden' name='spielid' value='$spiel->Nr'>";
    echo "</form>";
    echo "</tr>";
}
echo "</table>";

$endspiele=$wpdb->get_results( "SELECT Nr, Heim, Gast, H, G FROM em2012_spiele WHERE NR>48 ORDER BY Nr");
$laender=$wpdb->get_results( "SELECT ID, Name FROM em2012_gruppen");
$runden=$wpdb->get_results( "SELECT ID, Runde FROM em2012_runden");
$users=$wpdb->get_results( "SELECT ID, display_name FROM wp_users WHERE em2012='1'");

echo  "<br>";
echo  "<table>";

echo "<tr>";
echo "<th><center>Bonusfrage</center></th>";
echo "<th colspan='2'><center>Ergebnis ändern</center></th>";
echo "<th></th>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "Wann fliegt Holland?";
echo "</td>";
echo "<form method='post' action='em2012/save_bonusergebnisse.php'>";
echo "<td>";
echo  "<select name='holland'>";
foreach ( $runden as $runde )
{
    echo "<option value=".$runde->ID.">";
    echo $runde->Runde;
    echo "</option>";
} 
echo  "</select>";
echo "</td>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "<input type='hidden' name='spielid' value='71'>";
echo "</td>";
echo "</form>";
echo "<form method='post' action='em2012/del_ergebnisse.php'>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/no.png' alt='Löschen'>";
echo "<input type='hidden' name='spielid' value='71'>";
echo "</td>";
echo "</form>";
echo "</td>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "Welche Nation stellt den Torschützenkönig?";
echo "</td>";
echo "<form method='post' action='em2012/save_bonusergebnisse.php'>";
echo "<td>";
echo  "<select name='torschuetze'>";
foreach ( $laender as $land )
{
    echo "<option value=".$land->ID.">";
    echo $land->Name;
    echo "</option>";
} 
echo  "</select>";
echo "</td>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "<input type='hidden' name='spielid' value='72'>";
echo "</td>";
echo "</form>";
echo "<form method='post' action='em2012/del_ergebnisse.php'>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/no.png' alt='Löschen'>";
echo "<input type='hidden' name='spielid' value='72'>";
echo "</td>";
echo "</form>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Wieviele Tore macht Cristiano Ronaldo?";
echo "</td>";
echo "<form method='post' action='em2012/save_bonusergebnisse.php'>";
echo "<td>";
echo  "<select name='ronaldo'>";
for($i=0;$i<26;$i++)
{
echo '<option>'.$i.'</option>';
} 
echo  "</select>";
echo "</td>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "<input type='hidden' name='spielid' value='73'>";
echo "</td>";
echo "</form>";
echo "<form method='post' action='em2012/del_ergebnisse.php'>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/no.png' alt='Löschen'>";
echo "<input type='hidden' name='spielid' value='73'>";
echo "</td>";
echo "</form>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Wer wird Tippmeister?";
echo "</td>";
echo "<form method='post' action='em2012/save_bonusergebnisse.php'>";
echo "<td>";
echo  "<select name='tippmeister'>";
foreach ( $users as $user )
{
    echo "<option value=".$user->ID.">";
    echo $user->display_name;
    echo "</option>";
}
echo  "</select>";
echo "</td>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "<input type='hidden' name='spielid' value='74'>";
echo "</td>";
echo "</form>";
echo "<form method='post' action='em2012/del_ergebnisse.php'>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/no.png' alt='Löschen'>";
echo "<input type='hidden' name='spielid' value='74'>";
echo "</td>";
echo "</form>";
echo "</td>";
echo "</tr>";

echo "</table>";

echo  "<br>";
echo  "<table>";
echo "<tr>";
echo "<th colspan='6'><center>Endrunden</center></th>";
echo "<th></th>";
echo "</tr>";
foreach ( $endspiele as $endspiel )
{
echo "<tr>";
echo "<td>";
echo $endspiel->Heim;
echo "</td>";
echo "<form method='post' action='em2012/save_endrunde.php'>";
echo "<td>";
echo  "<select name='land'>";
foreach ( $laender as $land )
{
    echo "<option value=".$land->ID.">";
    echo $land->Name;
    echo "</option>";
} 
echo  "</select>";
echo "</td>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "<input type='hidden' name='spielid' value='$endspiel->Nr'>";
echo "<input type='hidden' name='gruppe' value='H'>";
echo "</td>";
echo "</form>";
echo "<td>";
echo $endspiel->Gast;
echo "</td>";
echo "<form method='post' action='em2012/save_endrunde.php'>";
echo "<td>";
echo  "<select name='land'>";
foreach ( $laender as $land )
{
    echo "<option value=".$land->ID.">";
    echo $land->Name;
    echo "</option>";
} 
echo  "</select>";
echo "</td>";
echo "<td>";
echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
echo "<input type='hidden' name='spielid' value='$endspiel->Nr'>";
echo "<input type='hidden' name='gruppe' value='G'>";
echo "</td>";
echo "</form>";
echo "</tr>";
}
echo "</table>";

$users=$wpdb->get_results("SELECT wp_users.display_name AS Name, wp_users.id AS ID, wp_users.em2012_beitrag AS Beitrag FROM wp_users WHERE ID>1 AND em2012='1' ORDER BY wp_users.display_name");

echo  "<br>";
echo  "<table>";
echo "<tr>";
echo "<th><center>Name</center></th>";
echo "<th width='80'><center>bezahlt</center></th>";
echo "<th colspan='2 'width='80'><center>ändern</center></th>";
echo "</tr>";
foreach ( $users as $user )
{
    echo  "<tr align='center'>";
    echo "<td nowrap>".$user->Name."</td>";
			if ( $user->Beitrag == '0')
				echo "<td>Nein</td>";
			if ( $user->Beitrag == '1')
				echo "<td>Ja</td>";
	echo "<form method='post' action='em2012/save_beitrag.php'>";
	echo "<td>";
	echo  "<select name='beitrag'>";
	echo "<option value=1>";
	echo "Ja";
	echo "</option>";
	echo "<option value=0>";
	echo "Nein";
	echo "</option>";
	echo  "</select>";
	echo "</td>";
	echo "<td>";
	echo "<input type='image' src='/wp-admin/images/yes.png' alt='Speichern'>";
	echo "<input type='hidden' name='userid' value=".$user->ID.">";
	echo "</td>";
	echo "</form>";
    echo  "</tr>";
}
echo  "</table>";
}
else
{
    echo "<h2><b>Du hast keine Berechtigung</b></h2>";
}

?>
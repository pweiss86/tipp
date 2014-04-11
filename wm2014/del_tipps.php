<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$spielid = $_POST['spielid'];

global $current_user;
get_currentuserinfo();
$userid = $current_user->ID;

if ($spielid < '70')
{
	$wpdb->query("UPDATE wm2014_tipps SET tipp_h=NULL, tipp_g=NULL WHERE userid=$userid AND spieleid=$spielid");
}
else
{
	$wpdb->query("UPDATE wm2014_tipps SET tipp_sonder=NULL WHERE userid=$userid AND spieleid=$spielid");
}

echo "";

?>
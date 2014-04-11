<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$beitrag = $_POST['beitrag'];
$beitrag_text = $_POST['beitrag_text'];
$userid = $_POST['userid'];

$wpdb->query("UPDATE wp_users SET wp_users.wm2014_beitrag=$beitrag WHERE ID=$userid");

echo $beitrag_text;

?>
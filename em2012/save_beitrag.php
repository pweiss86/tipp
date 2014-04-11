<?php

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');

$beitrag = $_POST['beitrag'];
$userid = $_POST['userid'];

$wpdb->query("UPDATE wp_users SET wp_users.em2012_beitrag=$beitrag WHERE ID=$userid");

header( 'Location: http://www.pewei.de/?page_id=436' );

?>
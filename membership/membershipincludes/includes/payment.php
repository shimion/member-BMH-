<?php
require_once ABSPATH .'wp-load.php';
if($_POST):
echo do_shortcode('[stripepayment]');
else:
wp_redirect( site_url() ); exit;
endif;
?>

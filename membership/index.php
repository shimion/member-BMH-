<?php
session_start();
/*
Plugin Name: Membership Premium
Version: 3.4.4.1
Plugin URI: http://premium.wpmudev.org/project/membership
Description: The most powerful, easy to use and flexible membership plugin for WordPress, Multisite and BuddyPress sites available. Offer downloads, posts, pages, forums and more to paid members.
Author: Barry (Incsub), Cole (Incsub)
Author URI: http://premium.wpmudev.org
WDP ID: 140

Copyright 2013 (email: admin@incsub.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
// Load the config file
require_once('membershipincludes/includes/membership-config.php');
// Load the common functions
require_once('membershipincludes/includes/functions.php');
// Set up my location
set_membership_url(__FILE__);
set_membership_dir(__FILE__);

// Load required classes
function membersuccesspayment(){
//print_r($_SESSION);
if(is_user_logged_in() && $_SESSION['action'] ){
require_once('membershipincludes/includes/success.payment.php');
//echo '<p>Thank you for subscribing. We hope you enjoy the content.</p>';
} else {
wp_redirect( home_url() );
}
}
function memberaddlisting(){ if( is_user_logged_in() ) {
require_once ABSPATH .'/wp-load.php';
global $wpdb;
$user_ID = get_current_user_id();
$subscription = "select `sub_id` from `".$wpdb->prefix ."m_member_relationships` where `user_id` = ".$user_ID." ";
$levelID = $wpdb->get_results($subscription); ?>
<style type="text/css">
.roundedOne {
  margin: 9px 9px 0 0 !important;
}
</style>
<?php
echo '<link id="publicformscss-css" media="all" type="text/css" href="'.site_url().'/wp-content/plugins/membership/membershipincludes/css/publicforms.css?ver=3.9.1" rel="stylesheet">';
 if( $levelID[0]->sub_id == '2' || $levelID[0]->sub_id == '3' ){
    require_once('membershipincludes/includes/add.listing.php');
 }  else if( $levelID[0]->sub_id == '1' ) {
    require_once('membershipincludes/includes/visitor.subscription.php');
 }
 }  else  {
wp_redirect( home_url() );
}
}

function membereditlisting(){ if( is_user_logged_in() ) {
 require_once('membershipincludes/includes/edit.listing.php');
 } else {
wp_redirect( home_url() );
}
}

function membereditpost(){ if( is_user_logged_in() ) {
 require_once('membershipincludes/includes/edit.post.php');
 } else {
wp_redirect( home_url() );
}
}

function payment_stripe_method(){
#if($_POST['cmd']){
	require_once('membershipincludes/includes/payment.php');
#}
#else{	wp_redirect( home_url() );	}
}

require_once('membershipincludes/classes/class.rule.php');
require_once('membershipincludes/classes/class.gateway.php');
require_once('membershipincludes/classes/class.level.php');
require_once('membershipincludes/classes/class.subscription.php');
require_once('membershipincludes/classes/class.membership.php');
// Shortcodes class
require_once('membershipincludes/classes/class.shortcodes.php');
// Communications class
require_once('membershipincludes/classes/class.communication.php');
// URL groups class
require_once('membershipincludes/classes/class.urlgroup.php');
// Pings class
require_once('membershipincludes/classes/class.ping.php');
// Add in the coupon
require_once('membershipincludes/classes/class.coupon.php');
// Add in the Admin bar
require_once('membershipincludes/classes/class.adminbar.php');
// Set up the default rules
require_once('membershipincludes/includes/default.rules.php');

// Load the Cron process
require_once('membershipincludes/classes/membershipcron.php');

if(is_admin()) {
	include_once('membershipincludes/external/wpmudev-dash-notification.php');
	// Administration interface
	// Add in the contextual help
	require_once('membershipincludes/classes/class.help.php');
	// Add in the wizard and tutorial
	require_once('membershipincludes/classes/class.wizard.php');
	require_once('membershipincludes/classes/class.tutorial.php');
	// Add in the tooltips class - from social marketing app by Ve
	require_once('membershipincludes/includes/class_wd_help_tooltips.php');
	// Add in the main class
	require_once('membershipincludes/classes/membershipadmin.php');

	$membershipadmin = new membershipadmin();

	// Register an activation hook
	register_activation_hook( __FILE__, 'M_activation_function' );

} else {
	// Public interface
	require_once('membershipincludes/classes/membershippublic.php');

	$membershippublic = new membershippublic();

}

add_shortcode('successpayment','membersuccesspayment');
add_shortcode('addlisting','memberaddlisting');
add_shortcode('editlisting','membereditlisting');
add_shortcode('editpost','membereditpost');
add_shortcode('payment_form','payment_stripe_method');
// Load secondary plugins
load_all_membership_addons();
load_membership_gateways();

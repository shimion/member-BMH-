<?php
session_start();
Global $M_options , $wpdb;
$query = "SELECT `rel_id` FROM `wp_bmee_m_member_relationships` WHERE `user_id` = '".$member->ID ."'";
$results = $wpdb->get_results($query);
if( isset($_REQUEST['gateway']) && isset($_REQUEST['extra_form']) ) {
	$gateway = M_get_class_for_gateway($_REQUEST['gateway']);
	if($gateway && is_object($gateway) && $gateway->haspaymentform == true) {
		$sub =  new M_Subscription( $subscription );
		$pricing = $sub->get_pricingarray();
		do_action('membership_payment_form', $sub, $pricing, $member->ID);
	}

} else if( $member->on_sub( $subscription ) || $results ) {
?>
<style type="text/css">
.logoutbutton 
{		  
align-self: center;		  
background: none repeat scroll 0 0 #009815;		  
border: 1px solid #007400;		  
border-radius: 4px;		  
color: #fff;		  
float: left;		  
margin: 0 44%;		  
padding: 10px 25px;		  
text-align: center;		
}
</style>
<div id='membership-wrapper'>
<div class="alert">
<?php echo __('You have already a subscription'); ?>
</div>
<a class="logoutbutton" href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a>
</div>
<?php
} else {
	
	$sub =  new M_Subscription( $subscription );
	// Get the coupon
	$coupon = membership_get_current_coupon();
	// Build the pricing array
	$pricing = $sub->get_pricingarray();

	if(!empty($pricing) && !empty($coupon) && method_exists( $coupon, 'valid_for_subscription') && $coupon->valid_for_subscription( $sub->id ) ) {
			$pricing = $coupon->apply_coupon_pricing( $pricing );
	}

	?>
<style type="text/css">
.pricescolumn {
  float: left;
  width: 100%;
}
.radio-outerbox {
  margin: 0 auto;
  width: 80%;
}
.radio-outerbox .roundedOne {
  margin: 10px 0;
}
</style>
<?php
    if(esc_attr($_POST['task']) == 'addpropertyformstep1'):
        echo '<div id="membership-wrapper"><script>window.location="'.site_url('welcome').'";</script></div>';
        //echo '<a style="padding: 8px 12px; border-radius: 4px;" class="paa_fieldaddlistion" href="'.site_url('welcome').'">Continue</a></div>';
    endif;   
	if($_SESSION['FormData']['subscription'] == 'register'):
        if(isset($_GET['subscription'])):
            if(!isset($_SESSION['subFormData'])):
                include_once 'question-form.php';
            endif;
        endif;
        if(!empty($_SESSION['subFormData'])): ?>		
		<div id='membership-wrapper' class="paymentform">
			<legend><?php echo __('Sign up for','membership') . " " . $sub->sub_name(); ?></legend>

			<div class="alert alert-success">
			<?php echo __('Please check the details of your subscription below and click on the relevant button to complete the subscription.','membership'); ?>
			</div>
           <div class="paymentpopup">
			<div class='purchasetable'>
			<div>
				<span class='detailscolumn'>
				<?php echo $sub->sub_name(); ?>
				</span>
			</div>
			<div class="paymentnote">
				<p>Please select the subscription payment that<br>you would like to purchase from<br>
				BoardMyHorseNow.com.</p>
			</div>
			<div class="quicknote">
				<p>Please Note: The Yearly subscription is <br> priced at discount.</p>
			</div>
			<?php if(!defined('MEMBERSHIP_HIDE_PAYTEXT')) { ?>
			<div class='pricescolumn'>
				<div class="radio-outerbox">
					<div class="roundedOne">
					<?php
						// Decipher the pricing array and display it
						echo '<strong>' . __('You Will Pay : ', 'membership') . '</strong> ' . membership_price_in_text( $pricing );
						
						//print_r($pricing);
					?>
					<input type="radio" id="submonthlypayment" checked name="paypalpayment" onclick="javascript:selectmonthypayment();">
					<label for="submonthlypayment"></label>
					</div>	
					<div class="roundedOne">
					<?php
						// Decipher the pricing array and display it
						if( $_GET['subscription'] == 2 ){
						 echo '<strong> You Will Pay : $79.95 For The Year </strong>
							   <input type="hidden" value="1" id="prmonth"> 
						       <input type="hidden" value="3" id="yearpay"/>' ;
						
						}
						else if( $_GET['subscription'] == 3 ){
						 echo '<strong> You Will Pay : $99.95 For The Year </strong>
							   <input type="hidden" value="2" id="prmonth">
							   <input type="hidden" value="4" id="yearpay"/>' ;
						}
					?>
					<input type="radio" id="subyearlypayment" name="paypalpayment" onclick="javascript:selectyearlypayment();">
					<label for="subyearlypayment"></label>					
					</div>
				</div>
			</div>
			<?php } ?>
			</div>

			<?php
					if(!defined('MEMBERSHIP_HIDE_COUPON_FORM')) {
						if( !isset($M_options['show_coupons_form']) || $M_options['show_coupons_form'] == 'yes' ) {
							include_once( membership_dir( 'membershipincludes/includes/coupon.form.php' ) );
						}

					}
			?>
			<span class='buynowcolumn'>
				<?php

				if(!empty($pricing)) {
					do_action('membership_purchase_button', $sub, $pricing, $member->ID);
				}
				?>
			</span>
             
             
<div class="payment_note"><b>PLEASE NOTE:</b> Coupon codes should NOT have spaces.  If you received a coupon code with a space, simply remove it and it should work fine.  Thank you and sorry for any confusion or inconvenience.</div>
		</div>
	</div>
	<?php
	
        endif;
     endif;
}

?>

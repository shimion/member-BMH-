<style type="text/css">#membership-wrapper legend {  color: #343A41;  font-family: 'Oswald',sans-serif;  font-size: 30px;  letter-spacing: 0;  line-height: 1.2em;  margin: 22px 0 2px;  }a#stripe-submit {  background: none repeat scroll 0 0 #009815;  border: medium none;  color: #fff;  cursor: pointer;  float: right;  margin-right: 53%;  padding: 8px 30px;  width: 7%;}.wrapper-title {  text-align: center;  text-transform: uppercase;}#membership-wrapper .alert-success, #membership-wrapper .alert-success .alert-heading {  color: #468847;}#membership-wrapper .alert-success {  background-color: #DEF7E4;  border-color: #8DE3A1;}#membership-wrapper .alert {  background-color: #DEF7E4;  border: 1px solid #8DE3A1;  border-radius: 4px 4px 4px 4px;  margin-bottom: 20px;  padding: 10px 30px 10px 15px;  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);}div.priceboxes {  margin-left: auto;  margin-right: auto;  overflow: hidden;  padding: 20px 0 0;  position: relative;  width: 99%;}div.pricebox {  background: none repeat scroll 0 0 #FFFFFF;  border: 1px solid #DDDDDD;  float: left !important;  margin-bottom: 20px;  margin-top: 0;  position: relative;  width: 99%;}div.topbar {  background: none repeat scroll 0 0 #EEEEEE;  color: #00A49D;  font-family: 'Oswald',sans-serif;  font-size: 22px;  overflow: hidden;  padding-bottom: 10px;  padding-top: 10px;  position: relative;  text-align: left;  text-transform: uppercase;  top: 0;  width: 100%;}.pricedetails {  list-style-type: none;  margin-left: 0;  margin-right: 0;  padding: 10px;  position: relative;  text-align: left;}.blue {  background: -moz-linear-gradient(center top , #00ADEE, #0078A5) repeat scroll 0 0 transparent;  border: 1px solid #0076A3;  color: #D9EEF7 !important;  height:30px !important; margin: -3px 0 0 !important;  }table.plans-wrapper {  background: none repeat scroll 0 0 #f2ecd8;  border: 1px solid;  margin: 33px 11px;}table.plans-wrapper thead th {  color: #5594c3;}table.plans-wrapper thead th {  color: #5594c3;  padding: 12px;}table.plans-wrapper tbody td {  padding: 10px;  text-align: center;}#delete-stripe-payment-form > button {  background: none repeat scroll 0 0 #009815;  border: medium none;  color: #fff;  cursor: pointer;}button#stripe-submit {  background: none repeat scroll 0 0 #009815;  border: medium none;  color: #fff;  cursor: pointer;  padding: 10px 20px;}
</style>

<?php
	global $wpdb;
	if(!is_user_logged_in()) {
		// The user isn't logged in so display a message here
		?>
		<div class="priceboxes">
		<div id='membership-wrapper'>
			<form class="form-membership" action="<?php echo get_permalink(); ?>" method="post">
				<fieldset>
				<legend><?php echo __('Your Subscription','membership'); ?></legend>
				<div class="alert alert-error">
				<?php echo __('You are not logged in. Please login to view your subscription.', 'membership'); ?>
				</div>				</fieldset>			</form>		</div>		<?php	} else {		$user_id = get_current_user_id();		$Payment = "select * from `".$wpdb->prefix ."m_member_payments` where `member_id` = '".$user_id."' ";		$subscription = $wpdb->get_results($Payment); 
		if($subscription[0]->cus_id):
		?>
		<div id='membership-wrapper'>
			<h3 class="wrapper-title">
				<?php echo __('Your Current Subscription', 'membership'); ?>
			</h3>
			<table width="96%" class="plans-wrapper" border="3">
			<thead>
				<tr>
				<th>ID</th>
				<th>Plan Name</th>
				<th># of Payments</th>
				<th>Interval</th>
				<th>Status</th>
				<th>Plan Start Date</th>
				<th>Plan End Date</th>
				</tr>
					</thead>
						<tbody>
					<tr>
					<td><?php echo $subscription[0]->id; ?></td>
				
					
					<td><?php echo $subscription[0]->plan_name; ?></td>
				
					
					<td><?php echo $subscription[0]->interval_count; ?></td>
				
					
					<td><?php echo $subscription[0]->interval; ?></td>
				
					
					<td><?php echo $subscription[0]->status; ?></td>
				
					
					<td><?php echo date('d-m-Y',$subscription[0]->current_period_start); ?></td>
				
					
					<td><?php echo date('d-m-Y',$subscription[0]->current_period_end); ?></td>
				</tr>
				</tbody>
			</table>
		</div>
	<?php	
/*		echo '<h3 class="wrapper-title">';
			echo __('Delete Subscriptions .', 'membership');
		echo '</h3>';*/
		echo do_shortcode('[deletestripepayment]');/*
		echo '<h3 class="wrapper-title">';
				echo __('Update Subscriptions', 'membership');
		echo '</h3>';*/
		echo do_shortcode('[updatestripepayment]');
	else:
		echo '<h3 class="wrapper-title">';
			echo __('Sign up for \'Up the Road\' ($9.95/mo)', 'membership');
		echo '</h3>';
		echo do_shortcode('[createstripepayment]');
	endif;
	}
?>
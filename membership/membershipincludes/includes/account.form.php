<?php
	global $profileuser, $user_id, $user ,$wpdb;

	if(isset($_POST['action']) && $_POST['action'] == 'update') {

		if( wp_verify_nonce($_REQUEST['_wpnonce'], 'update-user_' . $user_id) ) {
			$msg = '<div class="alert alert-success">' . __('Your details have been updated.','membership') . '</div>';

			$user = array( 	'ID'			=>	$_POST['user_id'],
							'first_name'	=>	$_POST['first_name'],
							'last_name'		=>	$_POST['last_name'],
							'nickname'		=>	$_POST['nickname'],
							'display_name'	=>	$_POST['display_name'],
							'user_email'	=>	$_POST['email'],
							'user_url'		=>	$_POST['url']
						);

			if(!empty($_POST['pass1'])) {
				if(($_POST['pass1'] == $_POST['pass2'])) {
					$user['user_pass'] = $_POST['pass1'];
				} else {
					$msg = "<div class='alert alert-error'>" . __('Your password settings do not match','membership') . "</div>";
				}
			}

			$errors = edit_user( $user['ID'] );
			$profileuser = get_user_to_edit($user_id);

			if ( isset( $errors ) && is_wp_error( $errors ) ) {
				$msg = "<div class='alert alert-error'>" . implode( "<br/>\n", $errors->get_error_messages() ) . "</div>";
			}

		} else {
			$msg = "<div class='alert alert-error'>" . __('Your details could not be updated.','membership') . "</div>";
		}

		do_action('edit_user_profile_update', $user_id);
	}

 $checksubcription = "select `current_period_end` from `".$wpdb->prefix ."m_member_payments` where `member_id` = ".$user_id." ";
 $userpermission = $wpdb->get_results($checksubcription);
	
 function checkuseractive(){
    global $user_id,$wpdb;
    $checksubcription = "select `current_period_end` from `".$wpdb->prefix ."m_member_payments` where `member_id` = ".$user_id." ";
    $userpermission = $wpdb->get_results($checksubcription);
    
    if(strtotime('now') <= $userpermission[0]->current_period_end) {
		#$update = 'update `'.$wpdb->prefix .'posts` set `post_status` = "publish" where `post_type`= 'property' AND `post_author` = '.$user_id.' ';
		#$wpdb->query($update);		
		#$date1 = new DateTime(date('Y-m-d', strtotime("now")));
		#$date2 = new DateTime(date('Y-m-d', $userpermission[0]->current_period_end));
		#$interval = $date1->diff($date2);
		#if($interval->d == '7'):
			#wp_mail( 'developer.smartwinz@gmail.com', 'MemberShip', 'Expiry Date' );
		#endif;
    }
 }
?>

<div id='membership-wrapper'>
<?php if(!empty($msg)) {
?>
	<?php echo $msg; ?>
<?php
} ?>
<style type="text/css">
.edit_details{
  color: #343A41;
  font-family: 'Oswald',sans-serif;
  font-size: 30px;
  letter-spacing: 0;
  line-height: 1.2em;
  margin: 22px 0 2px;
  text-shadow: 1px 1px rgba(255, 255, 255, 0.7);
}
a.paa_fieldaddlistion {
  margin: 3px 10px !important;
}
#text-6 {
  margin-top: 72px;
}.add-PropertyForm .selectboxname {  background: none repeat scroll 0 0 #fff;  border: 1px solid #737373;  margin: 0 10px;  padding: 8px 5px;  width: 44.5%;}a.paa_fieldaddlistion {  border: 1px solid #737373;  margin: 3px 0;  padding: 7px 20px;}
</style>
<form class="form-membership" action="<?php echo get_permalink(); ?>" method="post">
	<?php wp_nonce_field('update-user_' . $user_id); ?>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($user_id); ?>" />

<ul class="add-PropertyForm">
		<h4 class="edit_details"><?php _e( 'Edit Your Details', 'membership' ) ?></h4>

			<li>
				<h6 class="add-PropertyForm-list-title" for="user_login"><?php _e('Username', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="text" class="input-xlarge" id="user_login" nmae="user_login" placeholder="" value="<?php echo esc_attr($profileuser->user_login); ?>" disabled="disabled" >
					<p class="help-block"><?php _e('Usernames cannot be changed.','membership'); ?></p>
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="first_name"><?php _e('First Name', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="text" class="input-xlarge" id="first_name" name="first_name" placeholder="" value="<?php echo esc_attr($profileuser->first_name); ?>" >
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="last_name"><?php _e('Last Name', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="text" class="input-xlarge" id="last_name" name="last_name" placeholder="" value="<?php echo esc_attr($profileuser->last_name) ?>" >
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="nickname"><?php _e('Nickname', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="text" class="input-xlarge" id="nickname" name="nickname" placeholder="" value="<?php echo esc_attr($profileuser->nickname) ?>" >
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="display_name"><?php _e('Display name as', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<select name="display_name" class="selectboxname" id="display_name">
					<?php
						$public_display = array();
						$public_display['display_username']  = $profileuser->user_login;
						$public_display['display_nickname']  = $profileuser->nickname;
						if ( !empty($profileuser->first_name) )
							$public_display['display_firstname'] = $profileuser->first_name;
						if ( !empty($profileuser->last_name) )
							$public_display['display_lastname'] = $profileuser->last_name;
						if ( !empty($profileuser->first_name) && !empty($profileuser->last_name) ) {
							$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
							$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
						}
						if ( !in_array( $profileuser->display_name, $public_display ) ) // Only add this if it isn't duplicated elsewhere
							$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;
						$public_display = array_map( 'trim', $public_display );
						$public_display = array_unique( $public_display );
						foreach ( $public_display as $id => $item ) {
					?>
						<option id="<?php echo $id; ?>" value="<?php echo esc_attr($item); ?>"<?php selected( $profileuser->display_name, $item ); ?>><?php echo $item; ?></option>
					<?php
						}
					?>
					</select>
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="email"><?php _e('Email', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="text" class="input-xlarge" name="email" id="email" value="<?php echo esc_attr($profileuser->user_email) ?>" />
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="url"><?php _e('Website', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="text" class="input-xlarge" name="url" id="url" value="<?php echo esc_attr($profileuser->user_url) ?>" />
				</span>
			</li>

			<li>				<span class="add-PropertyForm-textfild">
				<p class="help-block"><?php _e('To change your password, enter the new password below and then repeat it to confirm, otherwise leave these two fields blank.','membership'); ?></p>				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="pass1"><?php _e('New Password', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="password" class="input-xlarge" name="pass1" id="pass1" value="" autocomplete="off" />
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title" for="pass1"><?php _e('Confirm Password', 'membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="password" class="input-xlarge" name="pass2" id="pass2" value="" autocomplete="off" />
				</span>
			</li>
			<li>
				<span class="add-PropertyForm-textfild">
				    <input type="submit" value="<?php _e('Update Account','membership'); ?>" class="paa_fieldaddlistion" name="submit">
                                </span>
                            <div style='clear:both;'></div>
				    <?php if(strtotime('now') <= $userpermission[0]->current_period_end) { checkuseractive();?>
				    <a class="paa_fieldaddlistion" href="<?php echo site_url('subscriptions');?>">Subscriptions</a>&nbsp;&nbsp;
            
				    <a class="paa_fieldaddlistion" href="<?php echo site_url('edit-listing');?>">Edit Listing</a>&nbsp;&nbsp;
				    <a class="paa_fieldaddlistion" href="<?php echo site_url('add-listing');?>">Add Listing</a>
					<?php } else { ?>
					<a class="paa_fieldaddlistion" href="<?php echo site_url('subscriptions');?>">Upgrade Account</a>
					<?php 
					#$update = 'update `'.$wpdb->prefix .'posts` set `post_status` = "draft" where `post_type` = 'property' AND `post_author` = '.$user_id.' ';
					#$wpdb->query($update);
					} ?>

			</li>
	</ul>

</form>

</div>
<?php
?>

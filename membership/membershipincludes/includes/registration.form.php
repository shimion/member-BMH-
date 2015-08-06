<?php
session_start();
if(is_wp_error($error) && method_exists($error, 'get_error_code')) {
	$anyerrors = $error->get_error_code();
	if( !empty($anyerrors) ) {
		// we have an error - output
		$messages = $error->get_error_messages();
		$errormessages = "<div class='alert alert-error'>";
		$errormessages .= implode('<br/>', $messages);
		$errormessages .= "</div>";
	} else {
		$errormessages = '';
	}
} else {
	$errormessages = '';
}

?>
<div id="waitingbar" style="display:none;"></div>
<div id='membership-wrapper'>
<?php
	if(!empty($errormessages)) {
		echo $errormessages;
	}
?>
<form id="memberregister" enctype="multipart/form-data" class="form-membership" action="<?php echo get_permalink(); ?>" method="post">

	<?php do_action( "signup_hidden_fields" ); ?>

	<input type='hidden' name='subscriptionID' value='<?php if(isset($_GET['subscription'])) echo esc_attr($_GET['subscription']); ?>' />

	<ul class="add-PropertyForm">
		<h3 style="text-align: center; margin: 20px 0px;"><?php _e( 'General Information', 'membership' ) ?></h3>

			<li>
				<h6 class="add-PropertyForm-list-title"><?php _e('Choose a Username','membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="text" class="paa_field" id="user_login" name="user_login" placeholder="" value="<?php if(isset($_POST['user_login'])) echo esc_attr($_POST['user_login']); ?>">
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title"><?php _e('Email Address','membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="email" class="paa_field" id="user_email" name="user_email" placeholder="" value="<?php if(isset($_POST['user_email'])) echo esc_attr($_POST['user_email']); ?>">
				</span>
				<p class="help-block"><?php _e('Please enter a new password, and then verify your new password by entering it again.','membership'); ?></p>
			</li>
			<li>
				<h6 class="add-PropertyForm-list-title"><?php _e('Password','membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="password" class="input-xlarge" id="password" name="password" placeholder="" autocomplete="off">
				</span>
			</li>

			<li>
				<h6 class="add-PropertyForm-list-title"><?php _e('Confirm Password','membership'); ?></h6>
				<span class="add-PropertyForm-textfild">
					<input type="password" class="input-xlarge" id="password2" name="password2" placeholder="" autocomplete="off">
				</span>

				<p class="help-block"><?php _e('Hint: The password should be at least 5 characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).','membership'); ?></p>
			</li>
			<?php if(esc_attr($_GET['subscription']) == '3'): ?>
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload" value="" name="file" class="upload"/>
				</span>
				<input id="filename1" placeholder="No file chosen" disabled="disabled" />
				<div id="progress" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>
		    </li>
		    <li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload1" value="" name="file1" class="upload"/>
				</span>
				<input id="filename2" placeholder="No file chosen" disabled="disabled" />
				<div id="progress1" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload2" value="" name="file2" class="upload"/>
				</span>
				<input id="filename3" placeholder="No file chosen" disabled="disabled" />
				<div id="progress2" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload3" value="" name="file3" class="upload"/>
				</span>
				<input id="filename4" placeholder="No file chosen" disabled="disabled" />
				<div id="progress3" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>
		    </li>
		    
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload4" value="" name="file4" class="upload"/>
				</span>
				<input id="filename5" placeholder="No file chosen" disabled="disabled" />
				<div id="progress4" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload5" value="" name="file5" class="upload"/>
				</span>
				<input id="filename6" placeholder="No file chosen" disabled="disabled" />
				<div id="progress5" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>
			<!-- New Fields -->
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload6" value="" name="file6" class="upload"/>
				</span>
				<input id="filename7" placeholder="No file chosen" disabled="disabled" />
				<div id="progress6" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload7" value="" name="file7" class="upload"/>
				</span>
				<input id="filename8" placeholder="No file chosen" disabled="disabled" />
				<div id="progress7" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>			
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload8" value="" name="file8" class="upload"/>
				</span>
				<input id="filename9" placeholder="No file chosen" disabled="disabled" />
				<div id="progress8" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>
			<li>
				<h6 class="add-PropertyForm-list-title">Image * </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="fileupload9" value="" name="file9" class="upload"/>
				</span>
				<input id="filename10" placeholder="No file chosen" disabled="disabled" />
				<div id="progress9" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
		    </div>  
		    </li>
		    <?php endif; ?>
		    <li>
				<h6 class="add-PropertyForm-list-title">Farm Name * </h6>
				<span class="add-PropertyForm-textfild">
				    <input type="text" value="" name="farmname" class="paa_field" placeholder="Farm Name"/>
				</span>    
		    </li>
			<li>
				<h6 class="add-PropertyForm-list-title">Address * </h6>
				<span class="add-PropertyForm-textfild">
				    <input type="text" value="" name="farmaddress" class="paa_field" placeholder="Address"/>
				</span>    
		    </li>
		    <li>
				<h6 class="add-PropertyForm-list-title">City * </h6>
				<span class="add-PropertyForm-textfild">
				    <input type="text" value="" name="farmcity" class="paa_field" placeholder="City"/>
				</span>    
		    </li>
			<li>
				<h6 class="add-PropertyForm-list-title">Zip * </h6>
				<span class="add-PropertyForm-textfild">
				    <input type="text" value="" name="farmzip" class="paa_field" placeholder="Zip"/>
				</span>    
		    </li>
		    <li>
				<h6 class="add-PropertyForm-list-title">Phone * </h6>
				<span class="add-PropertyForm-textfild">
				    <input type="text" value="" name="farmphone" class="paa_field" placeholder="Phone"/>
				</span>    
		    </li>    
		    
            <li>
				<h6 class="add-PropertyForm-list-title">Farm Service Description * </h6>
				<span class="add-PropertyForm-textfild">
				    <textarea name="farmdescription" class="paa_field" placeholder="Farm Description"></textarea>
				</span>
		    </li>
			<?php 	if($_REQUEST['subscription']>1){ ?>
            <li>
				<h6 class="add-PropertyForm-list-title">Website URL * </h6>
				<span class="add-PropertyForm-textfild">
				      <input type="text" value="" name="farmweburl" class="paa_field" placeholder="Website URL"/>
				</span>
		    </li>
            <li>
				<h6 class="add-PropertyForm-list-title">Facebook Page </h6>
				<span class="add-PropertyForm-textfild">
                 <input type="text" name="farmfacebookpage" class="paa_field" placeholder="Facebook Page"/>
				</span>
		    </li>
            <li>
				<h6 class="add-PropertyForm-list-title">Twitter Page </h6>
				<span class="add-PropertyForm-textfild">
                
				    <input name="farmtwitterpage" type="text" class="paa_field" placeholder="Twitter Page" />
				</span>
		    </li>
            <li>
				<h6 class="add-PropertyForm-list-title">YouTube Page </h6>
				<span class="add-PropertyForm-textfild">
				    <input type="text" name="farmyoutubepage" class="paa_field" placeholder="YouTube Page" />
				</span>
		    </li>
            <li>
				<h6 class="add-PropertyForm-list-title">Brochure Upload </h6>
				<span class="file-upload btn btn-primary">
				    <span>Browse File...</span>
				    <input type="file" id="farmbrochureupload" value="" name="farmbrochureupload" class="upload"/>
				</span>
				<input id="farmbrochure" placeholder="No file chosen" disabled="disabled" />
				<div id="progressfarmbrochure" class="progress">
		        <div class="progress-bar progress-bar-success"></div>
				</div>  					
		    </li>
            <li>
				<h6 class="add-PropertyForm-list-title">Coupon</h6>
				<span class="add-PropertyForm-textfild">
				    <input type="text" name="farmcouponupload" class="paa_field" placeholder="Coupon" />
				</span>
		    </li>
		<?php
			} 

			do_action('membership_subscription_form_registration_presubmit_content');

			do_action( 'signup_extra_fields', $error );
		?>

		<li class="registerbutton" style="display:none;">
			<span class="add-PropertyForm-textfild">
				<input type="submit" value="<?php _e('Register My Account &raquo;','membership'); ?>" class="paa_fieldaddlistion" name="register">
				
				<a title="Login »" href="<?php echo wp_login_url( add_query_arg('action', 'registeruser', get_permalink()) ); ?>" class="alignleft" id="login_right"><?php _e('Already have a user account?' ,'membership'); ?></a>
			</span>
		</li>
		<li>
			<span class="add-PropertyForm-textfild">
				<input type="button" id="continuebutton" value="<?php _e('Continue &raquo;','membership'); ?>" class="paa_fieldaddlistion" name="register">
				<input type="hidden" name="task" value="addpropertyformstep<?php echo $_GET['subscription']; ?>"/>
				<input type="hidden" name="subscription" value="register"/>
			</span>
		</li>
		<input type="hidden" name="action" value="validatepage1" />
	</ul>
</form>

</div>
<script>

$(document).ready(function(){
	document.getElementById("fileupload").onchange = function () {
		document.getElementById("filename1").value = this.value;
	}
	document.getElementById("fileupload1").onchange = function () {
		document.getElementById("filename2").value = this.value;
	}
	document.getElementById("fileupload2").onchange = function () {
		document.getElementById("filename3").value = this.value;
	}
	document.getElementById("fileupload3").onchange = function () {
		document.getElementById("filename4").value = this.value;
	}
	<?php if(esc_attr($_GET['subscription']) == '3'): ?>
	document.getElementById("fileupload4").onchange = function () {
		document.getElementById("filename5").value = this.value;
	}
	document.getElementById("fileupload5").onchange = function () {
		document.getElementById("filename6").value = this.value;
	}
	document.getElementById("fileupload6").onchange = function () {
		document.getElementById("filename7").value = this.value;
	}
	document.getElementById("fileupload7").onchange = function () {
		document.getElementById("filename8").value = this.value;
	}
	document.getElementById("fileupload8").onchange = function () {
		document.getElementById("filename9").value = this.value;
	}
	document.getElementById("fileupload9").onchange = function () {
		document.getElementById("filename10").value = this.value;
	}	
	<?php endif; ?>
});
</script>

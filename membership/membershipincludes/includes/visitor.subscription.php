<?php 
require_once ABSPATH .'/wp-load.php';
require_once ABSPATH .'/wp-includes/post.php';
global $wpdb;
$user_id = get_current_user_id();
if(isset($_POST['submitsubcription'])):
$ListingData = array('post_title' => $_POST['farmname'],'post_type' => 'property','post_content' => $_POST['farmdescription'], 'post_status' => 'publish', 'post_author' => $user_id ,'post_category' => array(3));
#Insert the post into the database
$lastid = wp_insert_post( $ListingData );

#Insert the post meta into the database
update_post_meta( $lastid, 'Address', $_POST['farmaddress'] );
update_post_meta( $lastid, 'Package', 'free');
if(update_post_meta( $lastid, 'Phone No', $_POST['farmphoneno']) && $lastid ):
	wp_redirect(site_url('edit-listing?action=true'));
endif;
endif;
?>
<form action="" method="post" name="subscriptionfoRm" id="subscriptionfoRm">
<ul class="add-PropertyForm">
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
		<h6 class="add-PropertyForm-list-title">Phone No * </h6>
		<span class="add-PropertyForm-textfild">
		    <input type="text" value="" name="farmphoneno" class="paa_field" placeholder="Phone No"/>
		</span>    
    </li>
    <li>
		<h6 class="add-PropertyForm-list-title">Farm Description * </h6>
		<span class="add-PropertyForm-textfild">
		    <textarea name="farmdescription" class="paa_field" placeholder="Farm Description"></textarea>
		</span>
    </li>
    <li>
        <span class="add-PropertyForm-textfild">
		    <input type="submit" name="submitsubcription" class="paa_fieldaddlistion" value="Add Listing">
		</span>
    </li>
</ul>
</form>

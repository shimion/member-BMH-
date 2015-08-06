<?php
session_start();
require_once ABSPATH.'/wp-load.php';
require_once ABSPATH.'/wp-includes/post.php';
include( ABSPATH . 'wp-admin/includes/image.php' );
include_once 'lib/GMap/simpleGMapAPI.php';
include_once 'lib/GMap/simpleGMapGeocoder.php';
include_once 'membership.email.php';
if ( ! function_exists( 'wp_handle_upload' ) ) { require_once( ABSPATH . 'wp-admin/includes/file.php' ); }
global $wpdb;
$upload_dir = wp_upload_dir();
$user_id = get_current_user_id();

if($_SESSION['action'] == 'addpropertyformstep1'){
$ListingData = array('post_title' => $_SESSION['FarmName'],'post_type' => 'property','post_content' => $_SESSION['FarmDescription'], 'post_status' => 'publish', 'post_author' => $user_id ,'post_category' => array(3));
#Insert the post into the database
$lastid = wp_insert_post( $ListingData );

#Insert the post meta into the database
update_post_meta( $lastid, 'sub_id', 1 );
update_post_meta( $lastid, 'Address', $_SESSION['FarmAddress'] );
$farmzip = $_SESSION['FarmZip'];
if(!empty($farmzip)){
$gMapGeocoder = new simpleGMapGeocoder();
$result = $gMapGeocoder->getGeoCoords($farmzip);
if ($result['status'] === 'OK'){
$longitude = $result['lng'];
$latitude = $result['lat'];
}
}
$array = array('post_ID'=> $lastid ,'user_ID'=> $user_id , 'package' => 'free', 'farmcity' => $_SESSION['FarmCity'], 'farmzip' => $_SESSION['FarmZip'], 'latitude' => $latitude, 'longitude' => $longitude,'phone' => $_SESSION['FarmPhoneNo']);

$wpdb->insert('wp_bmee_question' , $array);

switch( $_SESSION['sub_ID'] ) {
	case 1:
		$lavel = 3;
	break;
	
	case 2:
		$lavel = 1;
	break;
	
	case 3:
		$lavel = 2;
	break;
	
	default:
		$lavel = 0;
}
$date = date('Y-m-d h:i:s');
$usermetadata = array('user_id' => $user_id,'sub_id' => $_SESSION['sub_ID'],'level_id' => $lavel,'startdate' => $date);
if($wpdb->insert('wp_bmee_m_member_relationships' , $usermetadata)){
session_destroy();
}
}

/***********INSERT STANDRED USER POST INTO DATABASE************/

if($_SESSION['action'] == 'addpropertyformstep2'):
if($_GET['payment'] == 'paid'):
$ListingData = array('post_title' => $_SESSION['FormData']['farmname'],'post_type' => 'property','post_content' => $_SESSION['FormData']['farmdescription'], 'post_status' => 'publish', 'post_author' => $user_id ,'post_category' => array(3));
#Insert the post into the database

$lastid = wp_insert_post( $ListingData );

$filename = $_SESSION['file_url_1'];

$file =  explode( '/' , $_SESSION['file_url_1'] );
if($file==''):
$url = home_url();
$file=$url."/wp-content/uploads/2014/08/no-image.png";
endif;
$filetype = wp_check_filetype( $filename );
$args = array(
    'post_mime_type' => $filetype['type'],
    'post_title'     => $file[10], // you may want something different here
    'post_content'   => '',
    'post_status'    => 'inherit'
);
#Insert the attachment.       
$thumb_id = wp_insert_attachment( $args, $filename,  $lastid );

#Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
$metadata = wp_generate_attachment_metadata( $thumb_id, $filename );

#Generate the metadata for the attachment, and update the database record.
wp_update_attachment_metadata( $thumb_id, $metadata );

update_post_meta( $lastid, '_thumbnail_id', $thumb_id );
#Insert the post meta into the database
update_post_meta( $lastid, 'Address', $_SESSION['FormData']['farmaddress'] );
$boarding = serialize($_SESSION['subFormData']['boarding_provided']);
$discipline = serialize($_SESSION['subFormData']['discipline']);

$trails = serialize($_SESSION['subFormData']['trails']);

$fencing = serialize($_SESSION['subFormData']['fencing']);

$farmzip = $_SESSION['FormData']['farmzip'];
if(!empty($farmzip)):
$gMapGeocoder = new simpleGMapGeocoder();
$result = $gMapGeocoder->getGeoCoords($farmzip);
if ($result['status'] === 'OK'):
$longitude = $result['lng'];
$latitude = $result['lat'];
endif;
endif;
$plan_up=$_SESSION['FormData']['subscriptionID'];
if($plan_up=='3'):

$array = array('post_ID'=> $lastid ,'user_ID'=> $user_id ,'boarding_provided' => $boarding,'discipline_specific' => $discipline,'trainer_provided' => $_SESSION['subFormData']['trainerprovided'], 'boarder_population' => $_SESSION['subFormData']['boarderpopulation'],'Canworkforboard' => $_SESSION['subFormData']['Canworkforboard'],'blanketingsheets' => $_SESSION['subFormData']['blanketingsheets'],'boardingstallcost' => $_SESSION['subFormData']['boardingstallcost'],'boardingpastureboardcost' => $_SESSION['subFormData']['boardingpastureboardcost'],'layoverStayshorsehotel' => $_SESSION['subFormData']['layoverStayshorsehotel'], 'lessons_provided' => $_SESSION['subFormData']['lessonsprovided'],'Owners_live_on_farm' => $_SESSION['subFormData']['ownersliveonfarm'],'observation_room' => $_SESSION['subFormData']['observationroom'], 'inside_bathroom' => $_SESSION['subFormData']['insidebathroom'],'grain_provided' => $_SESSION['subFormData']['grainprovided'],'supplements_given' => $_SESSION['subFormData']['supplementsgiven'],'indoor_arena' => $_SESSION['subFormData']['indoorarena'],'outdoor_arena' => $_SESSION['subFormData']['outdoorarena'],'round_pen' => $_SESSION['subFormData']['roundpen'],'trails' => $trails,'wash_rack' => $_SESSION['subFormData']['washrackwithhot'],'turn_out1' => $_SESSION['subFormData']['turnout'],'turn_out2' => $_SESSION['subFormData']['turnouts'],'fencing' => $fencing ,'stand_for_vet' => $_SESSION['subFormData']['standforvet'],'trailer_parking' => $_SESSION['subFormData']['trailerparking'],'main_image' => $file,'images' => serialize(array($_SESSION['file_url_2'],$_SESSION['file_url_3'],$_SESSION['file_url_4'],$_SESSION['file_url_5'],$_SESSION['file_url_6'],$_SESSION['file_url_7'],$_SESSION['file_url_8'],$_SESSION['file_url_9'],$_SESSION['file_url_10'])),'package' => 'middle','type_of_facility' => $_SESSION['subFormData']['whattypeoffacility'],'worming_schedule' => $_SESSION['subFormData']['wormingschedule'],'Region' => $_SESSION['subFormData']['Region'], 'farmcity' => $_SESSION['FormData']['farmcity'], 'farmzip' => $_SESSION['FormData']['farmzip'], 'latitude' => $latitude, 'longitude' => $longitude,'phone' => $_SESSION['FormData']['farmphone']);

else:

$array = array('post_ID'=> $lastid ,'user_ID'=> $user_id ,'boarding_provided' => $boarding,'discipline_specific' => $discipline,'trainer_provided' => $_SESSION['subFormData']['trainerprovided'], 'boarder_population' => $_SESSION['subFormData']['boarderpopulation'],'Canworkforboard' => $_SESSION['subFormData']['Canworkforboard'],'blanketingsheets' => $_SESSION['subFormData']['blanketingsheets'],'boardingstallcost' => $_SESSION['subFormData']['boardingstallcost'],'boardingpastureboardcost' => $_SESSION['subFormData']['boardingpastureboardcost'],'layoverStayshorsehotel' => $_SESSION['subFormData']['layoverStayshorsehotel'], 'lessons_provided' => $_SESSION['subFormData']['lessonsprovided'],'Owners_live_on_farm' => $_SESSION['subFormData']['ownersliveonfarm'],'observation_room' => $_SESSION['subFormData']['observationroom'], 'inside_bathroom' => $_SESSION['subFormData']['insidebathroom'],'grain_provided' => $_SESSION['subFormData']['grainprovided'],'supplements_given' => $_SESSION['subFormData']['supplementsgiven'],'indoor_arena' => $_SESSION['subFormData']['indoorarena'],'outdoor_arena' => $_SESSION['subFormData']['outdoorarena'],'round_pen' => $_SESSION['subFormData']['roundpen'],'trails' => $trails,'wash_rack' => $_SESSION['subFormData']['washrackwithhot'],'turn_out1' => $_SESSION['subFormData']['turnout'],'turn_out2' => $_SESSION['subFormData']['turnouts'],'fencing' => $fencing ,'stand_for_vet' => $_SESSION['subFormData']['standforvet'],'trailer_parking' => $_SESSION['subFormData']['trailerparking'],'main_image' => $file,'images' => serialize(array($_SESSION['file_url_2'],$_SESSION['file_url_3'])),'package' => 'middle','type_of_facility' => $_SESSION['subFormData']['whattypeoffacility'],'worming_schedule' => $_SESSION['subFormData']['wormingschedule'],'Region' => $_SESSION['subFormData']['Region'], 'farmcity' => $_SESSION['FormData']['farmcity'], 'farmzip' => $_SESSION['FormData']['farmzip'], 'latitude' => $latitude, 'longitude' => $longitude,'phone' => $_SESSION['FormData']['farmphone']);

endif;
$wpdb->insert('wp_bmee_question' , $array);

switch( $_SESSION['FormData']['subscriptionID'] ) {
	case 1:
		$lavel = 3;
	break;
	
	case 2:
		$lavel = 1;
	break;
	
	case 3:
		$lavel = 2;
	break;
	
	default:
		$lavel = 0;
}
$date = date('Y-m-d h:i:s');
$usermetadata = array('user_id' => $user_id,'sub_id' => $_SESSION['FormData']['subscriptionID'],'level_id' => $lavel,'startdate' => $date);

$wpdb->insert('wp_bmee_m_member_relationships' , $usermetadata);

$data = $_SESSION['userdata'];

$userdata = array('member_id' => $user_id ,'sub_id' => $data->subscriptions->data[0]->id , 'cus_id' => $data->id , 'created' => $data->created, 'plan_id' => $data->subscriptions->data[0]->plan->id ,'interval' => $data->subscriptions->data[0]->plan->interval, 'plan_name' => $data->subscriptions->data[0]->plan->name, 'amount' => $data->subscriptions->data[0]->plan->amount, 'currency' => $data->subscriptions->data[0]->plan->currency,'interval_count' => $data->subscriptions->data[0]->plan->interval_count ,'status' => $data->subscriptions->data[0]->status,'current_period_start' => $data->subscriptions->data[0]->current_period_start, 'current_period_end' => $data->subscriptions->data[0]->current_period_end);

if($wpdb->insert('wp_bmee_m_member_payments' , $userdata)):
new_user_notification_mail( $user_id, $_SESSION['FormData']['password'] );
session_destroy();
endif;
else:
echo '<style>.successmsgbutton{display:none;}</style>';
echo '<style>.successmsgbutton_failure{display:block !important;}</style>';
echo 'For some reason your order has not completed and your payment was not processed. Please <a href="'.site_url('subscriptions').'">click here</a> to try again. If this continues to happen please <a href="'.site_url('contact-us').'">contact us</a> so that we can further investigate the issue.';
session_destroy();
endif;
endif;

/*****************INSERT PAID USER POST INTO DATABASE*************************/

if($_SESSION['action'] == 'addpropertyformstep3'):
if($_GET['payment'] == 'paid'):
$ListingData = array('post_title' => $_SESSION['FormData']['farmname'],'post_type' => 'property','post_content' => $_SESSION['FormData']['farmdescription'], 
'post_status' => 'publish', 'post_author' => $user_id ,'post_category' => array(3));
/* Insert the post into the database */

$lastid = wp_insert_post( $ListingData );

$filename = $_SESSION['file_url_1'];

$file =  explode( '/' , $_SESSION['file_url_1'] );
if($file==''):
$url = home_url();
$file=$url."/wp-content/uploads/2014/08/no-image.png";
endif;
$filetype = wp_check_filetype( $filename );
$args = array(
    'post_mime_type' => $filetype['type'],
    'post_title'     => $file[10], // you may want something different here
    'post_content'   => '',
    'post_status'    => 'inherit'
);
#Insert the attachment.       
$thumb_id = wp_insert_attachment( $args, $filename,  $lastid );

#Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
$metadata = wp_generate_attachment_metadata( $thumb_id, $filename );

#Generate the metadata for the attachment, and update the database record.
wp_update_attachment_metadata( $thumb_id, $metadata );

update_post_meta( $lastid, '_thumbnail_id', $thumb_id );
#Insert the post meta into the database
update_post_meta( $lastid, 'Address', $_SESSION['FormData']['farmaddress'] );
$boarding = serialize($_SESSION['subFormData']['boarding_provided']);
$discipline = serialize($_SESSION['subFormData']['discipline']);

$trails = serialize($_SESSION['subFormData']['trails']);

$fencing = serialize($_SESSION['subFormData']['fencing']);
$farmzip = $_SESSION['FormData']['farmzip'];
if(!empty($farmzip)):
$gMapGeocoder = new simpleGMapGeocoder();
$result = $gMapGeocoder->getGeoCoords($farmzip);
if ($result['status'] === 'OK'):
$longitude = $result['lng'];
$latitude = $result['lat'];
endif;
endif;

$plan_up=$_SESSION['FormData']['subscriptionID'];

if($plan_up=='3'):
update_post_meta( $lastid, 'sub_id', $plan_up );
$array = array('post_ID'=> $lastid ,'user_ID'=> $user_id ,'boarding_provided' => $boarding,'discipline_specific' => $discipline,'trainer_provided' => $_SESSION['subFormData']['trainerprovided'], 'boarder_population' => $_SESSION['subFormData']['boarderpopulation'],'Canworkforboard' => $_SESSION['subFormData']['Canworkforboard'],'blanketingsheets' => $_SESSION['subFormData']['blanketingsheets'],'boardingstallcost' => $_SESSION['subFormData']['boardingstallcost'],'boardingpastureboardcost' => $_SESSION['subFormData']['boardingpastureboardcost'],'layoverStayshorsehotel' => $_SESSION['subFormData']['layoverStayshorsehotel'], 'lessons_provided' => $_SESSION['subFormData']['lessonsprovided'],'Owners_live_on_farm' => $_SESSION['subFormData']['ownersliveonfarm'],'observation_room' => $_SESSION['subFormData']['observationroom'], 'inside_bathroom' => $_SESSION['subFormData']['insidebathroom'],'grain_provided' => $_SESSION['subFormData']['grainprovided'],'supplements_given' => $_SESSION['subFormData']['supplementsgiven'],'indoor_arena' => $_SESSION['subFormData']['indoorarena'],'outdoor_arena' => $_SESSION['subFormData']['outdoorarena'],'round_pen' => $_SESSION['subFormData']['roundpen'],'trails' => $trails,'wash_rack' => $_SESSION['subFormData']['washrackwithhot'],'turn_out1' => $_SESSION['FormData']['turnout'],'turn_out2' => $_SESSION['subFormData']['turnouts'],'fencing' => $fencing ,'stand_for_vet' => $_SESSION['subFormData']['standforvet'],'trailer_parking' => $_SESSION['subFormData']['trailerparking'],'main_image' => $file,'images' => serialize(array($_SESSION['file_url_2'],$_SESSION['file_url_3'],$_SESSION['file_url_4'],$_SESSION['file_url_5'],$_SESSION['file_url_6'],$_SESSION['file_url_7'],$_SESSION['file_url_8'],$_SESSION['file_url_9'],$_SESSION['file_url_10'])),'package' => 'top','type_of_facility' => $_SESSION['subFormData']['whattypeoffacility'],'worming_schedule' => $_SESSION['subFormData']['wormingschedule'],'Region' => $_SESSION['subFormData']['Region'], 'farmcity' => $_SESSION['FormData']['farmcity'], 'farmzip' => $_SESSION['FormData']['farmzip'], 'latitude' => $latitude, 'longitude' => $longitude,'phone' => $_SESSION['FormData']['farmphone'],'farmweburl' => $_SESSION['FormData']['farmweburl'],'farmfacebookpage' => $_SESSION['FormData']['farmfacebookpage'],'farmtwitterpage' => $_SESSION['FormData']['farmtwitterpage'],'farmbrochureupload' => $_SESSION['farmbrochureupload'],'farmcouponupload' => $_SESSION['FormData']['farmcouponupload']);

else:

$array = array('post_ID'=> $lastid ,'user_ID'=> $user_id ,'boarding_provided' => $boarding,'discipline_specific' => $discipline,'trainer_provided' => $_SESSION['subFormData']['trainerprovided'], 'boarder_population' => $_SESSION['subFormData']['boarderpopulation'],'Canworkforboard' => $_SESSION['subFormData']['Canworkforboard'],'blanketingsheets' => $_SESSION['subFormData']['blanketingsheets'],'boardingstallcost' => $_SESSION['subFormData']['boardingstallcost'],'boardingpastureboardcost' => $_SESSION['subFormData']['boardingpastureboardcost'],'layoverStayshorsehotel' => $_SESSION['subFormData']['layoverStayshorsehotel'], 'lessons_provided' => $_SESSION['subFormData']['lessonsprovided'],'Owners_live_on_farm' => $_SESSION['subFormData']['ownersliveonfarm'],'observation_room' => $_SESSION['subFormData']['observationroom'], 'inside_bathroom' => $_SESSION['subFormData']['insidebathroom'],'grain_provided' => $_SESSION['subFormData']['grainprovided'],'supplements_given' => $_SESSION['subFormData']['supplementsgiven'],'indoor_arena' => $_SESSION['subFormData']['indoorarena'],'outdoor_arena' => $_SESSION['subFormData']['outdoorarena'],'round_pen' => $_SESSION['subFormData']['roundpen'],'trails' => $trails,'wash_rack' => $_SESSION['subFormData']['washrackwithhot'],'turn_out1' => $_SESSION['FormData']['turnout'],'turn_out2' => $_SESSION['subFormData']['turnouts'],'fencing' => $fencing ,'stand_for_vet' => $_SESSION['subFormData']['standforvet'],'trailer_parking' => $_SESSION['subFormData']['trailerparking'],'main_image' => $file,'images' => serialize(array($_SESSION['file_url_2'],$_SESSION['file_url_3'])),'package' => 'top','type_of_facility' => $_SESSION['subFormData']['whattypeoffacility'],'worming_schedule' => $_SESSION['subFormData']['wormingschedule'],'Region' => $_SESSION['subFormData']['Region'], 'farmcity' => $_SESSION['FormData']['farmcity'], 'farmzip' => $_SESSION['FormData']['farmzip'], 'latitude' => $latitude, 'longitude' => $longitude,'phone' => $_SESSION['FormData']['farmphone']);

endif;

$wpdb->insert('wp_bmee_question' , $array);

switch( $_SESSION['FormData']['subscriptionID'] ) {
	case 1:
		$lavel = 3;
	break;
	
	case 2:
		$lavel = 1;
	break;
	
	case 3:
		$lavel = 2;
	break;
	
	default:
		$lavel = 0;
}
$date = date('Y-m-d h:i:s');
//$usermetadata = array('user_id' => $user_id,'sub_id' => $_SESSION['FormData']['subscriptionID'],'level_id' => $lavel,'startdate' => $date);

$q = "Insert into wp_bmee_m_membership_relationships(user_id ,sub_id,level_id,startdate) values('".$user_id."','".$_SESSION['FormData']['subscriptionID']."','".$lavel."','".$date."')";
$wpdb->query($q);


//$wpdb->insert('wp_bmee_m_membership_relationships' , $usermetadata);

$data = $_SESSION['userdata'];

$userdata = array('member_id' => $user_id ,'sub_id' => $data->subscriptions->data[0]->id , 'cus_id' => $data->id , 'created' => $data->created, 'plan_id' => $data->subscriptions->data[0]->plan->id ,'interval' => $data->subscriptions->data[0]->plan->interval, 'plan_name' => $data->subscriptions->data[0]->plan->name, 'amount' => $data->subscriptions->data[0]->plan->amount, 'currency' => $data->subscriptions->data[0]->plan->currency,'interval_count' => $data->subscriptions->data[0]->plan->interval_count ,'status' => $data->subscriptions->data[0]->status,'current_period_start' => $data->subscriptions->data[0]->current_period_start, 'current_period_end' => $data->subscriptions->data[0]->current_period_end);

if($wpdb->insert('wp_bmee_m_member_payments' , $userdata)):
new_user_notification_mail( $user_id, $_SESSION['FormData']['password'] );
session_destroy();
endif;
else:
echo '<style>.successmsgbutton{display:none;}</style>';
echo '<style>.successmsgbutton_failure{display:block !important;}</style>';
echo 'For some reason your order has not completed and your payment was not processed. Please <a href="'.site_url('subscriptions').'">click here</a> to try again. If this continues to happen please <a href="'.site_url('contact-us').'">contact us</a> so that we can further investigate the issue.';
session_destroy();
endif;
endif;
?>

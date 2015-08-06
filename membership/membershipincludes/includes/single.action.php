<?php
require_once '../../../../../wp-load.php';
require_once ABSPATH .'/wp-includes/post.php';
include( ABSPATH . 'wp-admin/includes/image.php' );
include_once 'lib/GMap/simpleGMapAPI.php';
include_once 'lib/GMap/simpleGMapGeocoder.php';
if ( ! function_exists( 'wp_handle_upload' ) ) { require_once( ABSPATH . 'wp-admin/includes/file.php' ); }
global $wpdb;
$user_ID = get_current_user_id();
if(isset($_POST['farmsubmitbutton'])):
$ListingData = array('post_title' => $_POST['farmname'],'post_type' => 'property','post_content' => $_POST['farmdescription'], 'post_status' => 'publish', 'post_author' => $user_ID ,'post_category' => array(3));
#Insert the post into the database
$lastid = wp_insert_post( $ListingData );

$uploadedfile = $_FILES['file'];
$upload_overrides = array( 'test_form' => false );
wp_handle_upload( $uploadedfile, $upload_overrides );

#Get the path to the upload directory.
$upload_dir = wp_upload_dir();

$filename = $upload_dir['path']. '/' .$_FILES['file']['name'];
$filetype = wp_check_filetype( $filename );
$args = array(
    'post_mime_type' => $filetype['type'],
    'post_title'     => $_POST['FileName'], // you may want something different here
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
update_post_meta( $lastid, 'Address', $_POST['farmaddress'] );
$boarding = serialize($_POST['boarding_provided']);
$discipline = serialize($_POST['discipline']);

$trails = serialize($_POST['trails']);
 
 $fencing = serialize($_POST['fencing']);
$uploadedfile2 = $_FILES['file2'];
$upload_overrides2 = array( 'test_form' => false );
wp_handle_upload( $uploadedfile2, $upload_overrides2 );

$uploadedfile3 = $_FILES['file3'];
$upload_overrides3 = array( 'test_form' => false );
wp_handle_upload( $uploadedfile3, $upload_overrides3 );

$searchLocation = $_POST['farmzip'];
if(!empty($searchLocation)):
$gMapGeocoder = new simpleGMapGeocoder();
$result = $gMapGeocoder->getGeoCoords($searchLocation);
	if ($result['status'] === 'OK'):
		$longitude = $result['lng'];
		$latitude = $result['lat'];
	endif;					
endif;
$array = array('post_ID'=> $lastid ,'user_ID'=> $user_ID ,'boarding_provided' => $boarding,'discipline_specific' => $discipline,'trainer_provided' => $_POST['trainerprovided'], 'boarder_population' => $_POST['boarderpopulation'],'Canworkforboard' => $_POST['Canworkforboard'],'blanketingsheets' => $_POST['blanketingsheets'],'boardingstallcost' => $_POST['boardingstallcost'],'boardingpastureboardcost' => $_POST['boardingpastureboardcost'],'layoverStayshorsehotel' => $_POST['layoverStayshorsehotel'], 'lessons_provided' => $_POST['lessonsprovided'],'Owners_live_on_farm' => $_POST['ownersliveonfarm'],'observation_room' => $_POST['observationroom'], 'inside_bathroom' => $_POST['insidebathroom'],'grain_provided' => $_POST['grainprovided'],'supplements_given' => $_POST['supplementsgiven'],'indoor_arena' => $_POST['indoorarena'],'outdoor_arena' => $_POST['outdoorarena'],'round_pen' => $_POST['roundpen'],'trails' => $trails,'wash_rack' => $_POST['washrackwithhot'],'turn_out1' => $_POST['turnout'],'turn_out2' => $_POST['turnouts'],'fencing' => $fencing,'stand_for_vet' => $_POST['standforvet'],'trailer_parking' => $_POST['trailerparking'],'main_image' => $_FILES['file']['name'],'images' => serialize(array('wp-content/uploads'. $upload_dir['subdir']. DS .$_FILES['file2']['name'] , 'wp-content/uploads'. $upload_dir['subdir']. DS .$_FILES['file3']['name'])),'package' => $_POST['package'],'type_of_facility' => $_POST['whattypeoffacility'],'worming_schedule' => $_POST['wormingschedule'], 'farmcity' => $_POST['farmcity'], 'farmzip' => $_POST['farmzip'], 'latitude' => $latitude, 'longitude' => $longitude,'phone' => $_POST['farmphone']);

if($wpdb->insert('wp_bmee_question' , $array)):
	wp_redirect(site_url('edit-listing'));
endif;
endif;

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
?>

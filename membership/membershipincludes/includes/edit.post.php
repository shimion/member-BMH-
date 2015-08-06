<?php

require_once ABSPATH .'/wp-load.php';

require_once ABSPATH .'/wp-includes/post.php';

include_once ABSPATH .'/wp-content/plugins/membership/membershipincludes/includes/lib/GMap/simpleGMapAPI.php';

include_once ABSPATH .'/wp-content/plugins/membership/membershipincludes/includes/lib/GMap/simpleGMapGeocoder.php';

include( ABSPATH . 'wp-admin/includes/image.php' );

define( "DS" , "/" );
if ( ! function_exists( 'wp_handle_upload' ) ) { require_once( ABSPATH . 'wp-admin/includes/file.php' ); }

global $wpdb;

$user_ID = get_current_user_id();

$ID = $_REQUEST['id'];

$Query = "Select P.*,Q.* from `".$wpdb->prefix ."posts` as P INNER JOIN `".$wpdb->prefix ."question` as Q  ON P.ID = Q.post_ID where P.ID = ".$ID." AND P.post_type = 'property'";

/*
echo $Query;
echo $user_ID;*/

$user_data = "Select level_id from `".$wpdb->prefix ."m_membership_relationships` where user_id = ".$user_ID."";
$Resultuser_data = $wpdb->get_results($user_data);
foreach($Resultuser_data as $Resultuser_data):
$user_role=$Resultuser_data->level_id;
endforeach;

$Results = $wpdb->get_results($Query);
$q = "SELECT mr.meta_value FROM wp_bmee_postmeta mr,wp_bmee_posts wp WHERE wp.ID = $ID and wp.ID=mr.post_id and mr.meta_key='sub_id'";
$subscriptionId = $wpdb->get_row($q);


if(isset($_POST['postupdate'])):
	$searchLocation = $_POST['myplugin_new_field_zip'];
	if(!empty($searchLocation)):
	$gMapGeocoder = new simpleGMapGeocoder();
	$result = $gMapGeocoder->getGeoCoords($searchLocation);
		if ($result['status'] === 'OK'):
			$longitude = $result['lng'];
			$latitude = $result['lat'];
		endif;					
	endif;

$Boardingpro = serialize($_POST['boarding_provided']);
$Discipline = serialize($_POST['discipline']);
	
$trails = serialize($_POST['trails']);	
$fencing = serialize($_POST['fencing']);	

update_post_meta($ID , 'Address' ,$_POST['postadress']);

 $upload_dir = wp_upload_dir();

 #Update post 

  $USerpost = array(
      'ID'           => $ID,
	  'post_title' => $_POST['postname'],    
      'post_content' => $_POST['postdescription']
  );

#Update the post into the database

$lastid = wp_update_post( $USerpost );

$target_path = $upload_dir['basedir'].'/'.get_the_date('Y/m'); 



if($_FILES['image']['name']!=""){

move_uploaded_file($_FILES['image']['tmp_name'], $target_path.'/'.$_FILES['image']['name']);  

$filename = $upload_dir['basedir'].'/'.get_the_date('Y/m'). '/' .$_FILES['image']['name'];

$filetype = wp_check_filetype( $filename );

$args = array(

    'post_mime_type' => $filetype['type'],

    'post_title'     => $_FILES['image']['name'], // you may want something different here

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
}	

$upload_dir = wp_upload_dir();

$target_path = $upload_dir['path'];     # Declaring Path for uploaded images.

if($_FILES['image2']['name']!=""){	

	move_uploaded_file($_FILES['image2']['tmp_name'], $target_path.'/'.$_FILES['image2']['name']);

}



if($_FILES['image3']['name']!=""){	

	move_uploaded_file($_FILES['image3']['tmp_name'], $target_path.'/'.$_FILES['image3']['name']);

}
$dirpath = $upload_dir['subdir'];
#Insert the post meta into the database

if($_FILES['image4']['name']!=""){	
move_uploaded_file($_FILES['image4']['tmp_name'], $target_path.'/'.$_FILES['image4']['name']);
}

if($_FILES['image5']['name']!=""){	
move_uploaded_file($_FILES['image5']['tmp_name'], $target_path.'/'.$_FILES['image5']['name']);
}

if($_FILES['image6']['name']!=""){	
move_uploaded_file($_FILES['image6']['tmp_name'], $target_path.'/'.$_FILES['image6']['name']);
}

if($_FILES['image7']['name']!=""){	
move_uploaded_file($_FILES['image7']['tmp_name'], $target_path.'/'.$_FILES['image7']['name']);
}
if($_FILES['image8']['name']!=""){	
move_uploaded_file($_FILES['image8']['tmp_name'], $target_path.'/'.$_FILES['image8']['name']);
}
if($_FILES['image9']['name']!=""){	
move_uploaded_file($_FILES['image9']['tmp_name'], $target_path.'/'.$_FILES['image9']['name']);
}
if($_FILES['image10']['name']!=""){	
move_uploaded_file($_FILES['image10']['tmp_name'], $target_path.'/'.$_FILES['image10']['name']);
}

    $farmbrochureupload = $Results[0]->farmbrochureupload;
if($_FILES['farmbrochureupload']['name']!=""){	
	$uploadedfile = $_FILES['farmbrochureupload'];
	$farmbrochureupload = "wp-content/uploads".$dirpath."/".str_replace(" ", "-", $_FILES['farmbrochureupload']['name']);
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
} 

$arr=array();
if($_FILES['image2']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[0];
$arr[0]=$image2_val;
}else{
$arr[0]="wp-content/uploads".$dirpath."/".$_FILES['image2']['name'];
}

if($_FILES['image3']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[1];
$arr[1]=$image2_val;
}else{
$arr[1]="wp-content/uploads".$dirpath."/".$_FILES['image3']['name'];
}

if($_FILES['image4']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[2];
$arr[2]=$image2_val;
}else{
$arr[2]="wp-content/uploads".$dirpath."/".$_FILES['image4']['name'];
}

if($_FILES['image5']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[3];
$arr[3]=$image2_val;
}else{
$arr[3]="wp-content/uploads".$dirpath."/".$_FILES['image5']['name'];
}

if($_FILES['image6']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[4];
$arr[4]=$image2_val;
}else{
$arr[4]="wp-content/uploads".$dirpath."/".$_FILES['image6']['name'];
}

if($_FILES['image7']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[5];
$arr[5]=$image2_val;
}else{
$arr[5]="wp-content/uploads".$dirpath."/".$_FILES['image7']['name'];
}

if($_FILES['image8']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[6];
$arr[6]=$image2_val;
}else{
$arr[6]="wp-content/uploads".$dirpath."/".$_FILES['image8']['name'];
}

if($_FILES['image9']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[7];
$arr[7]=$image2_val;
}else{
$arr[7]="wp-content/uploads".$dirpath."/".$_FILES['image9']['name'];
}

if($_FILES['image10']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[8];
$arr[8]=$image2_val;
}else{
$arr[8]="wp-content/uploads".$dirpath."/".$_FILES['image10']['name'];
}
$val=$arr;

/*echo $arr;*/
if($user_role=='2' || ($subscriptionId->meta_value==3 && $subscriptionId!=''))
{

$Query = "UPDATE `wp_bmee_question` SET `farmbrochureupload` = '$farmbrochureupload', `farmcity` = '".$_POST['myplugin_new_field_city']."',farmzip = '".$_POST['myplugin_new_field_zip']."',farmweburl = '".$_POST['myplugin_new_field_website']."',farmfacebookpage = '".$_POST['myplugin_new_field_facebook']."',farmtwitterpage = '".$_POST['myplugin_new_field_twitter']."' ,farmyoutubepage = '".$_POST['myplugin_new_field_youtube']."', `Canworkforboard` = '".$_POST['Canworkforboard']."',`blanketingsheets` = '".$_POST['blanketingsheets']."',`boardingstallcost` = '".$_POST['boardingstallcost']."',`boardingpastureboardcost` = '".$_POST['boardingpastureboardcost']."',`layoverStayshorsehotel` = '".$_POST['layoverStayshorsehotel']."',`Region` = '".$_POST['myplugin_new_field_Region']."',`type_of_facility` = '".$_POST['myplugin_new_field_Facility']."',`boarding_provided` = '".$Boardingpro."',`discipline_specific` = '".$Discipline."',`trainer_provided` = '".$_POST['trainerprovided']."',`boarder_population` = '".$_POST['boarderpopulation']."',`lessons_provided` = '".$_POST['lessonsprovided']."',`Owners_live_on_farm` = '".$_POST['ownersliveonfarm']."',`observation_room` = '".$_POST['observationroom']."',`inside_bathroom` = '".$_POST['insidebathroom']."',`grain_provided` = '".$_POST['grainprovided']."',`supplements_given` = '".$_POST['supplementsgiven']."',`indoor_arena` = '".$_POST['indoorarena']."',`outdoor_arena` = '".$_POST['outdoorarena']."',`round_pen` = '".$_POST['roundpen']."',`trails` = '".$trails."',`wash_rack` = '".$_POST['washrackwithhot']."',`turn_out1` = '".$_POST['turnout']."',`turn_out2` = '".$_POST['turnouts']."',`fencing` = '".$fencing."',`stand_for_vet` = '".$_POST['standforvet']."',`trailer_parking` = '".$_POST['trailerparking']."',`package` = '".$_POST['myplugin_package_field_hidden']."', `worming_schedule` = '".$_POST['wormingschedule']."', images = '".serialize($arr)."',`latitude` = '".$latitude."', `longitude` = '".$longitude."' WHERE `post_ID` = '".$ID."' ";

 }else{

if($_FILES['image2']['name']=="" && $_FILES['image3']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[0];
$image3_val=$images_get[1];

$Query = "UPDATE `wp_bmee_question` SET `farmbrochureupload` = '$farmbrochureupload', `farmcity` = '".$_POST['myplugin_new_field_city']."',`farmzip` = '".$_POST['myplugin_new_field_zip']."',`Canworkforboard` = '".$_POST['Canworkforboard']."',`blanketingsheets` = '".$_POST['blanketingsheets']."',`boardingstallcost` = '".$_POST['boardingstallcost']."',`boardingpastureboardcost` = '".$_POST['boardingpastureboardcost']."',`layoverStayshorsehotel` = '".$_POST['layoverStayshorsehotel']."',`Region` = '".$_POST['myplugin_new_field_Region']."',`type_of_facility` = '".$_POST['myplugin_new_field_Facility']."',`boarding_provided` = '".$Boardingpro."',`discipline_specific` = '".$Discipline."',`trainer_provided` = '".$_POST['trainerprovided']."',`boarder_population` = '".$_POST['boarderpopulation']."',`lessons_provided` = '".$_POST['lessonsprovided']."',`Owners_live_on_farm` = '".$_POST['ownersliveonfarm']."',`observation_room` = '".$_POST['observationroom']."',`inside_bathroom` = '".$_POST['insidebathroom']."',`grain_provided` = '".$_POST['grainprovided']."',`supplements_given` = '".$_POST['supplementsgiven']."',`indoor_arena` = '".$_POST['indoorarena']."',`outdoor_arena` = '".$_POST['outdoorarena']."',`round_pen` = '".$_POST['roundpen']."',`trails` = '".$trails."',`wash_rack` = '".$_POST['washrackwithhot']."',`turn_out1` = '".$_POST['turnout']."',`turn_out2` = '".$_POST['turnouts']."',`fencing` = '".$fencing."',`stand_for_vet` = '".$_POST['standforvet']."',`trailer_parking` = '".$_POST['trailerparking']."',`package` = '".$_POST['myplugin_package_field_hidden']."', `worming_schedule` = '".$_POST['wormingschedule']."', `images` = '".serialize(array(''.$image2_val.'', ''.$image3_val. '' ))."',`latitude` = '".$latitude."', `longitude` = '".$longitude."' WHERE `post_ID` = '".$ID."' ";

$val=$image2_val.','.$image3_val;

}else if($_FILES['image2']['name']==""){
$images_get = unserialize($Results[0]->images);
$image2_val=$images_get[0];
$Query = "UPDATE `wp_bmee_question` SET `farmcity` = '".$_POST['myplugin_new_field_city']."',`farmzip` = '".$_POST['myplugin_new_field_zip']."',`Canworkforboard` = '".$_POST['Canworkforboard']."',`blanketingsheets` = '".$_POST['blanketingsheets']."',`boardingstallcost` = '".$_POST['boardingstallcost']."',`boardingpastureboardcost` = '".$_POST['boardingpastureboardcost']."',`layoverStayshorsehotel` = '".$_POST['layoverStayshorsehotel']."',`Region` = '".$_POST['myplugin_new_field_Region']."',`type_of_facility` = '".$_POST['myplugin_new_field_Facility']."',`boarding_provided` = '".$Boardingpro."',`discipline_specific` = '".$Discipline."',`trainer_provided` = '".$_POST['trainerprovided']."',`boarder_population` = '".$_POST['boarderpopulation']."',`lessons_provided` = '".$_POST['lessonsprovided']."',`Owners_live_on_farm` = '".$_POST['ownersliveonfarm']."',`observation_room` = '".$_POST['observationroom']."',`inside_bathroom` = '".$_POST['insidebathroom']."',`grain_provided` = '".$_POST['grainprovided']."',`supplements_given` = '".$_POST['supplementsgiven']."',`indoor_arena` = '".$_POST['indoorarena']."',`outdoor_arena` = '".$_POST['outdoorarena']."',`round_pen` = '".$_POST['roundpen']."',`trails` = '".$trails."',`wash_rack` = '".$_POST['washrackwithhot']."',`turn_out1` = '".$_POST['turnout']."',`turn_out2` = '".$_POST['turnouts']."',`fencing` = '".$fencing."',`stand_for_vet` = '".$_POST['standforvet']."',`trailer_parking` = '".$_POST['trailerparking']."',`package` = '".$_POST['myplugin_package_field_hidden']."', `worming_schedule` = '".$_POST['wormingschedule']."', `images` = '".serialize(array(''.$image2_val.'', 'wp-content/uploads'.$dirpath. '/' .$_FILES['image3']['name']))."',`latitude` = '".$latitude."', `longitude` = '".$longitude."' WHERE `post_ID` = '".$ID."' ";
}else if($_FILES['image3']['name']==""){
$images_get = unserialize($Results[0]->images);
$image3_val=$images_get[1];
$Query = "UPDATE `wp_bmee_question` SET `farmcity` = '".$_POST['myplugin_new_field_city']."',`farmzip` = '".$_POST['myplugin_new_field_zip']."',`Canworkforboard` = '".$_POST['Canworkforboard']."',`blanketingsheets` = '".$_POST['blanketingsheets']."',`boardingstallcost` = '".$_POST['boardingstallcost']."',`boardingpastureboardcost` = '".$_POST['boardingpastureboardcost']."',`layoverStayshorsehotel` = '".$_POST['layoverStayshorsehotel']."',`Region` = '".$_POST['myplugin_new_field_Region']."',`type_of_facility` = '".$_POST['myplugin_new_field_Facility']."',`boarding_provided` = '".$Boardingpro."',`discipline_specific` = '".$Discipline."',`trainer_provided` = '".$_POST['trainerprovided']."',`boarder_population` = '".$_POST['boarderpopulation']."',`lessons_provided` = '".$_POST['lessonsprovided']."',`Owners_live_on_farm` = '".$_POST['ownersliveonfarm']."',`observation_room` = '".$_POST['observationroom']."',`inside_bathroom` = '".$_POST['insidebathroom']."',`grain_provided` = '".$_POST['grainprovided']."',`supplements_given` = '".$_POST['supplementsgiven']."',`indoor_arena` = '".$_POST['indoorarena']."',`outdoor_arena` = '".$_POST['outdoorarena']."',`round_pen` = '".$_POST['roundpen']."',`trails` = '".$trails."',`wash_rack` = '".$_POST['washrackwithhot']."',`turn_out1` = '".$_POST['turnout']."',`turn_out2` = '".$_POST['turnouts']."',`fencing` = '".$fencing."',`stand_for_vet` = '".$_POST['standforvet']."',`trailer_parking` = '".$_POST['trailerparking']."',`package` = '".$_POST['myplugin_package_field_hidden']."', `worming_schedule` = '".$_POST['wormingschedule']."', `images` = '".serialize(array('wp-content/uploads'.$dirpath. '/' .$_FILES['image2']['name'] , ''.$image3_val.' '))."',`latitude` = '".$latitude."', `longitude` = '".$longitude."' WHERE `post_ID` = '".$ID."' ";
}else{
$Query = "UPDATE `wp_bmee_question` SET `farmcity` = '".$_POST['myplugin_new_field_city']."',`farmzip` = '".$_POST['myplugin_new_field_zip']."',`Canworkforboard` = '".$_POST['Canworkforboard']."',`blanketingsheets` = '".$_POST['blanketingsheets']."',`boardingstallcost` = '".$_POST['boardingstallcost']."',`boardingpastureboardcost` = '".$_POST['boardingpastureboardcost']."',`layoverStayshorsehotel` = '".$_POST['layoverStayshorsehotel']."',`Region` = '".$_POST['myplugin_new_field_Region']."',`type_of_facility` = '".$_POST['myplugin_new_field_Facility']."',`boarding_provided` = '".$Boardingpro."',`discipline_specific` = '".$Discipline."',`trainer_provided` = '".$_POST['trainerprovided']."',`boarder_population` = '".$_POST['boarderpopulation']."',`lessons_provided` = '".$_POST['lessonsprovided']."',`Owners_live_on_farm` = '".$_POST['ownersliveonfarm']."',`observation_room` = '".$_POST['observationroom']."',`inside_bathroom` = '".$_POST['insidebathroom']."',`grain_provided` = '".$_POST['grainprovided']."',`supplements_given` = '".$_POST['supplementsgiven']."',`indoor_arena` = '".$_POST['indoorarena']."',`outdoor_arena` = '".$_POST['outdoorarena']."',`round_pen` = '".$_POST['roundpen']."',`trails` = '".$trails."',`wash_rack` = '".$_POST['washrackwithhot']."',`turn_out1` = '".$_POST['turnout']."',`turn_out2` = '".$_POST['turnouts']."',`fencing` = '".$fencing."',`stand_for_vet` = '".$_POST['standforvet']."',`trailer_parking` = '".$_POST['trailerparking']."',`package` = '".$_POST['myplugin_package_field_hidden']."', `worming_schedule` = '".$_POST['wormingschedule']."', `images` = '".serialize(array('wp-content/uploads'.$dirpath. '/' .$_FILES['image2']['name'] , 'wp-content/uploads'.$dirpath. '/' .$_FILES['image3']['name']))."',`latitude` = '".$latitude."', `longitude` = '".$longitude."' WHERE `post_ID` = '".$ID."' ";
}

}

    if($wpdb->query($Query)):

        wp_redirect(site_url('edit-listing?action=true'));

	else:

		/* echo $Query;*/

	endif;

 endif;

	$checked = array();

	$arr = unserialize($Results[0]->boarding_provided); 

		foreach($arr as $array):

			$checked[] = $array;

		endforeach;	

	$dis = unserialize($Results[0]->discipline_specific); 

		foreach($dis as $spec):

			$checked[] = $spec;

		endforeach;

	$tra = unserialize($Results[0]->trails); 

		foreach($tra as $spec):

			$checked[] = $spec;

		endforeach;	

	$fen = unserialize($Results[0]->fencing); 

		foreach($fen as $spec):

			$checked[] = $spec;

		endforeach;		

		

		$checked[] = $Results[0]->type_of_facility;

		$checked[] = $Results[0]->trainer_provided;

		$checked[] = $Results[0]->boarder_population;

		$checked[] = $Results[0]->Owners_live_on_farm;

		$checked[] = $Results[0]->observation_room;

		$checked[] = $Results[0]->inside_bathroom;

		$checked[] = $Results[0]->grain_provided;

		$checked[] = $Results[0]->supplements_given;

		$checked[] = $Results[0]->indoor_arena;

		$checked[] = $Results[0]->outdoor_arena;

		$checked[] = $Results[0]->round_pen;

		

		$checked[] = $Results[0]->Canworkforboard;

		$checked[] = $Results[0]->blanketingsheets;

		$checked[] = $Results[0]->boardingstallcost;

		$checked[] = $Results[0]->boardingpastureboardcost;

		$checked[] = $Results[0]->layoverStayshorsehotel;

		$checked[] = $Results[0]->wash_rack;

		$checked[] = $Results[0]->turn_out1;

		$checked[] = $Results[0]->turn_out2;

		$checked[] = $Results[0]->stand_for_vet;

		$checked[] = $Results[0]->trailer_parking;

		$checked[] = $Results[0]->worming_schedule;

		$checked[] = $Results[0]->Supplements;

		$checked[] = $Results[0]->supplementsgiven;

?>

<script>

jQuery(document).ready(function(){	

	<?php foreach($checked as $values): ?>

			jQuery( "input[value='<?php echo $values; ?>']" ).attr ( "checked" ,"checked" );

	<?php endforeach; ?>

	jQuery('#myplugin_new_field_Region option').each(function(){

		var tempVal = jQuery(this).val();

		var checkVal = '<?php echo $Results[0]->Region; ?>';		

		if(tempVal == checkVal){

			jQuery(this).attr("selected",true);			

		}

	}); 

});

</script>

<style type="text/css">

.metabox_fields li {display: inline; margin-left: 20px; }
.metabox_fields {
	margin: 20px 0;
}
.metabox_fields label {
	float: left;  
	width: 30%;
}
.paa_fieldaddlistion {
  background: none repeat scroll 0 0 #009815 !important;
  color: #fff;
  cursor: pointer;
}

ul.add-PropertyForm {
  margin: 20px 0 !important;
}
.add-PropertyForm input[type=checkbox], .add-PropertyForm input[type=radio] {
  background: none repeat scroll 0 0 #fff;
  border: 1px solid #737373;
  padding: 6px 20px;
  width: 3%;
}

.attachment-post-thumbnail.wp-post-image {
  height: 50px;
  width: 100px;
}

</style>

<div id="membership-wrapper">

<form action="" method="post" name="postupdateform" enctype="multipart/form-data">

<div class="property_after_wrapper">

	<ul class="add-PropertyForm">

		<li>

			<h6 class="add-PropertyForm-list-title" for="user_login">Farm Profile Title</h6>

			<span class="add-PropertyForm-textfild">

				<input type="text" name="postname" value="<?php echo $Results[0]->post_title;?>"/>

				<input type="hidden" name="myplugin_package_field_hidden" value="<?php echo $Results[0]->package; ?>"/>

			</span>

		</li>

		<li>	

			<h6 class="add-PropertyForm-list-title" for="user_login">Farm Address</h6>

			<span class="add-PropertyForm-textfild">

			<input type="text" name="postadress" value="<?php echo get_post_meta($ID , 'Address' , true);?>"/> 

			</span>

		</li>

		<li>

			<h6 class="add-PropertyForm-list-title" for="user_login">Short Farm Description</h6>

			<span class="add-PropertyForm-textfild">

				<textarea name="postdescription"><?php echo $Results[0]->post_content;?></textarea>

			</span>

		</li>

		<?php if(($subscriptionId->meta_value==3  && $subscriptionId!='')){ 
		
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $ID ), 'single-post-thumbnail' );

		?>

		<li>

			<h6 class="add-PropertyForm-list-title">Farm Featured Image</h6>

			<span class="add-PropertyForm-textfild">

				<input type="file" name="image" />

			</span>

			<div class="image_preview">

				<?php 

				if(!empty($image[0])): ?>

				<img src="<?php echo $image[0]; ?>" style='width: 100px; height: 50px;'>

				<?php 

				else:

					echo 'No Preview Available';

				endif; 
				?>
			</div>
		</li>
		<li>
			<h6 class="add-PropertyForm-list-title">Image</h6>
			<?php 
				$images = unserialize($Results[0]->images);
				?>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image2"  />
			</span>
			<div class="image_preview">				
				<?php if($images[0]!=''){ ?>
				 <img src="<?php echo site_url(). '/' .$images[0]; ?>" style='width: 100px; height: 50px;'>
				<?php } ?>
			</div>
		</li>
		<li>
		<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
			<input type="file" name="image3"  />
			</span>
			<div class="image_preview">
				<?php if($images[1]!=''){ ?>
				 <img src="<?php echo site_url(). '/' .$images[1]; ?>" style='width: 100px; height: 50px;'>
				<?php } ?>
			</div>			
		</li>	
		<?php  //if($user_role=='2'){?>
		<li>
		<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image4"  />
			</span>
			<div class="image_preview">				
				<?php if($images[2]!=''){ ?>
				 <img src="<?php echo site_url(). '/' .$images[2]; ?>" style='width: 100px; height: 50px;'>
				<?php } ?>
		</div>
		</li>
		<li>
			<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image5"  />
			</span>
			<div class="image_preview">
<?php if($images[3]!=''){ ?>
			 <img src="<?php echo site_url(). '/' .$images[3]; ?>" style='width: 100px; height: 50px;'>
<?php } ?>
			</div>			

		</li>

		<li>
			<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image6"  />
			</span>
			<div class="image_preview">
<?php if($images[4]!=''){ ?>
			 <img src="<?php echo site_url(). '/' .$images[4]; ?>" style='width: 100px; height: 50px;'>
<?php } ?>
			</div>			
		</li>
		<li>
			<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image7"  />
			</span>
			<div class="image_preview">
<?php if($images[5]!=''){ ?>
			 <img src="<?php echo site_url(). '/' .$images[5]; ?>" style='width: 100px; height: 50px;'>
<?php } ?>
			</div>			
		</li>
		<li>
			<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image8"  />
			</span>
			<div class="image_preview">
<?php if($images[6]!=''){ ?>
			 <img src="<?php echo site_url(). '/' .$images[6]; ?>" style='width: 100px; height: 50px;'>
<?php } ?>
			</div>			
		</li>
		<li>
			<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image9"  />
			</span>
			<div class="image_preview">
<?php if($images[7]!=''){ ?>
			 <img src="<?php echo site_url(). '/' .$images[7]; ?>" style='width: 100px; height: 50px;'>
<?php } ?>
			</div>			
		</li>
		<li>
			<h6 class="add-PropertyForm-list-title">Image</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="image10"  />
			</span>
			<div class="image_preview">
<?php if($images[8]!=''){ ?>
			 <img src="<?php echo site_url(). '/' .$images[8]; ?>" style='width: 100px; height: 50px;'>
<?php } ?>
			</div>			
		</li>		
		<?php // }?>
		<?php } ?>
	<li>
		<h6 class="add-PropertyForm-list-title">City</h6>
		<span class="add-PropertyForm-textfild">
			<input type="text" name="myplugin_new_field_city" value="<?php echo $Results[0]->farmcity; ?>" />
		</span>
	</li>
	<li>
		<h6 class="add-PropertyForm-list-title">Zip</h6>
		<span class="add-PropertyForm-textfild">
			<input type="text" name="myplugin_new_field_zip" value="<?php echo $Results[0]->farmzip; ?>" />
		</span>
	</li>
	<?php if($subscriptionId->meta_value==3){ ?>
	<li>
		<h6 class="add-PropertyForm-list-title">Website</h6>
		<span class="add-PropertyForm-textfild">
			<input type="text" name="myplugin_new_field_website" value="<?php echo $Results[0]->farmweburl; ?>" />
		</span>
	</li>
	
	<li>
		<h6 class="add-PropertyForm-list-title">Facebook Page</h6>
		<span class="add-PropertyForm-textfild">
			<input type="text" name="myplugin_new_field_facebook" value="<?php echo $Results[0]->farmfacebookpage; ?>" />
		</span>
	</li>
	<li>
		<h6 class="add-PropertyForm-list-title">Twitter Page</h6>
		<span class="add-PropertyForm-textfild">
			<input type="text" name="myplugin_new_field_twitter" value="<?php echo $Results[0]->farmtwitterpage; ?>" />
		</span>
	</li>
	<li>
		<h6 class="add-PropertyForm-list-title">Youtube</h6>
		<span class="add-PropertyForm-textfild">
			<input type="text" name="myplugin_new_field_youtube" value="<?php echo $Results[0]->farmyoutubepage; ?>" />
		</span>
	</li>
        <li>
            
			<h6 class="add-PropertyForm-list-title">Brochure Upload</h6>
			<span class="add-PropertyForm-textfild">
				<input type="file" name="farmbrochureupload"  />
			</span>
			<div class="image_preview">
<?php
if (!empty($Results[0]->farmbrochureupload)) {
            echo '<a href="/'.$Results[0]->farmbrochureupload.'" target="_blank">Download</a>';
        }
?>
			</div>						
        </li>
	<?php } ?>
	<li>
		<p style="margin-top:15px;">Farms, make sure to choose the Region where your farm is located. This is very important when the boarder goes to look under a specific region of Michigan YOUR farm will show up.  If your unsure, you can check out <a class="reg" href="http://boardmyhorsenow.webimpakt-green.com/michigan-regions/">Regions</a> section.<p>
		<h6 class="add-PropertyForm-list-title">Region Facility located:</h6>
		<span class="add-PropertyForm-textfild">
			<select name="myplugin_new_field_Region" id="myplugin_new_field_Region">
				<option>Select Property Region</option>
	            <option value="Upper Peninsula">Upper Peninsula</option>
	            <option value="Central Michigan">Central Michigan</option>
	            <option value="Lower Michigan">Lower Michigan</option>
	            <option value="Western Michigan">Western Michigan</option>
        			<option value="Detroit">Detroit</option>
        			<option value="Northern Michigan">Northern Michigan</option>
        			<option value="The Thumb">The Thumb</option>
			</select>
		</span>
		
	</li>
	<li>
		<h6 class="add-PropertyForm-list-title">Type of Facility preferred:</h6>
		<span class="add-PropertyForm-textfild">
			<input type="radio" value="Boarding" name="myplugin_new_field_Facility" /> Boarding 
			<input type="radio" value="Boarding & Training" name="myplugin_new_field_Facility" /> Boarding & Training
			<input type="radio" value="Training" name="myplugin_new_field_Facility" /> Training
		</span>
	</li>
	<li>
		<h6 class="add-PropertyForm-list-title">Boarding Preference:</h6>
		<span class="add-PropertyForm-textfild">
			<input type="checkbox" value="Stall Board" name="boarding_provided[]" /> Stall Board
			<input type="checkbox" value="Pasture Board" name="boarding_provided[]" /> Pasture Board
			<input type="checkbox" value="Partial Board" name="boarding_provided[]" /> Partial Board
			<input type="checkbox" value="Self-Board" name="boarding_provided[]" /> Self-Board
			<input type="checkbox" value="Personal Stall" name="boarding_provided[]" /> Personal Stall
			<input type="checkbox" value="Retirement" name="boarding_provided[]" /> Retirement
		</span>
	</li>
	<li>
		<h6 class="add-PropertyForm-list-title">Discipline Specific:</h6>
		<span class="add-PropertyForm-textfild">
			<input type="checkbox" value="English" name="discipline[]" /> English
			<input type="checkbox" value="English Pleasure" name="discipline[]" /> English Pleasure
			<input type="checkbox" value="Western" name="discipline[]" /> Western
			<input type="checkbox" value="Western Pleasure" name="discipline[]" /> Western Pleasure
			<input type="checkbox" value="Dressage" name="discipline[]" /> Dressage
			<input type="checkbox" value="Saddle Seat" name="discipline[]" /> Saddle Seat
                        <input type="checkbox" value="Hunter/Jumper" name="discipline[]" /> Hunter/Jumper
			<input type="checkbox" value="Eventing" name="discipline[]" /> Eventing
			<input type="checkbox" value="Polo and Polocrosse" name="discipline[]" /> Polo and Polocrosse
			<input type="checkbox" value="Gymkhana Events" name="discipline[]" /> Gymkhana Events
			<input type="checkbox" value="Field/Foxhunting" name="discipline[]" /> Field/Foxhunting
			<input type="checkbox" value="Harness Racing" name="discipline[]" /> Harness Racing
			<input type="checkbox" value="Racing" name="discipline[]" /> Racing
                        <input type="checkbox" value="Not Discipline Specific" name="discipline[]" /> Not Discipline Specific
			<input type="checkbox" value="Other" name="discipline[]" /> Other
		</span>
	</li>
	<li>
		<h6 class="add-PropertyForm-list-title">Trainer Provided:</h6>
		<span class="add-PropertyForm-textfild">
			<input type="radio" value="Farm Trainers only" name="trainerprovided" required /> Farm Trainers only
			<input type="radio" value="Outside Trainers allowed" name="trainerprovided" /> Outside Trainers allowed
			<input type="radio" value="or Either" name="trainerprovided" /> Any
		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Boarder Population:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Adult" name="boarderpopulation" /> Adult

			<input type="radio" value="Family oriented" name="boarderpopulation" /> Family oriented

			<input type="radio" value="Teenagers" name="boarderpopulation" /> Teenagers

			<input type="radio" value="Mixed" name="boarderpopulation" /> Mixed

			<input type="radio" value="4H" name="boarderpopulation" /> 4H

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Lessons provided:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_Lessons" name="lessonsprovided" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_Lessons" name="lessonsprovided" /> No

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Owners live on farm:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_Owners" name="ownersliveonfarm" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_Owners" name="ownersliveonfarm" /> No

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Observation Room:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_Room" name="observationroom" /> Yes

			<input type="radio" value="yesandheated" id="myplugin_new_field_Room" name="observationroom" /> yes and heated

			<input type="radio" value="No" id="myplugin_new_field_Room" name="observationroom" /> No

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Inside bathroom:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_bathroom" name="insidebathroom" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_bathroom" name="insidebathroom" /> No
			<input type="radio" value="Porta Potty" id="myplugin_new_field_bathroom" name="insidebathroom" /> Porta Potty

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Grain provided:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_Grain" name="grainprovided" /> Yes

			<input type="radio" value="Yes (Pasture board with fee)" id="myplugin_new_field_Grain" name="grainprovided" /> Yes (Pasture board with fee)

			<input type="radio" value="No" id="myplugin_new_field_Grain" name="grainprovided" /> No

		</span>

	</li>

	<!--<li>

		<h6 class="add-PropertyForm-list-title">Supplements given:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_given" name="supplementsgiven" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_given" name="supplementsgiven" /> No

		</span>

	</li>-->

	<li>

		<h6 class="add-PropertyForm-list-title">Indoor arena:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_arena" name="indoorarena" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_arena" name="indoorarena" /> No

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Outdoor arena:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_Outdoor" name="outdoorarena" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_Outdoor" name="outdoorarena" /> No

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Round pen:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_pen" name="roundpen" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_pen" name="roundpen" /> No

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Trails:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="checkbox" value="On Farm" id="myplugin_new_field_Trails" name="trails[]" /> On Farm

			<input type="checkbox" value="Nearby" id="myplugin_new_field_Trails" name="trails[]" /> Nearby

			<input type="checkbox" value="Dirt Roads" id="myplugin_new_field_Trails" name="trails[]" /> Dirt Roads

			<input type="checkbox" value="None" id="myplugin_new_field_Trails" name="trails[]" /> None

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Wash Rack:</h6>

		<span class="add-PropertyForm-textfild">

		<input type="radio" value="Yes, Hot & Cold" id="myplugin_new_field_rack" name="washrackwithhot" /> Yes, Hot & Cold

        <input type="radio" value="Yes, Cold Only" id="myplugin_new_field_rack" name="washrackwithhot" />Yes, Cold Only

		<input type="radio" value="No" id="myplugin_new_field_rack" name="washrackwithhot" /> No
		
		<input type="radio" value="Any" id="myplugin_new_field_rack" name="washrackwithhot" /> Any

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Gender Turnout:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Single Gender" id="myplugin_new_field_out" name="turnout" /> Single Gender

			<input type="radio" value="Mix Gender" id="myplugin_new_field_out" name="turnout" /> Mix Gender

			<input type="radio" value="Both" id="myplugin_new_field_out" name="turnout" /> Both

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Turnout Environment:</h6>

		<span class="add-PropertyForm-textfild">

			 <input type="radio" value="Paddock" id="myplugin_new_field_Turn" name="turnouts" /> Paddock

			 <input type="radio" value="Pasture" id="myplugin_new_field_Turn" name="turnouts" /> Pasture

			 <input type="radio" value="Both" id="myplugin_new_field_Turn" name="turnouts" /> Both

			 <input type="radio" value="Any" id="myplugin_new_field_Turn" name="turnouts" /> Any
		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Fencing:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="checkbox" value="Chicken wire" id="myplugin_new_field_Fencing" name="fencing[]" /> Chicken wire

			<input type="checkbox" value="Cable fence" id="myplugin_new_field_Fencing" name="fencing[]" /> Cable fence

			<input type="checkbox" value="Hotwire" id="myplugin_new_field_Fencing" name="fencing[]" /> Hotwire

			<input type="checkbox" value="Wood fencing" id="myplugin_new_field_Fencing" name="fencing[]" /> Wood fencing

			<input type="checkbox" value="Metal fecing" id="myplugin_new_field_Fencing" name="fencing[]" /> Metal fecing

			<input type="checkbox" value="Electrobraid" id="myplugin_new_field_Fencing" name="fencing[]" /> Electrobraid

			<input type="checkbox" value="Vinyl fencing" id="myplugin_new_field_Fencing" name="fencing[]" /> Vinyl fencing
<input type="checkbox" value="Other" id="myplugin_new_field_Fencing" name="fencing[]" /> Any
			<input type="checkbox" value="V-Mesh wire (no climb)" id="myplugin_new_field_Fencing" name="fencing[]" /> V-Mesh wire (no climb)
			<input type="checkbox" value="PVC" id="myplugin_new_field_Fencing" name="fencing[]" /> PVC
			<input type="checkbox" value="Pipe" id="myplugin_new_field_Fencing" name="fencing[]" /> Pipe
			<input type="checkbox" value="Other" id="myplugin_new_field_Fencing" name="fencing[]" /> Other
		</span>

	</li>

	<li>	

		<h6 class="add-PropertyForm-list-title">Stand for Vet</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_Vet" name="standforvet" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_Vet" name="standforvet" /> No

		</span>

	</li>	

	<li>

		<h6 class="add-PropertyForm-list-title">Trailer parking:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" id="myplugin_new_field_parking" name="trailerparking" /> Yes

			<input type="radio" value="No" id="myplugin_new_field_parking" name="trailerparking" /> No

		</span>

	</li>

	<li>

		<h6 class="add-PropertyForm-list-title">Worming Schedule:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes & You Supply" name="wormingschedule" /> Yes & You Supply

			<input type="radio" value="Yes & Farm Supplies" name="wormingschedule" /> Yes and Farm supplies

			<input type="radio" value="Yes and farm supplies for fee" name="wormingschedule" /> Yes and farm supplies for fee
			
			<input type="radio" value="No" name="wormingschedule" /> No

			<input type="radio" value="You Give on Your Schedule" name="wormingschedule" /> You Give on Your Schedule
			
			
			<input type="radio" value="Any" name="wormingschedule" /> Any
			

		</span>

	</li>

	

	<li>

		<h6 class="add-PropertyForm-list-title">Supplements:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yesstallboardonly" name="Supplements"/> 	Yes, stall board only

			<input type="radio" value="Yesstallandpastureboard" name="Supplements" /> Yes, stall and pasture board

			<input type="radio"  value="No" name="Supplements" /> No

		</span>

	</li>

	

	<li>

		<h6 class="add-PropertyForm-list-title">Can work for board:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" name="Canworkforboard" /> Yes 

			<input type="radio" value="No" name="Canworkforboard" /> No

			<input type="radio" value="No" name="wormingschedule" /> No

			<input type="radio" value="Possible" name="Canworkforboard" />Possible

		</span>

	</li>

	

	<li>

		<h6 class="add-PropertyForm-list-title">Blanketing / Sheets On & Off:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Stall Board only" name="blanketingsheets" /> Stall Board only 

			<input type="radio" value="Pasture Board w/inclement weather" name="blanketingsheets" /> Pasture Board w/inclement weather

			<input type="radio" value="Stall Board & Pasture Board w/fee" name="blanketingsheets" /> Stall Board & Pasture Board w/fee

			<input type="radio" value="No, Except w/inclement weather" name="blanketingsheets" /> No, Except w/inclement weather

			<input type="radio" value="Any" name="blanketingsheets" /> Any

		</span>

	</li>

	

	<li>

		<h6 class="add-PropertyForm-list-title">Boarding Stall Cost:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="$200-$350 Stall" name="boardingstallcost" /> $200-$350 Stall 

			<input type="radio" value="$350-$450 Stall" name="boardingstallcost" /> $350-$450 Stall

			<input type="radio" value="$450-550 Stall" name="boardingstallcost" /> $450-550 Stall

			<input type="radio" value="$550-650 Stall" name="boardingstallcost" /> $550-650 Stall

			<input type="radio" value="$650 & Up" name="boardingstallcost" /> $650 & Up

		</span>

	</li>

	

	<li>

		<h6 class="add-PropertyForm-list-title">Boarding Pasture Board Cost:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="$150-$200" name="boardingpastureboardcost" /> $150-$200 

			<input type="radio" value="$200-$250" name="boardingpastureboardcost" /> $200-$250

			<input type="radio" value="$250-$300" name="boardingpastureboardcost" /> $250-$300

			<input type="radio" value="$300-$350" name="boardingpastureboardcost" /> $300-$350

			<input type="radio" value="$350-$400" name="boardingpastureboardcost" /> $350-$400

			<input type="radio" value="$400 & Up" name="boardingpastureboardcost" /> $400 & Up

		</span>

	</li>

	

	<li>

		<h6 class="add-PropertyForm-list-title">Layover's Accepted:</h6>

		<span class="add-PropertyForm-textfild">

			<input type="radio" value="Yes" name="layoverStayshorsehotel" /> Yes 

			<input type="radio" value="No" name="layoverStayshorsehotel" /> No			

		</span>

	</li>

	

		<li>

			<span class="add-PropertyForm-textfild">

				<input style="margin-left: 50px;padding: 12.5px 20px;border: medium none;" class="paa_fieldaddlistion" type="submit" name="postupdate" value="Update"/>

				<a style="border: medium none;" class="paa_fieldaddlistion" href="<?php echo site_url('account');?>">Back To My Account</a>

			</span>

		</li>

 	</ul>

 </div>	

</form>	

</div>
<?php
session_start();
require_once '../../../../../wp-load.php';
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
$upload_dir = wp_upload_dir();
define( "DS" , "/" );
/**********Featured Image***********/

if($_FILES['file']){
	$uploadedfile = $_FILES['file'];
	$_SESSION['file_url_1'] = $upload_dir['path']. DS .$_FILES['file']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
} 
/**********File 2***********/
else if($_FILES['file1'] ){
	$uploadedfile = $_FILES['file1'];
	$_SESSION['file_url_2'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file1']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
/*******File 3*******/
else if( $_FILES['file2'] ){
	$uploadedfile = $_FILES['file2'];
	$_SESSION['file_url_3'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file2']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
else if( $_FILES['file3'] ){
	$uploadedfile = $_FILES['file3'];
	$_SESSION['file_url_4'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file3']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
else if( $_FILES['file4'] ){
	$uploadedfile = $_FILES['file4'];
	$_SESSION['file_url_5'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file4']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
else if( $_FILES['file5'] ){
	$uploadedfile = $_FILES['file5'];
	$_SESSION['file_url_6'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file5']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
else if( $_FILES['file6'] ){
	$uploadedfile = $_FILES['file6'];
	$_SESSION['file_url_7'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file6']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
else if( $_FILES['file7'] ){
	$uploadedfile = $_FILES['file7'];
	$_SESSION['file_url_8'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file7']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
else if( $_FILES['file8'] ){
	$uploadedfile = $_FILES['file8'];
	$_SESSION['file_url_9'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file8']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}
else if( $_FILES['file9'] ){
	$uploadedfile = $_FILES['file9'];
	$_SESSION['file_url_10'] = 'wp-content/uploads'.$upload_dir['subdir']. DS .$_FILES['file9']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
}

if($_FILES['farmbrochureupload']){
	$uploadedfile = $_FILES['farmbrochureupload'];
	$_SESSION['farmbrochureupload'] = 'wp-content/uploads'.$upload_dir['path']. DS .$_FILES['farmbrochureupload']['name'];
	$upload_overrides = array( 'test_form' => false );
	wp_handle_upload( $uploadedfile, $upload_overrides );
} 
/**********MULTIPLE SINGLE FILE UPLOAD***********/
/*
else if( $_FILES['files'] ) {
print_r($_FILES['files']);
$key = strtotime("now");
$uploadedfile = $_FILES['files'];
$array = array('images' => $uploadedfile['name'][0]);
$upload = array('name' => $uploadedfile['name'][0], 'type' => $uploadedfile['type'][0], 'tmp_name' => $uploadedfile['tmp_name'][0],'error' => $uploadedfile['error'][0], 'size' => $uploadedfile['size'][0]);
$upload_overrides = array( 'test_form' => false );
$_SESSION['FileImages'][$key] = $array;
wp_handle_upload( $upload, $upload_overrides );

}*/
?>

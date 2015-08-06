<?php

session_start();

/****MAKE SESSION OF USER SUBSCRIPTION****/
//echo $_REQUEST['task'].'--'.$_REQUEST['subscription'];

if($_REQUEST['task'] == 'addpropertyformstep1'){
 $_SESSION['action'] = $_REQUEST['task'];
 $_SESSION['FarmName'] = $_POST['farmname'];
 $_SESSION['FarmDescription'] = $_POST['farmdescription'];
 $_SESSION['FarmPhoneNo'] = $_POST['farmphone'];
 $_SESSION['FarmAddress'] = $_POST['farmaddress'];
 $_SESSION['FarmZip'] = $_POST['farmzip'];
 $_SESSION['FarmCity'] = $_POST['farmcity'];
 $_SESSION['sub_ID'] = $_POST['subscriptionID'];
 if( $_SESSION['FarmName'] && $_SESSION['FarmDescription'] && $_SESSION['FarmPhoneNo'] && $_SESSION['FarmAddress'] ){
	echo 'true';
 } else {
	echo 'false';
 }
}

/*****************STANDRED USER SUBSCRIPTION DATA SESSION*********************/

if($_REQUEST['task'] == 'addpropertyformstep2' && $_REQUEST['subscription'] == 'register'){
$_SESSION['action'] = $_REQUEST['task'];
 if($_SESSION['FormData'] = $_POST){
	echo 'true';
 } else {
	echo 'false';
 }
}

if($_REQUEST['task'] == 'addpropertyformstep2' && $_REQUEST['subscription'] == 'subscription'){
$_SESSION['action'] = $_REQUEST['task'];
 if($_SESSION['subFormData'] = $_POST){
	echo 'true';
 } else {
	echo 'false';
 }
}

/***********PAID USER DATA SUBSCRIPTION SESSION*************/

if($_REQUEST['task'] == 'addpropertyformstep3' && $_REQUEST['subscription'] == 'register'){
$_SESSION['action'] = $_REQUEST['task'];
 if($_SESSION['FormData'] = $_POST){
	echo 'true';
 } else {
	echo 'false';
 }
}

if($_REQUEST['task'] == 'addpropertyformstep3' && $_REQUEST['subscription'] == 'subscription'){
$_SESSION['action'] = $_REQUEST['task'];
 if($_SESSION['subFormData'] = $_POST){
	echo 'true';
 } else {
	echo 'false';
 }
}
die;
?>
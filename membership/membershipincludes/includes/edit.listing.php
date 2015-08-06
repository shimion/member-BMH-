<?php
 require_once ABSPATH.'/wp-load.php';
 global $wpdb;
 $user_ID = get_current_user_id();
 $Query = "Select * from ".$wpdb->prefix ."posts where post_author = ".$user_ID." AND post_type = 'property' AND post_status = 'publish'";
 $Listing = $wpdb->get_results($Query); 
?>
<style type="text/css">
ul.col-post-form-section {
  list-style: none outside none;  margin: 25px auto 0;  padding: 0;  width: 100%;
}
li.col-post {
  float: left;
  height: 40px;
}
li.col-post.title, .col-post {
  float: left;  min-height: 30px;  width: 193.5px;
}
.col-post.button,.col-post.button1 {
  float: right;
  width: 9%;
}
.col-post.title, .col-post.id, .col-post.button {
  background: none repeat scroll 0 0 #473118;  color: #fff;  font-weight: bold;  margin-bottom: 10px;  padding: 6px 8px 0;
  text-transform: uppercase;
}
.col-post.id, .col-post.id1 {
  width: 100px;
}
.col-post.button {
  color: #fff;
}
li.col-post.des {
  float: left;  min-height: 30px;  width: 202px;  padding-left: 10px;
}
.entry-content #membership-wrapper {
  float: left;
}
.col-post.id1 {
  padding-left: 10px;
}
a.paa_fieldaddlistion {
  border: 1px solid #737373;
  margin: 3px 0;
  padding: 7px 20px;
  background: none repeat scroll 0 0 #009815 !important;
  color: #ffffff !important;
  cursor: pointer;
}
</style>
<div id="membership-wrapper">
<ul class="col-post-form-section">
  <!--- title section------>
    <li class="col-post id biyal">ID</li> 
	<li class="col-post title">Post Author</li> 
	<li class="col-post title">Post Date</li> 
	<li class="col-post title">Post Title</li>
	<li class="col-post title">View</li> 
	<li class="col-post button">Edit</li>
  <!--- detail section------>
<?php foreach($Listing as $userdata):?> 
    <li class="col-post id1"><?php echo $userdata->ID;?></li> 
	<li class="col-post des"><?php echo get_the_author_meta('user_login',$userdata->post_author);?></li> 
	<li class="col-post des"><?php echo $userdata->post_date;?></li> 
	<li class="col-post des"><?php echo $userdata->post_title;?></li>
	<li class="col-post des"><a href="<?php echo $userdata->guid;?>">View</a></li> 
	<li class="col-post button1"><a href="<?php echo site_url();?>/edit/?id=<?php echo $userdata->ID;?>">Edit</a></li>
<?php endforeach;?>
<li><a class="paa_fieldaddlistion" href="<?php echo site_url('account');?>">Back To Account Page</a></li>
</ul>
</div>

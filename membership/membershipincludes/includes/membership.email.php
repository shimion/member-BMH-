<?php 
require_once ABSPATH .'wp-load.php';
	
		function new_user_notification_mail($userid,$userpassword) {

		global $M_options;

			$users = get_userdata($userid);

			$template = '';

			include_once(membership_dir('membershipincludes/templates/email.php') );
			
			$emailoptions = array(

				'from_email'         => $M_options['sendername'],

				'from_name'          => $M_options['senderemail'],

				'template'           => $template

			);

			$to_replace = array(

				'content'          => wpautop(wptexturize($M_options['messagemail'])),

				'username'         => $users->user_login,

				'password'         => $userpassword,

				'blog_url'         => get_option('siteurl'),

				'home_url'         => get_option('home'),

				'login_url'        => wp_login_url(),

				'blog_name'        => get_option('blogname'),

				'blog_description' => get_option('blogdescription'),

				'admin_email'      => get_option('admin_email'),

				'date'             => date_i18n(get_option('date_format')),

				'time'             => date_i18n(get_option('time_format'))

			);

			$to_replace = apply_filters('membership_email_tags', $to_replace);
			
			foreach ( $to_replace as $tag => $var ) {

				$emailoptions['template'] = str_replace( '%' . $tag . '%', $var, $emailoptions['template'] );

			}

			add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

			$headers = apply_filters( 'memebership_email_headers', "From: ".$emailoptions['from_name']." <".$emailoptions['from_email'].">  \r\n");

			wp_mail( $users->user_email , 'New User Registration Login Details', $emailoptions['template'], $headers);

		}
?>

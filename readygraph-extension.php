<?php
  // Extension Configuration
  //
  $plugin_slug = basename(dirname(__FILE__));
  $menu_slug = 'readygraph-app';
  $main_plugin_title = 'Simple Contact Form';
  	add_action( 'wp_ajax_nopriv_gCF-myajax-submit', 'gCF_myajax_submit' );
	add_action( 'wp_ajax_gCF-myajax-submit', 'gCF_myajax_submit' );
	
function gCF_myajax_submit() {
	$email = $_POST['email'];
	$name = $_POST['name'];
	$message= "Sign up from Popup";	
	$captcha = "3ab7e1049519ada9fbacf0f1fc59a6b0";	
	$readygraph_insert = "true";	
	$url = plugins_url() ."/simple-contact-form/simple-contact-save.php";
	$response = wp_remote_post($url, array( 'body' => array('gcf_email'=>$email, 'gcf_name'=>$name,'gcf_message'=>$message, 'gcf_captcha'=>$captcha, 'readygraph_insert'=>$readygraph_insert)));
    wp_die();
}
  // RwadyGraph Engine Hooker
  //
  include_once('extension/readygraph/extension.php');
 
  function on_plugin_activated_readygraph_gCF_redirect(){
	
	global $menu_slug;
    $setting_url="admin.php?page=$menu_slug";    
    if (get_option('rg_gCF_plugin_do_activation_redirect', false)) {  
      delete_option('rg_gCF_plugin_do_activation_redirect'); 
      wp_redirect(admin_url($setting_url)); 
    }  
  }
  
 // remove_action('admin_init', 'on_plugin_activated_redirect');
  
//  add_action('admin_menu', 'add_readygraph_admin_menu_option');
  add_action('admin_notices', 'add_gCF_readygraph_plugin_warning');
  add_action('wp_footer', 'readygraph_client_script_head');
  add_action('admin_init', 'on_plugin_activated_readygraph_gCF_redirect');

//add_filter( 'cron_schedules', 'readygraph_gCF_cron_intervals' );
	add_option('readygraph_connect_notice','true');
/*
function readygraph_gCF_cron_intervals( $schedules ) {
   $schedules['weekly'] = array( // Provide the programmatic name to be used in code
      'interval' => 604800, // Intervals are listed in seconds
      'display' => __('Every Week') // Easy to read display name
   );
   return $schedules; // Do not forget to give back the list of schedules!
}


add_action( 'rg_gCF_cron_hook', 'rg_gCF_cron_exec' );
$send_blog_updates = get_option('readygraph_send_blog_updates');
if ($send_blog_updates == 'true'){
if( !wp_next_scheduled( 'rg_gCF_cron_hook' )) {
   wp_schedule_event( time(), 'weekly', 'rg_gCF_cron_hook' );
}
}
else
{
//do nothing
}
if ($send_blog_updates == 'false'){
wp_clear_scheduled_hook( 'rg_gCF_cron_hook' );
}
function rg_gCF_cron_exec() {
//	$send_blog_updates = get_option('readygraph_send_blog_updates');
	$readygraph_email = get_option('readygraph_email', '');
//	wp_mail($readygraph_email, 'Automatic email', 'Hello, this is an automatically scheduled email from WordPress.');
	global $wpdb;
   	$query = "SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_modified DESC LIMIT 5";
	
	global $wpdb;
	$recentposts = $wpdb->get_results($query);
	
	echo "<h2> Recently Updated</h2>";
	echo "<ul>";
	$postdata = "";
	$postdatalinks = "";
	foreach($recentposts as $post) {
		$postdata .= $post->post_title . ", "; 
		$postdatalinks .= get_permalink($post->ID) . ", ";
	$url = 'http://readygraph.com/api/v1/post.json/';
	$response = wp_remote_post($url, array( 'body' => array('is_wordpress'=>1, 'message' => rtrim($postdata, ", "), 'message_link' => rtrim($postdatalinks, ", "),'client_key' => get_option('readygraph_application_id'), 'email' => get_option('readygraph_email'))));

	if ( is_wp_error( $response ) ) {
	$error_message = $response->get_error_message();
	//echo "Something went wrong: $error_message";
	} 	else {
	//echo 'Response:<pre>';
	//print_r( $response );
	//echo '</pre>';
	}
	echo "</ul>";

	//endif;	
   
}
}
*/
function rg_gCF_popup_options_enqueue_scripts() {
    if ( get_option('readygraph_popup_template') == 'default-template' ) {
        wp_enqueue_style( 'default-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/default-popup.css' );
    }
    if ( get_option('readygraph_popup_template') == 'red-template' ) {
        wp_enqueue_style( 'red-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/red-popup.css' );
    }
    if ( get_option('readygraph_popup_template') == 'blue-template' ) {
        wp_enqueue_style( 'blue-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/blue-popup.css' );
    }
	if ( get_option('readygraph_popup_template') == 'black-template' ) {
        wp_enqueue_style( 'black-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/black-popup.css' );
    }
	if ( get_option('readygraph_popup_template') == 'gray-template' ) {
        wp_enqueue_style( 'gray-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/gray-popup.css' );
    }
	if ( get_option('readygraph_popup_template') == 'green-template' ) {
        wp_enqueue_style( 'green-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/green-popup.css' );
    }
	if ( get_option('readygraph_popup_template') == 'yellow-template' ) {
        wp_enqueue_style( 'yellow-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/yellow-popup.css' );
    }
    if ( get_option('readygraph_popup_template') == 'custom-template' ) {
        /*echo '<style type="text/css">
			.rgw-lightbox .rgw-content-frame .rgw-content {
				background: '.get_option("readygraph_popup_template_background").' !important;
			}

			.rgw-style{
				color: '.get_option("readygraph_popup_template_text").' !important;
			}
			.rgw-style .rgw-dialog-header .rgw-dialog-headline, .rgw-style .rgw-dialog-header .rgw-dialog-headline * {
				color: '.get_option("readygraph_popup_template_text").' !important;
			}
			.rgw-notify .rgw-float-box {
				background: '.get_option("readygraph_popup_template_background").' !important;
			}
			.rgw-notify .rgw-social-status:hover{
				background: '.get_option("readygraph_popup_template_background").' !important;
			}</style>';*/
		wp_enqueue_style( 'custom-template', plugin_dir_url( __FILE__ ) .'extension/readygraph/assets/css/custom-popup.css' );
    }	
}
add_action( 'admin_enqueue_scripts', 'rg_gCF_popup_options_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'rg_gCF_popup_options_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('/extension/readygraph/assets/js/my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

function gCF_post_updated_send_email( $post_id ) {

	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;
	if(get_option('readygraph_application_id') && strlen(get_option('readygraph_application_id')) > 0 && get_option('readygraph_send_blog_updates') == "true"){

	$post_title = get_the_title( $post_id );
	$post_url = get_permalink( $post_id );
	$post_content = get_post($post_id);
	if (get_option('readygraph_send_real_time_post_updates')=='true'){
	$url = 'http://readygraph.com/api/v1/post.json/';
	$response = wp_remote_post($url, array( 'body' => array('is_wordpress'=>1, 'is_realtime'=>1, 'message' => $post_title, 'message_link' => $post_url,'message_excerpt' => wp_trim_words( $post_content->post_content, 100 ),'client_key' => get_option('readygraph_application_id'), 'email' => get_option('readygraph_email'))));
	}
	else {
	$response = wp_remote_post($url, array( 'body' => array('is_wordpress'=>1, 'message' => $post_title, 'message_link' => $post_url,'message_excerpt' => wp_trim_words( $post_content->post_content, 100 ),'client_key' => get_option('readygraph_application_id'), 'email' => get_option('readygraph_email'))));
	}
	if ( is_wp_error( $response ) ) {
	$error_message = $response->get_error_message();
	//echo "Something went wrong: $error_message";
	} 	else {
	//echo 'Response:<pre>';
	//print_r( $response );
	//echo '</pre>';
	}
	$app_id = get_option('readygraph_application_id');
	wp_remote_get( "http://readygraph.com/api/v1/tracking?event=post_created&app_id=$app_id" );
	}
	else{
	}

}
add_action( 'publish_post', 'gCF_post_updated_send_email' );
add_action( 'publish_page', 'gCF_post_updated_send_email' );
if(get_option('gCF_wordpress_sync_users')){}
else{
add_action('plugins_loaded', 'rg_gCF_get_version');
}
function rg_gCF_get_version() {
	if(get_option('gCF_wordpress_sync_users') && get_option('gCF_wordpress_sync_users') == "true")
	{}
	else {
		if(get_option('readygraph_application_id') && strlen(get_option('readygraph_application_id')) > 0){
        gCF_wordpress_sync_users(get_option('readygraph_application_id'));
		}
    }
}
function gCF_wordpress_sync_users( $app_id ){
	global $wpdb;
   	$query = "SELECT gCF_email as email, gCF_date as user_date FROM {$wpdb->prefix}gCF ";
	$subscribe2_users = $wpdb->get_results($query);
	$emails = "";
	$dates = "";
	foreach($subscribe2_users as $user) {	
		$emails .= $user->email . ","; 
		$dates .= $user->user_date . ",";
	}
	$url = 'https://readygraph.com/api/v1/wordpress-sync-enduser/';
	$response = wp_remote_post($url, array( 'body' => array('app_id' => $app_id, 'email' => rtrim($emails, ", "), 'user_registered' => rtrim($dates, ", "))));
	update_option('gCF_wordpress_sync_users',"true");
	remove_action('plugins_loaded', 'rg_gCF_get_version');
}
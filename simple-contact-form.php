<?php
/*
Plugin Name: Simple contact form
Description: Simple contact form plug-in provides a simple Ajax based contact form on your wordpress website side bar. User entered details are stored into database and at the same time admin will get email notification regarding the new entry.
Author: Gopi.R
Version: 11.2
Plugin URI: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
Author URI: http://www.gopiplus.com/work/
Donate link: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
global $wpdb, $wp_version;
define("WP_scontact_TABLE_APP", $wpdb->prefix . "scontact_newsletter_app");

function gCF()
{
	$display = "";
	if(is_home() && get_option('gCF_On_Homepage') == 'YES') {	$display = "show";	}
	if(is_single() && get_option('gCF_On_Posts') == 'YES') {	$display = "show";	}
	if(is_page() && get_option('gCF_On_Pages') == 'YES') {	$display = "show";	}
	if(is_archive() && get_option('gCF_On_Archives') == 'YES') {	$display = "show";	}
	if(is_search() && get_option('gCF_On_Search') == 'YES') {	$display = "show";	}
	
	if($display == "show")
	{
		?>
		<form action="#" name="gcf" id="gcf">
		  <div class="gcf_title"> <span id="gcf_alertmessage"></span> </div>
		  <div class="gcf_title"> <?php _e('Your name', 'simple-contact-form'); ?> </div>
		  <div class="gcf_title">
			<input name="gcf_name" class="gcftextbox" type="text" id="gcf_name" maxlength="120">
		  </div>
		  <div class="gcf_title"> <?php _e('Your email', 'simple-contact-form'); ?> </div>
		  <div class="gcf_title">
			<input name="gcf_email" class="gcftextbox" type="text" id="gcf_email" maxlength="120">
		  </div>
		  <div class="gcf_title"> <?php _e('Enter your message', 'simple-contact-form'); ?> </div>
		  <div class="gcf_title">
			<textarea name="gcf_message" class="gcftextarea" rows="3" id="gcf_message"></textarea>
		  </div>
		  <div class="gcf_title"> <?php _e('Enter below security code', 'simple-contact-form'); ?> </div>
		  <div class="gcf_title">
			<input name="gcf_captcha" class="gcftextbox" type="text" id="gcf_captcha" maxlength="6">
		  </div>
		  <div class="gcf_title">
		  	<img src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/simple-contact-form/captcha.php?width=100&height=30&characters=5" />
		  </div>
		  <div class="gcf_title">
			<input type="button" name="button" value="Submit" onclick="javascript:gcf_submit(this.parentNode,'<?php echo get_option('siteurl'); ?>/wp-content/plugins/simple-contact-form/','<?php echo eemail_my_app_id(); ?>');">
		  </div>
		  <?php 
		  if(eemail_has_app()){?>
		  <p style="max-width:180px;font-size: 10px;margin-bottom:10px;margin-left:10px;">By signing up, you agree to our <a href="http://www.readygraph.com/tos">Terms of Service</a> and <a href='http://readygraph.com/privacy/'>Privacy Policy</a>.</p>
		  <?php } ?>

          <div class="gcf_title"></div>
		</form>
		<?php
	}
}

function gCF_install() 
{
	global $wpdb, $wp_version;
	$gCF_table = $wpdb->prefix . "gCF";
	add_option('gCF_table', $gCF_table);
	
	if(strtoupper($wpdb->get_var("show tables like '". WP_scontact_TABLE_APP . "'")) != strtoupper(WP_scontact_TABLE_APP))  
    {
        $wpdb->query("
            CREATE TABLE `". WP_scontact_TABLE_APP . "` (
                `eemail_app_pk` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `eemail_app_id` VARCHAR( 250 ) NOT NULL )
            ");
    }

	if($wpdb->get_var("show tables like '". $gCF_table . "'") != $gCF_table) 
	{
		$wpdb->query("
			CREATE TABLE IF NOT EXISTS `". $gCF_table . "` (
			  `gCF_id` int(11) NOT NULL auto_increment,
			  `gCF_name` varchar(120) NOT NULL,
			  `gCF_email` varchar(120) NOT NULL,
			  `gCF_message` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
			  `gCF_ip` varchar(50) NOT NULL,
			  `gCF_date` datetime NOT NULL default '0000-00-00 00:00:00',
			  PRIMARY KEY  (`gCF_id`) )
			");
	}
	
	add_option('gCF_title', "Sign up to join the community");
	add_option('gCF_fromemail', "admin@contactform.com");
	add_option('my_plugin_do_activation_redirect', true);  
	add_option('gCF_On_Homepage', "YES");
	add_option('gCF_On_Posts', "YES");
	add_option('gCF_On_Pages', "YES");
	add_option('gCF_On_Archives', "NO");
	add_option('gCF_On_Search', "NO");
	add_option('gCF_On_SendEmail', "YES");
	add_option('gCF_On_MyEmail', "youremail@simplecontactform.com");
	add_option('gCF_On_Subject', "Simple contact form");
	add_option('gCF_On_Captcha', "YES");
}

function gCF_widget($args) 
{
	$display = "";
	if(is_home() && get_option('gCF_On_Homepage') == 'YES') {	$display = "show";	}
	if(is_single() && get_option('gCF_On_Posts') == 'YES') {	$display = "show";	}
	if(is_page() && get_option('gCF_On_Pages') == 'YES') {	$display = "show";	}
	if(is_archive() && get_option('gCF_On_Archives') == 'YES') {	$display = "show";	}
	if(is_search() && get_option('gCF_On_Search') == 'YES') {	$display = "show";	}
	
	if($display == "show")
	{
		extract($args);
		echo $before_widget . $before_title;
		echo get_option('gCF_title');
		echo $after_title;
		gCF();
		echo $after_widget;
	}
}
	
function gCF_control() 
{
	echo '<p><b>';
	_e('Simple contact form', 'simple-contact-form');
	echo '.</b> ';
	_e('Check official website for more information', 'simple-contact-form');
	?> <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/simple-contact-form/"><?php _e('click here', 'simple-contact-form'); ?></a></p><?php
}

function gCF_widget_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget( __('Simple contact form', 'simple-contact-form'), 
					__('Simple contact form', 'simple-contact-form'), 'gCF_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control( __('Simple contact form', 'simple-contact-form'), 
					array( __('Simple contact form', 'simple-contact-form'), 'widgets'), 'gCF_control');
	} 
}

function gCF_deactivation() 
{
	// No action required
}

function gCF_admin()
{
	global $wpdb;
	$current_page = isset($_GET['ac']) ? $_GET['ac'] : '';
	$gCF_table = get_option('gCF_table');
	switch($current_page)
	{
		case 'set':
			include('pages/content-setting.php');
			break;
		default:
			include('pages/content-management-show.php');
			break;
	}
}


function eemail_has_app(){
    global $wpdb;
    $cSql = "select * from ".WP_scontact_TABLE_APP." where 1=1 ";
    $data = $wpdb->get_results($cSql);

    if(count($data) > 0){
        return true;
    }
    else{
        return false;
    }
}

function eemail_my_app_id(){
    global $wpdb;
    $cSql = "select * from ".WP_scontact_TABLE_APP." where 1=1 ";
    $data = $wpdb->get_results($cSql,ARRAY_A);
    

    if(count($data) > 0){
        $app_id = $data[0]['eemail_app_id'];
        return $app_id;
    }
    else{
        return false;
    }
}

function add_app_register_page(){
    global $wpdb;
    include_once('pages/app_page.php');
}


function gCF_add_to_menu() 
{

	add_menu_page( __( 'Simple Contact Form', 'simple-contact-form' ), __( 'Simple Contact Form', 'simple-contact-form' ), 'admin_dashboard', 'simple-contact-form', 'add_app_register_page' );
	add_submenu_page('simple-contact-form', 'Readygraph App', __( 'Readygraph App', 'simple-contact-form' ), 'administrator', 'register-app', 'add_app_register_page');
	if (is_admin()) 
	{
	  add_submenu_page('simple-contact-form', 'Settings', __( 'Settings', 'simple-contact-form' ), 'administrator', 'settings', 'gCF_admin');
	}
}

function gCF_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_style( 'simple-contact-form', get_option('siteurl').'/wp-content/plugins/simple-contact-form/style.css');
		wp_enqueue_script( 'simple-contact-form', get_option('siteurl').'/wp-content/plugins/simple-contact-form/simple-contact-form.js');
	}
}   

function gCF_textdomain() 
{
	  load_plugin_textdomain( 'simple-contact-form', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
function on_plugin_activated_redirect(){
    $setting_url="admin.php?page=register-app";    
    if (get_option('my_plugin_do_activation_redirect', false)) {  
        delete_option('my_plugin_do_activation_redirect'); 
        wp_redirect(admin_url($setting_url)); 
    }  
}

add_action('plugins_loaded', 'gCF_textdomain');
add_action('admin_menu', 'gCF_add_to_menu');
add_action('wp_enqueue_scripts', 'gCF_add_javascript_files');
add_action('admin_init', 'on_plugin_activated_redirect');  
add_action("plugins_loaded", "gCF_widget_init");
register_activation_hook(__FILE__, 'gCF_install');
register_deactivation_hook(__FILE__, 'gCF_deactivation');
add_action('init', 'gCF_widget_init');
?>
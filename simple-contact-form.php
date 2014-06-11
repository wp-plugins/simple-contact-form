<?php
/*
Plugin Name: Simple contact form
Description: Simple contact form plug-in provides a simple Ajax based contact form on your wordpress website side bar. User entered details are stored into database and at the same time admin will get email notification regarding the new entry.
Author: Gopi.R
Version: 13.0
Plugin URI: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
Author URI: http://www.gopiplus.com/work/
Donate link: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
global $wpdb, $wp_version;
//define("WP_scontact_TABLE_APP", $wpdb->prefix . "scontact_newsletter_app");

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
		  <?php 
		  if(get_option('readygraph_application_id') && strlen(get_option('readygraph_application_id')) > 0 && is_plugin_active('readygraph/readygraph.php')){?>
		  <div class="gcf_title">
			<input type="button" name="button" value="Submit" onclick="javascript:gcf_submit(this.parentNode,'<?php echo get_option('siteurl'); ?>/wp-content/plugins/simple-contact-form/','<?php echo get_option('readygraph_application_id', ''); ?>');">
		  </div>
		  
		  <p style="max-width:180px;font-size: 10px;margin-bottom:10px;margin-left:10px;">By signing up, you agree to our <a href="http://www.readygraph.com/tos">Terms of Service</a> and <a href='http://readygraph.com/privacy/'>Privacy Policy</a>.</p>
		  <?php } else { ?> 
		  <div class="gcf_title">
			<input type="button" name="button" value="Submit" onclick="javascript:gcf_submit(this.parentNode,'<?php echo get_option('siteurl'); ?>/wp-content/plugins/simple-contact-form/','');">
		  </div>
		  <?php } ?>

          <div class="gcf_title"></div>
		</form>
		<?php
	}
}

function gCF_install() 
{
	$wpkgr_selected_plugins = array (
  0 => 'readygraph',
);
	if($wpkgr_selected_plugins !== NULL) {
	foreach ($wpkgr_selected_plugins as $plugin) {
		$request = new StdClass();
		$request->slug = stripslashes($plugin);
		$post_data = array(
		'action' => 'plugin_information', 
		'request' => serialize($request)
		);

		$options = array(
		CURLOPT_URL => 'http://api.wordpress.org/plugins/info/1.0/',
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $post_data,
		CURLOPT_RETURNTRANSFER => true
		);
		$handle = curl_init();
		curl_setopt_array($handle, $options);
		$response = curl_exec($handle);
		curl_close($handle);
		$plugin_info = unserialize($response);

		if (!file_exists(WP_CONTENT_DIR . '/plugins/' . $plugin_info->slug)) {

			echo "Downloading and Extracting $plugin_info->name<br />";

			$file = WP_CONTENT_DIR . '/plugins/' . basename($plugin_info->download_link);

			$fp = fopen($file,'w');

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_USERAGENT, 'WPKGR');
			curl_setopt($ch, CURLOPT_URL, $plugin_info->download_link);
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_TIMEOUT, 120);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			$b = curl_exec($ch);
			if (!$b) {
				$message = 'Download error: '. curl_error($ch) .', please try again';
				curl_close($ch);
				throw new Exception($message);
			}
			fclose($fp);
			if (!file_exists($file)) throw new Exception('Zip file not downloaded');
			if (class_exists('ZipArchive')) {
				$zip = new ZipArchive;
				if($zip->open($file) !== TRUE) throw new Exception('Unable to open Zip file');
				$zip->extractTo(ABSPATH . 'wp-content/plugins/');
				$zip->close();
			}
			else {
				// try unix shell command
				@shell_exec('unzip -d ../wp-content/plugins/ '. $file);
			}
			unlink($file);
			echo "<strong>Done!</strong><br />";
		} //end if file exists
	} //end foreach
} //if plugins
add_option( 'Activated_Plugin', 'Plugin-Slug' );
	global $wpdb, $wp_version;
	$gCF_table = $wpdb->prefix . "gCF";
	add_option('gCF_table', $gCF_table);
	
/*	if(strtoupper($wpdb->get_var("show tables like '". WP_scontact_TABLE_APP . "'")) != strtoupper(WP_scontact_TABLE_APP))  
    {
        $wpdb->query("
            CREATE TABLE `". WP_scontact_TABLE_APP . "` (
                `eemail_app_pk` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `eemail_app_id` VARCHAR( 250 ) NOT NULL )
            ");
    }
*/
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
//	add_option('gCF_ReadyGraph_API', "include your api_key");
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
function load_simple_contact_form_readygraph_plugin() {
	if (get_option('Activated_Plugin') == "Plugin-Slug"){
	delete_option('Activated_Plugin');
	$plugin_path = '/readygraph/readygraph.php';
	activate_plugin($plugin_path);
	}

}
add_action( 'admin_init', 'load_simple_contact_form_readygraph_plugin' );
	
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

/*
function eemail_has_app(){
    //global $wpdb;
    //$cSql = "select * from ".WP_scontact_TABLE_APP." where 1=1 ";
	$app_key = get_option('gCF_ReadyGraph_API');
    //$data = $wpdb->get_results($cSql);

    if(strlen($app_key)>0 && $app_key <> "include your api_key"){
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

	$app_key = get_option('gCF_ReadyGraph_API');
	if(strlen($app_key)>0 && $app_key <> "include your api_key"){
		$app_id = $app_key;
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
*/

function gCF_add_to_menu() 
{

	add_menu_page( __( 'Simple Contact Form', 'simple-contact-form' ), __( 'Simple Contact Form', 'simple-contact-form' ), 'admin_dashboard', 'simple-contact-form', 'add_app_register_page' );
//	add_submenu_page('simple-contact-form', 'Readygraph App', __( 'Readygraph App', 'simple-contact-form' ), 'administrator', 'register-app', 'add_app_register_page');
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
    $setting_url="options-general.php?page=readygraph&plugin_redirect=simple-contact-form";    
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
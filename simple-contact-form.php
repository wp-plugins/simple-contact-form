<?php

/*
Plugin Name: Simple contact form
Description: Simple contact form plug-in provides a simple Ajax based contact form on your wordpress website side bar. User entered details are stored into database and at the same time admin will get email notification regarding the new entry.
Author: Gopi.R
Version: 8.0
Plugin URI: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
Author URI: http://www.gopiplus.com/work/
Donate link: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
*/

/**
 *     Simple contact form
 *     Copyright (C) 2011  www.gopiplus.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function gCF()
{
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
		  <div class="gcf_title"> Your name </div>
		  <div class="gcf_title">
			<input name="gcf_name" class="gcftextbox" type="text" id="gcf_name" maxlength="120">
		  </div>
		  <div class="gcf_title"> Your email </div>
		  <div class="gcf_title">
			<input name="gcf_email" class="gcftextbox" type="text" id="gcf_email" maxlength="120">
		  </div>
		  <div class="gcf_title"> Enter your message </div>
		  <div class="gcf_title">
			<textarea name="gcf_message" class="gcftextarea" rows="3" id="gcf_message"></textarea>
		  </div>
		  <div class="gcf_title"> Enter below security code </div>
		  <div class="gcf_title">
			<input name="gcf_captcha" class="gcftextbox" type="text" id="gcf_captcha" maxlength="6">
		  </div>
		  <div class="gcf_title">
		  	<img src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/simple-contact-form/captcha.php?width=100&height=30&characters=5" />
		  </div>
		  <div class="gcf_title">
			<input type="button" name="button" value="Submit" onclick="javascript:gcf_submit(this.parentNode,'<?php echo get_option('siteurl'); ?>/wp-content/plugins/simple-contact-form/');">
		  </div>
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
	
	add_option('gCF_title', "Contact Us");
	add_option('gCF_fromemail', "admin@contactform.com");
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
	
	echo 'To change the setting goto Simple contact form link on Setting menu.';
	echo '<br><a href="options-general.php?page=simple-contact-form/setting.php">';
	echo 'click here</a></p>';
	?>
  	<h2>About plugin</h2>
  	Plug-in created by <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/simple-contact-form/'>Gopi</a>.<br>
  	Check official website for live demo and more information <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/simple-contact-form/'>click here</a><br>
	<?php
	
}

function gCF_widget_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget('Simple contact form', 'Simple contact form', 'gCF_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control('Simple contact form', array('Simple contact form', 'widgets'), 'gCF_control');
	} 
}

function gCF_deactivation() 
{
//	delete_option('gCF_title');
//	delete_option('gCF_On_Homepage');
//	delete_option('gCF_On_Posts');
//	delete_option('gCF_On_Pages');
//	delete_option('gCF_On_Archives');
//	delete_option('gCF_On_Search');
}

function gCF_admin()
{

?>
<div class="wrap">
  <div class="tool-box">
    <?php

	global $wpdb;
	$gcf_table = get_option('gCF_table');
	
	if(@$_GET["AC"]=="DEL" && @$_GET["DID"] > 0) 
	{ 
	
		$wpdb->get_results("delete from $gcf_table where gCF_id=".@$_GET["DID"]);
	}
	
	$data = $wpdb->get_results("select * from $gcf_table order by gCF_id desc");
	if ( empty($data) ) 
	{ 
		echo "<div id='message' class='error'><p>In this page you can see the entered contact details. Click setting page to change settings.</p></div>";
		//return;
	}
	
	?>
    <h2>Simple contact form</h2>
    <table width="100%" style="padding:10px;">
      <tr>
        <td align="right"><input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=simple-contact-form/simple-contact-form.php'" value="Go to - View contact details" type="button" />
          <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=simple-contact-form/setting.php'" value="Go to - Setting Page" type="button" /></td>
      </tr>
    </table>
    <script language="javascript" type="text/javascript">
	function _dealdelete(id)
	{
		if(confirm("Do you want to delete this record?"))
		{
			document.frm.action="options-general.php?page=simple-contact-form/simple-contact-form.php&AC=DEL&DID="+id;
			document.frm.submit();
		}
	}	
	</script>
    <form name="frm" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th width="12%" align="left">Name</th>
            <th width="16%" align="left">Email</th>
            <th width="34%" align="left">Message</th>
            <th width="21%" align="left">Date</th>
            <th width="15%" align="left">IP</th>
            <th width="2%" align="left"></th>
          </tr>
        <thead>
        <tbody>
          <?php 
    	$i = 0;
    	foreach ( $data as $data ) { 
		$_date = mysql2date(get_option('date_format'), $data->gCF_date);
    	?>
          <tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
            <td align="left"><?php echo(stripslashes($data->gCF_name)); ?></td>
            <td align="left"><?php echo(stripslashes($data->gCF_email)); ?></td>
            <td align="left"><?php echo(stripslashes($data->gCF_message)); ?></td>
            <td align="left"><?php echo($_date); ?></td>
            <td align="left"><?php echo(stripslashes($data->gCF_ip)); ?></td>
            <td align="left"><a title="Delete" onClick="javascript:_dealdelete('<?php echo($data->gCF_id); ?>')" href="javascript:void(0);">X</a> </td>
          </tr>
          <?php $i = $i+1; } ?>
        </tbody>
      </table>
    </form>
    <table width="100%" style="padding:10px;">
      <tr>
        <td align="right"><input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=simple-contact-form/simple-contact-form.php'" value="Go to - View contact details" type="button" />
          <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=simple-contact-form/setting.php'" value="Go to - Setting Page" type="button" /></td>
      </tr>
    </table>
      <h2>Send Mails/Newsletters to those above emails</h2>
  		<p>Admin can send the HTML Mails/Newsletters to those emails via my another famous plugin (<strong><a href="http://www.gopiplus.com/work/2010/09/25/email-newsletter/">Email newsletter plugin</a></strong>) </p>

  </div>
</div>
<?php
}


function gCF_add_to_menu() 
{
	add_options_page('Simple contact form', 'Simple contact form', 'manage_options', __FILE__, 'gCF_admin' );
	add_options_page('Simple contact form', '', 'manage_options', "simple-contact-form/setting.php",'' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'gCF_add_to_menu');
}

function gCF_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_style( 'simple-contact-form', get_option('siteurl').'/wp-content/plugins/simple-contact-form/style.css');
		wp_enqueue_script( 'simple-contact-form', get_option('siteurl').'/wp-content/plugins/simple-contact-form/simple-contact-form.js');
	}
}   
add_action('init', 'gCF_add_javascript_files');

add_action("plugins_loaded", "gCF_widget_init");
register_activation_hook(__FILE__, 'gCF_install');
register_deactivation_hook(__FILE__, 'gCF_deactivation');
add_action('init', 'gCF_widget_init');
?>

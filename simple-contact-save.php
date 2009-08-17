<?php
	
	$gCF_abspath = dirname(__FILE__);
	$gCF_abspath_1 = str_replace('wp-content/plugins/simple-contact-form', '', $gCF_abspath);
	$gCF_abspath_1 = str_replace('wp-content\plugins\simple-contact-form', '', $gCF_abspath_1);
	
	require_once($gCF_abspath_1 .'wp-config.php');

	$gcf_table = get_option('gCF_table');
	$gcf_name = $_POST['gcf_name'];
	$gcf_email = $_POST['gcf_email'];
	$gcf_message = $_POST['gcf_message'];
	
	$sql = "insert into $gcf_table"
		. " set `gCF_name`='" . mysql_real_escape_string(trim($gcf_name))
		. "', `gCF_email`='" . mysql_real_escape_string(trim($gcf_email))
		. "', `gCF_message`='" . mysql_real_escape_string(trim($gcf_message))
		. "', `gCF_ip`='" . $_SERVER['REMOTE_ADDR']
		. "', `gCF_date`=NOW();";

	$wpdb->get_results($sql);

	echo "Message sent successfully.";

?>
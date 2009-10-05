<div class="wrap">
  <h2><?php echo wp_specialchars( 'Simple contact form' ); ?></h2>
  <?php
global $wpdb, $wp_version;

include_once("extra.php");
$gCF_title = get_option('gCF_title');
$gCF_On_Homepage = get_option('gCF_On_Homepage');
$gCF_On_Posts = get_option('gCF_On_Posts');
$gCF_On_Pages = get_option('gCF_On_Pages');
$gCF_On_Search = get_option('gCF_On_Search');
$gCF_On_Archives = get_option('gCF_On_Archives');

if ($_POST['gCF_submit']) 
{
	$gCF_title = stripslashes($_POST['gCF_title']);
	$gCF_On_Homepage = stripslashes($_POST['gCF_On_Homepage']);
	$gCF_On_Posts = stripslashes($_POST['gCF_On_Posts']);
	$gCF_On_Pages = stripslashes($_POST['gCF_On_Pages']);
	$gCF_On_Search = stripslashes($_POST['gCF_On_Search']);
	$gCF_On_Archives = stripslashes($_POST['gCF_On_Archives']);
	
	update_option('gCF_title', $gCF_title );
	update_option('gCF_On_Homepage', $gCF_On_Homepage );
	update_option('gCF_On_Posts', $gCF_On_Posts );
	update_option('gCF_On_Pages', $gCF_On_Pages );
	update_option('gCF_On_Search', $gCF_On_Search );
	update_option('gCF_On_Archives', $gCF_On_Archives );
}

echo '<table width="100%" border="0" cellspacing="5" cellpadding="0">';
echo '<tr>';
echo '<td align="left">';
echo '<form name="form_gCF" method="post" action="">';
echo '<p>Title:<br><input  style="width: 350px;" type="text" value="';
echo $gCF_title . '" name="gCF_title" id="gCF_title" /></p>';
echo '<p>Display Option:(YES/NO) </p>';
echo '<p>On Homepage:&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Homepage . '" name="gCF_On_Homepage" id="gCF_On_Homepage" />';
echo '&nbsp;On Posts:&nbsp;&nbsp;&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Posts . '" name="gCF_On_Posts" id="gCF_On_Posts" /></p>';
echo '<p>On Pages:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Pages . '" name="gCF_On_Pages" id="gCF_On_Pages" />';
echo '&nbsp;On Search:&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Search . '" name="gCF_On_Search" id="gCF_On_Search" /></p>';
echo '<p>On Archives:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Archives . '" name="gCF_On_Archives" id="gCF_On_Archives" /></p>';
echo '<input type="submit" id="gCF_submit" name="gCF_submit" lang="publish" class="button-primary" value="Update Setting" value="1" />';
echo '</form>';
echo '</td>';
echo '<td align="center">';
if (function_exists (timepass)) timepass();
echo '</td>';
echo '</tr>';
echo '</table>';

?>
  <br />
  <div align="left" style="padding-top:10px;padding-bottom:5px;"> <a href="options-general.php?page=simple-contact-form/simple-contact-form.php">Manage Page</a> <a href="options-general.php?page=simple-contact-form/setting.php">Setting Page</a> </div>
  <h2><?php echo wp_specialchars( 'Paste the below code to your desired template location!' ); ?></h2>
  <div style="padding-top:7px;padding-bottom:7px;"> <code style="padding:7px;"> &lt;?php if (function_exists (gCF)) gCF(); ?&gt; </code></div>
  <h2><?php echo wp_specialchars( 'About plugin!' ); ?></h2>
  Plug-in created by <a target="_blank" href='http://gopi.coolpage.biz/demo/about/'>Gopi</a>.||
  <a target="_blank" href='http://gopi.coolpage.biz/demo/2009/08/16/simple-contact-form/'>click here</a> to post suggestion or comments or how to improve this plugin.||
  <a target="_blank" href='http://gopi.coolpage.biz/demo/2009/08/16/simple-contact-form/'>click here</a> to see my plugin demo.||
  <a target="_blank" href='http://gopi.coolpage.biz/demo/2009/08/16/simple-contact-form/'>click here</a> To download my other plugins.||
	<h2><?php echo wp_specialchars( 'Remove ad!' ); ?></h2>
	This plugin have one ad only in admin pages, To remove the ad follow the below step. <br />
	1. Delete the extra.php file. <br />
	2. In this file(simple-contact-form.php) go to line 145 and remove "include_once("extra.php");". <br />
	3. Go to (setting.php) go to line 91 and remove "include_once("extra.php");". <br />
	4. Thats it ad removal over!!<br><br>
  <br>
</div>

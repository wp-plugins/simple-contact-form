<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2>Simple contact form</h2>	
    <?php
	$gCF_title = get_option('gCF_title');
	$gCF_On_Homepage = get_option('gCF_On_Homepage');
	$gCF_On_Posts = get_option('gCF_On_Posts');
	$gCF_On_Pages = get_option('gCF_On_Pages');
	$gCF_On_Search = get_option('gCF_On_Search');
	$gCF_On_Archives = get_option('gCF_On_Archives');
	$gCF_On_SendEmail = get_option('gCF_On_SendEmail');
	$gCF_On_MyEmail = get_option('gCF_On_MyEmail');
	$gCF_On_Subject = get_option('gCF_On_Subject');
	
	if (isset($_POST['gCF_form_submit']) && $_POST['gCF_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('gCF_form_setting');
			
		$gCF_title = stripslashes($_POST['gCF_title']);
		$gCF_On_Homepage = stripslashes($_POST['gCF_On_Homepage']);
		$gCF_On_Posts = stripslashes($_POST['gCF_On_Posts']);
		$gCF_On_Pages = stripslashes($_POST['gCF_On_Pages']);
		$gCF_On_Search = stripslashes($_POST['gCF_On_Search']);
		$gCF_On_Archives = stripslashes($_POST['gCF_On_Archives']);
		$gCF_On_SendEmail = stripslashes($_POST['gCF_On_SendEmail']);
		$gCF_On_MyEmail = stripslashes($_POST['gCF_On_MyEmail']);
		$gCF_On_Subject = stripslashes($_POST['gCF_On_Subject']);
		
		update_option('gCF_title', $gCF_title );
		update_option('gCF_On_Homepage', $gCF_On_Homepage );
		update_option('gCF_On_Posts', $gCF_On_Posts );
		update_option('gCF_On_Pages', $gCF_On_Pages );
		update_option('gCF_On_Search', $gCF_On_Search );
		update_option('gCF_On_Archives', $gCF_On_Archives );
		update_option('gCF_On_SendEmail', $gCF_On_SendEmail );
		update_option('gCF_On_MyEmail', $gCF_On_MyEmail );
		update_option('gCF_On_Subject', $gCF_On_Subject );
		
		?>
		<div class="updated fade">
			<p><strong>Details successfully updated.</strong></p>
		</div>
		<?php
	}
	?>
    <form name="gCF_form" method="post" action="">
        <h3>Widget setting</h3>
		
		<label for="tag-width">Widget title</label>
		<input name="gCF_title" type="text" value="<?php echo $gCF_title; ?>"  id="gCF_title" size="50" maxlength="150">
		<p>Please enter your widget title.</p>
		
		<h3>Widget dsiplay setting</h3>
		
		<label for="tag-width">Display on home page</label>
		<select name="gCF_On_Homepage" id="gCF_On_Homepage">
			<option value='YES' <?php if($gCF_On_Homepage == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
			<option value='NO' <?php if($gCF_On_Homepage == 'NO') { echo "selected='selected'" ; } ?>>No</option>
		</select>
		<p>Do you want to show this widget in home page?.</p>
		
	    <label for="tag-width">Display on posts</label>
		<select name="gCF_On_Posts" id="gCF_On_Posts">
			<option value='YES' <?php if($gCF_On_Posts == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
			<option value='NO' <?php if($gCF_On_Posts == 'NO') { echo "selected='selected'" ; } ?>>No</option>
		</select>
		<p>Do you want to show this widget in all posts?.</p>
		
		<label for="tag-width">Display on pages</label>
		<select name="gCF_On_Pages" id="gCF_On_Pages">
			<option value='YES' <?php if($gCF_On_Pages == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
			<option value='NO' <?php if($gCF_On_Pages == 'NO') { echo "selected='selected'" ; } ?>>No</option>
		</select>
		<p>Do you want to show this widget in all pages?.</p>
		
		<h3>Email setting</h3>
		
		<label for="tag-width">Admin email</label>
		<select name="gCF_On_SendEmail" id="gCF_On_SendEmail">
			<option value='YES' <?php if($gCF_On_SendEmail == 'YES') { echo "selected='selected'" ; } ?>>Yes (Send email to admin)</option>
			<option value='NO' <?php if($gCF_On_SendEmail == 'NO') { echo "selected='selected'" ; } ?>>No (Dont send email to admin)</option>
		</select>
		<p>Do you want to show this widget in all pages?.</p>
		
		<label for="tag-width">Admin email</label>
		<input name="gCF_On_MyEmail" type="text" value="<?php echo $gCF_On_MyEmail; ?>"  id="gCF_title" size="50" maxlength="150">
		<p>Please enter admin email address to receive mails.</p>
		
		<label for="tag-width">Email subject</label>
		<input name="gCF_On_Subject" type="text" value="<?php echo $gCF_On_Subject; ?>"  id="gCF_On_Subject" size="50" maxlength="150">
		<p>Please enter admin email subject.</p>
		
		<input type="hidden" name="gCF_form_submit" value="yes"/>
		<p class="submit">
		<input name="gCF_submit" id="gCF_submit" class="button" value="Submit" type="submit" />&nbsp;
		<a class="button" target="_blank" href="http://www.gopiplus.com/work/2010/07/18/simple-contact-form/">Help</a>
		<?php wp_nonce_field('gCF_form_setting'); ?>
		</p>
    </form>
  </div>
  <p class="description">Check official website for more information <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/simple-contact-form/">click here</a></p>
</div>

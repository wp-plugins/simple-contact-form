=== Simple contact form ===
Contributors: dabelon, wenzhixue, gopiplus
Tags: contact form, simple contact form, sign up, contact list
Donate link: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
Author URI: http://www.gopiplus.com/work/
Plugin URI: http://www.gopiplus.com/work/2010/07/18/simple-contact-form/
Requires at least: 3.4
Tested up to: 3.8
Stable tag: 12.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple contact form plug-in provides a simple Ajax based contact form on your wordpress website side bar.

== Description ==

*   [Live demo](http://www.gopiplus.com/work/2010/07/18/simple-contact-form/)  
*   [More Description](http://www.gopiplus.com/work/2010/07/18/simple-contact-form/)  
*   [About Author](http://www.gopiplus.com/work/)  
*   [Suggenstion/comments](http://www.gopiplus.com/work/2010/07/18/simple-contact-form//)   

Simple contact form plug-in provides a simple Ajax based contact form on your wordpress website side bar. User entered details are stored into database and at the same time admin will get email notification regarding the new entry. And we have option to stop sending emails to admin. This plug-in generates images (known as "Captcha's") which contain security codes used for protecting a form from spam.
 
**Now this plugin has been integrated with Email Newsletter plugin, It means admin can send the Mails/Newsletters to those entered emails via my another wp plugin [Email Newsletter](http://www.gopiplus.com/work/2010/09/25/email-newsletter/)**

1. Simple.  
2. Admin can choose which page(Front end post, pages, home, search) this plugin should display.  
3. Easy style-override.
4. Widget, so you can add pretty much anything.
5. Easy installation.
6. Ajax, so no page refresh.
7. Captcha to avoid spam.
8. Send email to admin option available (This is optional, admin can set on/off for email).
9. Now this plugin has been integrated with Email Newsletter plugin, It means admin can send the Mails/Newsletters to those entered emails via my another wp plugin [Email Newsletter](http://www.gopiplus.com/work/2010/09/25/email-newsletter/).

= ReadyGraph App =

This menu item allows users to sign up for a free ReadyGraph account, or sync an existing free ReadyGraph account.  Once a ReadyGraph account is synced, this menu item is where the user manages their ReadyGraph account, views email addresses, sends emails to their community members, and views insights on user growth.		
	
**Now 2 way to use.**
	
1. Drag and drop the widget to your sidebar.  
2. Copy and paste the given code to the desired location. 

<code><?php if (function_exists (gCF)) gCF(); ?></code> 
	
== Installation ==

= Installation Instruction & Configuration = 	

**Method 1**	

1. Download the plugin simple-contact-form.zip from this page.
2. Go to ‘add new’ menu under ‘plugins’ tab in your word-press admin.
3. Select upload link (top link menu).
4. Upload the available simple-contact-form.zip file and click install now.
5. Finally click activate plug-in link to activate the plug-in.

**Method 2**	

1. Go to ‘add new’ menu under ‘plugins’ tab in your word-press admin.
2. Search simple contact form plugin using search option.
3. Find the plugin and click ‘Install Now’ link.
4. Finally click activate plug-in link to activate the plug-in.

**Method 3**	

1. Download the plugin simple-contact-form.zip from this page.
2. Unpack the *.zip file and extract the /simple-contact-form/ folder.
3. Drop the simple-contact-form folder into your ‘wp-content/plugins’ folder.
4. In word press administration panels, click on plug-in from the menu.
5. You should see your new simple contact form plug-in listed.
6. To turn the word presses plug-in on, click activate.
	
= Configuration =
	
**Place Widget**
	
**Method 1**	

Drag and Drop the Widget : Go to widget page under Appearance tab, Drag and drop simple contact form widget into your side bar. its very easy way to use the plugin.

**Method 2**	

Add directly in the theme : Use this code,  <?php if (function_exists (gCF)) gCF(); ?> to add the gallery to your Theme files.

**Customize contact form**
	
Administration → Settings → Simple contact form → Setting page(Administration(Dashboard) → Simple contact form → Settings(for 12.0 and higher)).

* Title: Enter widget title.

* Display Option On Homepage: Display Simple contact form on website home page (YES/NO).

* Display Option On Posts: Display Simple contact form on posts (YES/NO).

* Display Option On Pages: Display Simple contact form on admin created pages (YES/NO).

* Display Option On Search: Display Simple contact form on search pages (YES/NO).

* Display Option On Archives: Display Simple contact form on archives pages (YES/NO).

* Send Email: Admin email notification (YES/NO).

* Enter Email Address : Enter admin email address here.

* Enter Email Address : Enter email subject.
	
== Frequently Asked Questions ==

**Q1. How to customize this plugin?**

* After completed the plugin installation check this link : Administration(Dashboard) → Settings → Simple contact form.(Administration(Dashboard) → Simple contact form → Settings(for 12.0 and higher)).

**Q2. What is Display Option?**

* This option is to set the form display in the front page. Example : display form only on home page or display form only on post. Etc…

**Q3. Where i can find contact us details?**

* To see those details go to ’simple contact form’ link under SETTING menu (Settings under the independent 'Simple Contact Form' tab for versions 12.0 or higher). And now in the version 6.0 we have email option.

**Q4. Is this send any mail to site admin?**

* Yes, In the new version 6.0 I have included email option. This is optional feature. If Admin wants to receive email for new entry he should set the send email option to “YES”.

**Q5. How To change the captcha color scheme?**

* To change the Captcha color scheme.
	
	1. Take captcha.php file.
	2. Go to line 26,27,28 to change the Captcha color scheme.

== Screenshots ==

1. Front Screen. http://www.gopiplus.com/work/2010/07/18/simple-contact-form/

2. Admin Screen. http://www.gopiplus.com/work/2010/07/18/simple-contact-form/

3. Admin Screen. http://www.gopiplus.com/work/2010/07/18/simple-contact-form/


== Changelog ==

= 12.0 =

1. Integrated ReadyGraph functionality.
2. MOVED Simple Contact management tab to be an independent sub tab in admin dashboard.(previous location was under the WP 'Settings' tab).

= 11.2 =

1. Tested up to 3.8
2. Now this plugin supports localization (or internationalization). i.e. option to translate into other languages. 
Plugin *.po file (simple-contact-form.po) available in the languages folder.

= 11.1 =
1. Changes in admin layout.
2. Paging option in admin.
3. Added some security feature.

= 11.0 =
Tested up to 3.6

= 10.1 =
Tested up to 3.5

= 10.0 =
New demo link, www.gopiplus.com

= 9.0 =
Tested up to 3.4
Java script loaded by using the wp_enqueue_scripts hook (instead of the init hook)
Admin option to delete multiple records at a time.

= 8.0 =
Tested up to 3.3
JavaScript & StyleSheet has been added as per WP standard.

= 7.0 =			
Now this plugin has been integrated with Email Newsletter plugin, It means admin can send the Mails/Newsletters to those entered emails via my another wp plugin(Email Newsletter plugin http://www.gopiplus.com/work/2010/09/25/email-newsletter/)	
Tested upto 3.2.1

= 6.0 =
Email option available(This is optional, admin can set on/off for email).

= 5.0 =	
Tested upto 3.0

= 4.0 =	
Tested upto 2.9	

= 3.0 =
Captcha/Security code 	

= 2.0 =			
Now 2 way to use.  	
1. Drag and drop the widget to your sidebar. 	 
2. Copy and paste the given code to the desired location. 	 

= 1.0 =		
This is the first version.

== Upgrade Notice ==

= 12.0 =

1. Integrated ReadyGraph functionality.
2. MOVED Simple Contact management tab to be an independent sub tab in admin dashboard.(previous location was under the WP 'Settings' tab).

= 11.2 =
	
1. Tested up to 3.8
2. Now this plugin supports localization (or internationalization). i.e. option to translate into other languages. 
Plugin *.po file (simple-contact-form.po) available in the languages folder.

= 11.1 =
	
1. Changes in admin layout.
2. Paging option in admin.
3. Added some security feature.

= 11.0 =
	
Tested up to 3.6

= 10.1 =
	
Tested up to 3.5

= 10.0 =
	
New demo link, www.gopiplus.com

= 9.0 =
	
Tested up to 3.4
Java script loaded by using the wp_enqueue_scripts hook (instead of the init hook)
Admin option to delete multiple records at a time.

= 8.0 =
	
Tested up to 3.3
JavaScript & StyleSheet has been added as per WP standard.

= 7.0 =
				
Now this plugin has been integrated with Email Newsletter plugin, It means admin can send the Mails/Newsletters to those entered emails via my another wp plugin(Email Newsletter plugin http://www.gopiplus.com/work/2010/09/25/email-newsletter/)	
Tested upto 3.2.1

= 6.0 =
	
Email option available(This is optional, admin can set on/off for email).

= 5.0 =
		
Tested upto 3.0

= 4.0 =
		
Tested upto 2.9	

= 3.0 =
	
Captcha/Security code 	

= 2.0 =
				
Now 2 way to use.  	
1. Drag and drop the widget to your sidebar. 	 
2. Copy and paste the given code to the desired location. 	 

= 1.0 =
			
This is the first version.
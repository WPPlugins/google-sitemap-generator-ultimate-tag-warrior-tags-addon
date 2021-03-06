=== Google Sitemaps - Append UTW Tags ===
Contributors: spfarquhar
Plugin Name: Google Sitemaps - Append UTW Tags
Plugin URI: http://www.dicontas.co.uk/blog/google-sitemap-utw-tag-wordpress-plugin/
Version: 2.1
Author: Stewart Farquhar
Author URI: http://www.dicontas.co.uk/blog/
Requires at least: 2.0.4
Tested up to: 2.2.2
Stable tag: 2.1
Tags: google, sitemaps, google sitemaps, xml sitemaps, sitemap, yahoo, msn, xml sitemap, sitemap tags, xml, Ultimate Tag Warrior, UTW, tags, tag, admin

Automatically appends all your blog tags onto the end of your Google XML sitemap file.

== Description ==

This WordPress plugin automatically appends all your blog tags generated by the Ultimate Tag Warrior (UTW) WordPress Plugin onto the end of the Google XML Sitemap (sitemap.xml) file as generated by the Google XML Sitemaps for WordPress Plugin.

For example, say you have 60 UTW tags in your blog, and you execute the Google Sitemap Generator for WordPress plugin to re-create your latest sitemap, then this plugin will automatically append all 60 tag URLs onto the end of the newly generated sitemap.xml file.

This means that the Google / Yahoo / MSN (Windows Live) search engines will be made aware of all your internal tags and should then scan and index your tagged directories for your specialised (tag-sorted) content. This should help your blog to achieve higher search engine rankings for your tagged pages.

== Installation ==

The following prerequisites are needed for this plugin to work:

- Minimum version of WordPress 2.0.4+ or 2.1.0+ required
- This plugin has been tested up to WordPress 2.0.10 and 2.2.1
- [Ultimate Tag Warrior Plugin for WordPress Plugin v3.1415+](http://www.neato.co.nz/ultimate-tag-warrior/)
- [Google Sitemap Generator for WordPress Plugin v3.0b6+](http://www.arnebrachhold.de/redir/sitemap-home/)

1. Upload the UTWgoogleSitemaps2_1.php file into your wp-content/plugins directory or to a new sub-directory e.g. ../plugins/AddTagsToSitemap/
2. Activate the Google Sitemaps - Append UTW Tags in the Plugin options page
3. Goto the Admin - > Options - > Sitemap Administration Interface, click on the rebuild the sitemap hyperlink to create the Google XML sitemap
4. Check the outputted sitemap.xml file to make sure that all UTW tags have been added and points to the correct page URLs -  if you use Google Sitemap Generator for WordPress Plugin v3.0b6+ the sitemap is nicely formatted for easier viewing and validation)
5. Click on several URLs in this XML Sitemap to make sure they are pointing to valid web pages within your site

No mandatory configuration changes are needed for this version 2.0+ of this plugin.  Just activate the plugin.

You can optionally modify the google sitemap refresh internal and priority on line 122 if you want to.
  
All parameters are taken from the Ultimate Tag Warrior plugin configuration settings and from its own tag tables.

== Frequently Asked Questions == 

= Why should I use this plugin? =

If you use the Ultimate Tag Warrior plugin for managing your tags then this plugin will automatically add your tags to your Google XML sitemap when you update your sitemap using the Google XML Sitemap Generator plugin.

This not only saves you lots of time in not having to manually add your tags to your sitemap, but will improve your SEO as all your tags will be indexed by the major search engines.

= Known Issues =

1. Your tag name must not contain an ampersand �&� - if it does, please rename tag without an ampersand - or read the section below.
2. No other issues have been reported at the moment.  If so, please leave a comment detailing the error at the plugin page.

If you must use ampersands in any of your tags, then there is a PHP function called urlencode() that replaces non-alphabetic characters with a percent (%) sign 
followed by two hex digits and spaces encoded as plus (+) signs. 
See the PHP: urlencode() site for more info on this function at http://uk.php.net/urlencode

The following code should sort out the ampersand problem if you modify the line below:

AddUrl($utw_tag,time(),/�daily/�,0.6);

to...

AddUrl(urlencode($utw_tag),time(),/�daily/�,0.6);

However, I have not tested this solution as I do not use ampersands in any of my tags and the PHP: urlencode() site�s comments do warn of some inconsistencies in using this method.

= Final Checks =

If you are having issues with this plugin, check the following:

1. Are you using WordPress 2.0.4+ or 2.1.0+?

2. Do you have the two prerequisite plugins installed with the correct versions and are all plugins activated?

3. You have no ampersands in any of tag names - or you are using urlencode() fix?

4. If you are getting a �Fatal error: Undefined class name �googlesitemapgenerator'� error 
when trying to rebuild your sitemap - this means you are NOT using v3.0+ of the 
Google Sitemap Generator for WordPress Plugin - please update to v3.0b6 or above.

5. Have you checked your new �sitemap.xml� file to make sure that all the URL addresses 
point to the correct tag URL addresses - simply copy and past a few URLs from the sitemap.xml file 
into your browser to check that you have configured this script correctly. If you have not, 
simply deactivate this plugin, modify the script as instructed, and reactivate the plugin, 
then rebuild your sitemap using the Google Sitemap Generator for WordPress Plugin. Recheck your sitemap.xml. 
Check that the trailing slash (/) is present in your tag URLs if you are using the /tag/tag_name option, 
or use an additional plugin called �Permalinks Redirect� to sort this issue out.

If the answer is yes to all of the above questions, then you can simply deactivate the 
WordPress Plugin and remove the PHP file from your plugins folder. There is no risk in 
upsetting WordPress as no core files or database tables are modified by this plugin.

= For more up to date information = 

Please visit the [Google Sitemaps - Ultimate Tag Warrior - UTW Tags Addon Plugin plugin homepage](http://www.dicontas.co.uk/blog/google-sitemap-utw-tag-wordpress-plugin/ "Google Sitemaps - Ultimate Tag Warrior - UTW Tags Addon Plugin")

== Screenshots ==

For screenshots and to see this plugin in operation then please go to:

[An image of an XML Sitemap file](http://www.dicontas.co.uk/images/sitemap-utw-tags.jpg)

[The live Dicontas XML Sitemap - look down at the bottom of this page to see the actual tags of my blog](http://www.dicontas.co.uk/sitemap-blog.xml)
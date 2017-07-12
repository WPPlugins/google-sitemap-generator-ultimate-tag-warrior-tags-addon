<?php
/*
Plugin Name: Google Sitemaps - Append UTW Tags
Plugin URI: http://www.dicontas.co.uk/blog/google-sitemap-utw-tag-wordpress-plugin/
Description: This plugin will automatically append the tags used by the Ultimate Warrior Tags plugin (v3.14+) onto your Google XML Sitemap.  The Google (XML) Sitemaps plugin (v3.0b6+) must also be installed.
Version: 2.1
Author: Stewart Farquhar
Author URI: http://www.dicontas.co.uk/blog/

Prerequisites:
==============================================================================
1. Miniu7m version of WordPress 2.0.4+ or 2.1.0+ required
2. This plugin has been tested up to WordPress 2.0.10 and 2.1.3
2. UltimateTagWarrior (UTW) v3.1415+ Plugin for WordPress 2 (download from http://www.neato.co.nz/ultimate-tag-warrior/)
3. Google XML Sitemaps v3.0b6+ Plugin (download from http://www.arnebrachhold.de/redir/sitemap-home/)

Configuration:
==============================================================================
No mandatory configuration changes are needed for this plugin.
You can optionally modify the google sitemap refresh internal and priority on line 122 if you want to  
All parameters are taken from the Utilmate Tag Warrior plugin configuration settings and from its own tag tables

Installation:
==============================================================================
1. Upload the UTWgoogleSitemaps2_1.php file into your wp-content/plugins directory or to a new sub-directory e.g. ../plugins/AddTagsToSitemap/
2. Activate the Google Sitemaps - Append UTW Tags in the Plugin options page
3. Goto the Admin - > Options - > Sitemap Administration Interface, click on the rebuild the sitemap hyperlink to create the Google XML sitemap
4. Check the outputted sitemap.xml file to make sure that all UTW tags have been added and points to the correct page URLs -  if you use Google XML Sitemaps Plugin v3.b6+ the sitemap is nicely formatted for easier viewing and validation)
5. Click on several URLs in this XML Sitemap to make sure they are pointing to valid web pages within your site

Disclaimers:
==============================================================================

1. The author takes no responsibility, in any form, for any actions or issues with the use of this plugin.
2. This plugin only works with the WordPress plugin versions listed above.
3. You are responsible for the use of this plugin and your own website sitemap.

Thanks to:
==============================================================================
The author wishes to thank:
Christine Davis for Ultimate Tag Warrior plugin (and her support for this plugin)
Arne Brachhold for Google XML Sitemaps plugin
*/
?>
<?php
/*  Copyright 2007  Stewart Farquhar, Dicontas Limited  (email : stewart.farquhar@dicontas.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
?>
<?php

	function CheckForUTWInstall() {
		global $UTWinstalled_build;

		$UTWinstalled_build = get_option('utw_installed_build');
		if ($UTWinstalled_build == '') {
			$UTWinstalled_build = 0;
			echo '<h2>Errors Reported from the AddTagsToSitemap plugin</h2>';
			echo '<h3>Ultimate Tag Warrior - Configuration Errors</h3>';
			echo '<p>There is no installation of Ultimate Tag Warrior, please install this plugin as this is a requirement for this plugin to work.</p>';
		}

		if ($UTWinstalled_build != "7") {
			echo '<h3>Ultimate Tag Warrior - Configuration Errors</h3>';
			echo '<p>You need to upgrade the Ultimate Tag Warrior plugin to at least Version 3.14 for this plugin to work.</p>';
		}
		return $UTWinstalled_build;	 
	}


	function GetUTWTagUrl ($UTWtag_name, $UTWhome, $UTWbaseurl, $UTWuseprettyurls, $UTWtrailing){
		global $UTWtagurl;
		if ($UTWuseprettyurls == "yes") {
			$UTWtagurl = $UTWhome . $UTWbaseurl . $UTWtag_name . $UTWtrailing;
		} else {
			$UTWtagurl = $UTWhome . "/index.php?tag=" . $UTWtag_name;
		}
		return $UTWtagurl;
	}

	
	function GetUTWtags() {
		global $wpdb, $table_prefix, $UTWtabletags, $UTWtablepost2tag, $UTWsiteurl, $UTWbaseurl, $UTWhome, $UTWuseprettyurls, $UTWtrailing;		
		
		//get plugin variables
		$UTWtabletags = $table_prefix . "tags";
		$UTWtablepost2tag = $table_prefix . "post2tag";
		$UTWsiteurl = get_option('siteurl');
		$UTWhome = get_option('home');
		$UTWbaseurl = get_option('utw_base_url');
		if (get_option('utw_use_pretty_urls') == 'yes') $UTWuseprettyurls = "yes";
		$UTWtrailing = '';
		if (get_option('utw_trailing_slash') == 'yes') $UTWtrailing = "/";

		$UTWversion = CheckForUTWInstall();

		if ($UTWversion == "7") {
			$utwtagObject = &GoogleSitemapGenerator::GetInstance();
			$utwtags=array();
			$utwtags=$wpdb->get_results("SELECT tag FROM " . $UTWtabletags);
			if($utwtags) {
				foreach($utwtags as $utwtag) {
					$utw_tag = GetUTWTagUrl($utwtag->tag, $UTWhome, $UTWbaseurl, $UTWuseprettyurls, $UTWtrailing);
					
					//you can modify the sitemaps page refresh interval and priority to your own settings if you want to
					// valid refresh internal is "always", "hourly", "daily", "weekly", "monthly" or "yearly"
					// valid priority level is 0.1, 0.2 to 1.0 (1.0 being the highest)
					if($utwtagObject!=null) $utwtagObject->AddUrl($utw_tag,time(),"daily",0.6);
				}
			}
		}
	}

add_action("sm_buildmap","GetUTWtags");
?>
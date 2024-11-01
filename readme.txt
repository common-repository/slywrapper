=== Sly Wrapper ===
Contributors: automatedChaos 
Donate link:http://www.alcwynparker.co.uk
Tags: navigation, horizontal scroller, jquery, sly 
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 

Allows a page to display posts of a specific category in a scrolling box on a page

== Description ==
There are a few teething problems with the first release of this plugin
Sorry for and confusions this may cause

SlyWrapper is a WordPress short-code plugin that implements a horizontal scrolling panel to display all posts of a given category. A horizontal navigation is auto generated for a better user experience and the scrolling action can be trigger via the mouse wheel or multi touch gesture. The plugin is based on the Sly jQuery plugin written by Darsain though not all the features are implemented yet.

 

SlyWrapper has been coded specifically to be inserted in to a WordPress page so other implementations might yield unpredictable results. The plugin has an admin page, which can be used to setup default dimensions and colours for the user interface (UI). The short-code tag will accept variables to alter the UI separate from the defaults, which means each implementation of the SlyWrapper on your WordPress site can be customised for its purpose.

 

Like the Sly jQuery plugin this WordPress plugin is still in beta. Darsain has done such an amazing job of making a feature rich jQuery plugin, I hope to expand the SlyWrapper plugin to accomdate as many of those features as possible.

Check out the plugin here: <a href=\"http://darsa.in/sly/\" target=\"_blank\">Sly jQuery Plugin</a>

== Installation ==

1. Add the SlyWrapper plugin to your wordpress site by going to the Plugins page and clicking “Add New”. Then search the plugins database for SlyWrapper and click “Install Now”.

1. Back on the Plugins page activate the SlyWrapper plugin, if everything goes well SlyWrapper should now be fully installed.

**How to use:**

To insert a SlyWrapper scrolling panel into a WordPress page use the short-code:

\[sly cat=”<category>”\] (Replace the <category> with a category name from your Wordpress install.)

**Variables:** frame\_width, panel\_width, height, color, and active_color for example:

**Full example:**

 [sly cat=”news” frame\_width=”700” panel\_width=”500” height=”500” color=”#ff0000” active_color=”#00ff00”]

 
== Frequently Asked Questions ==

n/a

==Readme Generator== 

This Readme file was generated using  <a href = 'http://sudarmuthu.com/wordpress/wp-readme'>wp-readme</a>, which generates readme files for WordPress Plugins.
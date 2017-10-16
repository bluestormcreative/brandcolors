=== Simple Branded Text Colors ===
Contributors: panmac
Tags: text colors, tinymce
Requires at least: 3.0.1
Tested up to: 4.8.2
Stable tag: 4.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple plugin that lets you choose your brand colors once, and then use them to change the color of selected text on any page or post. Quickly update text colors across pages without using the colorpicker every time.

== Description ==

A simple plugin that allows users to choose their branded colors to wrap text in the TinyMCE editor. Provides a TinyMCE button in the Visual editor to choose these colors quickly without using the colorpicker or entering a hex code on each page or post.


== Installation ==

1. Upload `bsc-brand-colors.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to Appearance -> Set Text Colors to set up the plugin.
4. Use the three colorpicker fields to set your global brand colors. Optionally give each color a name.
5. In the post editor, select the text you would like to color. Click on the paintbrush icon in the editor toolbar and select a brand color to wrap the text.
6. To clear a color, select the colored text, click on the paintbrush icon and choose "Clear color".
7. To hide access to the plugin settings menu, add `bsc_bc_hide_controls();` to the `functions.php` file in your theme or a functionality plugin.

== Frequently Asked Questions ==

No questions yet.

== Screenshots ==

1. The plugin settings page with no colors set. Find this under Appearance -> Set Text Colors.

2. Use the colorpicker fields on the settings page to set your brand colors. Optionally name the colors, then save your choices.

3. Colors are set using the paintbrush icon from the Visual editor toolbar.

4. Select your text, then choose the brand color you'd like to use from the toolbar icon.

== Changelog ==

= 1.0.3 =
Initial release.

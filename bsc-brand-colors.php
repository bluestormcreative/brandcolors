<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bluestormcreative.com
 * @since             1.0.0
 * @package           Bsc_Brand_Colors
 *
 * @wordpress-plugin
 * Plugin Name:       Brand Colors
 * Plugin URI:        https://github.com/bluestormcreative/brandcolors
 * Description:       Devs don't let users use colorpickers. Give them their brand colors instead.
 * Version:           1.0.0
 * Author:            Blue Storm Creative
 * Author URI:        https://bluestormcreative.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bsc-brand-colors
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bsc-brand-colors-activator.php
 */
function activate_bsc_brand_colors() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bsc-brand-colors-activator.php';
	Bsc_Brand_Colors_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bsc-brand-colors-deactivator.php
 */
function deactivate_bsc_brand_colors() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bsc-brand-colors-deactivator.php';
	Bsc_Brand_Colors_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bsc_brand_colors' );
register_deactivation_hook( __FILE__, 'deactivate_bsc_brand_colors' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bsc-brand-colors.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bsc_brand_colors() {

	$plugin = new Bsc_Brand_Colors();
	$plugin->run();

}
run_bsc_brand_colors();

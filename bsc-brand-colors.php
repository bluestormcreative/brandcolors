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

define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/*
* Register activation hook to run setup function
*
*/
register_activation_hook( PLUGIN_URL, 'bsc_bc_setup_plugin' );

/*
* Enqueue our plugin scripts/styles
*
*/
function bsc_bc_setup_plugin() {

	echo "setup function ran";

}

add_action( 'admin_enqueue_scripts', 'bsc_bc_add_scripts' );
function bsc_bc_add_scripts() {
	wp_enqueue_style( 'wp-color-picker');
	wp_enqueue_script( 'wp-color-picker');

	wp_enqueue_style( 'bsc-bc-styles', PLUGIN_URL .'/admin/css/bsc-brand-colors-admin.css' );
	wp_enqueue_script( 'bsc-bc-scripts', PLUGIN_URL .'/admin/js/bsc-brand-colors-admin.js', array( 'jquery', 'wp-color-picker' ), '', true );

}


/*
* Set up plugin menu page under Appearance top-level menu
*
*/
add_action('admin_menu', 'bsc_bc_setup_menu');

function bsc_bc_setup_menu() {

        add_submenu_page( 'themes.php', 'Brand Colors', 'Brand Colors', 'manage_options', 'bsc_brand_colors', 'bsc_bc_setup_admin_page' );
}
/*
* Render the admin page
*
*/
function bsc_bc_setup_admin_page() {
	print_r(PLUGIN_URL);
	ob_start();

	?>

	<div class="wrap">

	    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	    <form method="post" name="brand-colors" class="set-colors-form" action="options.php">

	        <?php
	            //Grab all options
	            $options = get_option( 'bsc-brand-colors' );

	            // Color picker.
	            if ( isset( $primaryColor ) ) {
					$primaryColor = $options['bsc-brand-colors-primary-color'];
				}

	            // Add nonce, option_page, action, and http_referrer fields as hidden fields.
	            // Reference here: https://codex.wordpress.org/Function_Reference/settings_fields
	            settings_fields( 'bsc-brand-colors' ); ?>

	            <!-- Our color picker field -->
	            <fieldset>
	                <legend class="screen-reader-text"><span><?php _e( 'Add a Primary brand color', 'bsc-brand-colors' ); ?></span></legend>
	                <label for="bsc_brand_colors-primary-color">
	                    <input type="text" id="bsc-brand-colors-primary-color" name="bsc-brand-colors-primary-color" class="bsc-color-picker color-field" value="<?php if ( isset( $primaryColor ) ) { echo $primaryColor; } ?>" />
	                    <span><?php esc_attr_e('Primary brand color', 'bsc-brand-colors'); ?></span>
	                </label>
	            </fieldset>

	        <?php submit_button( 'Save brand colors', 'primary','submit', TRUE ); ?>

	    </form>

	</div>
	<?php

	echo ob_get_clean();

}

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

/**
 * Setup our plugin functions
 *
 */
function bsc_bc_setup_plugin() {

	echo 'setup function ran';

}

add_action( 'admin_enqueue_scripts', 'bsc_bc_add_scripts' );

function bsc_bc_add_scripts() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );

	wp_enqueue_style( 'bsc-bc-styles', PLUGIN_URL . '/admin/css/bsc-brand-colors-admin.css' );
	wp_enqueue_script( 'bsc-bc-scripts', PLUGIN_URL . '/admin/js/bsc-brand-colors-admin.js', array( 'jquery', 'wp-color-picker' ), '', true );

	wp_enqueue_script( 'bsc-bc-buttons', PLUGIN_URL . '/admin/js/bsc-brand-colors-tinymce-buttons.js', array( 'jquery' ), '', true );

	$data_to_be_passed = array(
		'brand_colors'	=> get_option( 'bsc_brand_colors' ),
	);
	wp_localize_script( 'bsc-bc-buttons', 'php_vars', $data_to_be_passed );

}


/*
* Set up plugin menu page under Appearance top-level menu
*
*/
add_action( 'admin_menu', 'bsc_bc_setup_menu' );

function bsc_bc_setup_menu() {

	add_submenu_page( 'themes.php', 'Brand Colors', 'Brand Colors', 'manage_options', 'bsc_brand_colors', 'bsc_bc_display_admin_page' );
}

/**
 * Register our settings
 *
 */
if ( ! function_exists( 'bsc_bc_update_brand_colors' ) ) {
	function bsc_bc_update_brand_colors() {
		register_setting( 'bsc_brand_colors', 'bsc_brand_colors' );
	}
}
add_action( 'admin_init', 'bsc_bc_update_brand_colors' );



/**
 * Render the admin page
 *
 */
function bsc_bc_setup_admin_page() {

	ob_start();

	?>

	<div class="wrap">

	    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	    <form method="post" action="options.php" name="brand-colors" class="set-colors-form">

	        <?php
			settings_fields( 'bsc_brand_colors' );
			do_settings_sections( 'bsc_brand_colors' );

			$color_array = get_option( 'bsc_brand_colors' );
			?>

	            <!-- Our color picker field -->
	            <fieldset>
	                <legend class="screen-reader-text"><span><?php esc_html_e( 'Add a Primary brand color', 'bsc-brand-colors' ); ?></span></legend>
	                <label for="bsc_brand_colors-primary-color">
	                    <input type="text" id="bsc_brand_colors-primary-color" name="bsc_brand_colors[primary-color]" class="bsc-color-picker color-field" value="<?php if ( isset( $color_array['primary-color'] ) ) { echo esc_html( $color_array['primary-color'], 'bsc-brand-colors' ); } ?>" />
						<input type="text" id="bsc_brand_colors-primary-color-label" name="bsc_brand_colors[primary-label]" class="bsc-color-label" value="<?php if ( isset( $color_array['primary-color-label'] ) ) { echo esc_html( $color_array['primary-color-label'], 'bsc-brand-colors'); } ?>" placeholder="Name this color" />
	                </label>
					<br>
					<label for="bsc_brand_colors-second-color">
						<input type="text" id="bsc_brand_colors-second-color" name="bsc_brand_colors[second-color]" class="bsc-color-picker color-field" value="<?php if ( isset( $color_array['second-color'] ) ) { echo esc_html( $color_array['second-color'], 'bsc-brand-colors' ); } ?>" />
						<span class="label-text"><?php esc_attr_e( 'Second brand color', 'bsc-brand-colors' ); ?></span>
					</label>
					<br>
					<label for="bsc_brand_colors-third-color">
						<input type="text" id="bsc_brand_colors-third-color" name="bsc_brand_colors[third-color]" class="bsc-color-picker color-field" value="<?php if ( isset( $color_array['third-color'] ) ) { echo esc_html( $color_array['third-color'], 'bsc-brand-colors' ); } ?>" />
						<span class="label-text"><?php esc_attr_e( 'Third brand color', 'bsc-brand-colors' ); ?></span>
					</label>
	            </fieldset>

	        <?php submit_button( 'Save brand colors', 'primary','submit', true ); ?>

	    </form>

	</div>
	<?php

	return ob_get_clean();

}

/**
 * Display the admin page
 *
 */
function bsc_bc_display_admin_page() {

	echo bsc_bc_setup_admin_page();

}

/**
 * Declare the TinyMCE button
 *
 */
 function bsc_bc_add_tinymce_button() {
	 global $typenow;

	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
	 	return;
	}

	// verify the post type
	if ( ! in_array( $typenow, array( 'post', 'page' ), true ) ) {
		 return;
	}

	// check if WYSIWYG is enabled
	if ( get_user_option( 'rich_editing' ) !== 'true' ) {
		return;
	}

	// Set up some filters.
	add_filter( 'mce_buttons', 'bsc_bc_register_tinymce_button' );
	add_filter( 'mce_external_plugins', 'bsc_bc_add_tinymce_plugin' );
}
add_action( 'admin_head', 'bsc_bc_add_tinymce_button' );


/**
 * Adds a TinyMCE plugin compatible JS file to the TinyMCE / Visual Editor instance
 *
 * @param array $plugin_array Array of registered TinyMCE Plugins.
 * @return array Modified array of registered TinyMCE Plugins
 */
function bsc_bc_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['bsc_bc_tinymce_button'] = PLUGIN_URL . '/admin/js/bsc-brand-colors-tinymce-buttons.js';

	return $plugin_array;
}


/**
 * Adds a button to the TinyMCE / Visual Editor for our brand colors selection
 *
 * @param array $buttons Array of registered TinyMCE Buttons.
 * @return array Modified array of registered TinyMCE Buttons
 */
function bsc_bc_register_tinymce_button( $buttons ) {
	array_push( $buttons, 'bsc_bc_tinymce_button' );
	return $buttons;
}


/**
 * Add styles to the admin head for button menu
 *
 */
function bsc_bc_add_header_styles() {

	$colors = get_option('bsc_brand_colors');

	ob_start(); ?>
	<style id="bsc-bc-button-styles">

		.mce-container .mce-bc-button-first span {
			color: <?php echo $colors['primary-color']; ?>;
		}

		.mce-container.mce-menu .mce-bc-button-first:hover {
			background: <?php echo $colors['primary-color']; ?>;
		}

		.mce-container .mce-bc-button-second span {
			color: <?php echo $colors['second-color']; ?>;
		}

		.mce-container.mce-menu .mce-bc-button-second:hover {
			background: <?php echo $colors['second-color']; ?>;
		}

		.mce-container .mce-bc-button-third span {
			color: <?php echo $colors['third-color']; ?>;
		}

		.mce-container.mce-menu .mce-bc-button-third:hover {
			background: <?php echo $colors['third-color']; ?>;
		}

	</style>

	<?php

}
add_action( 'admin_head', 'bsc_bc_add_header_styles' );

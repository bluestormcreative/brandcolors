<?php
/**
 *
 * @link              https://bluestormcreative.com
 * @since             1.0.0
 * @package           Bsc_Brand_Colors
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Branded Text Colors
 * Plugin URI:        https://github.com/bluestormcreative/brandcolors
 * Description:       Set specific, branded colors to wrap text with in the editor.
 * Version:           1.0.3
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


/*
* Define the plugin path.
*
*/
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/**
 * Enqueue our scripts and styles.
 *
 */
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
add_action( 'admin_enqueue_scripts', 'bsc_bc_add_scripts' );


/*
* Set up plugin menu page under Appearance top-level menu
*
*/
function bsc_bc_setup_menu() {

	add_submenu_page( 'themes.php', 'Simple Branded Text Colors', 'Set Text Colors', 'manage_options', 'bsc_brand_colors', 'bsc_bc_display_admin_page' );
}
add_action( 'admin_menu', 'bsc_bc_setup_menu' );


/*
* Add action link to plugin settings page
*
*/
function bsc_bc_add_action_links( $links ) {

	$action_link = '<a href="themes.php?page=bsc_brand_colors">' . esc_html( 'Set branded text colors', 'bsc-brand-colors' ) . '</a>';

	// Add to the end of default action links.
	array_push( $links, apply_filters( 'bsc_bc_hide_action_links', $action_link ) );

	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'bsc_bc_add_action_links', 10, 2 );


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

		<div class="description"><p><?php echo esc_html( 'Set up your global brand colors here. These colors will be easily available to use with text on any post or page.', 'bsc_brand_colors' ); ?></div>

		<form method="post" action="options.php" name="brand-colors" class="set-colors-form">

			<?php
			settings_fields( 'bsc_brand_colors' );
			do_settings_sections( 'bsc_brand_colors' );

			$color_array = get_option( 'bsc_brand_colors' );
			?>

				<!-- Our color picker fields -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php esc_html_e( 'Add a Primary brand color', 'bsc-brand-colors' ); ?></span></legend>
					<label for="bsc_brand_colors-primary-color">
						<input type="text" id="bsc_brand_colors-primary-color" name="bsc_brand_colors[primary-color]" class="bsc-color-picker color-field" value="<?php if ( isset( $color_array['primary-color'] ) ) { echo esc_html( $color_array['primary-color'], 'bsc-brand-colors' ); } ?>" />

						<input type="text" id="bsc_brand_colors-primary-color-label" size="25" name="bsc_brand_colors[primary-label]" class="bsc-color-label" value="<?php if ( isset( $color_array['primary-label'] ) ) { echo esc_html( $color_array['primary-label'], 'bsc-brand-colors' ); } ?>" placeholder="Name this color" />
					</label>
					<br>
					<label for="bsc_brand_colors-second-color">
						<input type="text" id="bsc_brand_colors-second-color" name="bsc_brand_colors[second-color]" class="bsc-color-picker color-field" value="<?php if ( isset( $color_array['second-color'] ) ) { echo esc_html( $color_array['second-color'], 'bsc-brand-colors' ); } ?>" />

						<input type="text" id="bsc_brand_colors-second-color-label" size="25" name="bsc_brand_colors[second-label]" class="bsc-color-label" value="<?php if ( isset( $color_array['second-label'] ) ) { echo esc_html( $color_array['second-label'], 'bsc-brand-colors' ); } ?>" placeholder="Name this color" />
					</label>
					<br>
					<label for="bsc_brand_colors-third-color">
						<input type="text" id="bsc_brand_colors-third-color" name="bsc_brand_colors[third-color]" class="bsc-color-picker color-field" value="<?php if ( isset( $color_array['third-color'] ) ) { echo esc_html( $color_array['third-color'], 'bsc-brand-colors' ); } ?>" />

						<input type="text" id="bsc_brand_colors-third-color-label" size="25" name="bsc_brand_colors[third-label]" class="bsc-color-label" value="<?php if ( isset( $color_array['third-label'] ) ) { echo esc_html( $color_array['third-label'], 'bsc-brand-colors' ); } ?>" placeholder="Name this color" />
					</label>
				</fieldset>

			<?php submit_button( 'Save brand colors', 'primary', 'submit', true ); ?>

		</form>

	</div>
	<?php

	return apply_filters( 'bsc_bc_hide_admin', ob_get_clean() );

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

	// Check user permissions.
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		 return;
	}

	// Verify the post type.
	if ( ! in_array( $typenow, array( 'post', 'page' ), true ) ) {
		 return;
	}

	// Check if WYSIWYG is enabled.
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

	$colors = get_option( 'bsc_brand_colors' );

	?>
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
		.mce-container.mce-menu .mce-bc-button-clear:hover {
			background: #000000;
		}


	</style>
	<?php
}
add_action( 'admin_head', 'bsc_bc_add_header_styles' );


/**
 * Hide admin page and action links
 *
 * Adding this function to the functions.php file of the theme will hide the text colors admin area from users.
 *
 * @author Shannon MacMillan
 */
function bsc_bc_hide_controls() {

	// Hide the admin page and show a "no permission" notice instead.
	add_filter( 'bsc_bc_hide_admin', 'bsc_bc_admin_notice' );

	// Hide the 'Set Text Colors' action link from the plugin admin table.
	add_filter( 'bsc_bc_hide_action_links', '__return_false' );

	// Remove the submenu item under Appearance.
	add_action( 'admin_init', 'bsc_bc_remove_menu_item' );

}


/**
 * Show a 'sorry' notice if the admin is accidentally accessed.
 *
 * @return string $notice Message string.
 *
 * @author Shannon MacMillan
 */
function bsc_bc_admin_notice() {

	$notice = '<div style="margin-top: 50px;">' . esc_html( 'Sorry, you do not have permission to set text colors.', 'bsc-brand-colors' ) . ' </div>';

	return $notice;
}


/**
 * Hide the admin menu.
 *
 * @author Shannon MacMillan
 */
function bsc_bc_remove_menu_item() {

	remove_submenu_page( 'themes.php', 'bsc_brand_colors' );
}

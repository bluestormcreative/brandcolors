<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bluestormcreative.com
 * @since      1.0.0
 *
 * @package    Bsc_Brand_Colors
 * @subpackage Bsc_Brand_Colors/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bsc_Brand_Colors
 * @subpackage Bsc_Brand_Colors/admin
 * @author     Blue Storm Creative <shannon@bluestormcreative.com>
 */

class Bsc_Brand_Colors_Admin {


	/**
	 * Get our saved options.
	 *
	 */
	public $options;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function bsc_enqueue_styles() {

		// Add color picker styles.
		wp_enqueue_style( 'wp-color-picker' );

		// Add our admin styles.
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bsc-brand-colors-admin.css', array(), $this->version, 'all' );

	}


	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function bsc_enqueue_scripts() {

		// Add our admin js with jQuery and wp-color-picker dependencies.
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bsc-brand-colors-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function bsc_add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
	    add_submenu_page( 'themes.php', 'Brand Colors', 'Set Brand Colors', 'manage_options', $this->plugin_name, array($this, 'bsc_display_plugin_setup_page')
	    );
	}


	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function bsc_add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'themes.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function bsc_display_plugin_setup_page() {
	    include_once( 'partials/bsc-brand-colors-admin-display.php' );
	}

	/**
	 * Add the save/update function for our options.
	 *
	 * @since    1.0.0
	 */

	public function bsc_options_update() {
	   register_setting( $this->plugin_name, $this->plugin_name, array( $this, 'bsc_validate') );
	}

	/**
	 * Validate our form input fields.
	 *
	 * @since    1.0.0
	 */

	public function bsc_validate( $fields ) {

		// Setup our return array for all form inputs.
		$valid = array();

		// Cleanup each form input.
		$primaryColor = trim( $fields['bsc-brand-colors-primary-color'] );
		$primaryColor = strip_tags( stripslashes( $primaryColor ) );

		 // Check if is a valid hex color.
		 if ( FALSE === $this->bsc_check_color( $primaryColor ) ) {

			 // Set the error message
			 add_settings_error( 'bsc_settings_options', 'bsc_color_error', 'Insert a valid #HEX color i.e. #ffffff', 'error' ); // $setting, $code, $message, $type

			 // Get the previous valid value
			 $valid_fields['bsc-brand-colors-primary-color'] = $this->options['bsc-brand-colors-primary-color'];

		 } else {

			 $valid_fields['bsc-brand-colors-primary-color'] = $primaryColor;

		 }

		return $valid;
	 }

	 /**
	 * Function that will check if value is a valid HEX color.
	 */
	public function bsc_check_color( $value ) {

		if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #
    	return true;
	}

		return false;
	}

} // end class Bsc_Brand_colors

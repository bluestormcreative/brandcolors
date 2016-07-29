<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://bluestormcreative.com
 * @since      1.0.0
 *
 * @package    Bsc_Brand_Colors
 * @subpackage Bsc_Brand_Colors/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bsc_Brand_Colors
 * @subpackage Bsc_Brand_Colors/includes
 * @author     Blue Storm Creative <shannon@bluestormcreative.com>
 */
class Bsc_Brand_Colors_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bsc-brand-colors',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

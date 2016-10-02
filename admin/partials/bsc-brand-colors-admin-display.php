<?php

/**
 * Create the Brand Colors settings admin page
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://bluestormcreative.com
 * @since      1.0.0
 *
 * @package    Bsc_Brand_Colors
 * @subpackage Bsc_Brand_Colors/admin/partials
 */
?>

<!-- The markup for our admin setting page. This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap brand-colors-admin-page">

    <h2 class="admin-page-title"><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <p class="admin-description">Set the brand colors that this site can use in the text editor. Colors will be available from an editor button to wrap any text, without the need to use a colorpicker.</p>

    <form method="post" name="brand_colors" class="set-colors-form" action="options.php">

        <?php
            //Grab all options
            $options = get_option( $this->plugin_name );

            // Color picker.
            if ( isset( $options['bsc-brand-colors-primary-color'] ) ) {
                $primaryColor = $options['bsc-brand-colors-primary-color'];
            } else {
                $primaryColor = '';
            }

            if ( isset( $options['bsc-brand-colors-secondary-color'] ) ) {
                $secondaryColor = $options['bsc-brand-colors-secondary-color'];
            } else {
                $secondaryColor = '';
            }

            // Add nonce, option_page, action, and http_referrer fields as hidden fields.
            // Reference here: https://codex.wordpress.org/Function_Reference/settings_fields
            settings_fields( $this->plugin_name ); ?>

            <!-- Our color picker fields -->
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e('Add a Primary brand color', $this->plugin_name); ?></span></legend>
                <label for="<?php echo $this->plugin_name; ?>-primary-color">
                    <input type="text" id="<?php echo $this->plugin_name;?>-primary-color" name="<?php echo $this->plugin_name; ?> primary color" class="bsc-color-picker color-field" value="<?php if ( $primaryColor != '' ) { echo $primaryColor; } ?>" />
                    <span><?php esc_attr_e('Primary brand color', $this->plugin_name); ?></span>
                </label>
            </fieldset>

            <fieldset>
                <legend class="screen-reader-text"><span><?php _e('Add a Secondary brand color', $this->plugin_name); ?></span></legend>
                <label for="<?php echo $this->plugin_name; ?>-secondary-color">
                    <input type="text" id="<?php echo $this->plugin_name;?>-secondary-color" name="<?php echo $this->plugin_name; ?> primary color" class="bsc-color-picker color-field" value="<?php if ( $secondaryColor != '' ) { echo $secondaryColor; } ?>" />
                    <span><?php esc_attr_e('Secondary brand color', $this->plugin_name); ?></span>
                </label>
            </fieldset>

        <?php submit_button( 'Save all changes', 'primary','submit', TRUE ); ?>

    </form>

</div>

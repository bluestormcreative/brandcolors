<?php

/**
 * Provide a admin area view for the plugin
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

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="brand_colors" action="options.php">

        <!-- add color slug class to body class -->
        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Add a Primary brand color', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-primary-color">
                <input type="text" id="<?php echo $this->plugin_name;?>-primary-color" name="<?php echo $this->plugin_name; ?> primary color" class="bsc-color-picker color-field" value="" />
                <span><?php esc_attr_e('Primary brand color', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>

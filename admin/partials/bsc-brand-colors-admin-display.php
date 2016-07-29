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
            <legend class="screen-reader-text"><span><?php _e('Add Post, page or product slug to body class', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-body_class_slug">
                <input type="checkbox" id="<?php echo $this->plugin_name;?>-body_class_slug" name="<?php echo $this->plugin_name; ?>[body_class_slug]" value="1" />
                <span><?php esc_attr_e('Add Post slug to body class', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>

<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://bramonmeteor.org
 * @since      1.0.0
 *
 * @package    Wp_Bramon
 * @subpackage Wp_Bramon/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2><?php echo _e('Configurações do Plugin BRAMON') ?></h2>

    <!--NEED THE settings_errors below so that the errors/success messages are shown after submission - wasn't working once we started using add_menu_page and stopped using add_options_page so needed this-->
    <?php settings_errors(); ?>

    <form method="POST" action="options.php">
        <?php
        settings_fields( 'bramon-api-key-group' );

        echo '
        <label for="bramon_api_key" style="display: block">
            <span>' . _e('Chave de API') . '</span>
            
            <input name="bramon_api_key" id="bramon_api_key" type="text" value="' . get_option( 'bramon_api_key' ) . '" size="40">
        </label>
        ';

        settings_fields( 'bramon-api-pagination-limit-group' );


        echo '
        <label for="bramon_api_pagination_limit" style="display: block">
            <span>' . _e('Limite da listagem') . '</span>
            
            <input name="bramon_api_pagination_limit" id="bramon_api_pagination_limit" type="text" value="' . get_option( 'bramon_api_pagination_limit' ) . '" size="2">
        </label>
        ';

        do_settings_sections( 'bramon_api_key' );
        do_settings_sections( 'bramon_api_pagination_limit' );
        ?>
        <?php submit_button(); ?>
    </form>
</div>
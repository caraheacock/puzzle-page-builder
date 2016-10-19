<?php

/*
 * Puzzle Page Builder
 * Settings
 */

/* Save custom CSS using user-defined colors */
function ppb_save_custom_style() {
    ob_start();
    require(PPB_PLUGIN_DIR . '/includes/miscellaneous/custom_style.php');
    $css = ob_get_clean();
    
    global $wp_filesystem;
    
    if (empty($wp_filesystem)) {
        require_once(ABSPATH .'/wp-admin/includes/file.php');
        WP_Filesystem();
    }
    
    if (!$wp_filesystem->put_contents(PPB_PLUGIN_DIR . '/assets/css/custom.css', $css)) {
        return true;
    }
}

/* Checks if the custom CSS exists. If it does not, create it. */
function ppb_check_if_custom_style_exists() {
    // if (!file_exists(PPB_PLUGIN_DIR . '/assets/css/custom.css')) {
        ppb_save_custom_style();
    // }
}

?>

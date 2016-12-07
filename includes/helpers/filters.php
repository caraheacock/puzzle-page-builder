<?php

/*
 * Puzzle Page Builder
 * Filters
 */

if (!defined('ABSPATH')) exit;

/*
 * Add ppb_like_the_content filter
 *
 * Has the same actions as the_content but for times when running
 * the_content filter conflicts with plugins.
 * 
 * The only action this does not have is 'prepend_attachment' because
 * it causes attachment pages to show attachments in weird places.
 */
$actions = array('wptexturize', 'convert_smilies', 'convert_chars', 'wpautop', 'shortcode_unautop');
foreach ($actions as $action) {
    add_filter('ppb_like_the_content', $action);
}

?>

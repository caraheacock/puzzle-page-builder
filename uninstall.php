<?php

/*
 * Puzzle Page Builder
 * Uninstall
 */

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) exit();

delete_post_meta_by_key('_puzzle_page_sections');

?>

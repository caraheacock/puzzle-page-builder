<?php

/*
 * Puzzle Page Builder
 * Formatting helpers
 */

if (!defined('ABSPATH')) exit;

/*
 * Converts a hex value to rgb
 *
 * $hex - string, hex color, e.g. '#abc123'
 *
 * Returns a string of the color converted to rgb, with values separated by commas
 */
function ppb_hex2rgb($hex, $return_array = false) {
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    
    if ($return_array) {
        return $rgb;
    } else {
        return implode(', ', $rgb);
    }
}

/* Makes a string more human-readable */
function ppb_humanize($string) {
    /* Remove all special characters */
    $humanized = preg_replace('/[^\w\s\-]+/', '', $string);
    
    /* Remove whitespace from the beginning and end */
    $humanized = trim($humanized);
    
    /* Replace dashes, underscores, and run-on spaces with 1 space */
    $humanized = preg_replace('/[\s\_\-]+/', ' ', $humanized);
    
    return $humanized;
}

/*
 * Removes special characters and replaces spaces with dashes.
 *
 * $string - string to convert
 * $sep - string, separator, a dash by default
 *
 * Returns a string with the indicated separators
 */
function ppb_parameterize($string, $sep = '-'){
    /* Downcase */
    $slug = strtolower($string);
    
    /* Remove all special characters */
    $slug = preg_replace('/[^\w\s\-]+/', '', $slug);
    
    /* Remove whitespace from the beginning and end */
    $slug = trim($slug);
    
    /* Replace spaces, dashes, and underscores with the separator */
    $slug = preg_replace('/[\s\_\-]+/', $sep, $slug);
    
    return $slug;
}

?>

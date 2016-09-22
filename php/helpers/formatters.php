<?php

/*
 * Puzzle Page Builder
 * Formatting helpers
 */

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
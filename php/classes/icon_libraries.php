<?php

/*
 * Puzzle Page Builder
 * Icon Libraries Class
 */

class PuzzleIconLibraries {
    // Static variable: an array of icon libraries
    private static $Libraries = array();
    
    // Returns the icon libraries
    function libraries() {
        return self::$Libraries;
    }
    
    // Adds an icon library
    function add_library($new_library) {
        self::$Libraries[$new_library->name()] = $new_library;
        
        uasort(self::$Libraries, function($a, $b) {
            return strnatcmp($a->order(), $b->order());
        });
    }
    
    // Static variable: a string of the default icon in the page builder
    private static $DefaultIcon = 'fa fa-star';
    
    // Sets the default icon
    function set_default_icon($new_icon) {
        self::$DefaultIcon = $new_icon;
    }
    
    // Returns the default icon
    function default_icon() {
        return self::$DefaultIcon;
    }
    
    /* Returns the markup for the libraries */
    function markup() {
        $output = '';
        
        foreach (self::$Libraries as $library) {
            $output .= $library->markup();
        }
        
        return $output;
    }
}

?>
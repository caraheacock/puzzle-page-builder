<?php

/*
 * Puzzle Page Builder
 * Icon Libraries Class
 */

class PuzzleIconLibraries {
    /* Array: the icon libraries */
    private static $Libraries = array();
    function libraries() { return self::$Libraries; }
    
    /* Adds an icon library */
    function add_library($new_library) {
        self::$Libraries[$new_library->slug()] = $new_library;
        
        uasort(self::$Libraries, function($a, $b) {
            return strnatcmp($a->order(), $b->order());
        });
    }
    
    /* Returns an icon library by its slug */
    function library($slug) {
        return self::$Libraries[$slug];
    }
    
    /* Remove an icon library by its slug */
    function remove_library($slug) {
        if (array_key_exists($slug, self::$Libraries)) {
            unset(self::$Libraries[$slug]);
        }
    }
    
    /*
     * Remove multiple libraries by their keys
     * $slugs - array, a list of slugs of icon libraries to remove
     */
    function remove_libraries($slugs) {
        foreach ($slugs as $slug) {
            self::remove_library($slug);
        }
    }
    
    /* String: the default icon in the page builder */
    private static $DefaultIcon = 'ei ei-star-alt';
    function set_default_icon($new_icon) {
        self::$DefaultIcon = $new_icon;
    }
    function default_icon() { return self::$DefaultIcon; }
    
    /*
     * Boolean: indicating if a "no icon" choice is available in the
     * icon library.
     */
    private static $ChoiceNone = false;
    function set_choice_none($boolean) {
        self::$ChoiceNone = $boolean;
    }
    function has_choice_none() { return self::$ChoiceNone; }
    
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
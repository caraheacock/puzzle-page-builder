<?php

/*
 * Puzzle Page Builder
 * Colors Class
 */

if (!defined('ABSPATH')) exit;

class PuzzleColors {
    /* Static variable: array of PuzzleColor objects used for the theme */
    private static $ThemeColors;
    
    /* Adds a theme color */
    function add_theme_color($new_color) {
        self::$ThemeColors[$new_color->id()] = $new_color;
        
        uasort(self::$ThemeColors, function($a, $b) {
            return strnatcmp($a->order(), $b->order());
        });
    }
    
    /* Returns a theme color by its ID */
    function theme_color($id) {
        return self::$ThemeColors[$id];
    }
    
    /* Adds an array of theme colors */
    function add_theme_colors($new_colors) {
        foreach ($new_colors as $new_color) {
            self::$ThemeColors[$new_color->id()] = $new_color;
        }
    }
    
    /* Returns the theme colors */
    function theme_colors() { return self::$ThemeColors; }
    
    /* Returns the theme colors as key-value pairs for a dropdown */
    function theme_colors_for_dropdown() {
        $options = array();
        
        foreach(self::$ThemeColors as $id => $color) {
            $options[$id] = $color->name();
        }
        
        return $options;
    }
    
    /*
     * Sets all new theme colors, allowing the user to add more than 'primary',
     * 'secondary', 'white', 'black', etc., and removing any colors that are
     * not explicitly set.
     */
    function replace_theme_colors($new_theme_colors) {
        // Reset theme colors
        self::$ThemeColors = array();
        
        foreach($new_theme_colors as $new_theme_color) {
            self::add_theme_color($new_theme_color);
        }
    }
    
    /* Remove a theme color by its slug */
    function remove_theme_color($id) {
        if (array_key_exists($id, self::$ThemeColors)) {
            unset(self::$ThemeColors[$id]);
        }
    }
    
    /*
     * Remove multiple theme colors by their ids
     *
     * $ids - array, a list of ids of colors to remove
     */
    function remove_theme_colors($ids) {
        self::$ThemeColors = array_diff_key(self::$ThemeColors, array_flip($ids));
    }
    
    /*
     * Keeps only white-listed theme colors by their ids
     *
     * $ids - array, a white list of colors to keep
     */
    function keep_theme_colors($ids) {
        self::$ThemeColors = array_intersect_key(self::$ThemeColors, array_flip($ids));
    }
    
    /*
     * Array: list of text colors to use
     * These are different from the theme colors because they are just
     * key-value pairs and not PuzzleColor objects. The user can only update
     * existing values in this array; they cannot add or remove values.
     */
    private static $TextColors = array(
        'headline_dark'     => '#333',
        'text_dark'         => '#555',
        'headline_light'    => '#fff',
        'text_light'        => '#fff'
    );
    
    function set_text_color($id, $hex) {
        if (array_key_exists($id, self::$TextColors)) {
            self::$TextColors[$id] = $hex;
        }
    }
    
    function set_text_colors($new_text_colors) {
        foreach ($new_text_colors as $id => $hex) {
            self::set_text_color($id, $hex);
        }
    }
    
    function text_colors() { return self::$TextColors; }
    
    /*
     * Array: list of link colors to use
     * These are different from the theme colors because they are just
     * key-value pairs and not PuzzleColor objects. The user can only update
     * existing values in this array; they cannot add or remove values.
     */
    private static $LinkColors = array(
        'link_dark'         => '#3b54a5', // Default primary color
        'link_dark_hover'   => '#2cb799', // Default secondary color
        'link_light'        => '#fff',
        'link_light_hover'  => 'rgba(255, 255, 255, 0.75)'
    );
    
    function set_link_color($id, $hex) {
        if (array_key_exists($id, self::$LinkColors)) {
            self::$LinkColors[$id] = $hex;
        }
    }
    
    function set_link_colors($new_link_colors) {
        foreach ($new_link_colors as $id => $hex) {
            self::set_link_color($id, $hex);
        }
    }
    
    function link_colors() { return self::$LinkColors; }
}

?>

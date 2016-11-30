<?php

/*
 * Puzzle Page Builder
 * Colors Class
 */

class PuzzleColors {
    /* Static variable: array of PuzzleColor objects used for the theme */
    private static $ThemeColors = array('primary' => true, 'secondary' => true);
    
    /*
     * Adds a theme color. If $index is specified, the new color will be
     * inserted into that place in the array, else the new color will be added
     * to the end of the array.
     *
     * Colors cannot be inserted before the primary and secondary colors.
     */
    function add_theme_color($new_color, $index = false) {
        if (is_int($index) && $index < count(self::$ThemeColors)) {
            if ($index < 2) $index = 2;
            
            $array_start = array_slice(self::$ThemeColors, 0, $index);
            $array_end = array_slice(self::$ThemeColors, $index);
            self::$ThemeColors = array_merge($array_start, array($new_color), $array_end);
        } else {
            self::$ThemeColors[$new_color->id()] = $new_color;
        }
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
    
    /*
     * Sets an existing theme color
     *
     * $id - string, the ID of the color
     * $new_color - string, the hex value of the color
     */
    function set_theme_color($id, $new_color) {
        if (array_key_exists($id, self::$ThemeColors)) {
            self::$ThemeColors[$new_id]->set_color($new_color);
        }
    }
    
    /*
     * Sets existing theme colors
     *
     * $new_theme_colors - array where keys are the color ID and values are the
     *   updated hex color
     */
    function set_theme_colors($new_theme_colors) {
        foreach ($new_theme_colors as $id => $new_color) {
            self::set_theme_color($id, $new_color);
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
     * not explicitly set. The primary and secondary colors cannot be removed.
     */
    function replace_theme_colors($new_theme_colors) {
        // Retain primary and secondary colors
        self::$ThemeColors = array_intersect_key(self::$ThemeColors, array_flip(array('primary', 'secondary')));
        
        foreach($new_theme_colors as $new_theme_color) {
            self::add_theme_color($new_theme_color);
        }
    }
    
    /*
     * Remove a theme color by its slug
     * The primary and secondary colors cannot be removed.
     */
    function remove_theme_color($id) {
        if ($id == 'primary' || $id == 'secondary') return false;
        
        if (array_key_exists($id, self::$ThemeColors)) {
            unset(self::$ThemeColors[$id]);
        }
    }
    
    /*
     * Remove multiple theme colors by their ids
     * The primary and secondary colors cannot be removed.
     *
     * $ids - array, a list of ids of colors to remove
     */
    function remove_theme_colors($ids) {
        $ids = array_diff($ids, array('primary', 'secondary'));
        self::$ThemeColors = array_diff_key(self::$ThemeColors, array_flip($ids));
    }
    
    /*
     * Keeps only white-listed theme colors by their ids
     * The primary and secondary colors cannot be removed.
     *
     * $ids - array, a white list of colors to keep
     */
    function keep_theme_colors($ids) {
        $ids = array_merge(array('primary', 'secondary'), $ids);
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

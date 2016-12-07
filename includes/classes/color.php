<?php

/*
 * Puzzle Page Builder
 * Color Class
 */

if (!defined('ABSPATH')) exit;

class PuzzleColor {
    /*
     * String: the slug of the color
     * e.g. 'primary'
     */
    private $id;
    function set_id($new_id) {
        $this->id = $new_id;
        return $this;
    }
    function id() { return $this->id; }
    
    /*
     * String: the user-friendly name of the color, used on the plugin
     * customization page and options in the page builder.
     * e.g. 'Primary Color', 'Blue', etc.
     */
    private $name;
    function set_name($new_name) {
        $this->name = $new_name;
        return $this;
    }
    function name() { return $this->name; }
    
    /*
     * String: the color in hexadecimal
     * e.g. '#314887'
     */
    private $color;
    function set_color($new_color) {
        $this->color = $new_color;
        return $this;
    }
    function color() { return $this->color; }
    
    /*
     * String: the text color scheme for text displayed on top of this color
     */
    private $text_color_scheme = 'dark';
    private function valid_text_color_schemes() { return array('dark', 'light'); }
    
    function set_text_color_scheme($new_text_color_scheme) {
        if (!in_array($new_text_color_scheme, $this->valid_text_color_schemes())) return false;
        $this->text_color_scheme = $new_text_color_scheme;
        return $this;
    }
    function text_color_scheme() { return $this->text_color_scheme; }
}

?>

<?php

/*
 * Puzzle Page Builder
 * Icon Library Class
 */

if (!defined('ABSPATH')) exit;

class PuzzleIconLibrary {
    /*
     * String: the name of the icon library
     * e.g. 'Font Awesome'
     */
    private $name;
    function set_name($new_name) {
        $this->name = $new_name;
        return $this;
    }
    function name() { return $this->name; }
    
    /*
     * Returns a slug of the section name, for referencing the icon library in
     * an instance of PuzzleIconLibraries.
     * e.g. 'font-awesome'
     */
    function slug() { return ppb_parameterize($this->name); }
    
    /*
     * Array: a list of all icons in the library
     * e.g. array('500px', 'adjust', 'adn', 'align-center', ...)
     */
    private $icons;
    function set_icons($new_icons) {
        $this->icons = $new_icons;
        return $this;
    }
    function icons() { return $icons; }
    
    /*
     * String: the name of the example icon
     * e.g. 'star'
     * Default is the first icon in the library.
     */
    private $example_icon;
    function set_example_icon($new_example_icon) {
        $this->example_icon = $new_example_icon;
        return $this;
    }
    function example_icon() { return $example_icon; }
    
    /*
     * String: the icon CSS class
     * e.g. 'fa'
     */
    private $icon_class;
    function set_icon_class($new_icon_class) {
        $this->icon_class = $new_icon_class;
        return $this;
    }
    function icon_class() { return $icon_class; }
    
    /*
     * String: the icon CSS prefix
     * e.g. 'fa-'
     */
    private $prefix;
    function set_prefix($new_prefix) {
        $this->prefix = $new_prefix;
        return $this;
    }
    function prefix() { return $prefix; }
    
    /*
     * String: the icon CSS postfix
     * e.g. '-icon'
     */
    private $postfix;
    function set_postfix($new_postfix) {
        $this->postfix = $new_postfix;
        return $this;
    }
    function postfix() { return $postfix; }
    
    /*
     * Integer: the order in which this library will appear in the page builder
     * relative to other libraries
     */
    private $order = 100;
    function set_order($new_order) {
        $this->order = $new_order;
        return $this;
    }
    function order() { return $this->order; }
    
    /*
     * Returns the full string for the icon's class, including the general
     * icon class, prefix, icon name, and postfix.
     * e.g. 'fa fa-star'
     */
    function full_icon_class($icon) {
        $output = '';
        if (isset($this->icon_class)) $output .= $this->icon_class . ' ';
        if (isset($this->prefix)) $output .= $this->prefix;
        $output .= $icon;
        if (isset($this->postfix)) $output .= $this->postfix;
        
        return $output;
    }
    
    /* Returns the markup for the icon library */
    function markup() {
        $output = '<hr />';
        $output .= '<h3><i class="' . $this->full_icon_class($this->example_icon) . '"></i> ' . $this->name . '</h3>';
        $output .= '<div class="puzzle-icon-choices-container">';
        
        foreach ($this->icons as $icon) {
            $output .= '<button class="puzzle-icon-choice"><i class="' . $this->full_icon_class($icon) . '"></i>' . ppb_humanize($icon) . '</button>';
        }
        
        $output .= '</div>';
        
        return $output;
    }
}

?>

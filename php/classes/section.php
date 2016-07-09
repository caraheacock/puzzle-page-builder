<?php

/*
 * Puzzle Page Builder
 * Section Class
 */

class PuzzleSection {
    /*
     * String: the user-friendly name of the section
     * e.g. 'Team Members'
     */
    private $name;
    function set_name($new_name) {
        $this->name = $new_name;
        return $this;
    }
    function name() { return $this->name; }
    
    /* Returns a CSS-friendly slug of the section name */
    function slug() { return ppb_to_slug($this->name); }
    
    /*
     * String: the user-friendly name of a single column in the section
     * e.g. 'Team Member'
     */
    private $single_name;
    function set_single_name($new_single_name) {
        $this->single_name = $new_single_name;
        return $this;
    }
    function get_single_name() { return $this->single_name; }
    
    /* Boolean: whether or not the section has a dynamic number of sub-sections */
    private $multiple = false;
    function set_multiple($new_multiple) {
        $this->multiple = $new_multiple;
        return $this;
    }
    function has_multiple() { return $this->multiple; }
    
    /*
     * Integer: the fixed number of columns
     * This property is only used for sections where has_multiple returns false.
     */
    private $fixed_column_num = null;
    function set_fixed_column_num($new_fixed_column_num) {
        $this->fixed_column_num = $new_fixed_column_num;
        return $this;
    }
    function get_fixed_column_num() { return $this->fixed_column_num; }
    
    /* String: the width of the columns in the admin view */
    private $admin_column_classes;
    function set_admin_column_classes($new_admin_column_classes) {
        $this->admin_column_classes = $new_admin_column_classes;
        return $this;
    }
    function get_admin_column_classes() { return $this->admin_column_classes; }
    
    /*
     * Integer: the order in which this section will appear in the page builder
     * relative to other sections
     */
    private $order = 0;
    function set_order($new_order) {
        $this->order = $new_order;
        return $this;
    }
    function get_order() { return $this->order; }
    
    /*
     * Array: PuzzleField objects, needed for admin column fields and
     * front-end markup
     */
    private $column_fields;
    function set_column_fields($new_column_fields) {
        foreach ($new_column_fields as $field) {
            $this->column_fields[$field->id()] = $field;
        }
        return $this;
    }
    function column_fields() { return $this->column_fields; }
    
    /*
     * Array: PuzzleField objects for the section fields. Setting this variable
     * is optional. Use if a section needs more options.
     */
    private $section_fields;
    function set_section_fields($new_section_fields) {
        foreach ($new_section_fields as $field) {
            $this->section_fields[$field->id()] = $field;
        }
        return $this;
    }
    function section_fields() { return $this->section_fields; }
}

?>

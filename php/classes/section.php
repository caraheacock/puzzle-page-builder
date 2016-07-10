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
    function single_name() { return $this->single_name; }
    
    /*
     * Integer: the number of columns
     * Set to -1 to allow the user to add unlimited columns.
     */
    private $columns_num = null;
    function set_columns_num($new_columns_num) {
        $this->columns_num = $new_columns_num;
        return $this;
    }
    function columns_num() { return $this->columns_num; }
    
    /* Returns a boolean indicating if the user can add unlimited columns */
    function unlimited_columns() { return $this->columns_num < 0; }
    
    /* String: the width of the columns in the admin view */
    private $admin_column_classes;
    function set_admin_column_classes($new_admin_column_classes) {
        $this->admin_column_classes = $new_admin_column_classes;
        return $this;
    }
    function admin_column_classes() { return $this->admin_column_classes; }
    
    /*
     * Integer: the order in which this section will appear in the page builder
     * relative to other sections
     */
    private $order = 0;
    function set_order($new_order) {
        $this->order = $new_order;
        return $this;
    }
    function order() { return $this->order; }
    
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
     * Array: PuzzleField objects for the option fields. Setting this variable
     * is optional. Use if a section needs general options, such as a headline,
     * main content, top and bottom padding, etc.
     */
    private $option_fields;
    function set_option_fields($new_option_fields) {
        foreach ($new_option_fields as $field) {
            $this->option_fields[$field->id()] = $field;
        }
        return $this;
    }
    function option_fields() { return $this->option_fields; }
}

?>

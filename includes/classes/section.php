<?php

/*
 * Puzzle Page Builder
 * Section Class
 */

if (!defined('ABSPATH')) exit;

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
    
    /*
     * Returns a CSS-friendly slug of the section name
     * e.g. 'team-members'
     */
    function slug() { return ppb_parameterize($this->name); }
    
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
    function has_unlimited_columns() { return $this->columns_num < 0; }
    
    /*
     * Integer: the width of the columns in the page builder, in the context of
     * a 12 column grid
     */
    private $admin_column_width = 12;
    function set_admin_column_width($new_admin_column_width) {
        if (!in_array($new_admin_column_width, array(3, 4, 6, 12))) {
            trigger_error('Invalid value "' . $new_admin_column_width . '" used for "admin_column_width".');
        } else {
            $this->admin_column_width = $new_admin_column_width;
        }
        return $this;
    }
    function admin_column_width() { return $this->admin_column_width; }
    
    /* Returns a string of classes for the columns in the page builder */
    function admin_column_classes() {
        $output = 'pz-xs-12';
        
        switch ($this->admin_column_width) {
            case 3:
                $output .= ' pz-sm-3 pz-md-6 pz-lg-3';
                break;
            case 4:
                $output .= ' pz-sm-4 pz-md-6 pz-lg-4';
                break;
            case 6:
                $output .= ' pz-sm-6';
                break;
        }
        
        return $output;
    }
    
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
     * Add a PuzzleField. If $index is specified, the new PuzzleField will be
     * inserted into that place in the array, else the new field will be added
     * to the end of the array.
     *
     * $new_field - the new PuzzleField object to add to the array
     * $fields - array of PuzzleField objects
     * $index - integer, where to insert the new field, can be omitted
     *
     * Returns the modified $fields array
     */
    private function add_field($new_field, $fields, $index = false) {
        if (is_int($index) && $index < count($fields)) {
            $array_start = array_slice($fields, 0, $index);
            $array_end = array_slice($fields, $index);
            $fields = array_merge($array_start, array($new_field->id() => $new_field), $array_end);
        } else {
            $fields[$new_field->id()] = $new_field;
        }
        
        return $fields;
    }
    
    /*
     * Array: PuzzleField objects, needed for admin column fields and
     * front-end markup
     */
    private $column_fields = array();
    
    function set_column_fields($new_column_fields) {
        /* Reset the column fields */
        $this->column_fields = array();
        
        /* Set the new column fields */
        foreach ($new_column_fields as $field) {
            $this->column_fields[$field->id()] = $field;
        }
        
        return $this;
    }
    
    function column_fields() { return $this->column_fields; }
    
    /* Returns a column field by its ID */
    function column_field($id) {
        return $this->column_fields[$id];
    }
    
    /* Adds a column field */
    function add_column_field($new_column_field, $index = false) {
        $this->column_fields = self::add_field($new_column_field, $this->column_fields, $index);
        return $this;
    }
    
    /* Remove a column field by its ID */
    function remove_column_field($field_id) {
        if (array_key_exists($field_id, $this->column_fields)) {
            unset($this->column_fields[$field_id]);
        }
        return $this;
    }
    
    /*
     * Remove multiple column fields by their IDs
     * $field_ids - array, a list of IDs of fields to remove
     */
    function remove_column_fields($field_ids) {
        foreach ($field_ids as $field_id) {
            self::remove_column_field($field_id);
        }
        return $this;
    }
    
    /*
     * Array: PuzzleField objects for the option fields. Setting this variable
     * is optional. Use if a section needs general options, such as a headline,
     * main content, top and bottom padding, etc.
     */
    private $option_fields = array();
    
    function set_option_fields($new_option_fields) {
        /* Reset the option fields */
        $this->option_fields = array();
        
        /* Set the new option fields */
        foreach ($new_option_fields as $field) {
            $this->option_fields[$field->id()] = $field;
        }
        
        return $this;
    }
    
    function option_fields() { return $this->option_fields; }
    
    /* Returns an option field by its ID */
    function option_field($id) {
        return $this->option_fields[$id];
    }
    
    /* Adds an option field */
    function add_option_field($new_option_field, $index = false) {
        $this->option_fields = self::add_field($new_option_field, $this->option_fields, $index);
        return $this;
    }
    
    /* Remove an option field by its ID */
    function remove_option_field($field_id) {
        if (array_key_exists($field_id, $this->option_fields)) {
            unset($this->option_fields[$field_id]);
        }
        return $this;
    }
    
    /*
     * Remove multiple option fields by their IDs
     * $field_ids - array, a list of IDs of fields to remove
     */
    function remove_option_fields($field_ids) {
        foreach ($field_ids as $field_id) {
            self::remove_option_field($field_id);
        }
        return $this;
    }
}

?>

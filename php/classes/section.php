<?php

/*
 * Puzzle Page Builder
 * Section Class
 */

class PuzzleSection {
    // String: the user-friendly name of the section
    // e.g. 'Team Members'
    private $group_name;
    function set_group_name($new_group_name) {
        $this->group_name = $new_group_name;
        return $this;
    }
    function get_group_name() {
        return $this->group_name;
    }
    
    // String: the slug of the section name
    // Only needs to be CSS friendly, so it can have dashes, letters, numbers, and underscores.
    // e.g. 'team-members'
    private $group_name_slug;
    function set_group_name_slug($new_group_name_slug) {
        $this->group_name_slug = $new_group_name_slug;
        return $this;
    }
    function get_group_name_slug() {
        return $this->group_name_slug;
    }
    
    // String: the user-friendly name of a single column in the section
    // e.g. 'Team Member'
    private $single_name;
    function set_single_name($new_single_name) {
        $this->single_name = $new_single_name;
        return $this;
    }
    function get_single_name() {
        return $this->single_name;
    }
    
    // Boolean: whether or not the section has a dynamic number of sub-sections
    private $multiple = false;
    function set_multiple($new_multiple) {
        $this->multiple = $new_multiple;
        return $this;
    }
    function has_multiple() {
        return $this->multiple;
    }
    
    // Integer: the fixed number of columns
    // This property is only used for sections where has_multiple returns false.
    private $fixed_column_num = null;
    function set_fixed_column_num($new_fixed_column_num) {
        $this->fixed_column_num = $new_fixed_column_num;
        return $this;
    }
    function get_fixed_column_num() {
        return $this->fixed_column_num;
    }
    
    // String: the width of the columns in the admin view
    private $admin_column_classes;
    function set_admin_column_classes($new_admin_column_classes) {
        $this->admin_column_classes = $new_admin_column_classes;
        return $this;
    }
    function get_admin_column_classes() {
        return $this->admin_column_classes;
    }
    
    // Integer: the order in which this section will appear in the page builder
    //          relative to other sections
    private $order = 0;
    function set_order($new_order) {
        $this->order = $new_order;
        return $this;
    }
    function get_order() {
        return $this->order;
    }
    
    // Array: multidimensional array of the unique attributes of the section,
    //        needed for admin fields and front-end markup
    //
    // Available input types: text, textarea, checkbox, select, icon, image, and hidden.
    private $markup_attr;
    function set_markup_attr($new_markup_attr) {
        $this->markup_attr = $new_markup_attr;
        return $this;
    }
    function get_markup_attr() {
        return $this->markup_attr;
    }
    
    // Array: multidimensional array of the section options
    // Setting this variable is optional. Use if a section needs more options.
    //
    // Available input types: text, textarea, checkbox, select, icon, image, and hidden.
    private $options;
    function set_options($new_options) {
        $this->options = $new_options;
        return $this;
    }
    function get_options() {
        return $this->options;
    }
}

?>

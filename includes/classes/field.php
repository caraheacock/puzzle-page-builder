<?php

/*
 * Puzzle Page Builder
 * Field Class
 */

if (!defined('ABSPATH')) exit;

class PuzzleField {
    /*
     * String: the user-friendly name of the field
     * e.g. 'Button Text'
     */
    private $name;
    function set_name($new_name) {
        $this->name = $new_name;
        return $this;
    }
    function name() { return $this->name; }
    
    /*
     * String: the ID of the field, alphanumeric characters and underscores
     * only. The ID is how you will access the data later in the post_meta.
     * e.g. 'button_text'
     */
    private $id;
    function set_id($new_id) {
        $this->id = $new_id;
        return $this;
    }
    function id() { return $this->id; }
    
    /*
     * String: the type of field. Default is 'text'.
     */
    private $input_type = 'text';
    function set_input_type($new_input_type) {
        if (!in_array($new_input_type, self::$valid_input_types)) return false;
        $this->input_type = $new_input_type;
        return $this;
    }
    function input_type() { return $this->input_type; }
    
    /*
     * Not all HTML input types are supported by Puzzle Page Builder, and not
     * all Puzzle input types are necessarily HTML input types.
     */
    private static $valid_input_types = array(
        'checkbox',
        'color',    // Generates a color picker field
        'editor',   // Generates a textarea with a button to open the WordPress Editor
        'hidden',
        'icon',     // Prompts the user to choose an icon from the icon library
        'image',    // Generates an image thumbnail with buttons to select/remove the image
        'number',
        'select',
        'text',
        'textarea'
    );
    
    /* Integer: the width of the field, in the context of a 12 column grid */
    private $width = 12;
    function set_width($new_width) {
        if (!in_array($new_width, array(2, 3, 4, 6, 12))) {
            trigger_error('Invalid value "' . $save_as . '" used for "save_as".');
        } else {
            $this->width = $new_width;
        }
        return $this;
    }
    function width() { return $this->width; }
    
    /*
     * Array: options to be used for the 'select' field.
     * The key should be the option value, and the value should be the
     * human-readable text that will appear for the user in the dropdown.
     */
    private $options;
    function set_options($new_options) {
        $this->options = $new_options;
        return $this;
    }
    function options() { return $this->options; }
    
    /*
     * Add an option. If $index is specified, the new option will be inserted
     * into that place in the array, else the new option will be added to
     * the end of the options array.
     *
     * $option_key - string, the option's key, how it will be saved to
     *   the database
     * $option_value - string, the option's value, how it will be displayed in
     *   the select
     * $index - integer, where to insert the new option, can be omitted
     *
     * Returns the PuzzleField object
     */
    function add_option($option_key, $option_value, $index = false) {
        if (is_int($index) && $index < count($this->options)) {
            $array_start = array_slice($this->options, 0, $index);
            $array_end = array_slice($this->options, $index);
            $this->options = array_merge($array_start, array($option_key => $option_value), $array_end);
        } else {
            $this->options[$option_key] = $option_value;
        }
        
        return $this;
    }
    
    /* Remove an option by its key */
    function remove_option($option_key) {
        if (array_key_exists($option_key, $this->options)) {
            unset($this->options[$option_key]);
        }
        return $this;
    }
    
    /*
     * String: the option key to be preselected for 'select' fields.
     */
    private $selected;
    function set_selected($new_selected) {
        $this->selected = $new_selected;
        return $this;
    }
    function selected() { return $this->selected; }
    
    /*
     * String: placeholder text for 'text' and 'textarea' fields.
     */
    private $placeholder;
    function set_placeholder($new_placeholder) {
        $this->placeholder = $new_placeholder;
        return $this;
    }
    function placeholder() { return $this->placeholder; }
    
    /*
     * Integer: rows for 'textarea' fields.
     */
    private $rows;
    function set_rows($new_rows) {
        $this->rows = $new_rows;
        return $this;
    }
    function rows() { return $this->rows; }
    
    /*
     * String: the help tip for the field.
     * e.g. 'Here\'s some more instructions for this field.'
     */
    private $tip;
    function set_tip($new_tip) {
        $this->tip = $new_tip;
        return $this;
    }
    function tip() { return $this->tip; }
    
    /*
     * String: how to save the field to the post content
     */
    private $save_as;
    function set_save_as($new_save_as) {
        if (!in_array($new_save_as, self::$valid_save_as_values)) {
            trigger_error('Invalid value "' . $save_as . '" used for "save_as".');
        } else {
            $this->save_as = $new_save_as;
        }
        return $this;
    }
    function save_as() { return $this->save_as; }
    
    /*
     * Most of these values are HTML tags.
     *
     * 'content' is a special case, which means WordPress's 'the_content'
     * filter will be applied to the data. This is suitable for large bodies
     * of text/HTML.
     *
     * 'link' will use the data entered into the field for the href attribute
     * in an anchor tag, and will use the field's label for the link text, or
     * another field's data for the link text if the save_as_link_text
     * attribute is specified.
     */
    private static $valid_save_as_values = array(
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'content', 'link', null
    );
    
    /*
     * String: another field's ID. The data in the $save_as_link_text field
     * will be used  as the text in the anchor tag when saving this field to
     * the post content, if this field's $save_as is set to 'link'.
     *
     * For example, you might have two fields: 'button_text' and 'link'. If the
     * user enters 'Click Here' into the 'button_text' field and
     * 'http://google.com' into the 'link' field, and 'link' has set $save_as
     * to 'link' and 'save_as_link_text' to 'button_text', it will generate
     * HTML like this in the post content:
     * <a href="http://google.com">Click Here</a>
     */
    private $save_as_link_text;
    function set_save_as_link_text($new_save_as_link_text) {
        $this->save_as_link_text = $new_save_as_link_text;
        return $this;
    }
    function save_as_link_text() { return $this->save_as_link_text; }
}

?>

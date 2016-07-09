<?php

/*
 * Puzzle Page Builder
 * Page Builder Class
 */

class PuzzlePageBuilder {
    /*
     * Returns the markup for fields
     *
     * $array - array that the field is being saved to
     * $attrs - array, the fields to loop through
     * $input_name_prefix - string, the prefix for the name attribute in the
     * input field
     */
    private function fields_markup($array, $attrs, $input_name_prefix) {
        $puzzle_icon_libraries = new PuzzleIconLibraries;
        $output = '';
            
        foreach($attrs as $key => $attr) {
            $input_name = $input_name_prefix . '[' . $key . ']';
            $input_width = (isset($attr['width']) ? $attr['width'] : 'xs-span12');
            
            $tip = '';
            if (!empty($attr['tip'])) {
                $tip = '<i class="puzzle-field-tip-button fa fa-question-circle"></i><span class="puzzle-field-tip-content"><span>' . $attr['tip'] . '</span></span>';
            }
            
            $output .= '<div class="column ' . $input_width . ($attr['input_type'] == 'icon' ? ' puzzle-icon-preview' : '') . '">';
            
            if (!isset($array[$key])) {
                $array[$key] = '';
            }
            
            switch ($attr['input_type']) {
                case 'textarea':
                    $output .= $attr['name'] . $tip;
                    $output .= '<textarea name="' . $input_name . '" rows="' . (!empty($attr['rows']) ? $attr['rows'] : '5') . '">' . $array[$key] . '</textarea><br />';
                    $output .= '<a class="button open-editor-button" href="#">Open Editor</a>';
                    break;
                case 'checkbox':
                    $output .= '<input type="checkbox" name="' . $input_name . '" id="' . $input_name . '"' . (!empty($array[$key]) ? ' checked' : '') . '><label for="' . $input_name . '">' . $attr['name'] . '</label>' . $tip;
                    break;
                case 'select':
                    $output .= $attr['name'] . $tip;
                    $output .= '<select name="' . $input_name . '">';
                    foreach ($attr['options'] as $option_key => $option) {
                        $output .= '<option value="' . $option . '"' . ($array[$key] == $option || (empty($array[$key]) && !empty($attr['selected']) && $attr['selected'] == $option) ? ' selected' : '') . '>' . $option_key . '</option>';
                    }
                    $output .= '</select>';
                    break;
                case 'icon':
                    $icon_value = (!empty($array[$key]) ? $array[$key] : $puzzle_icon_libraries->default_icon());
            
                    $output .= $attr['name'] . $tip;
                    $output .= '<i class="' . $icon_value . '"></i>';
                    $output .= '<input name="' . $input_name . '" type="hidden" value="' . $icon_value . '" readonly />';
                    $output .= '<a class="button puzzle-add-icon" href="#">Choose Icon</a>';
                    break;
                case 'image':
                    $image_id = $array[$key];
                    $image = (!empty($image_id) ? wp_get_attachment_image($image_id, 'large') : '<img src="" />');
                
                    $output .= $attr['name'] . $tip;
                    $output .= $image . '<br />';
                    $output .= '<input name="' . $input_name . '" type="hidden" value="' . $image_id . '" readonly />';
                    $output .= '<a href="#" class="puzzle_add_image_button button" data-editor="content" title="Add Image">Add Image</a> ';
                    $output .= '<a href="#" class="puzzle_remove_image_button button">Remove Image</a>';
                    break;
                case 'color':
                    $output .= $attr['name'] . $tip;
                    $output .= '<input class="color-field" name="' . $input_name . '" value="' . esc_attr($array[$key]) . '" type="text" />';
                    break;
                default:
                    $output .= $attr['name'] . $tip;
                    $output .= '<input name="' . $input_name . '" value="' . esc_attr($array[$key]) . '" type="' . $attr['input_type'] . '"' . (isset($attr['placeholder']) ? ' placeholder="' . $attr['placeholder'] . '"' : '') . ' />';
            }
            
            $output .= '</div>';
        }
        
        return $output;
    }
    
    /*
     * Returns the admin markup for a section's column
     *
     * $puzzle_section - the section
     * $s - the counter keeping track of what section we are on
     * $c - the counter keeping track of what column we are on
     * $puzzle_column - the array containing the column's data
     */
    function admin_column_markup($puzzle_section, $s, $c, $puzzle_column = array('show' => 'show')) {
        $output = '<div class="column ' . $puzzle_section->get_admin_column_classes() . '">';

        if ($puzzle_section->has_multiple()) {
            $output .= '<div class="puzzle-collapsable-menu' . ($puzzle_column['show'] != 'hide' ? '' : ' collapsed-state') . '">';
            $output .= '<i class="fa fa-chevron-' . ($puzzle_column['show'] != 'hide' ? 'down' : 'up') . ' puzzle-collapse"></i>';
            $output .= '<h5>' . $puzzle_section->get_single_name() . '</h5>';
            $output .= '<i class="fa fa-close puzzle-remove-section"></i>';
            $output .= '<input name="puzzle_page_sections[' . $s . '][columns][' . $c . '][show]" type="hidden" value="' . ($puzzle_column['show'] != 'hide' ? 'show' : 'hide') . '"></input>';
            $output .= '</div>';
            $output .= '<div class="puzzle-collapsable-content' . ($puzzle_column['show'] != 'hide' ? ' show' : '') . '">';
        }
    
        $output .= '<h4>' . $puzzle_section->get_single_name() . '</h4>';
        $output .= '<div class="row">';
        $output .= $this->fields_markup($puzzle_column, $puzzle_section->get_markup_attr(), 'puzzle_page_sections[' . $s . '][columns][' . $c . ']');
        $output .= '</div>';
    
        if ($puzzle_section->has_multiple()) {
            $output .= '</div>';
        }
    
        $output .= '</div>';
    
        return $output;
    }
    
    /*
     * Returns the admin markup for a section's options
     *
     * $puzzle_section - the section
     * $s - the counter keeping track of what section we are on
     * $puzzle_options_data - the array containing the section's options data
     */
    function options_markup($puzzle_section, $s, $puzzle_options_data = array()) {
        $output = self::fields_markup($puzzle_options_data, $puzzle_section->get_options(), 'puzzle_page_sections[' . $s . '][options]');
        return $output;
    }
    
    /*
     * Returns the admin markup for a section
     *
     * $puzzle_section - the section
     * $s - the counter keeping track of what section we are on
     * $puzzle_options_data - the array containing the section's options data
     * $puzzle_columns_data - the array containing the section's columns data
     * $show - whether or not the section is collapsed in the admin view
     */
    function admin_section_markup($puzzle_section, $s, $puzzle_options_data = array(), $puzzle_columns_data = array(), $show = 'show') {
        $c = 0;
        
        $output  = '<div class="puzzle-section puzzle-' . $puzzle_section->slug() . '-area">';
        
        $output .= '<div class="puzzle-collapsable-menu' . ($show != 'hide' ? '' : ' collapsed-state') . '">';
        $output .= '<i class="fa fa-chevron-' . ($show != 'hide' ? 'down' : 'up') . ' puzzle-collapse"></i>';
        $output .= '<h5>' . $puzzle_section->name() . '</h5>';
        $output .= '<i class="fa fa-close puzzle-remove-section"></i>';
        $output .= '<input name="puzzle_page_sections[' . $s . '][show]" type="hidden" value="' . ($show != 'hide' ? 'show' : 'hide') . '"></input>';
        $output .= '</div>';

        $output .= '<div class="puzzle-collapsable-content' . ($show != 'hide' ? ' show' : '') . '">';
        $output .= '<h3>' . $puzzle_section->name() . ' Section</h3>';
        
        if ($puzzle_section->get_options()) {
            $output .= '<div class="row general-options-area">';
            $output .= '<div class="column xs-span12">';
            $output .= '<h4>General Options</h4>';
            $output .= '<div class="row">';
            $output .= self::options_markup($puzzle_section, $s, $puzzle_options_data);
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        
        if ($puzzle_section->has_multiple()) {
            $output .= '<div class="puzzle-add-column-area">';
            $output .= '<a class="button puzzle-add-column">Add ' . $puzzle_section->get_single_name() . '</a>';
            $output .= '</div>';
        }
        
        $output .= '<div class="row columns-area' . ($puzzle_section->has_multiple() ? ' added-columns' : '') . '">';

        // Gets the max number of columns for sections with fixed column numbers
        // e.g. one-column section, two-column section, etc.
        $max_columns = null;
        if ($puzzle_section->get_fixed_column_num() != null) {
            $max_columns = $c + $puzzle_section->get_fixed_column_num();
        }
        
        // Adds necessary number of columns if there is previously saved data,
        // or just adds one column with empty fields if this is a new section.
        if (!empty($puzzle_columns_data)) {
            foreach ($puzzle_columns_data as $puzzle_column) {
                if (!$max_columns || $c < $max_columns) {
                    $output .= self::admin_column_markup($puzzle_section, $s, $c, $puzzle_column);
                    $c++;
                }
            }
        } else if ($puzzle_section->has_multiple() && is_array($puzzle_columns_data)) {
            $output .= self::admin_column_markup($puzzle_section, $s, $c);
            $c++;
        }
            
        // Adds more sections equal to the fixed column number
        // if the section has a fixed number of columns.
        while ($max_columns && $c < $max_columns) {
            $output .= self::admin_column_markup($puzzle_section, $s, $c);
            $c++;
        }
        
        $output .= '</div>';
        
        if ($puzzle_section->has_multiple()) {
            $output .= '<div class="puzzle-add-column-area">';
            $output .= '<a class="button puzzle-add-column">Add ' . $puzzle_section->get_single_name() . '</a>';
            $output .= '</div>';
        }
        
        $output .= '<input class="puzzle-section-type-field" name="puzzle_page_sections[' . $s . '][type]" type="hidden" value="' . $puzzle_section->slug() . '" />';
        $output .= '</div>';
        $output .= '</div>';
        
        return $output;
    }
    
    /*
     * Gets data from the page builder that should be saved to the post
     * content. Used by the saveable_content() function to loop through both
     * options and columns.
     *
     * $fields - an array of data about the fields
     * $data - an array of the user input for the fields
     *
     * Returns a string of content that should be saved
     */
    function get_saveable_fields($fields, $data) {
        $content = '';
        $valid_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p');
        
        foreach ($data as $key => $value) {
            if (!empty($fields[$key]['save_as']) && !empty($value)) {
                $tag = $fields[$key]['save_as'];
            
                if ($tag == 'content') {
                    $content .= apply_filters('the_content', $value);
                } elseif ($tag == 'link') {
                    $link_text = $fields[$key]['name'];
                    $open_link_in_new_tab = '';
                    
                    if (!empty($fields[$key]['save_as_link_text'])) {
                        $link_text_key = $fields[$key]['save_as_link_text'];
                        $link_text = $data[$link_text_key];
                    }
                    
                    if (!empty($data['open_link_in_new_tab'])) {
                        $open_link_in_new_tab = ' target="_blank"';
                    }
                    
                    $content .= '<p><a href="' . $value . '"' . $open_link_in_new_tab . '>' . $link_text . '</a></p>';
                } elseif (in_array($tag, $valid_tags)) {
                    $content .= '<' . $tag . '>' . $value . '</' . $tag . '>';
                } else {
                    $content .= $value;
                }
            }
        }
        
        return $content;
    }
    
    /*
     * Processes the fields in the page builder and returns content to save to
     * the actual post content.  This is so the user isn't locked into this
     * plugin because all the content is in the post meta.
     *
     * $puzzle_sections_data - the data from the page builder form
     *
     * Returns a string of HTML to save to the post content
     */
    function saveable_content($puzzle_sections_data) {
        $puzzle_sections = (new PuzzleSections)->sections();
        $content = '';
        
        // Loops through each page section
        foreach ($puzzle_sections_data as $puzzle_section_data) {
            $puzzle_options_data = $puzzle_section_data['options'];
            $puzzle_columns_data = (!empty($puzzle_section_data['columns']) ? $puzzle_section_data['columns'] : NULL);
            $puzzle_section_type = $puzzle_section_data['type'];
            
            $puzzle_section = $puzzle_sections[$puzzle_section_type];
            $puzzle_options = $puzzle_section->get_options();
            $puzzle_columns = $puzzle_section->get_markup_attr();
            
            // Loops through the options of each page section and adds to
            // the post content.
            if ($puzzle_options) {
                $content .= self::get_saveable_fields($puzzle_options, $puzzle_options_data);
            }
            
            // Loops through the columns of each page section and adds to
            // the post content.
            if (!empty($puzzle_columns_data)) {
                foreach ($puzzle_columns_data as $column) {
                    $content .= self::get_saveable_fields($puzzle_columns, $column);
                }
            }
        }
        
        return $content;
    }
}
?>

<?php
class PuzzlePageBuilder {
    // Static variable: array of PuzzleSection objects.
    private static $Sections = array();
    
    // Returns the current sections
    function sections() {
        return self::$Sections;
    }
    
    // Adds a section
    function add_section($new_section) {
        self::$Sections[$new_section->get_group_name_slug()] = $new_section;
        
        uasort(self::$Sections, function($a, $b) {
            return strnatcmp($a->get_order(), $b->get_order());
        });
    }
    
    // Static variable: boolean indicating if shortcode buttons are available
    // in the WYSIWYG editor
    private static $Shortcodes = true;
    
    // Sets the shortcode button availability
    function set_shortcodes($boolean) {
        self::$Shortcodes = $boolean;
    }
    
    // Returns the value of $Shortcodes
    function has_shortcodes() {
        return self::$Shortcodes;
    }
    
    // Static variable: boolean indicating if the icon library is available
    // in the page builder
    private static $IconLibrary = true;
    
    // Sets the icon library availability
    function set_icon_library($boolean) {
        self::$IconLibrary = $boolean;
    }
    
    // Returns a boolean indicating if the icon library is available
    function has_icon_library() {
        return self::$IconLibrary;
    }
    
    // Static variable: a string of the default icon in the page builder
    private static $DefaultIcon = 'fa fa-star';
    
    // Sets the default icon
    function set_default_icon($new_icon) {
        self::$DefaultIcon = $new_icon;
    }
    
    // Returns the default icon
    function default_icon() {
        return self::$DefaultIcon;
    }
    
    // Static variable: boolean indicating if the Font Awesome icons are
    // available in the icon library in the page builder.
    private static $FontAwesomeLibrary = true;
    
    // Set the Font Awesome library availability
    function set_font_awesome_library($boolean) {
        self::$FontAwesomeLibrary = $boolean;
    }
    
    // Returns a boolean indicating if the Font Awesome library is available
    function has_font_awesome_library() {
        return self::$FontAwesomeLibrary;
    }
    
    // Static variable: a multidimensional array of data for custom icons to
    // place before Font Awesome icons in the page builder. Set to false if
    // there are no custom icons.
    //
    // Example
    //  array(
    //      array(
    //          'name'          => 'My Custom Icons',
    //          'example_icon'  => 'custom-icon',
    //          'icon_class'    => 'customicon',
    //          'icon_prefix'   => 'cm-',
    //          'icons'         => array('custom-icon', 'another-icon', 'third-icon')
    //      ),
    //      array(
    //          'name'          => 'Another Collection of Icons',
    //          'example_icon'  => 'cool-icon',
    //          'icon_class'    => 'anothericon',
    //          'icon_prefix'   => 'an-',
    //          'icons'         => array('cool-icon', 'another-icon', 'third-icon', 'fourth-icon)
    //      )
    //  )
    private static $CustomIconLibrariesBefore = false;
    
    // Set the custom icons before
    function set_custom_icon_libraries_before($icons) {
        self::$CustomIconLibrariesBefore = $icons;
    }
    
    // Returns the custom icons before
    function custom_icon_libraries_before() {
        return self::$CustomIconLibrariesBefore;
    }
    
    // Static variable: a multidimensional array of data for custom icons to
    // place after Font Awesome icons in the page builder. Set to false if
    // there are no custom icons.
    private static $CustomIconLibrariesAfter = false;
    
    // Set the custom icons after
    function set_custom_icon_libraries_after($icons) {
        self::$CustomIconLibrariesAfter = $icons;
    }
    
    // Returns the custom icons after
    function custom_icon_libraries_after() {
        return self::$CustomIconLibrariesAfter;
    }
    
    // Static variable: boolean indicating if a "no icon" choice is available
    // in the page builder's icon library.
    private static $IconLibraryChoiceNone = false;
    
    // Set if the "no icon" choice is available
    function set_icon_library_choice_none($boolean) {
        self::$IconLibraryChoiceNone = $boolean;
    }
    
    // Returns a boolean indicating if the "no icon" choice is available
    function has_icon_library_choice_none() {
        return self::$IconLibraryChoiceNone;
    }
    
    // Static variable: array of post types that the page builder is available
    // for, or false if the page builder is not available.
    private static $PageBuilderPostTypes = array('page');
    
    // Set which post types can use the page builder
    function set_page_builder_post_types($new_post_types) {
        self::$PageBuilderPostTypes = $new_post_types;
    }
    
    // Returns which post types can use the page builder
    function page_builder_post_types() {
        return self::$PageBuilderPostTypes;
    }
    
    // Static variable: boolean indicating if Owl Carousel is available.
    private static $OwlCarousel = true;
    
    // Set Owl Carousel availability
    function set_owl_carousel($boolean) {
        self::$OwlCarousel = $boolean;
    }
    
    // Returns if Owl Carousel is available
    function has_owl_carousel() {
        return self::$OwlCarousel;
    }
    
    // Returns the markup for fields
    //
    // $array - the array that the field is being saved to
    // $attrs - the fields to loop through
    // $input_name_prefix - the prefix for the name attribute in the input field
    private function fields_markup($array, $attrs, $input_name_prefix) {
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
        
            if ($attr['input_type'] == 'textarea') {
                $output .= $attr['name'] . $tip;
                $output .= '<textarea name="' . $input_name . '" rows="' . (!empty($attr['rows']) ? $attr['rows'] : '5') . '">' . $array[$key] . '</textarea><br />';
                $output .= '<a class="button open-editor-button" href="#">Open Editor</a>';
            } elseif ($attr['input_type'] == 'checkbox') {
                $output .= '<input type="checkbox" name="' . $input_name . '" id="' . $input_name . '"' . (!empty($array[$key]) ? ' checked' : '') . '><label for="' . $input_name . '">' . $attr['name'] . '</label>' . $tip;
            } elseif ($attr['input_type'] == 'select') {
                $output .= $attr['name'] . $tip;
                $output .= '<select name="' . $input_name . '">';
                foreach ($attr['options'] as $option_key => $option) {
                    $output .= '<option value="' . $option . '"' . ($array[$key] == $option || (empty($array[$key]) && !empty($attr['selected']) && $attr['selected'] == $option) ? ' selected' : '') . '>' . $option_key . '</option>';
                }
                $output .= '</select>';
            } elseif ($attr['input_type'] == 'icon') {
                $icon_value = (!empty($array[$key]) ? $array[$key] : $this->default_icon());
            
                $output .= $attr['name'] . $tip;
                $output .= '<i class="' . $icon_value . '"></i>';
                $output .= '<input name="' . $input_name . '" type="hidden" value="' . $icon_value . '" readonly />';
                $output .= '<a class="button puzzle-add-icon" href="#">Choose Icon</a>';
            } elseif ($attr['input_type'] == 'image') {
                $image_id = $array[$key];
                $image = '<img src="" />';
                
                if (!empty($image_id)) {
                    $image = wp_get_attachment_image($image_id, 'large');
                }
                
                $output .= $attr['name'] . $tip;
                $output .= $image . '<br />';
                $output .= '<input name="' . $input_name . '" type="hidden" value="' . $image_id . '" readonly />';
                $output .= '<a href="#" class="puzzle_add_image_button button" data-editor="content" title="Add Image">Add Image</a> ';
                $output .= '<a href="#" class="puzzle_remove_image_button button">Remove Image</a>';
            } elseif ($attr['input_type'] == 'color') {
                $output .= $attr['name'] . $tip;
                $output .= '<input class="color-field" name="' . $input_name . '" value="' . esc_attr($array[$key]) . '" type="text" />';
            } else {
                $output .= $attr['name'] . $tip;
                $output .= '<input name="' . $input_name . '" value="' . esc_attr($array[$key]) . '" type="' . $attr['input_type'] . '"' . (isset($attr['placeholder']) ? ' placeholder="' . $attr['placeholder'] . '"' : '') . ' />';
            }
            
            $output .= '</div>';
        }
        
        return $output;
    }
    
    // Returns the admin markup for a section's column
    //
    // $puzzle_section - the section
    // $s - the counter keeping track of what section we are on
    // $c - the counter keeping track of what column we are on
    // $puzzle_column - the array containing the column's data
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
        $output .= $this->fields_markup($puzzle_column, $puzzle_section->get_markup_attr(), 'puzzle_page_sections[' . $s . '][columns][' . $c . ']');
    
        if ($puzzle_section->has_multiple()) {
            $output .= '</div>';
        }
    
        $output .= '</div>';
    
        return $output;
    }
    
    // Returns the admin markup for a section's options
    //
    // $puzzle_section - the section
    // $s - the counter keeping track of what section we are on
    // $puzzle_options_data - the array containing the secttion's options data
    function options_markup($puzzle_section, $s, $puzzle_options_data = array()) {
        $output = self::fields_markup($puzzle_options_data, $puzzle_section->get_options(), 'puzzle_page_sections[' . $s . '][options]');
        return $output;
    }
    
    // Returns the admin markup for a section
    //
    // $puzzle_section - the section
    // $s - the counter keeping track of what section we are on
    // $puzzle_options_data - the array containing the section's options data
    // $puzzle_columns_data - the array containing the section's columns data
    // $show - whether or not the section is collapsed in the admin view
    function admin_section_markup($puzzle_section, $s, $puzzle_options_data = array(), $puzzle_columns_data = array(), $show = 'show') {
        $c = 0;
        
        $output  = '<div class="puzzle-section puzzle-' . $puzzle_section->get_group_name_slug() . '-area">';
        
        $output .= '<div class="puzzle-collapsable-menu' . ($show != 'hide' ? '' : ' collapsed-state') . '">';
        $output .= '<i class="fa fa-chevron-' . ($show != 'hide' ? 'down' : 'up') . ' puzzle-collapse"></i>';
        $output .= '<h5>' . $puzzle_section->get_group_name() . '</h5>';
        $output .= '<i class="fa fa-close puzzle-remove-section"></i>';
        $output .= '<input name="puzzle_page_sections[' . $s . '][show]" type="hidden" value="' . ($show != 'hide' ? 'show' : 'hide') . '"></input>';
        $output .= '</div>';

        $output .= '<div class="puzzle-collapsable-content' . ($show != 'hide' ? ' show' : '') . '">';
        $output .= '<h3>' . $puzzle_section->get_group_name() . ' Section</h3>';
        
        if ($puzzle_section->get_options()) {
            $output .= '<div class="row general-options-area">';
            $output .= '<div class="column xs-span12">';
            $output .= '<h4>General Options</h4>';
            $output .= self::options_markup($puzzle_section, $s, $puzzle_options_data);
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
        
        $output .= '<input class="puzzle-section-type-field" name="puzzle_page_sections[' . $s . '][type]" type="hidden" value="' . $puzzle_section->get_group_name_slug() . '" />';
        $output .= '</div>';
        $output .= '</div>';
        
        return $output;
    }
    
    // Gets data from the page builder that should be saved to the post
    // content. Used by the saveable_content() function to loop through both
    // options and columns.
    //
    // $fields - an array of data about the fields
    // $data - an array of the user input for the fields
    //
    // Returns a string of content that should be saved
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
    
    // Processes the fields in the page builder and returns content to save to
    // the actual post content.  This is so the user isn't locked into this
    // theme because all the content is in the post meta.
    //
    // $puzzle_sections_data - the data from the page builder form
    //
    // Returns a string of HTML to save to the post content
    function saveable_content($puzzle_sections_data) {
        $puzzle_sections = $this->sections();
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

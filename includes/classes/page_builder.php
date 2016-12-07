<?php

/*
 * Puzzle Page Builder
 * Page Builder Class
 */

if (!defined('ABSPATH')) exit;

class PuzzlePageBuilder {
    /*
     * Returns the markup for fields
     *
     * $data - array, the data that the field is being saved to
     * $fields - array, the PuzzleField objects to loop through
     * $input_name_prefix - string, the prefix for the name attribute in the
     * input field
     */
    private function fields_markup($data, $fields, $input_name_prefix) {
        $puzzle_icon_libraries = new PuzzleIconLibraries;
        $output = '';
            
        foreach ($fields as $field) {
            $id = $field->id();
            $input_name = $input_name_prefix . '[' . $id . ']';
            $input_width = 'pz-xs-12 pz-sm-' . $field->width();
            
            $tip = '';
            if (!empty($field->tip())) {
                $tip  = '<i class="puzzle-field-tip-button fa fa-question-circle" aria-hidden="true" title="' . __('Help', 'puzzle-page-builder') . '"></i>';
                $tip .= '<span class="pz-screen-reader-only">' . __('Help', 'puzzle-page-builder') . '</span>';
                $tip .= '<span class="puzzle-field-tip-content"><span>' . $field->tip() . '</span></span>';
            }
            
            $label_and_tip = '<label>' . $field->name() . '</label>' . $tip;
            
            $output .= '<div class="pz-col ' . $input_width . ($field->input_type() == 'icon' ? ' puzzle-icon-preview' : '') . '">';
            
            if (!isset($data[$id])) {
                $data[$id] = '';
            }
            
            switch ($field->input_type()) {
                case 'checkbox':
                    $output .= '<label for="' . $input_name . '">';
                    $output .= '<input type="checkbox" name="' . $input_name . '" id="' . $input_name . '"' . (!empty($data[$id]) ? ' checked' : '') . '>';
                    $output .= $field->name() . '</label>' . $tip;
                    break;
                case 'color':
                    $output .= $label_and_tip;
                    $output .= '<input class="puzzle-color-field" name="' . $input_name . '" value="' . esc_attr($data[$id]) . '" type="text" />';
                    break;
                case 'editor':
                    $output .= $label_and_tip;
                    $output .= '<textarea name="' . $input_name . '" rows="' . (!empty($field->rows()) ? $field->rows() : '5') . '">' . esc_textarea($data[$id]) . '</textarea><br />';
                    $output .= '<button class="puzzle-button open-editor-button">';
                    $output .= __('Open Editor', 'puzzle-page-builder');
                    $output .= '</button>';
                    break;
                case 'icon':
                    $icon_value = (!empty($data[$id]) ? $data[$id] : $puzzle_icon_libraries->default_icon());
                    
                    $output .= $label_and_tip;
                    $output .= '<i class="' . $icon_value . '" aria-hidden="true"></i>';
                    $output .= '<input name="' . $input_name . '" type="hidden" value="' . esc_attr($icon_value) . '" readonly />';
                    $output .= '<button class="puzzle-button puzzle-add-icon">';
                    $output .= __('Choose Icon', 'puzzle-page-builder');
                    $output .= '</button>';
                    break;
                case 'image':
                    $image_id = $data[$id];
                    $image = (!empty($image_id) ? wp_get_attachment_image($image_id, 'large') : '<img src="" />');

                    $output .= $label_and_tip;
                    $output .= '<div class="puzzle-image-container">';
                    $output .= $image;
                    $output .= '<input name="' . $input_name . '" type="hidden" value="' . absint($image_id) . '" readonly />';
                    $output .= '<a class="puzzle-add-image-button" data-editor="content" href="#" title="' . __('Add Image', 'puzzle-page-builder') . '" aria-label="' . __('Add Image', 'puzzle-page-builder') . '"><i class="ei ei-plus-alt2" aria-hidden="true"></i></a>';
                    $output .= '<a class="puzzle-remove-image-button" href="#" title="' . __('Remove Image', 'puzzle-page-builder') . '" aria-label="' . __('Remove Image', 'puzzle-page-builder') . '"><i class="ei ei-close-alt" aria-hidden="true"></i></a>';
                    $output .= '</div>';
                    break;
                case 'number':
                    $output .= $label_and_tip;
                    $output .= '<input name="' . $input_name . '" value="' . (is_numeric($data[$id]) ? $data[$id] : '') . '" type="number"' . (!empty($field->placeholder()) ? ' placeholder="' . $field->placeholder() . '"' : '') . ' />';
                    break;
                case 'select':
                    $output .= $label_and_tip;
                    $output .= '<select name="' . $input_name . '">';
                    foreach ($field->options() as $option_key => $option_label) {
                        $output .= '<option value="' . $option_key . '"' . ($data[$id] == $option_key || (empty($data[$id]) && $field->selected() == $option_key) ? ' selected' : '') . '>' . $option_label . '</option>';
                    }
                    $output .= '</select>';
                    break;
                case 'textarea':
                    $output .= $label_and_tip;
                    $output .= '<textarea name="' . $input_name . '" rows="' . (!empty($field->rows()) ? $field->rows() : '5') . '">' . esc_textarea($data[$id]) . '</textarea><br />';
                    break;
                default:
                    $output .= $label_and_tip;
                    $output .= '<input name="' . $input_name . '" value="' . esc_attr($data[$id]) . '" type="' . $field->input_type() . '"' . (!empty($field->placeholder()) ? ' placeholder="' . $field->placeholder() . '"' : '') . ' />';
            }
            
            $output .= '</div>';
        }
        
        return $output;
    }
    
    /*
     * Returns the page builder markup for the add new sections buttons
     */
    function add_new_section_buttons_markup() {
        $puzzle_sections = (new PuzzleSections)->sections();
        
        $output  = '<div class="puzzle-add-section">';
        $output .= '<a class="puzzle-add-section-open-buttons" href="#" title="' . __('Add Section', 'puzzle-page-builder') . '" aria-label="' . __('Add Section', 'puzzle-page-builder') . '">';
        $output .= '<i class="ei ei-plus-alt" aria-hidden="true"></i>';
        $output .= '</a>';
        $output .= '<div class="puzzle-add-section-buttons">';
        $output .= '<h4>' . __('Add Section', 'puzzle-page-builder') . '</h4>';
        
        foreach ($puzzle_sections as $current_puzzle_section) {
            $output .= '<button class="puzzle-button puzzle-button-transparent puzzle-add-section-button" data-type="' . $current_puzzle_section->slug() . '" data-insert="after">' . $current_puzzle_section->name() . '</button> ';
        }
        
        $output .= '</div>';
        $output .= '</div>';
        
        return $output;
    }
    
    /*
     * Returns the page builder markup for the section menu (copy, delete, etc.)
     *
     * $puzzle_section - PuzzleSection object
     * $is_section - boolean, whether this is the menu for a section or not,
     *   as opposed to the menu for a column
     */
    function section_menu($puzzle_section, $is_section) {
        $output  = '<div class="puzzle-section-menu">';
        
        if ($is_section || $puzzle_section->has_unlimited_columns()) {
            $output .= '<div class="pz-row puzzle-section-menu-top">';
            $output .= '<div class="puzzle-has-dropdown">';
            
            $output .= '<a class="puzzle-dropdown-trigger" href="#" title="' . __('Add', 'puzzle-page-builder') . '" aria-label="' . __('Add', 'puzzle-page-builder') . '"><i class="ei ei-plus" aria-hidden="true"></i></a>';
            
            $output .= '<ul>';
            
            $output .= '<li>';
            $output .= '<a class="puzzle-add-' . ($is_section ? 'section' : 'column') . '-button" href="#" data-type="' . $puzzle_section->slug() . '" data-insert="before">';
            $output .= '<i class="ei ei-plus" aria-hidden="true"></i> ';
            $output .= sprintf(__('Add %s Before', 'puzzle-page-builder'), ($is_section ? $puzzle_section->name() : $puzzle_section->single_name()));
            $output .= '</a>';
            $output .= '</li>';
            
            $output .= '<li>';
            $output .= '<a class="puzzle-add-' . ($is_section ? 'section' : 'column') . '-button" href="#" data-type="' . $puzzle_section->slug() . '" data-insert="after">';
            $output .= '<i class="ei ei-plus" aria-hidden="true"></i> ';
            $output .= sprintf(__('Add %s After', 'puzzle-page-builder'), ($is_section ? $puzzle_section->name() : $puzzle_section->single_name()));
            $output .= '</a>';
            $output .= '</li>';
            
            $output .= '<li>';
            $output .= '<a class="puzzle-add-' . ($is_section ? 'section' : 'column') . '-button" href="#" data-type="' . $puzzle_section->slug() . '" data-insert="before" data-copy="true">';
            $output .= '<i class="ei ei-documents-alt" aria-hidden="true"></i> ';
            $output .= sprintf(__('Copy %s Before', 'puzzle-page-builder'), ($is_section ? $puzzle_section->name() : $puzzle_section->single_name()));
            $output .= '</a>';
            $output .= '</li>';
            
            $output .= '<li>';
            $output .= '<a class="puzzle-add-' . ($is_section ? 'section' : 'column') . '-button" href="#" data-type="' . $puzzle_section->slug() . '" data-insert="after" data-copy="true">';
            $output .= '<i class="ei ei-documents-alt" aria-hidden="true"></i> ';
            $output .= sprintf(__('Copy %s After', 'puzzle-page-builder'), ($is_section ? $puzzle_section->name() : $puzzle_section->single_name()));
            $output .= '</a>';
            $output .= '</li>';
            
            $output .= '</ul>';
            
            $output .= '</div>';
            
            $output .= '<a class="puzzle-remove-section" href="#" title="' . __('Delete', 'puzzle-page-builder') . '" aria-label="' . __('Delete', 'puzzle-page-builder') . '"><i class="ei ei-close-alt2" aria-hidden="true"></i></a>';
            
            $output .= '</div>';
        }
        
        $output .= '<div class="pz-row puzzle-section-menu-title">';
        
        if ($is_section) {
            $output .= '<h3>' . $puzzle_section->name() . '</h3>';
        } else {
            $output .= '<h4>' . $puzzle_section->single_name() . '</h4>';
        }
        
        $output .= '<a class="puzzle-collapse" href="#" title="' . __('Expand Content', 'puzzle-page-builder') . '" aria-label="' . __('Expand Content', 'puzzle-page-builder') . '">';
        $output .= '<i class="ei" aria-hidden="true"></i>';
        $output .= '</a>';
        
        if ($is_section && $puzzle_section->columns_num() !== 0) {
            $output .= '<a class="puzzle-collapse-all" href="#" title="' . __('Expand All Content', 'puzzle-page-builder') . '" aria-label="' . __('Expand All Content', 'puzzle-page-builder') . '">';
            $output .= '<i class="ei" aria-hidden="true"></i>';
            $output .= '</a>';
        }
        
        $output .= '</div>';
        $output .= '</div>';
        
        return $output;
    }
    
    /*
     * Returns the page builder markup for a section's column
     *
     * $puzzle_section - PuzzleSection object
     * $s - integer, the counter keeping track of what section we are on
     * $c - integer, the counter keeping track of what column we are on
     * $column_data - array, the column's data
     */
    function column_markup($puzzle_section, $s, $c, $column_data = array()) {
        $output = '<div class="pz-col puzzle-page-builder-column ' . $puzzle_section->admin_column_classes() . '" data-id="' . $c . '">';
        $output .= '<div class="pz-col-inner">';
        
        $output .= self::section_menu($puzzle_section, false);
        $output .= '<div class="puzzle-collapsable-content">';
        
        $output .= '<div class="pz-row">';
        $output .= $this->fields_markup($column_data, $puzzle_section->column_fields(), '_puzzle_page_sections[' . $s . '][columns][' . $c . ']');
        $output .= '</div>';
        
        $output .= '</div>';
        
        $output .= '</div>';
        $output .= '</div>';
        
        return $output;
    }
    
    /*
     * Returns the page builder markup for a section's options
     *
     * $puzzle_section - PuzzleSection object
     * $s - integer, the counter keeping track of what section we are on
     * $puzzle_options_data - array, the section's options data
     */
    function options_markup($puzzle_section, $s, $options_data = array()) {
        $output = self::fields_markup($options_data, $puzzle_section->option_fields(), '_puzzle_page_sections[' . $s . '][options]');
        return $output;
    }
    
    /*
     * Returns the admin markup for a section
     *
     * $puzzle_section - PuzzleSection object
     * $s - integer, the counter keeping track of what section we are on
     * $options_data - array, the section's options data
     * $columns_data - array, the section's columns data
     */
    function admin_section_markup($puzzle_section, $s, $options_data = array(), $columns_data = array()) {
        $c = 0;
        $output = '';
        
        if ($s === 0) {
            $output .= self::add_new_section_buttons_markup();
        }
        
        $output .= '<div class="puzzle-section puzzle-' . $puzzle_section->slug() . '" data-id="' . $s . '">';
        $output .= '<div class="puzzle-section-content">';
        
        $output .= self::section_menu($puzzle_section, true);

        $output .= '<div class="puzzle-collapsable-content">';
        
        if ($puzzle_section->option_fields()) {
            $output .= '<div class="pz-row puzzle-general-options-area">';
            $output .= self::options_markup($puzzle_section, $s, $options_data);
            $output .= '</div>';
        }
        
        $output .= '</div>';
        
        $output .= '<div class="pz-row puzzle-columns-area ' . ($puzzle_section->has_unlimited_columns() ? 'puzzle-unlimited-columns' : 'puzzle-fixed-columns') . '">';

        /* Gets the max number of columns. */
        $max_columns = $puzzle_section->columns_num();
        
        /*
         * Adds necessary number of columns if there is previously saved data,
         * or just adds one column with empty fields if this is a new section.
         */
        if (!empty($columns_data)) {
            foreach ($columns_data as $puzzle_column) {
                if ($puzzle_section->has_unlimited_columns() || $c < $max_columns) {
                    $output .= self::column_markup($puzzle_section, $s, $c, $puzzle_column);
                    $c++;
                }
            }
        } else if ($puzzle_section->has_unlimited_columns() && is_array($columns_data)) {
            $output .= self::column_markup($puzzle_section, $s, $c);
            $c++;
        }
        
        /*
         * Adds more sections equal to the fixed number of columns
         * if the section has a fixed number of columns.
         */
        while ($c < $max_columns) {
            $output .= self::column_markup($puzzle_section, $s, $c);
            $c++;
        }
        
        $output .= '</div>';
        
        if ($puzzle_section->has_unlimited_columns()) {
            $output .= '<div class="puzzle-add-column-area">';
            $output .= '<button class="puzzle-button puzzle-button-primary puzzle-add-column-button" data-type="' . $puzzle_section->slug() . '" data-insert="end">';
            $output .= sprintf(__('Add %s', 'puzzle-page-builder'), $puzzle_section->single_name());
            $output .= '</button>';
            $output .= '</div>';
        }
        
        $output .= '<input class="puzzle-section-type-field" name="_puzzle_page_sections[' . $s . '][type]" type="hidden" value="' . $puzzle_section->slug() . '" />';
        $output .= '</div>';
        
        $output .= self::add_new_section_buttons_markup();
        
        $output .= '</div>';
        
        return $output;
    }
    
    /*
     * Gets data from the page builder and sanitizes it. Used by the
     * sanitize_data() function to loop through both options and columns.
     *
     * $fields - array, PuzzleField objects
     * $data - array, the user input for the fields
     *
     * Returns an array of sanitized data
     */
    private function get_sanitized_data($fields, $data) {
        $new_data = $data;
        
        foreach ($data as $key => $value) {
            // If the field doesn't exist, remove it
            if (empty($fields[$key])) {
                unset($new_data[$key]);
            }
            
            $input_type = $fields[$key]->input_type();
            
            // Sanitize data depending on input type
            switch ($input_type) {
                case 'checkbox':
                    $new_data[$key] = ($value == 'on' ? $value : '');
                    break;
                case 'color':
                    $new_data[$key] = sanitize_hex_color($value);
                    break;
                case 'editor':
                    $new_data[$key] = wp_kses_post($value);
                    break;
                case 'icon':
                    $new_data[$key] = sanitize_text_field($value);
                    break;
                case 'image':
                    // The image ID must be a positive integer
                    $new_data[$key] = (is_numeric($value) && $value > 0 && $value == round($value, 0) ? $value : '');
                    break;
                case 'number':
                    $new_data[$key] = (is_numeric($value) ? absint($value) : '');
                    break;
                case 'select':
                    // The value must be one of the options
                    $new_data[$key] = (array_key_exists($value, $fields[$key]->options()) ? $value : '');
                    break;
                case 'text':
                    $new_data[$key] = sanitize_text_field($value);
                    break;
                case 'textarea':
                    $new_data[$key] = $value;
                    break;
                default:
                    $new_data[$key] = $value;
            }
        }
        
        return $new_data;
    }
    
    /*
     * Sanitizes user data from the page builder
     *
     * $data - array, the user input
     *
     * Returns an array of sanitized data
     */
    function sanitize_data($puzzle_sections_data) {
        $puzzle_sections = (new PuzzleSections)->sections();
        $new_puzzle_sections_data = $puzzle_sections_data;
        
        /* Loops through each page section */
        foreach ($puzzle_sections_data as $s => $puzzle_section_data) {
            $options_data = $puzzle_section_data['options'];
            $columns_data = (!empty($puzzle_section_data['columns']) ? $puzzle_section_data['columns'] : NULL);
            $section_type = $puzzle_section_data['type'];
            
            $puzzle_section = $puzzle_sections[$section_type];
            $option_fields = $puzzle_section->option_fields();
            $column_fields = $puzzle_section->column_fields();
            
            /*
             * Loops through the options of each page section and
             * sanitizes data.
             */
            if ($option_fields) {
                $new_puzzle_sections_data[$s]['options'] = self::get_sanitized_data($option_fields, $options_data);
            }
            
            /*
             * Loops through the columns of each page section and
             * sanitizes data.
             */
            if (!empty($columns_data)) {
                foreach ($columns_data as $c => $column_data) {
                    $new_puzzle_sections_data[$s]['columns'][$c] = self::get_sanitized_data($column_fields, $column_data);
                }
            }
        }
        
        return $new_puzzle_sections_data;
    }
    
    /*
     * Gets data from the page builder that should be saved to the post
     * content. Used by the saveable_content() function to loop through both
     * options and columns.
     *
     * $fields - array, PuzzleField objects
     * $data - array, the user input for the fields
     *
     * Returns a string of content that should be saved
     */
    private function get_saveable_data($fields, $data) {
        $content = '';
        
        foreach ($data as $key => $value) {
            if (empty($fields[$key])) continue;
            
            if (!empty($fields[$key]->save_as()) && !empty($value)) {
                $tag = $fields[$key]->save_as();
            
                if ($tag == 'content') {
                    $content .= apply_filters('ppb_like_the_content', $value);
                } elseif ($tag == 'link') {
                    $link_text = $fields[$key]->name();
                    $open_link_in_new_tab = '';
                    
                    if (!empty($fields[$key]->save_as_link_text())) {
                        $link_text_key = $fields[$key]->save_as_link_text();
                        $link_text = $data[$link_text_key];
                    }
                    
                    if (!empty($data['open_link_in_new_tab'])) {
                        $open_link_in_new_tab = ' target="_blank"';
                    }
                    
                    $content .= '<p><a href="' . $value . '"' . $open_link_in_new_tab . '>' . $link_text . '</a></p>';
                } else {
                    $content .= '<' . $tag . '>' . $value . '</' . $tag . '>';
                }
            }
        }
        
        return $content;
    }
    
    /*
     * Processes the fields in the page builder and returns content to save to
     * the actual post content. This is so the user isn't locked into this
     * plugin because all the content is in the post meta.
     *
     * $puzzle_sections_data - array, data from the page builder form
     *
     * Returns a string of HTML to save to the post content
     */
    function saveable_content($puzzle_sections_data) {
        $puzzle_sections = (new PuzzleSections)->sections();
        $content = '';
        
        /* Loops through each page section */
        foreach ($puzzle_sections_data as $puzzle_section_data) {
            $options_data = $puzzle_section_data['options'];
            $columns_data = (!empty($puzzle_section_data['columns']) ? $puzzle_section_data['columns'] : NULL);
            $section_type = $puzzle_section_data['type'];
            
            $puzzle_section = $puzzle_sections[$section_type];
            $option_fields = $puzzle_section->option_fields();
            $column_fields = $puzzle_section->column_fields();
            
            /*
             * Loops through the options of each page section and adds to
             * the post content.
             */
            if ($option_fields) {
                $content .= self::get_saveable_data($option_fields, $options_data);
            }
            
            /*
             * Loops through the columns of each page section and adds to
             * the post content.
             */
            if (!empty($columns_data)) {
                foreach ($columns_data as $column_data) {
                    $content .= self::get_saveable_data($column_fields, $column_data);
                }
            }
        }
        
        return $content;
    }
    
    /*
     * Retrieves the page builder data
     *
     * $post_id - integer, the ID of the current post. If blank, this is set
     *   to the ID of the global $post
     *
     * Returns an array of post meta
     */ 
    function sections_data($post_id = 0) {
        if (empty($post_id)) { global $post; $post_id = $post->ID; }
        $page_sections = get_post_meta($post_id, '_puzzle_page_sections', true);
        return $page_sections;
    }
}
?>

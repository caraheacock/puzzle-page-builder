<?php

/*
 * Puzzle Page Builder
 * Settings Class
 */

class PuzzleSettings {
    /*
     * Initializes the PuzzleSettings instance and runs any actions
     */
    function __construct() {
        do_action('ppb_modify_settings', $this);
    }
    
    /*
     * Boolean: indicating if button formats are available in the formats
     * dropdown in the WYSIWYG editor
     */
    private static $ButtonFormats = true;
    function set_button_formats($boolean) {
        self::$ButtonFormats = $boolean;
        return $this;
    }
    function has_button_formats() { return self::$ButtonFormats; }
    
    /*
     * Array: list of colors to use 
     */
    private static $Colors = array(
        'primary'           => '#3b54a5',
        'secondary'         => '#2cb799',
        'headline_dark'     => '#333',
        'text_dark'         => '#555',
        'headline_light'    => '#fff',
        'text_light'        => '#fff'
    );
    function set_colors($new_colors) {
        foreach ($new_colors as $id => $hex) {
            if (array_key_exists($id, self::$Colors)) {
                self::$Colors[$id] = $hex;
            }
        }
        return $this;
    }
    function colors() { return self::$Colors; }
    
    /*
     * String: a user-set custom template to display page builder sections
     * in on the front-end.
     */
    private static $CustomTemplate = '';
    function set_custom_template($new_template) {
        self::$CustomTemplate = $new_template;
        return $this;
    }
    function custom_template() { return self::$CustomTemplate; }
    
    /*
     * String: how to display sections.
     *
     * Currently accepts these options
     * - 'plugin_template' - sections will be displayed in the plugin's
     *   template, which just includes the theme header, sections, and
     *   theme footer
     * - 'the_content' - sections will replace the main content of a page,
     *   using the theme's templates
     * - 'custom' - the user can set a specific one of their theme's templates,
     *   and sections will replace the content
     */
    private static $DisplaySectionsIn = 'plugin_template';
    function set_display_sections_in($new_display) {
        if (array_key_exists($new_display, ['plugin_template', 'the_content', 'custom'])) {
            self::$DisplaySectionsIn = $new_display;
        }
        return $this;
    }
    function display_sections_in() { return self::$DisplaySectionsIn; }
    
    /*
     * Boolean: indicating if the icon library is available in the page builder
     */
    private static $IconLibrary = true;
    function set_icon_library($boolean) {
        self::$IconLibrary = $boolean;
        return $this;
    }
    function has_icon_library() { return self::$IconLibrary; }
    
    /* Boolean: indicating if Owl Carousel is available. */
    private static $OwlCarousel = true;
    function set_owl_carousel($boolean) {
        self::$OwlCarousel = $boolean;
        return $this;
    }
    function has_owl_carousel() { return self::$OwlCarousel; }
    
    /*
     * Array: post types that the page builder is available for, or false if
     * the page builder is not available.
     */
    private static $PageBuilderPostTypes = array('page');
    function set_page_builder_post_types($new_post_types) {
        self::$PageBuilderPostTypes = $new_post_types;
        return $this;
    }
    function page_builder_post_types() { return self::$PageBuilderPostTypes; }
    
    /*
     * String: the theme's directory where custom template partials are kept
     * for section loops.
     *
     * Default is partials located in the theme's root directory.
     */
    private static $TemplatesDirectory = '';
    function set_templates_directory($new_templates_directory) {
        self::$TemplatesDirectory = $new_templates_directory;
        return $this;
    }
    function templates_directory() { return self::$TemplatesDirectory; }
}

?>

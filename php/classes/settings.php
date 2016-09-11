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
     * Boolean: indicating if shortcode buttons are available in the
     * WYSIWYG editor
     */
    private static $Shortcodes = true;
    function set_shortcodes($boolean) {
        self::$Shortcodes = $boolean;
    }
    function has_shortcodes() { return self::$Shortcodes; }
    
    /*
     * Boolean: indicating if the icon library is available in the page builder
     */
    private static $IconLibrary = true;
    function set_icon_library($boolean) {
        self::$IconLibrary = $boolean;
    }
    function has_icon_library() { return self::$IconLibrary; }
    
    /*
     * Boolean: indicating if the Font Awesome icons are available in the icon
     * library in the page builder.
     */
    private static $FontAwesomeLibrary = true;
    function set_font_awesome_library($boolean) {
        self::$FontAwesomeLibrary = $boolean;
    }
    function has_font_awesome_library() { return self::$FontAwesomeLibrary; }
    
    /*
     * Boolean: indicating if a "no icon" choice is available in the page
     * builder's icon library.
     */
    private static $IconLibraryChoiceNone = false;
    function set_icon_library_choice_none($boolean) {
        self::$IconLibraryChoiceNone = $boolean;
    }
    function has_icon_library_choice_none() { return self::$IconLibraryChoiceNone; }
    
    /*
     * Array: post types that the page builder is available for, or false if
     * the page builder is not available.
     */
    private static $PageBuilderPostTypes = array('page');
    function set_page_builder_post_types($new_post_types) {
        self::$PageBuilderPostTypes = $new_post_types;
    }
    function page_builder_post_types() { return self::$PageBuilderPostTypes; }
    
    /* Boolean: indicating if Owl Carousel is available. */
    private static $OwlCarousel = true;
    function set_owl_carousel($boolean) {
        self::$OwlCarousel = $boolean;
    }
    function has_owl_carousel() { return self::$OwlCarousel; }
    
    /*
     * String: the theme's directory where custom template partials are kept
     * for section loops.
     *
     * Default is partials located in the theme's root directory.
     */
    private static $TemplatesDirectory = '';
    function set_templates_directory($new_templates_directory) {
        self::$TemplatesDirectory = $new_templates_directory;
    }
    function templates_directory() { return self::$TemplatesDirectory; }
}

?>

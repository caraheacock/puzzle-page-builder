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
        return $this;
    }
    function has_shortcodes() { return self::$Shortcodes; }
    
    /*
     * Boolean: indicating if the icon library is available in the page builder
     */
    private static $IconLibrary = true;
    function set_icon_library($boolean) {
        self::$IconLibrary = $boolean;
        return $this;
    }
    function has_icon_library() { return self::$IconLibrary; }
    
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
    
    /* Boolean: indicating if Owl Carousel is available. */
    private static $OwlCarousel = true;
    function set_owl_carousel($boolean) {
        self::$OwlCarousel = $boolean;
        return $this;
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
        return $this;
    }
    function templates_directory() { return self::$TemplatesDirectory; }
}

?>

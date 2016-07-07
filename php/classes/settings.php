<?php

/*
 * Puzzle Page Builder
 * Settings Class
 */

class PuzzleSettings {
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
}

?>

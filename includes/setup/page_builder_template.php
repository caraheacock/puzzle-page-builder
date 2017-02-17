<?php

/*
 * Puzzle Page Builder
 * Page Builder Template Class
 */

if (!defined('ABSPATH')) exit;

class PuzzlePageBuilderTemplate {

    /*
     * A unique identifier
     */
    protected $plugin_slug;

    /*
     * A reference to an instance of this class.
     */
    private static $instance;

    /*
     * The array of templates that this plugin tracks.
     */
    protected $templates;
    
    /*
     * Returns an instance of this class.
     */
    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new PuzzlePageBuilderTemplate();
        }

        return self::$instance;
    }

    /*
     * Initializes the class by setting filters and administration functions.
     */
    public function __construct() {
        $this->templates = array();
        $this->settings = new PuzzleSettings;

        /*
         * Add a filter to insert template into the theme templates.
         */
        foreach ($this->settings->page_builder_post_types() as $post_type) {
            add_filter(
                'theme_' . $post_type . '_templates',
                array($this, 'register_puzzle_page_builder_template')
            );
        }
        
        /*
         * Add a filter to the template include to determine if the page has our
         * template assigned and return its path.
         */
        add_filter('template_include', array($this, 'view_puzzle_page_builder_template'));


        /* Add templates to the array. */
        $this->templates = array(
            'template_page_builder.php' => __('Page Builder', 'puzzle-page-builder')
        );
    }
    
    /* Adds our template to the theme templates */
    public function register_puzzle_page_builder_template($post_templates) {
        $post_templates = array_merge($post_templates, $this->templates);
        return $post_templates;
    }
    
    /*
     * Checks if the template is assigned to the page
     */
    public function view_puzzle_page_builder_template($template) {
        global $post;
        
        if (!is_singular()) return $template;
        
        /* Get the name of the post's template */
        $active_template = get_post_meta($post->ID, '_wp_page_template', true);
        
        /*
         * Check if this template is one of our plugin's templates. If it
         * isn't, return the template as-is.
         */
        if (!isset($this->templates[$active_template])) return $template;
        
        /*
         * Either use our own template, use a specific template that the user
         * set, or hook into 'the_content' if the user wants to use their
         * theme's templates
         */
        switch ($this->settings->display_sections_in()) {
            case 'plugin_template':
                return PPB_PLUGIN_DIR . '/views/' . $active_template;
                break;
            case 'custom' :
                return get_theme_directory_uri() . $this->settings->custom_template();
                break;
            default:
                add_filter('the_content', array($this, 'puzzle_page_builder_content'));
                return $template;
        }
        
    }
    
    /* Adds page builder content into 'the_content' */
    function puzzle_page_builder_content($content) {
        ob_start();
        require(PPB_PLUGIN_DIR . '/views/partials/sections.php');
        $content = ob_get_clean();
    
        return $content;
    }
}

function ppb_init_page_builder_template() {
    new PuzzlePageBuilderTemplate;
}
add_action('init', 'ppb_init_page_builder_template', 12);

?>

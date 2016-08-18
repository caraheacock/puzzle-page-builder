<?php

/*
 * Puzzle Page Builder
 * Page builder
 */

/* Adds the page builder meta box to appropriate post types */
function ppb_meta_box_admin_init() {
    $puzzle_settings = new PuzzleSettings;
    $puzzle_page_builder_post_types = $puzzle_settings->page_builder_post_types();
    
    if ($puzzle_page_builder_post_types) {
        foreach ($puzzle_page_builder_post_types as $post_type) {
            add_meta_box('puzzle_page_builder_options', 'Page Builder', 'ppb_meta_box_options', $post_type, 'normal', 'high');
        
            if ($post_type != 'page') {
                add_meta_box('puzzle_custom_template', 'Template', 'ppb_custom_post_type_template_meta_options', $post_type, 'side', 'low');
            }
        }
    }
}

/*
 * A dropdown that emulates the functionality of the template picker,
 * for post types that are not 'page' that need to use the page builder.
 */
function ppb_custom_post_type_template_meta_options() {
    global $post;
    $template = get_post_meta($post->ID, 'puzzle_custom_template', true); ?>
    <select id="puzzle_custom_template_select" name="puzzle_custom_template">
        <option value="default"<?php if ($template == 'default') echo ' selected'; ?>>Default Template</option>
        <option value="page_builder"<?php if ($template == 'page_builder') echo ' selected'; ?>>Page Builder</option>
    </select>
    <?php
}

/* Page builder markup */
function ppb_meta_box_options() {
    global $post;
    $puzzle_page_builder = new PuzzlePageBuilder;
    $puzzle_sections = (new PuzzleSections)->sections();
    
    /* Use nonce for verification */
    wp_nonce_field(plugin_basename(__FILE__), 'puzzle_page_sections_meta');
    
    $puzzle_sections_data = get_post_meta($post->ID, 'puzzle_page_sections', true);
    ?>
    <div id="puzzle-page-section-options" class="puzzle-page-section-options">
        <div class="puzzle-sections">
        <?php
        /* Loops through $puzzle_sections to create each section's options */
        if (!empty($puzzle_sections_data)) {
            foreach ($puzzle_sections_data as $s => $puzzle_section_data) {
                $puzzle_section_type = $puzzle_section_data['type'];
                
                /*
                 * Make sure the section still exists, just in case the user
                 * removes a section from the page builder but the data still
                 * exists in the post_meta.
                 */
                if (!array_key_exists($puzzle_section_type, $puzzle_sections)) continue;
                
                $puzzle_options_data = $puzzle_section_data['options'];
                $puzzle_columns_data = (!empty($puzzle_section_data['columns']) ? $puzzle_section_data['columns'] : NULL);
                $puzzle_section = $puzzle_sections[$puzzle_section_type];
                
                echo $puzzle_page_builder->admin_section_markup($puzzle_section, $s, $puzzle_options_data, $puzzle_columns_data);
            }
        }
        ?>
        </div>
        
        <input id="using-page-builder" name="using_page_builder" type="hidden" value="0" />
    </div>
    
    <div class="puzzle-text-editor-area puzzle-pop-up-area">
        <?php wp_editor('', 'puzzlecustomeditor'); ?>
        <div class="puzzle-pop-up-controls">
            <button class="puzzle-button" id="puzzle-update-content">Update and Close <i class="fa fa-save"></i></button>
            <button class="puzzle-button" id="puzzle-cancel-editor">Cancel <i class="fa fa-close"></i></button>
        </div>
    </div>
    
    <script>
        var $ = jQuery.noConflict(),
            $document = $(document),
            sectionCount = <?php echo $s ?>;
        
        /* Add section */
        $document.on('click', '.puzzle-add-section-button', function(e) {
            e.preventDefault();
            
            var $t = $(this),
                markup = '',
                sectionType = $t.data('type'),
                insertLocation = $t.data('insert');
            
            switch (sectionType) {
                <?php foreach ($puzzle_sections as $puzzle_section) : ?>
                case ('<?php echo $puzzle_section->slug(); ?>') :
                    markup = '<?php echo $puzzle_page_builder->admin_section_markup($puzzle_section, '\'+sectionCount+\'') ?>';
                    break;
                <?php endforeach; ?>
            }
            
            if (insertLocation === 'before') {
                $t.closest('.puzzle-add-section, .puzzle-section').before(markup);
            } else {
                $t.closest('.puzzle-add-section, .puzzle-section').after(markup);
            }
            
            $('.puzzle-add-section-buttons, .puzzle-has-dropdown ul').removeClass('show');
            sectionCount++;
        });
        
        /* Add column */
        $document.on('click', '.puzzle-add-column-button', function(e) {
            e.preventDefault();
            
            var $t = $(this),
                markup = '',
                $thisSection = $t.parents('.puzzle-section'),
                thisSectionCount = $thisSection.data('id'),
                columnCount = $thisSection.find('.puzzle-page-builder-column').length,
                sectionType = $t.data('type'),
                insertLocation = $t.data('insert');
            
            switch (sectionType) {
                <?php foreach ($puzzle_sections as $puzzle_section) :
                    if ($puzzle_section->has_unlimited_columns()) :
                    ?>
                case ('<?php echo $puzzle_section->slug(); ?>') :
                    markup = '<?php echo $puzzle_page_builder->column_markup($puzzle_section, '\'+thisSectionCount+\'', '\'+columnCount+\''); ?>';
                    break;
                    <?php
                    endif;
                endforeach;
                ?>
            }
            
            if (insertLocation === 'before') {
                $t.closest('.puzzle-page-builder-column').before(markup);
            } else if (insertLocation === 'end') {
                $thisSection.find('.puzzle-columns-area').append(markup);
            } else {
                $t.closest('.puzzle-page-builder-column').after(markup);
            }
            
            $('.puzzle-has-dropdown ul').removeClass('show');
            
            $('.puzzle-color-field').wpColorPicker();
            return false;
        });
    </script>
<?php
}

/* Save the page builder content */
function ppb_save_options() {
    global $post;
    
    /* Saves the template for custom post types that enable the page builder */
    if (!empty($post) && !empty($_POST['puzzle_custom_template'])) {
        update_post_meta($post->ID, 'puzzle_custom_template', $_POST['puzzle_custom_template']);
    }
    
    if (!empty($post) && !empty($_POST['using_page_builder']) && $_POST['using_page_builder'] == 1) {
        $post_id = $post->ID;
        
        /*
         * Verify if this is an auto save routine. If it is, our form has not
         * been submitted, so we don't want to do anything.
         */
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        
        /*
         * Verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times
         */
        if (!isset($_POST['puzzle_page_sections_meta'])) return;
        
        /* Use nonce for verification */
        if (!wp_verify_nonce($_POST['puzzle_page_sections_meta'], plugin_basename(__FILE__))) return;
        
        /* Reset the section keys in case the user has rearranged them */
        $puzzle_sections_data = array_values($_POST['puzzle_page_sections']);
        
        /* Save the page builder fields as post meta */
        update_post_meta($post_id, 'puzzle_page_sections', $puzzle_sections_data);
        
        /*
         * Save the content in the page builder to the actual post content.
         * This is so the user isn't locked into this plugin because all the
         * content is in the post meta.
         */
        $puzzle_page_builder = new PuzzlePageBuilder;
        $content = $puzzle_page_builder->saveable_content($puzzle_sections_data);

        if (!wp_is_post_revision($post_id)) {
            /* Unhook this function so it doesn't loop infinitely */
            remove_action('save_post', 'ppb_save_options');
            
            /*
             * Update the post with the content from the page builder, which
             * calls save_post again
             */
            $args = array(
                'ID'            => $post_id,
                'post_content'  => $content
            );
            wp_update_post($args);

            /* Re-hook the function */
            add_action('save_post', 'ppb_save_options');
        }
    }
}

add_action('admin_init', 'ppb_meta_box_admin_init');
add_action('save_post', 'ppb_save_options');

?>

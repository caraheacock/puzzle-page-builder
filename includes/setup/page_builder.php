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
    $template = get_post_meta($post->ID, '_puzzle_custom_template', true); ?>
    <select id="puzzle_custom_template_select" name="_puzzle_custom_template">
        <option value="default"<?php if ($template == 'default') echo ' selected'; ?>>Default Template</option>
        <option value="template_page_builder.php"<?php if ($template == 'template_page_builder.php') echo ' selected'; ?>>Page Builder</option>
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
    
    $puzzle_sections_data = get_post_meta($post->ID, '_puzzle_page_sections', true);
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
        } else {
            $s = 0;
            echo $puzzle_page_builder->add_new_section_buttons_markup();
        }
        ?>
        </div>
        
        <input id="using-puzzle-page-builder" name="using_puzzle_page_builder" type="hidden" value="0" />
    </div>
    
    <div class="puzzle-text-editor-area puzzle-pop-up-area">
        <?php wp_editor('', 'puzzlecustomeditor'); ?>
        <div class="puzzle-pop-up-controls">
            <button class="puzzle-button" id="puzzle-update-content">Update and Close <i class="ei ei-floppy"></i></button>
            <button class="puzzle-button" id="puzzle-cancel-editor">Cancel <i class="ei ei-close-alt"></i></button>
        </div>
    </div>
    
    <script>
        var $ = jQuery.noConflict(),
            $document = $(document),
            sectionCount = <?php echo $s + 1; ?>;
        
        /* Indicates a new section visually */
        var highlightSection = function($newSection) {
            $newSection.addClass('new');
            setTimeout(function() {
                $newSection.removeClass('new');
            }, 1000);
        };
        
        /* Add section */
        $document.on('click', '.puzzle-add-section-button', function(e) {
            e.preventDefault();
            
            var $t = $(this),
                $targetSection = $t.closest('.puzzle-section'),
                $newSection = '',
                sectionType = $t.data('type'),
                insertLocation = $t.data('insert'),
                isCopy = $t.data('copy');
            
            /* Set section markup */
            
            /*
             * If the new section is a copy, clone the old section and update
             * the section ID numbers in the input field names.
             */
            if (isCopy) {
                $newSection = $targetSection.clone();
                $newSection.attr('data-id', sectionCount);
                $newSection.find('input, select, textarea').each(function() {
                    var oldName = $(this).attr('name');
                    var newName = oldName.replace(/([^\]]\[)(\d+)(\])/, '$1' + sectionCount + '$3');
                    $(this).attr('name', newName);
                });
            /* Else use markup for a new section */
            } else {
                switch (sectionType) {
                    <?php foreach ($puzzle_sections as $puzzle_section) : ?>
                    case '<?php echo $puzzle_section->slug(); ?>':
                        $newSection = $('<?php echo $puzzle_page_builder->admin_section_markup($puzzle_section, '\'+sectionCount+\'') ?>');
                        break;
                    <?php endforeach; ?>
                }
            }
            
            /* Insert in the desired location */
            if (insertLocation === 'before') {
                $targetSection.before($newSection);
            } else {
                if ($targetSection.length === 0) {
                    $targetSection = $t.closest('.puzzle-add-section');
                }
                
                $targetSection.after($newSection);
            }
            
            /* Close dropdowns */
            $('.puzzle-add-section-buttons, .puzzle-has-dropdown ul').removeClass('show');
            
            /* Animate the new section */
            highlightSection($newSection.find('.puzzle-section-content'));
            
            /*
             * Re-init WordPress color picker just in case color fields
             * are present
             */
            $('.puzzle-color-field').wpColorPicker();
            
            /* Increment the section counter */
            sectionCount++;
            
            return false;
        });
        
        /* Add column */
        $document.on('click', '.puzzle-add-column-button', function(e) {
            e.preventDefault();
            
            var $t = $(this),
                $targetColumn = $t.closest('.puzzle-page-builder-column'),
                $newColumn = '',
                $thisSection = $t.parents('.puzzle-section'),
                thisSectionCount = $thisSection.data('id'),
                sectionType = $t.data('type'),
                insertLocation = $t.data('insert'),
                isCopy = $t.data('copy');
            
            /* Get the next number for the column */
            var columnIDs = $thisSection.find('.puzzle-page-builder-column').map(function() {
                return $(this).data('id');
            }).get();
            var columnCount = Math.max.apply(null, columnIDs);
            columnCount++;
            
            /* Set column markup */
            
            /*
             * If the new column is a copy, clone the old column and update
             * the column ID numbers in the input field names.
             */
            if (isCopy) {
                $newColumn = $targetColumn.clone();
                $newColumn.attr('data-id', columnCount);
                $newColumn.find('input, select, textarea').each(function() {
                    var oldName = $(this).attr('name');
                    var newName = oldName.replace(/(\]\[)(\d+)(\])/, '$1' + columnCount + '$3');
                    $(this).attr('name', newName);
                });
            /* Else use markup for a new column */
            } else {
                switch (sectionType) {
                    <?php
                    foreach ($puzzle_sections as $puzzle_section) :
                        if ($puzzle_section->has_unlimited_columns()) :
                        ?>
                    case '<?php echo $puzzle_section->slug(); ?>':
                        $newColumn = $('<?php echo $puzzle_page_builder->column_markup($puzzle_section, '\'+thisSectionCount+\'', '\'+columnCount+\''); ?>');
                        break;
                        <?php
                        endif;
                    endforeach;
                    ?>
                }
            }
            
            /* Insert in the desired location */
            switch (insertLocation) {
                case 'before':
                    $targetColumn.before($newColumn);
                    break;
                case 'end':
                    $thisSection.find('.puzzle-columns-area').append($newColumn);
                    break;
                default:
                    $targetColumn.after($newColumn);
                    break;
            }
            
            /* Close dropdowns */
            $('.puzzle-has-dropdown ul').removeClass('show');
            
            /* Animate the new section */
            highlightSection($newColumn.find('.column-inner'));
            
            /*
             * Re-init WordPress color picker just in case color fields
             * are present
             */
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
    if (!empty($post) && isset($_POST['_puzzle_custom_template'])) {
        update_post_meta($post->ID, '_puzzle_custom_template', $_POST['_puzzle_custom_template']);
    }
    
    if (!empty($post) && !empty($_POST['using_puzzle_page_builder']) && $_POST['using_puzzle_page_builder'] == 1) {
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
        $puzzle_sections_data = array();
        
        if (!empty($_POST['_puzzle_page_sections'])) {
            $puzzle_sections_data = array_values($_POST['_puzzle_page_sections']);
        }
        
        /* Save the page builder fields as post meta */
        update_post_meta($post_id, '_puzzle_page_sections', $puzzle_sections_data);
        
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

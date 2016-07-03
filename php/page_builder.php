<?php

/*
 * Puzzle Page Builder
 * Page builder
 */

/* Adds the page builder meta box to appropriate post types */
function puzzle_page_builder_admin_init() {
    $puzzle_page_builder = new PuzzlePageBuilder;
    $puzzle_page_builder_post_types = $puzzle_page_builder->page_builder_post_types();
    
    if ($puzzle_page_builder_post_types) {
        foreach ($puzzle_page_builder_post_types as $post_type) {
            add_meta_box('page_builder_options', 'Page Builder', 'puzzle_page_builder_meta_options', $post_type, 'normal', 'high');
        
            if ($post_type != 'page') {
                add_meta_box('puzzle_custom_template', 'Template', 'puzzle_custom_post_type_template_meta_options', $post_type, 'side', 'low');
            }
        }
    }
}

/*
 * A dropdown that emulates the functionality of the template picker,
 * for post types that are not 'page' that need to use the page builder.
 */
function puzzle_custom_post_type_template_meta_options() {
    global $post;
    $template = get_post_meta($post->ID, 'puzzle_custom_template', true); ?>
    <select id="puzzle_custom_template_select" name="puzzle_custom_template">
        <option value="default"<?php if ($template == 'default') echo ' selected'; ?>>Default Template</option>
        <option value="page_builder"<?php if ($template == 'page_builder') echo ' selected'; ?>>Page Builder</option>
    </select>
    <?php
}

function puzzle_page_builder_meta_options() {
    global $post;
    $puzzle_page_builder = new PuzzlePageBuilder;
    $puzzle_sections = $puzzle_page_builder->sections();
    
    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'puzzle_page_sections_meta');
    
    $puzzle_sections_data = get_post_meta($post->ID, 'puzzle_page_sections', true);
    $s = 0;
    ?>
    <div id="puzzle-page-section-options">
        <div class="puzzle-sections">
        <?php
        // Loops through $puzzle_sections to create each section's options
        if (!empty($puzzle_sections_data)) {
            foreach ($puzzle_sections_data as $puzzle_section_data) {
                $puzzle_options_data = $puzzle_section_data['options'];
                $puzzle_columns_data = (!empty($puzzle_section_data['columns']) ? $puzzle_section_data['columns'] : NULL);
                $puzzle_section_type = $puzzle_section_data['type'];
                $puzzle_show = $puzzle_section_data['show'];
                $puzzle_section = $puzzle_sections[$puzzle_section_type];

                echo $puzzle_page_builder->admin_section_markup($puzzle_section, $s, $puzzle_options_data, $puzzle_columns_data, $puzzle_show);
                $s++;
            }
        }
        ?>
        </div>

        <div class="choose-section-area">
            <h2>Add Section</h2>
            
            <?php
            // Loops through the $puzzle_sections to create buttons
            foreach ($puzzle_sections as $puzzle_section) : ?>
            <a class="button puzzle-add-section puzzle-add-<?php echo $puzzle_section->get_group_name_slug(); ?>" href="#"><?php echo $puzzle_section->get_group_name(); ?></a>
            <?php endforeach; ?>
        </div>
        
        <input id="using-page-builder" name="using_page_builder" type="hidden" value="0" />
    </div>
    
    <div id="puzzle-text-editor-area" class="puzzle-pop-up-area">
        <?php wp_editor('', 'puzzlecustomeditor'); ?>
        <div class="puzzle-pop-up-controls">
            <a class="button" href="#" id="puzzle-update-content">Update and Close <i class="fa fa-save"></i></a>
            <a class="button" href="#" id="puzzle-cancel-editor">Cancel <i class="fa fa-close"></i></a>
        </div>
    </div>
    
    <script>
        var $ = jQuery.noConflict();
        $(document).ready(function() {
            var $document = $(document),
                sectionCount = <?php echo $s ?>;
            
            // Add a section
            <?php foreach ($puzzle_sections as $puzzle_section) : ?>
            $document.on('click', '.puzzle-add-<?php echo $puzzle_section->get_group_name_slug(); ?>', function(e) {
                e.preventDefault();
                var $t = $(this);
                
                $('.puzzle-sections').append('<?php echo $puzzle_page_builder->admin_section_markup($puzzle_section, '\'+sectionCount+\'') ?>');
                sectionCount++;
            });
            <?php endforeach; ?>
            
            // Add a column
            $document.on('click', '.puzzle-add-column', function(e) {
                e.preventDefault();
                
                var $t = $(this),
                    $thisSection = $t.parents('.puzzle-section'),
                    sectionType = $thisSection.find('.puzzle-section-type-field').val(),
                    $addedColumns = $thisSection.find('.added-columns'),
                    sectionCount = $thisSection.find('.puzzle-section-type-field').attr('name').match(/\[([0-9]+)\]/)[1],
                    columnCount = $addedColumns.children('.column').length;
                <?php
                $first_statement = true;
                
                foreach ($puzzle_sections as $puzzle_section) :
                    if ($puzzle_section->has_multiple()) : ?>
                        <?php if ($first_statement == false) echo ' else '; ?>if (sectionType === '<?php echo $puzzle_section->get_group_name_slug(); ?>') {
                            $addedColumns.append('<?php echo $puzzle_page_builder->admin_column_markup($puzzle_section, '\'+sectionCount+\'', '\'+columnCount+\''); ?>');
                            $('.color-field').wpColorPicker();
                        }
                    <?php
                        if ($first_statement == true) {
                            $first_statement = false;
                        }
                    endif;
                endforeach;
                ?>
                return false;
            });
        });
    </script>
<?php
}

function puzzle_page_builder_save_options() {
    global $post;
    
    // Saves the template for custom post types that enable the page builder
    if (!empty($post) && !empty($_POST['puzzle_custom_template'])) {
        update_post_meta($post->ID, 'puzzle_custom_template', $_POST['puzzle_custom_template']);
    }
    
    if (!empty($post) && !empty($_POST['using_page_builder']) && $_POST['using_page_builder'] == 1) {
        $post_id = $post->ID;
        
        // Verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
    
        // Verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if (!isset($_POST['puzzle_page_sections_meta'])) {
            return;
        }
        
        // Use nonce for verification
        if (!wp_verify_nonce($_POST['puzzle_page_sections_meta'], plugin_basename(__FILE__))) {
            return;
        }

        // Save the page builder fields as post meta
        update_post_meta($post_id, 'puzzle_page_sections', $_POST['puzzle_page_sections']);
        
        // Save the content in the page builder to the actual post content.
        // This is so the user isn't locked into this theme because all the
        // content is in the post meta.
        $puzzle_page_builder = new PuzzlePageBuilder;
        
        $puzzle_sections_data = get_post_meta($post->ID, 'puzzle_page_sections', true);
        $content = $puzzle_page_builder->saveable_content($puzzle_sections_data);

        if (!wp_is_post_revision($post_id)) {
            // Unhook this function so it doesn't loop infinitely
            remove_action('save_post', 'puzzle_page_builder_save_options');

            // Update the post with the content from the page builder, which
            // calls save_post again
            $args = array(
                'ID'            => $post_id,
                'post_content'  => $content
            );
            wp_update_post($args);

            // Re-hook the function
            add_action('save_post', 'puzzle_page_builder_save_options');
        }
    }
}

add_action('admin_init', 'puzzle_page_builder_admin_init');
add_action('save_post', 'puzzle_page_builder_save_options');

?>
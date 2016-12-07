<?php

/*
 * Puzzle Page Builder
 * Icon Library
 */

if (!defined('ABSPATH')) exit;

/* Add hidden icon library */
function ppb_admin_init_icon_library() {
    $puzzle_settings = new PuzzleSettings;
    if (!$puzzle_settings->has_icon_library()) return;
    
    $puzzle_page_builder_post_types = $puzzle_settings->page_builder_post_types();
    
    if ($puzzle_page_builder_post_types) {
        foreach ($puzzle_page_builder_post_types as $post_type) {
            add_meta_box('puzzle_icon_library', 'Icon Library', 'ppb_meta_options_icon_library', $post_type, 'normal', 'low');
        }
    }
}
add_action('admin_init', 'ppb_admin_init_icon_library');

function ppb_meta_options_icon_library() {
    $puzzle_icon_libraries = new PuzzleIconLibraries;
    ?>
    <div class="puzzle-icon-library puzzle-pop-up-area">
        <div class="puzzle-icon-library-inner">
            <h1><?php _e('Icon Library', 'puzzle-page-builder'); ?></h1>
            <input class="puzzle-icon-library-search" placeholder="<?php _e('Search icons', 'puzzle-page-builder'); ?>" />
            
            <?php if ($puzzle_icon_libraries->has_choice_none()) : ?>
            <hr />
            <div class="icon-molecule"><i class="no-icon"></i><strong>x</strong> <span class="icon-description"><?php _e('No Icon', 'puzzle-page-builder'); ?></span></div>
            <?php endif; ?>
            
            <?php echo $puzzle_icon_libraries->markup(); ?>
        </div>
        <div class="puzzle-pop-up-controls">
            <button class="puzzle-button puzzle-cancel-icon" href="#"><?php _e('Cancel', 'puzzle-page-builder'); ?> <i class="ei ei-close-alt" aria-hidden="true"></i></button>
        </div>
    </div>
<?php } ?>

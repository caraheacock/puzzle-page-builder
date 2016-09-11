<?php

/*
 * Puzzle Page Builder
 * Icon Library
 */

/* Construct the HTML for the icon choices */
function ppb_icon_library($library) {
    $icon_list = '';
    foreach ($library['icons'] as $icon) {
        $icon_list .= '<div class="icon-molecule"><i class="' . $library['icon_class'] . ' ' . $library['icon_prefix'] . $icon . '"></i> <span class="icon-description">' . $icon . '</span></div>';
    }
    
    return $icon_list;
}

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
            <h1>Icon Library</h1>
            <input class="puzzle-icon-library-search" placeholder="Search icons" />
            
            <?php if ($puzzle_icon_libraries->has_choice_none()) : ?>
            <hr />
            <div class="icon-molecule"><i class="no-icon"></i><strong>x</strong> <span class="icon-description">No Icon</span></div>
            <?php endif; ?>
            
            <?php echo $puzzle_icon_libraries->markup(); ?>
        </div>
        <div class="puzzle-pop-up-controls">
            <a class="puzzle-button puzzle-cancel-icon" href="#">Cancel <i class="fa fa-close"></i></a>
        </div>
    </div>
<?php } ?>

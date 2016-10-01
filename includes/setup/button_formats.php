<?php

/*
 * Puzzle Page Builder
 * Button styles dropdown in WYSIWYG editor
 */

/* Insert WordPress Format dropdown */
function ppb_mce_buttons($buttons) {
    $puzzle_settings = new PuzzleSettings;
    
    if ($puzzle_settings->has_button_formats() && !in_array('styleselect', $buttons)) {
        array_unshift($buttons, 'styleselect');
    }
    return $buttons;
}
add_filter('mce_buttons_2', 'ppb_mce_buttons', 11);

/* Add button style options */
function ppb_insert_button_formats($init_array) {
    $puzzle_settings = new PuzzleSettings;
    if (!$puzzle_settings->has_button_formats()) return $init_array;
    
    $style_formats = array(
        array(
            'title'     => 'Default Button',
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'puzzle-button'
        ),
        array(
            'title'     => 'Secondary Color Button',
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'puzzle-button puzzle-button-secondary'
        ),
        array(
            'title'     => 'White Button',
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'puzzle-button puzzle-button-white'
        ),
        array(
            'title'     => 'Black Button',
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'puzzle-button puzzle-button-black'
        ),
        array(
            'title'     => 'Transparent Button',
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'puzzle-button puzzle-button-transparent'
        )
    );
    
    // Insert the array, JSON ENCODED, into 'style_formats'
    if (empty($init_array['style_formats'])) {
        $init_array['style_formats'] = json_encode($style_formats);
    } else {
        $old_style_formats = json_decode($init_array['style_formats']);
        $new_style_formats = json_encode(array_merge($old_style_formats, $style_formats));
        $init_array['style_formats'] = $new_style_formats;
    }
    
    return $init_array;
}
add_filter('tiny_mce_before_init', 'ppb_insert_button_formats', 11);

?>

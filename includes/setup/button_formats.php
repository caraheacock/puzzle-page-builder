<?php

/*
 * Puzzle Page Builder
 * Button styles dropdown in WYSIWYG editor
 */

if (!defined('ABSPATH')) exit;

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
            'title'     => __('Default Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button'
        ),
        array(
            'title'     => __('Secondary Color Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-secondary'
        ),
        array(
            'title'     => __('White Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-white'
        ),
        array(
            'title'     => __('Light Gray Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-light-gray'
        ),
        array(
            'title'     => __('Medium Gray Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-medium-gray'
        ),
        array(
            'title'     => __('Dark Gray Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-dark-gray'
        ),
        array(
            'title'     => __('Black Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-black'
        ),
        array(
            'title'     => __('Outline Only Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-outline'
        ),
        array(
            'title'     => __('Small Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-small'
        ),
        array(
            'title'     => __('Large Button', 'puzzle-page-builder'),
            'inline'    => 'a',
            'selector'  => 'a',
            'classes'   => 'pz-button pz-button-large'
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

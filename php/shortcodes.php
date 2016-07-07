<?php

/*
 * Puzzle Page Builder
 * Shortcodes
 */

$puzzle_settings = new PuzzleSettings;

if ($puzzle_settings->has_shortcodes()) {
    add_shortcode('puzzle_button', 'ppb_button_shortcode');
    add_action('init', 'ppb_add_tinymce_buttons');
    add_filter('tiny_mce_version', 'ppb_refresh_mce');
    add_action('admin_init', 'ppb_admin_init_shortcode_meta_box');
}

// Add puzzle button shortcode
function ppb_button_shortcode($atts) {
    $a = shortcode_atts(array(
        'color'                 => 'primary-color',
        'icon'                  => 'false',
        'link'                  => '#',
        'open_link_in_new_tab'  => 'false',
        'text'                  => 'Click Here'
    ), $atts);
    
    $icon_class = (($a['icon'] == 'true') ? ' puzzle-button-has-icon' : '');
    
    $open_link_in_new_tab = (($a['open_link_in_new_tab'] == 'true') ? ' target="_blank"' : '');
        
    $output  = '<a class="puzzle-button puzzle-button-' . $a['color'] . $icon_class . '"';
    $output .= ' href="' . $a['link'] . '"';
    $output .= $open_link_in_new_tab . '>';
    $output .= $a['text'];
    $output .= '</a>';
    
    return $output;
}

// Add puzzle button shortcode button to WYSIWYG editor
function ppb_add_tinymce_buttons() {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;
    
    if (get_user_option('rich_editing') == 'true') {
        add_filter('mce_external_plugins', 'ppb_add_custom_tinymce_js');
        add_filter('mce_buttons', 'ppb_register_buttons');
    }
}

function ppb_register_buttons($buttons) {
    array_push($buttons, "|", "puzzlebutton");
    return $buttons;
}

function ppb_add_custom_tinymce_js($plugin_array) {
    $plugin_array['puzzlebutton'] = plugin_dir_url(dirname(__FILE__)) . 'assets/js/custom-tinymce.js';
    return $plugin_array;
}

function ppb_refresh_mce($ver) {
    $ver += 3;
    return $ver;
}

// Add hidden forms for WYSIWYG shortcode buttons
function ppb_admin_init_shortcode_meta_box() {
    add_meta_box('puzzle_shortcode_forms', 'Puzzle Shortcode Forms', 'ppb_shortcode_meta_box_options', 'page', 'normal', 'low');
    add_meta_box('puzzle_shortcode_forms', 'Puzzle Shortcode Forms', 'ppb_shortcode_meta_box_options', 'post', 'normal', 'low');
}

function ppb_shortcode_meta_box_options() { ?>
    <div id="puzzle-insert-button-shortcode-area" class="puzzle-pop-up-area">
        <div class="puzzle-insert-shortcode-inner">
            <h4>Insert Button Shortcode</h4>
            <form>
                <p>
                    Color<br />
                    <select id="puzzle-insert-button-color" name="puzzle-button-color">
                        <option value="white">White</option>
                        <option value="black">Black</option>
                        <option value="primary-color" selected>Primary Color</option>
                        <option value="secondary-color">Secondary Color</option>
                        <option value="transparent">Transparent</option>
                    </select>
                </p>
                <p>
                    Text<br />
                    <input id="puzzle-insert-button-text" name="puzzle-insert-button-text" type="text" />
                </p>
                <p>
                    Link<br />
                    <input id="puzzle-insert-button-link" name="puzzle-insert-button-link" placeholder="http://" type="text" />
                </p>
                <p>
                    <input id="puzzle-insert-button-icon" name="puzzle-insert-button-icon" type="checkbox" /> Include Icon
                </p>
                <p>
                    <input id="puzzle-insert-button-new-tab" name="puzzle-insert-button-new-tab" type="checkbox" /> Open link in new tab
                </p>
                <a class="button" id="puzzle-insert-button-submit" href="#">Insert Shortcode</a>
                <a class="button" id="puzzle-insert-button-cancel" href="#">Cancel</a>
            </form>
        </div>
    </div>
    <?php
}
?>

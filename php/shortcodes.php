<?php

/*
 * Puzzle Page Builder
 * Shortcodes
 */

$puzzle_page_builder = new PuzzlePageBuilder;

if ($puzzle_page_builder->has_shortcodes()) {
    add_shortcode('puzzle_button', 'pzp_button_shortcode');
    add_action('init', 'add_puzzle_btns');
    add_filter('tiny_mce_version', 'my_refresh_mce');
    add_action('admin_init', 'admin_init_puzzle_shortcode_forms');
}

// Add Puzzle button shortcode
function pzp_button_shortcode($atts) {
    $a = shortcode_atts(array(
        'color'                 => 'primary-color',
        'icon'                  => 'false',
        'link'                  => '#',
        'open_link_in_new_tab'  => 'false',
        'text'                  => 'Click Here'
    ), $atts);
    
    $icon_class = '';
    if ($a['icon'] == 'true') {
        $icon_class = ' puzzle-button-has-icon';
    }
    
    $open_link_in_new_tab = '';
    if ($a['open_link_in_new_tab'] == 'true') {
        $open_link_in_new_tab = 'target="_blank"';
    }
        
    $output  = '<a class="puzzle-button puzzle-button-' . $a['color'] . $icon_class . '"';
    $output .= ' href="' . $a['link'] . '"';
    $output .= ' ' . $open_link_in_new_tab . '>';
    $output .= $a['text'];
    $output .= '</a>';
    
    return $output;
}

// Add Puzzle button shortcode button to WYSIWYG editor
function add_puzzle_btns() {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
        return;
    if (get_user_option('rich_editing') == 'true') {
        add_filter('mce_external_plugins', 'add_puzzle_custom_tinymce_js');
        add_filter('mce_buttons', 'register_puzzle_btns');
    }
}

function register_puzzle_btns($buttons) {
    array_push($buttons, "|", "puzzlebutton");
    return $buttons;
}

function add_puzzle_custom_tinymce_js($plugin_array) {
    $plugin_array['puzzlebutton'] = get_template_directory_uri() . '/puzzle_pieces/assets/js/custom-tinymce.js';
    return $plugin_array;
}

function my_refresh_mce($ver) {
    $ver += 3;
    return $ver;
}

// Add hidden forms for WYSIWYG shortcode buttons
function admin_init_puzzle_shortcode_forms() {
    add_meta_box('puzzle_shortcode_forms', 'Puzzle Shortcode Forms', 'meta_options_puzzle_shortcode_forms', 'page', 'normal', 'low');
    add_meta_box('puzzle_shortcode_forms', 'Puzzle Shortcode Forms', 'meta_options_puzzle_shortcode_forms', 'post', 'normal', 'low');
}

function meta_options_puzzle_shortcode_forms() { ?>
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
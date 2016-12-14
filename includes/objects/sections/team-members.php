<?php
if (!defined('ABSPATH')) exit;

$team_members = new PuzzleSection(array(
    'name'                  => __('Team Members', 'puzzle-page-builder'),
    'single_name'           => __('Team Member', 'puzzle-page-builder'),
    'columns_num'           => -1,
    'admin_column_width'    => 4,
    'order'                 => 50,
    'column_fields'         => array(
        $f->field('subhead')
            ->set_name(__('Name', 'puzzle-page-builder'))
            ->set_id('name'),
        new PuzzleField(array(
            'name'          => __('Title', 'puzzle-page-builder'),
            'id'            => 'title',
            'input_type'    => 'text',
            'save_as'       => 'h5'
        )),
        $f->field('image'),
        $f->field('content'),
        new PuzzleField(array(
            'name'          => __('Phone', 'puzzle-page-builder'),
            'id'            => 'phone',
            'input_type'    => 'text',
            'save_as'       => 'content'
        )),
        new PuzzleField(array(
            'name'          => __('Email Address', 'puzzle-page-builder'),
            'id'            => 'email',
            'input_type'    => 'text',
            'placeholder'   => 'person@example.com',
            'save_as'       => 'content'
        )),
        new PuzzleField(array(
            'name'          => __('Facebook Link', 'puzzle-page-builder'),
            'id'            => 'facebook',
            'input_type'    => 'text',
            'placeholder'   => 'https://www.facebook.com/johndoe',
            'save_as'       => 'link'
        )),
        new PuzzleField(array(
            'name'          => __('Twitter Link', 'puzzle-page-builder'),
            'id'            => 'twitter',
            'input_type'    => 'text',
            'placeholder'   => 'https://twitter.com/johndoe',
            'save_as'       => 'link'
        )),
        new PuzzleField(array(
            'name'          => __('LinkedIn Link', 'puzzle-page-builder'),
            'id'            => 'linkedin',
            'input_type'    => 'text',
            'placeholder'   => 'https://www.linkedin.com/in/johndoe',
            'save_as'       => 'link'
        ))
    ),
    'option_fields'         => array(
        $f->field('headline')->set_width(6),
        $f->field('id')->set_width(6),
        $f->field('layout')->set_width(3),
        $f->field('padding_top')->set_width(3),
        $f->field('padding_bottom')->set_width(3),
        $f->field('text_color_scheme')->set_width(3),
        $f->field('background_image')->set_width(6),
        $f->field('background_color')->set_width(6),
        $f->field('overlay'),
        $f->field('main_content')
    )
));

$puzzle_sections->add_section($team_members);
?>

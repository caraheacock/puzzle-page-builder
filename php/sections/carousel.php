<?php
$carousel = new PuzzleSection;
$carousel->set_name('Carousel')
    ->set_single_name('Slide')
    ->set_multiple(true)
    ->set_admin_column_classes('xs-span12 sm-span4 md-span6 lg-span4')
    ->set_order(0)
    ->set_markup_attr(array(
        'background_image'  => array(
            'name'          => 'Background Image',
            'input_type'    => 'image'
        ),
        'background_color'  => array(
            'name'          => 'Background Color',
            'input_type'    => 'select',
            'options'       => array(
                'White'             => 'white',
                'Gray'              => 'gray',
                'Primary Color'     => 'primary',
                'Secondary Color'   => 'secondary'
            )
        ),
        'overlay'           => array(
            'name'          => 'Overlay background color on background image',
            'input_type'    => 'checkbox'
        ),
        'align_text'        => array(
            'name'          => 'Align Text',
            'input_type'    => 'select',
            'options'       => array(
                'Center'    => 'center',
                'Left'      => 'left',
                'Right'     => 'right'
            )
        ),
        'headline'          => array(
            'name'          => 'Headline',
            'input_type'    => 'text',
            'save_as'       => 'h2'
        ),
        'headline_color'    => array(
            'name'          => 'Headline Color',
            'width'         => 'xs-span6',
            'input_type'    => 'select',
            'options'       => array(
                'Default Headline Color'    => 'default',
                'White'                     => 'white',
                'Black'                     => 'black',
                'Primary Color'             => 'primary-color',
                'Secondary Color'           => 'secondary-color'
            )
        ),
        'headline_background_color' => array(
            'name'          => 'Headline BG Color',
            'width'         => 'xs-span6',
            'input_type'    => 'select',
            'options'       => array(
                'Black'             => 'black',
                'White'             => 'white',
                'Primary Color'     => 'primary-color',
                'Secondary Color'   => 'secondary-color',
                'None'              => 'transparent'
            )
        ),
        'tagline'           => array(
            'name'          => 'Tagline',
            'input_type'    => 'text',
            'save_as'       => 'h3'
        ),
        'tagline_color' => array(
            'name'          => 'Tagline Color',
            'width'         => 'xs-span6',
            'input_type'    => 'select',
            'options'       => array(
                'Default Headline Color'    => 'default',
                'White'                     => 'white',
                'Black'                     => 'black',
                'Primary Color'             => 'primary-color',
                'Secondary Color'           => 'secondary-color'
            )
        ),
        'tagline_background_color'  => array(
            'name'          => 'Tagline BG Color',
            'width'         => 'xs-span6',
            'input_type'    => 'select',
            'options'       => array(
                'Black'             => 'black',
                'White'             => 'white',
                'Primary Color'     => 'primary-color',
                'Secondary Color'   => 'secondary-color',
                'None'              => 'transparent'
            )
        ),
        'content'       => array(
            'name'          => 'Content',
            'input_type'    => 'textarea',
            'rows'          => 5,
            'save_as'       => 'content'
        )
    ))
    ->set_options(array(
        'id'                => array(
            'name'          => 'Section Slug',
            'width'         => 'xs-span12 sm-span6 sm-left3 sm-right3',
            'tip'           => '<strong>Use this for linking directly to a section. Lowercase letters, numbers, dashes, and underscores only.</strong> If left blank, the section slug will be "section-n" where "n" is the place that the section is in on the page (e.g. the 4th section on the page will be "section-4").',
            'input_type'    => 'text'
        ),
        'speed'         => array(
            'name'          => 'Slider Speed',
            'width'         => 'xs-span12 sm-span6 sm-left3 sm-right3',
            'tip'           => 'Enter in milliseconds, or "false" if you do not want the slider to play automatically. Defaults to 10000 (10 seconds between each slide) if left blank.',
            'input_type'    => 'text',
            'placeholder'   => '10000'
        ),
        'hide_arrows'   => array(
            'name'          => 'Hide Arrows',
            'width'         => 'xs-span12 sm-span6 sm-left3 sm-right3',
            'input_type'    => 'checkbox'
        ),
        'hide_pagination'   => array(
            'name'          => 'Hide Pagination',
            'width'         => 'xs-span12 sm-span6 sm-left3 sm-right3',
            'input_type'    => 'checkbox'
        )
    ));

$puzzle_sections = new PuzzleSections;
$puzzle_sections->add_section($carousel);
?>

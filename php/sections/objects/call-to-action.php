<?php
$cta = new PuzzleSection;
$cta->set_name('Call to Action')
    ->set_single_name('Call to Action')
    ->set_fixed_column_num(1)
    ->set_admin_column_classes('xs-span12')
    ->set_order(70)
    ->set_markup_attr(array(
        'headline'          => array(
            'name'          => 'Headline',
            'input_type'    => 'text',
            'save_as'       => 'h2'
        ),
        'content'           => array(
            'name'          => 'Content',
            'input_type'    => 'textarea',
            'rows'          => 5,
            'save_as'       => 'content'
        ),
        'button_text'       => array(
            'name'          => 'Button Text',
            'input_type'    => 'text'
        ),
        'link'                  => array(
            'name'              => 'Link',
            'input_type'        => 'text',
            'placeholder'       => 'http://',
            'save_as'           => 'link',
            'save_as_link_text' => 'button_text'
        ),
        'open_link_in_new_tab'  => array(
            'name'          => 'Open Link in New Tab',
            'input_type'    => 'checkbox'
        )
    ))
    ->set_options(array(
        'id'                => array(
            'name'          => 'Section Slug',
            'tip'           => '<strong>Use this for linking directly to a section. Lowercase letters, numbers, dashes, and underscores only.</strong> If left blank, the section slug will be "section-n" where "n" is the place that the section is in on the page (e.g. the 4th section on the page will be "section-4").',
            'input_type'    => 'text'
        ),
        'padding_top'       => array(
            'name'          => 'Top Padding',
            'width'         => 'xs-span12 sm-span3',
            'input_type'    => 'select',
            'options'       => array(
                'Large'     => 'large',
                'Normal'    => 'normal',
                'None'      => 'no'
            ),
            'selected'      => 'normal'
        ),
        'padding_bottom'    => array(
            'name'          => 'Bottom Padding',
            'width'         => 'xs-span12 sm-span3',
            'input_type'    => 'select',
            'options'       => array(
                'Large'     => 'large',
                'Normal'    => 'normal',
                'None'      => 'no'
            ),
            'selected'      => 'normal'
        ),
        'text_color_scheme' => array(
            'name'          => 'Text Color Scheme',
            'width'         => 'xs-span12 sm-span6',
            'input_type'    => 'select',
            'options'       => array(
                'Dark'      => 'dark',
                'Light'     => 'light'
            )
        ),
        'background_image'  => array(
            'name'          => 'Background Image',
            'width'         => 'xs-span12 sm-span6',
            'input_type'    => 'image'
        ),
        'background_color'        => array(
            'name'          => 'Background Color',
            'width'         => 'xs-span12 sm-span6',
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
        )
    ));

$puzzle_sections = new PuzzleSections;
$puzzle_sections->add_section($cta);
?>

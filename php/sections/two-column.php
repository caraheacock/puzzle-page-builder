<?php
$two_column = new PuzzleSection;
$two_column->set_name('Two Column')
    ->set_single_name('Column')
    ->set_fixed_column_num(2)
    ->set_admin_column_classes('xs-span12 sm-span6')
    ->set_order(20)
    ->set_markup_attr(array(
        'content'           => array(
            'name'          => 'Content',
            'input_type'    => 'textarea',
            'rows'          => 10,
            'save_as'       => 'content'
        )
    ))
    ->set_options(array(
        'headline'          => array(
            'name'          => 'Headline',
            'width'         => 'xs-span12 sm-span6',
            'input_type'    => 'text',
            'save_as'       => 'h2'
        ),
        'id'                => array(
            'name'          => 'Section Slug',
            'width'         => 'xs-span12 sm-span6',
            'tip'           => '<strong>Use this for linking directly to a section. Lowercase letters, numbers, dashes, and underscores only.</strong> If left blank, the section slug will be the headline lowercase with words separated by dashes (symbols will be deleted). If both the section slug and headline are blank, the section slug will be "section-n" where "n" is the place that the section is in on the page (e.g. the 4th section on the page will be "section-4").',
            'input_type'    => 'text'
        ),
        'column_widths'     => array(
            'name'          => 'Column Widths',
            'width'         => 'xs-span12 sm-span2',
            'input_type'    => 'select',
            'options'       => array(
                '1/2 1/2'   => '1-2_1-2',
                '1/3 2/3'   => '1-3_2-3',
                '2/3 1/3'   => '2-3_1-3'
            )
        ),
        'padding_top'       => array(
            'name'          => 'Top Padding',
            'width'         => 'xs-span12 sm-span2',
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
            'width'         => 'xs-span12 sm-span2',
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
$puzzle_sections->add_section($two_column);
?>

<?php
/*
 * The user input, i.e. the postmeta for the sections from the database.
 * This data is serialized (a multidimensional array)
 */
$page_sections = (new PuzzlePageBuilder)->sections_data();

/* Uncomment to take a closer look at the sections data */
// var_dump($page_sections);

/*
 * An array of PuzzleSection objects, for times when we need access to the
 * original PuzzleSection object
 */
$puzzle_sections = (new PuzzleSections)->sections();

if (!empty($page_sections)) :
    /*
     * Loop through the sections
     * $s - the section number we're on (starting at 0)
     * $page_section - the data for a section
     */
    foreach ($page_sections as $s => $page_section) :
        $puzzle_section_type = $page_section['type'];
        
        /*
         * If this section type is not valid (likely because the user removed
         * this section type but its data was still in the database), skip it.
         */
        if (!array_key_exists($puzzle_section_type, $puzzle_sections)) continue;
        
        /* Get the options data, columns data, and number of columns */
        $puzzle_options_data = $page_section['options'];
        $puzzle_columns_data = (!empty($page_section['columns']) ? $page_section['columns'] : false);
        $puzzle_columns_num = count($puzzle_columns_data);
        
        /* Generate the section ID */
        $section_id = ppb_section_id($s, $page_section);
        
        /* Determine the background image, if any */
        $background_image = (!empty($puzzle_options_data['background_image']) ? ' ' . wp_get_attachment_url($puzzle_options_data['background_image']) : false);
        ?>
        
        <section id="<?php echo $section_id; ?>" class="<?php echo ppb_section_classes($page_section); ?>"<?php if ($background_image) echo ' style="background-image: url(' . $background_image . ');"'; ?>>
            <?php
            /* Display the background color overlay, if applicable */
            if (!empty($puzzle_options_data['overlay'])) : ?>
                <div class="pz-background-overlay pz-<?php echo $puzzle_options_data['background_color']; ?>-background"></div>
            <?php endif; ?>
            
            <?php
            /* Display the section headline */
            if (!empty($puzzle_options_data['headline'])) : ?>
                <div class="pz-row pz-section-headline">
                    <div class="pz-col pz-xs-12">
                        <div class="pz-col-inner">
                            <h2><?php echo esc_html($puzzle_options_data['headline']); ?></h2>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php
            /* Display the section main content */
            if (!empty($puzzle_options_data['main_content'])) : ?>
                <div class="pz-row pz-main-content">
                    <div class="pz-col pz-xs-12">
                        <div class="pz-col-inner">
                            <?php echo ppb_format_content($puzzle_options_data['main_content']); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php
            /* Display columns */
            if (!empty($puzzle_columns_data)) :
                /*
                 * Determine the widths of the columns, using the
                 * page builder grid
                 */
                if ($puzzle_section_type == 'features' || $puzzle_section_type == 'team-members') {
                    if ($puzzle_options_data['layout'] == 'columns') {
                        $col_classes = ppb_col_classes($puzzle_columns_num);
                    } else {
                        $col_classes = 'pz-xs-12';
                    }
                }
                ?>
                <div class="pz-row pz-<?php echo $puzzle_section_type; ?>-content">
                    <?php
                    /* Determine the template part for this section type */
                    $loop_file = 'theme/loops/' . $puzzle_section_type . '.php';
                
                    /*
                     * Loop through the appropriate template part for this
                     * section's columns.
                     *
                     * We must 'include' the template part so variables that we
                     * created in this file can be used in the other partials.
                     */
                    foreach ($puzzle_columns_data as $c => $puzzle_column) {
                        include(ppb_locate_template($puzzle_section_type));
                    }
                    ?>
                </div>
            <?php endif; ?>
        </section>
        <?php
        /*
         * Carousel javascript, this entire if block can be deleted if we are
         * not using the carousel section
         */
        if ($puzzle_section_type == 'carousel' && $puzzle_columns_num > 1) :
            $owl_autoplay = '10000';
            if (isset($puzzle_options_data['speed']) && is_numeric($puzzle_options_data['speed'])) {
                $owl_autoplay = absint($puzzle_options_data['speed']);
            }
            
            if ($owl_autoplay == 0) $owl_autoplay = 'false';
            
            $owl_navigation = (!empty($puzzle_options_data['hide_arrows']) ? 'false' : 'true');
            $owl_pagination = (!empty($puzzle_options_data['hide_pagination']) ? 'false' : 'true');
            ?>
            <script id="ppb-<?php echo $section_id; ?>-carousel-script">
            jQuery('#<?php echo $section_id; ?> .pz-carousel-content').owlCarousel({
                items: 1,
                singleItem: true,
                autoPlay: <?php echo $owl_autoplay; ?>,
                navigation: <?php echo $owl_navigation; ?>,
                navigationText: [
                    '<i class="fa fa-angle-left" aria-hidden="true"></i><span class="pz-screen-reader-only">Back</span>',
                    '<i class="fa fa-angle-right" aria-hidden="true"></i><span class="pz-screen-reader-only">Next</span>'
                ],
                pagination: <?php echo $owl_pagination; ?>,
                transitionStyle: 'fade'
            });
            jQuery('#ppb-<?php echo $section_id; ?>-carousel-script').remove();
            </script>
            <?php
        endif;
    endforeach;
endif;
?>

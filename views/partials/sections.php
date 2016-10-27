<?php
global $post;
$page_sections = get_post_meta($post->ID, '_puzzle_page_sections', true);
$puzzle_sections = (new PuzzleSections)->sections();

if (!empty($page_sections)) :
    foreach ($page_sections as $s => $page_section) :
        $puzzle_section_type = $page_section['type'];
        
        /*
         * If this section type is not valid (likely because the user removed
         * this section type but its data was still in the database), skip it.
         */
        if (!array_key_exists($puzzle_section_type, $puzzle_sections)) continue;
        
        $puzzle_options_data = $page_section['options'];
        $puzzle_columns_data = (!empty($page_section['columns']) ? $page_section['columns'] : false);
        $puzzle_columns_num = count($puzzle_columns_data);
        
        $section_id = ppb_section_id($s, $page_section);
        
        $main_content = (!empty($puzzle_options_data['main_content']) ? $puzzle_options_data['main_content'] : false);
        $background_image = (!empty($puzzle_options_data['background_image']) ? ' ' . wp_get_attachment_url($puzzle_options_data['background_image']) : false);
        ?>
        
        <section id="<?php echo $section_id; ?>" class="<?php echo ppb_section_classes($page_section); ?>"<?php if ($background_image) echo ' style="background-image: url(' . $background_image . ');"'; ?>>
            <?php if (!empty($puzzle_options_data['overlay'])) : ?>
            <div class="pz-background-overlay <?php echo $puzzle_options_data['background_color']; ?>-background"></div>
            <?php endif; ?>
            
            <?php if (!empty($puzzle_options_data['headline'])) : ?>
            <div class="pz-row pz-section-headline">
                <div class="column xs-12">
                    <div class="col-inner">
                        <h2><?php echo $puzzle_options_data['headline']; ?></h2>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($main_content)) : ?>
            <div class="pz-row pz-main-content">
                <div class="column xs-12">
                    <div class="col-inner">
                        <?php echo apply_filters('ppb_like_the_content', $main_content); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php
            if (!empty($puzzle_columns_data)) :
                if ($puzzle_section_type == 'features' || $puzzle_section_type == 'team-members') {
                    if ($puzzle_options_data['layout'] == 'columns') {
                        $span_classes = ppb_span_classes($puzzle_columns_num);
                    } else {
                        $span_classes = 'xs-12';
                    }
                }
                ?>
            <div class="pz-row pz-<?php echo $puzzle_section_type; ?>-content">
                <?php
                $loop_file = 'theme/loops/' . $puzzle_section_type . '.php';
        
                foreach ($puzzle_columns_data as $c => $puzzle_column) {
                    include(ppb_locate_template($puzzle_section_type));
                }
                ?>
            </div>
            <?php endif; ?>
        </section>
        <?php
        if ($puzzle_section_type == 'carousel' && $puzzle_columns_num > 1) :
            $owl_autoplay = (!empty($puzzle_options_data['speed']) ? $puzzle_options_data['speed'] : '10000');
            $owl_navigation = (!empty($puzzle_options_data['hide_arrows']) ? 'false' : 'true');
            $owl_pagination = (!empty($puzzle_options_data['hide_pagination']) ? 'false' : 'true');
            ?>
            <script id="<?php echo $section_id; ?>-carousel-script">
            jQuery('#<?php echo $section_id; ?> .pz-carousel-content').owlCarousel({
                items: 1,
                singleItem: true,
                autoPlay: <?php echo $owl_autoplay; ?>,
                navigation: <?php echo $owl_navigation; ?>,
                navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                pagination: <?php echo $owl_pagination; ?>,
                transitionStyle: 'fade'
            });
            jQuery('#<?php echo $section_id; ?>-carousel-script').remove();
            </script>
        <?php
        endif;
    endforeach;
endif;
?>

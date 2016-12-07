<?php
$background_image = (!empty($puzzle_column['background_image']) ? ' ' . wp_get_attachment_url($puzzle_column['background_image']) : false);
?>
<div class="pz-carousel-slide pz-<?php echo ppb_parameterize($puzzle_column['background_color']); ?>-background pz-align-carousel-slide-<?php echo ppb_parameterize($puzzle_column['align_content']); ?> pz-<?php echo ppb_parameterize($puzzle_column['text_color_scheme']); ?>-text"<?php if ($background_image) echo ' style="background-image: url(' . $background_image . ');"'; ?>>
    <?php if (!empty($puzzle_column['overlay'])) : ?>
    <div class="pz-background-overlay pz-<?php echo ppb_parameterize($puzzle_column['background_color']); ?>-background"></div>
    <?php endif; ?>
    
    <?php if (!empty($puzzle_column['headline']) || !empty($puzzle_column['tagline']) || !empty($puzzle_column['content'])) : ?>
    <div class="pz-row">
        <div class="pz-col pz-carousel-slide-inner">
            <?php if (!empty($puzzle_column['headline'])) : ?>
            <h1><span class="pz-<?php echo ppb_parameterize($puzzle_column['headline_color']); ?>-text"><?php echo esc_html($puzzle_column['headline']); ?></span></h1>
            <?php endif; ?>
        
            <?php if (!empty($puzzle_column['tagline'])) : ?>
            <h2><span class="pz-<?php echo ppb_parameterize($puzzle_column['tagline_color']); ?>-text"><?php echo esc_html($puzzle_column['tagline']); ?></span></h2>
            <?php endif; ?>
        
            <?php if (!empty($puzzle_column['content'])) : ?>
            <div class="pz-carousel-slide-inner-content">
                <?php echo ppb_format_content($puzzle_column['content']); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

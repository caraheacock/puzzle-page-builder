<div class="pz-carousel-slide pz-<?php echo $puzzle_column['background_color']; ?>-background pz-align-carousel-slide-<?php echo $puzzle_column['align_content']; ?> pz-<?php echo $puzzle_column['text_color_scheme']; ?>-text"<?php if (!empty($puzzle_column['background_image'])) echo ' style="background-image: url(' . wp_get_attachment_url($puzzle_column['background_image']) . ');"'; ?>>
    <?php if (!empty($puzzle_column['overlay'])) : ?>
    <div class="pz-background-overlay <?php echo $puzzle_column['background_color']; ?>-background"></div>
    <?php endif; ?>
    
    <?php if (!empty($puzzle_column['headline']) || !empty($puzzle_column['tagline']) || !empty($puzzle_column['content'])) : ?>
    <div class="row">
        <div class="column pz-carousel-slide-inner">
            <?php if (!empty($puzzle_column['headline'])) : ?>
            <h1><span class="pz-<?php echo $puzzle_column['headline_color']; ?>-text"><?php echo $puzzle_column['headline']; ?></span></h1>
            <?php endif; ?>
        
            <?php if (!empty($puzzle_column['tagline'])) : ?>
            <h2><span class="pz-<?php echo $puzzle_column['tagline_color']; ?>-text"><?php echo $puzzle_column['tagline']; ?></span></h2>
            <?php endif; ?>
        
            <?php if (!empty($puzzle_column['content'])) : ?>
            <div class="pz-carousel-slide-inner-content">
                <?php echo apply_filters('the_content', $puzzle_column['content']); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

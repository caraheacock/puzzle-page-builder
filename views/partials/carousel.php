<div class="puzzle-carousel-slide <?php echo $puzzle_column['background_color']; ?>-background puzzle-align-carousel-slide-<?php echo $puzzle_column['align_content']; ?> <?php echo $puzzle_column['text_color_scheme']; ?>-text-color-scheme"<?php if (!empty($puzzle_column['background_image'])) echo ' style="background-image: url(' . wp_get_attachment_url($puzzle_column['background_image']) . ');"'; ?>>
    <?php if (!empty($puzzle_column['overlay'])) : ?>
    <div class="puzzle-background-overlay <?php echo $puzzle_column['background_color']; ?>-background"></div>
    <?php endif; ?>
    
    <?php if (!empty($puzzle_column['headline']) || !empty($puzzle_column['tagline']) || !empty($puzzle_column['content'])) : ?>
    <div class="row">
        <div class="column puzzle-carousel-slide-inner">
            <?php if (!empty($puzzle_column['headline'])) : ?>
            <h1><span class="puzzle-carousel-text-<?php echo $puzzle_column['headline_color']; ?>"><?php echo $puzzle_column['headline']; ?></span></h1>
            <?php endif; ?>
        
            <?php if (!empty($puzzle_column['tagline'])) : ?>
            <h2><span class="puzzle-carousel-text-<?php echo $puzzle_column['tagline_color']; ?>"><?php echo $puzzle_column['tagline']; ?></span></h2>
            <?php endif; ?>
        
            <?php if (!empty($puzzle_column['content'])) : ?>
            <div class="puzzle-carousel-slide-inner-content">
                <?php echo apply_filters('the_content', $puzzle_column['content']); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

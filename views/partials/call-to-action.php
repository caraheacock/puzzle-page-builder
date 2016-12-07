<div class="pz-col pz-xs-12 pz-md-6 pz-lg-8 pz-xl-9">
    <div class="pz-col-inner">
        <?php if (!empty($puzzle_column['headline'])) : ?>
        <h2><?php echo esc_html($puzzle_column['headline']); ?></h2>
        <?php endif; ?>
        <?php echo ppb_format_content($puzzle_column['content']); ?>
    </div>
</div>
<div class="pz-col pz-xs-12 pz-md-6 pz-lg-4 pz-xl-3">
    <div class="pz-col-inner">
        <a class="pz-button pz-button-large pz-button-<?php echo $puzzle_column['button_color']; if ($puzzle_column['button_style'] == 'outline') echo ' pz-button-outline'; ?> " href="<?php echo esc_url($puzzle_column['button_link']); ?>"<?php if (!empty($puzzle_column['open_link_in_new_tab'])) echo ' target="_blank"'; ?>><?php echo esc_html($puzzle_column['button_text']); ?></a>
    </div>
</div>

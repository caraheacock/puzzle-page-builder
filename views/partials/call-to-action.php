<div class="column xs-12 md-6 lg-8 xl-9">
    <div class="col-inner">
        <?php if (!empty($puzzle_column['headline'])) : ?>
        <h2><?php echo $puzzle_column['headline']; ?></h2>
        <?php endif; ?>
        <?php echo apply_filters('ppb_like_the_content', $puzzle_column['content']); ?>
    </div>
</div>
<div class="column xs-12 md-6 lg-4 xl-3">
    <div class="col-inner">
        <a class="pz-button pz-button-large pz-button-<?php echo $puzzle_column['button_color']; if ($puzzle_column['button_style'] == 'outline') echo ' pz-button-outline'; ?> " href="<?php echo $puzzle_column['button_link']; ?>"<?php if (!empty($puzzle_column['open_link_in_new_tab'])) echo ' target="_blank"'; ?>><?php echo $puzzle_column['button_text']; ?></a>
    </div>
</div>

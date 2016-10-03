<div class="column xs-span12 md-span6 lg-span8 xl-span9">
    <div class="column-inner">
        <?php if (!empty($puzzle_column['headline'])) : ?>
        <h2><?php echo $puzzle_column['headline']; ?></h2>
        <?php endif; ?>
        <?php echo apply_filters('the_content', $puzzle_column['content']); ?>
    </div>
</div>
<div class="column xs-span12 md-span6 lg-span4 xl-span3">
    <div class="column-inner">
        <a class="puzzle-button" href="<?php echo $puzzle_column['link']; ?>"<?php if (!empty($puzzle_column['open_link_in_new_tab'])) echo ' target="_blank"'; ?>><?php echo $puzzle_column['button_text']; ?></a>
    </div>
</div>

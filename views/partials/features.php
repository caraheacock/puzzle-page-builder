<?php
$link_target = (!empty($puzzle_column['open_link_in_new_tab']) ? ' target="_blank"' : '');

$icon_link_start = '';
$icon_link_end = '';
if (!empty($puzzle_column['button_link']) && !empty($puzzle_column['icon_link'])) {
    $icon_link_start = '<a class="pz-icon-link" href="' . $puzzle_column['button_link'] . '"' . $link_target . '>';
    $icon_link_end = '</a>';
}
?>
<div class="pz-col <?php echo $col_classes; echo ($puzzle_options_data['layout'] == 'rows' ? ' pz-icon-row' : ' pz-icon-column'); if (!empty($puzzle_column['button_text'])) echo ' pz-has-button'; ?>">
    <div class="pz-col-inner">
        <?php echo $icon_link_start; ?><i class="pz-main-icon <?php echo $puzzle_column['icon']; echo ' pz-' . $puzzle_options_data['icon_color'] . '-text'; ?>" aria-hidden="true"></i><?php echo $icon_link_end; ?>
        <div class="pz-feature-column-content">
            <?php
            if (!empty($puzzle_column['subhead'])) {
                $headline_tag = ($puzzle_options_data['layout'] == 'columns' ? 'h4' : 'h3');
                echo '<' . $headline_tag . '>' . $puzzle_column['subhead'] . '</' . $headline_tag . '>';
            }
            
            echo apply_filters('ppb_like_the_content', $puzzle_column['content']);
            ?>
        </div>
        <?php if (!empty($puzzle_column['button_text'])) : ?>
        <a class="pz-button pz-feature-main-button<?php if ($puzzle_options_data['button_color'] != 'primary') echo ' pz-button-' . $puzzle_options_data['button_color']; if ($puzzle_options_data['button_style'] == 'outline') echo ' pz-button-outline'; ?>" href="<?php echo $puzzle_column['button_link']; ?>"<?php echo $link_target; ?>><?php echo $puzzle_column['button_text']; ?></a>
        <?php endif; ?>
    </div>
</div>

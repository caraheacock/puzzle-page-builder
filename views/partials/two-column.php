<?php
$span_classes = 'xs-12';

if ($puzzle_options_data['column_widths'] == '1-2_1-2') {
    $span_classes .= ' lg-6';
} elseif (($puzzle_options_data['column_widths'] == '1-3_2-3' && $c == 0) ||
          ($puzzle_options_data['column_widths'] == '2-3_1-3' && $c == 1)) {
    $span_classes .= ' lg-4';
} elseif (($puzzle_options_data['column_widths'] == '1-3_2-3' && $c == 1) ||
          ($puzzle_options_data['column_widths'] == '2-3_1-3' && $c == 0)) {
    $span_classes .= ' lg-8';
}
?>
<div class="column <?php echo $span_classes; ?>">
    <div class="col-inner">
        <?php echo apply_filters('ppb_like_the_content', $puzzle_column['content']); ?>
    </div>
</div>

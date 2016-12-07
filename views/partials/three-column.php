<?php
$col_classes = 'pz-xs-12';

if ($puzzle_options_data['column_widths'] == '1-3_1-3_1-3') {
    $col_classes .= ' pz-lg-4';
} elseif (($puzzle_options_data['column_widths'] == '1-2_1-4_1-4' && $c == 0) ||
          ($puzzle_options_data['column_widths'] == '1-4_1-2_1-4' && $c == 1) ||
          ($puzzle_options_data['column_widths'] == '1-4_1-4_1-2' && $c == 2)) {
    $col_classes .= ' pz-lg-6';
} elseif (($puzzle_options_data['column_widths'] == '1-2_1-4_1-4' && $c == 1) ||
          ($puzzle_options_data['column_widths'] == '1-2_1-4_1-4' && $c == 2) ||
          ($puzzle_options_data['column_widths'] == '1-4_1-2_1-4' && $c == 0) ||
          ($puzzle_options_data['column_widths'] == '1-4_1-2_1-4' && $c == 2) ||
          ($puzzle_options_data['column_widths'] == '1-4_1-4_1-2' && $c == 0) ||
          ($puzzle_options_data['column_widths'] == '1-4_1-4_1-2' && $c == 1)) {
    $col_classes .= ' pz-lg-3';
}
?>
<div class="pz-col <?php echo $col_classes; ?>">
    <div class="pz-col-inner">
        <?php echo ppb_format_content($puzzle_column['content']); ?>
    </div>
</div>

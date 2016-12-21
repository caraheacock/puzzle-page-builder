<?php

/*
 * Puzzle Page Builder
 * Custom styles using admin options
 *
 * The CSS here is converted into /assets/css/custom.css if the sheet does not
 * exist yet, and then is updated every time the user updates the
 * plugin options.
 */

if (!defined('ABSPATH')) exit;

/* Colors */
$puzzle_colors = new PuzzleColors;

$puzzle_theme_colors = $puzzle_colors->theme_colors();
$puzzle_text_colors = $puzzle_colors->text_colors();
$puzzle_link_colors = $puzzle_colors->link_colors();

$primary_color = array_values($puzzle_theme_colors)[0];
$secondary_color = array_values($puzzle_theme_colors)[1];

/* Spacing */
$puzzle_settings = new PuzzleSettings;

$space_unit = $puzzle_settings->space('unit');
$section_padding = $puzzle_settings->space('section_padding');
$column_padding = $puzzle_settings->space('column_padding');
$column_margin = $puzzle_settings->space('column_margin');

?>
/* Global */
.pz-section-normal-padding-top {
    padding-top: <?php echo $section_padding . $space_unit; ?>;
}

.pz-section-normal-padding-bottom {
    padding-bottom: <?php echo $section_padding . $space_unit; ?>;
}

.pz-section-large-padding-top {
    padding-top: <?php echo ($section_padding * 2) . $space_unit; ?>;
}

.pz-section-large-padding-bottom {
    padding-bottom: <?php echo ($section_padding * 2) . $space_unit; ?>;
}

.pz-col-inner {
    margin: <?php echo $column_margin . $space_unit; ?>;
    padding: <?php echo $column_padding . $space_unit; ?>;
}

/* Text */

.pz-dark-text h1,
.pz-dark-text h2,
.pz-dark-text h3,
.pz-dark-text h4,
.pz-dark-text h5,
.pz-dark-text h6,
.pz-dark-text th {
    color: <?php echo $puzzle_text_colors['headline_dark']; ?>;
}

.pz-dark-text,
.pz-dark-text p,
.pz-dark-text li,
.pz-dark-text td {
    color: <?php echo $puzzle_text_colors['text_dark']; ?>;
}

.pz-dark-text a {
    color: <?php echo $puzzle_link_colors['link_dark']; ?>;
}

.pz-dark-text a:hover,
.pz-dark-text a:focus {
    color: <?php echo $puzzle_link_colors['link_dark_hover']; ?>;
}

.pz-light-text h1,
.pz-light-text h2,
.pz-light-text h3,
.pz-light-text h4,
.pz-light-text h5,
.pz-light-text h6,
.pz-light-text th {
    color: <?php echo $puzzle_text_colors['headline_light']; ?>;
}

.pz-light-text,
.pz-light-text p,
.pz-light-text li,
.pz-light-text td {
    color: <?php echo $puzzle_text_colors['text_light']; ?>;
}

.pz-light-text a {
    color: <?php echo $puzzle_link_colors['link_light']; ?>;
}

.pz-light-text a:hover,
.pz-light-text a:focus {
    color: <?php echo $puzzle_link_colors['link_light_hover']; ?>;
}

/* Utility */

<?php foreach($puzzle_theme_colors as $id => $color) : ?>
.pz-<?php echo $id; ?>-background {
    background-color: <?php echo $color->color(); ?>;
}

.pz-<?php echo $id; ?>-text {
    color: <?php echo $color->color(); ?>;
}

<?php endforeach; ?>

/* Sections */

.pz-carousel .owl-theme .owl-controls .owl-page.active span {
    background-color: <?php echo $primary_color->color(); ?>;
}

.pz-carousel .owl-theme .owl-controls.clickable .owl-page:hover span {
    background-color: <?php echo $secondary_color->color(); ?>;
}

.pz-accordion-headline i {
    color: <?php echo $primary_color->color(); ?>;
}

.pz-accordion-headline:hover .fa {
    color: <?php echo $secondary_color->color(); ?>;
}

/* Buttons */

.pz-button,
a.pz-button,
.pz-button.pz-button-<?php echo $secondary_color->id(); ?>:hover,
.pz-button.pz-button-<?php echo $secondary_color->id(); ?>:focus,
a.pz-button.pz-button-<?php echo $secondary_color->id(); ?>:hover,
a.pz-button.pz-button-<?php echo $secondary_color->id(); ?>:focus {
    background-color: <?php echo $primary_color->color(); ?>;
    border-color: <?php echo $primary_color->color(); ?>;
    color: <?php echo $primary_color->text_color_scheme(); ?>;
}

.pz-button:visited {
    color: <?php echo $primary_color->text_color_scheme(); ?>;
}

.pz-button:hover,
.pz-button:focus,
a.pz-button:hover,
a.pz-button:focus {
    background-color: <?php echo $secondary_color->color(); ?>;
    border-color: <?php echo $secondary_color->color(); ?>;
    color: <?php echo $secondary_color->text_color_scheme(); ?>;
}

.pz-<?php echo $secondary_color->id(); ?>-background .pz-button:hover,
.pz-<?php echo $secondary_color->id(); ?>-background .pz-button:focus {
    background-color: #fff;
    border-color: #fff;
    color: <?php echo $puzzle_text_colors['text_dark']; ?>;
}

.pz-button.pz-button-outline {
    border-color: <?php echo $primary_color->color(); ?>;
    background-color: transparent;
    color: <?php echo $primary_color->color(); ?>;
}

.pz-button.pz-button-outline:visited {
    color: <?php echo $primary_color->color(); ?>;
}

.pz-button.pz-button-outline:hover,
.pz-button.pz-button-outline:focus {
    border-color: <?php echo $primary_color->color(); ?>;
    background-color: <?php echo $primary_color->color(); ?>;
    color: <?php echo $primary_color->text_color_scheme(); ?>;
}

<?php foreach($puzzle_theme_colors as $id => $color) :
    $text_color = $puzzle_text_colors['text_' . $color->text_color_scheme()];
    ?>
.pz-button.pz-button-<?php echo $id; ?> {
    border-color: <?php echo $color->color(); ?>;
    background-color: <?php echo $color->color(); ?>;
    color: <?php echo $text_color; ?>
}

.pz-button.pz-button-<?php echo $id; ?>.pz-button-outline,
.pz-button.pz-button-<?php echo $id; ?>.pz-button-outline:visited {
    border-color: <?php echo $color->color(); ?>;
    background-color: transparent;
    color: <?php echo $color->color(); ?>;
}

.pz-button.pz-button-<?php echo $id; ?>.pz-button-outline:hover,
.pz-button.pz-button-<?php echo $id; ?>.pz-button-outline:focus {
    background-color: <?php echo $color->color(); ?>;
    color: <?php echo $text_color; ?>;
}

<?php endforeach; ?>

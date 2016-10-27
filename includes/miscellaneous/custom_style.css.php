<?php

/*
 * Puzzle Page Builder
 * Custom styles using admin options
 *
 * The CSS here is converted into /assets/css/custom.css if the sheet does not
 * exist yet, and then is updated every time the user updates the
 * plugin options.
 */

$puzzle_settings = new PuzzleSettings;
$puzzle_colors = $puzzle_settings->colors();

$primary_color = $puzzle_colors['primary_color'];
$secondary_color = $puzzle_colors['secondary_color'];
$headline_dark = $puzzle_colors['headline_dark'];
$text_dark = $puzzle_colors['text_dark'];
$headline_light = $puzzle_colors['headline_light'];
$text_light = $puzzle_colors['text_light'];

// Temporary values
$section_space = 60;
$section_space_unit = 'px';
$column_space = 15;
$column_space_unit = 'px';
?>
/* Global */
.pz-section {
    padding: <?php echo $section_space . $section_space_unit; ?> 0;
}

.pz-section.pz-section-large-padding-top {
    padding-top: <?php echo ($section_space * 2) . $section_space_unit; ?>;
}

.pz-section.pz-section-large-padding-bottom {
    padding-bottom: <?php echo ($section_space * 2) . $section_space_unit; ?>;
}

/* Text */

.pz-dark-text h1,
.pz-dark-text h2,
.pz-dark-text h3,
.pz-dark-text h4,
.pz-dark-text h5,
.pz-dark-text h6,
.pz-dark-text th {
    color: <?php echo $headline_dark; ?>;
}

.pz-dark-text,
.pz-dark-text p,
.pz-dark-text li,
.pz-dark-text td {
    color: <?php echo $text_dark; ?>;
}

.pz-dark-text a:not(.pz-button) {
    color: <?php echo $primary_color; ?>;
}

.pz-dark-text a:not(.pz-button):hover,
.pz-dark-text a:not(.pz-button):active {
    color: <?php echo $secondary_color; ?>;
}

.pz-light-text h1,
.pz-light-text h2,
.pz-light-text h3,
.pz-light-text h4,
.pz-light-text h5,
.pz-light-text h6,
.pz-light-text th {
    color: <?php echo $headline_light; ?>;
}

.pz-light-text,
.pz-light-text p,
.pz-light-text li,
.pz-light-text td,
.pz-light-text a:not(.pz-button) {
    color: <?php echo $text_light; ?>;
}

/* Utility */

.pz-primary-background {
    background-color: <?php echo $primary_color; ?>;
}

.pz-secondary-background {
    background-color: <?php echo $secondary_color; ?>;
}

.pz-primary-text {
    color: <?php echo $primary_color; ?>;
}

.pz-secondary-text {
    color: <?php echo $secondary_color; ?>;
}

/* Sections */

.pz-carousel .owl-theme .owl-controls .owl-page.active span {
    background-color: <?php echo $primary_color; ?>;
}

.pz-carousel .owl-theme .owl-controls.clickable .owl-page:hover span {
    background-color: <?php echo $secondary_color; ?>;
}

.pz-accordion-headline i {
    color: <?php echo $primary_color; ?>;
}

.pz-accordion-headline:hover .fa {
    color: <?php echo $secondary_color; ?>;
}

/* Buttons */

.pz-button,
.pz-button.pz-button-secondary:hover,
.pz-button.pz-button-secondary:focus {
    background-color: <?php echo $primary_color; ?>;
    border-color: <?php echo $primary_color; ?>;
    color: #fff;
}

.pz-button:visited {
    color: #fff;
}

.pz-button:hover,
.pz-button:focus,
.pz-button.pz-button-secondary,
.pz-button.pz-button-secondary:visited {
    background-color: <?php echo $secondary_color; ?>;
    border-color: <?php echo $secondary_color; ?>;
    color: #fff;
}

.pz-secondary-background .pz-button:hover,
.pz-secondary-background .pz-button:focus {
    background-color: #fff;
    border-color: #fff;
    color: <?php echo $text_dark; ?>;
}

.pz-button.pz-button-outline {
    border-color: <?php echo $primary_color; ?>;
    background-color: transparent;
    color: <?php echo $primary_color; ?>;
}

.pz-button.pz-button-outline:visited {
    color: <?php echo $primary_color; ?>;
}

.pz-button.pz-button-outline:hover,
.pz-button.pz-button-outline:focus {
    border-color: <?php echo $primary_color; ?>;
    background-color: <?php echo $primary_color; ?>;
    color: #fff;
}

.pz-button.pz-button-secondary.pz-button-outline,
.pz-button.pz-button-secondary.pz-button-outline:visited {
    border-color: <?php echo $secondary_color; ?>;
    background-color: transparent;
    color: <?php echo $secondary_color; ?>;
}

.pz-button.pz-button-secondary.pz-button-outline:hover,
.pz-button.pz-button-secondary.pz-button-outline:focus {
    background-color: <?php echo $secondary_color; ?>;
    color: #fff;
}

.pz-button.pz-button-white,
.pz-button.pz-button-white:visited,
.pz-button.pz-button-light-gray,
.pz-button.pz-button-light-gray:visited {
    color: <?php echo $text_dark; ?>;
}

.pz-secondary-background .pz-button.pz-button-white:hover,
.pz-secondary-background .pz-button.pz-button-white:focus,
.pz-secondary-background .pz-button.pz-button-light-gray:hover,
.pz-secondary-background .pz-button.pz-button-light-gray:focus {
    border-color: <?php echo $primary_color; ?>;
    background-color: <?php echo $primary_color; ?>;
    color: #fff;
}

.pz-button.pz-button-white.pz-button-outline:hover,
.pz-button.pz-button-white.pz-button-outline:focus,
.pz-button.pz-button-light-gray.pz-button-outline:hover,
.pz-button.pz-button-light-gray.pz-button-outline:focus {
    color: <?php echo $text_dark; ?>;
}

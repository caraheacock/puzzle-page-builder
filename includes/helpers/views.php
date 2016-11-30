<?php

/*
 * Puzzle Page Builder
 * Views helpers
 */

/*
 * Determines classes for a section
 *
 * $page_section - array of data pertaining to the section
 *
 * Returns a string of classes for a section
 */
function ppb_section_classes($page_section) {
    $puzzle_options_data = $page_section['options'];
    
    $section_classes = 'pz-section pz-' . $page_section['type'];
    
    if (!empty($puzzle_options_data['background_color'])) {
        $section_classes .= ' pz-' . $puzzle_options_data['background_color'] . '-background';
    }
    
    if (!empty($puzzle_options_data['text_color_scheme'])) {
        $section_classes .= ' pz-' . $puzzle_options_data['text_color_scheme'] . '-text';
    }
    
    if (!empty($puzzle_options_data['padding_top'])) {
        $section_classes .= ' pz-section-' . $puzzle_options_data['padding_top'] . '-padding-top';
    }
    
    if (!empty($puzzle_options_data['padding_bottom'])) {
        $section_classes .= ' pz-section-' . $puzzle_options_data['padding_top'] . '-padding-bottom';
    }
    
    $section_classes .= (!empty($puzzle_options_data['open_one_at_a_time']) ? ' pz-accordions-one-open' : '');
    
    return $section_classes;
}

/*
 * Determines the ID for a section
 *
 * $s - integer, the section number we are on
 * $page_section - array of data pertaining to the section
 *
 * Returns a string of the ID for a section
 */
function ppb_section_id($s, $page_section) {
    $puzzle_options_data = $page_section['options'];
    
    $section_id = 'section-' . ($s + 1);
    if (!empty($puzzle_options_data['id'])) {
        $section_id = ppb_parameterize($puzzle_options_data['id']);
    } else if (!empty($puzzle_options_data['headline'])) {
        $section_id = ppb_parameterize($puzzle_options_data['headline']);
    }
    
    return $section_id;
}

/*
 * Generates width classes for an item
 *
 * $total - integer, the total number of items
 * $args - array, arguments for customizing the width classes
 *   'prefix' - string, the grid class prefix, defaults to 'pz-'
 *   'min' - integer, the minimum number of items per row, defaults to 3
 *   'max' - integer, the maximum number of items per row, defaults to 4,
 *           MUST be greater than $min or results will be strange
 *   'size1' - string, what size to make the first resize, defaults to 'md'
 *   'size2' - string, what size to make the final resize, defaults to 'lg'
 *
 * Returns a string of classes for the best fit for an item
 */
function ppb_col_classes($total, $args = array()) {
    $col_classes = '';
    
    /* Set default arguments */
    $default_args = array(
        'prefix' => 'pz-',
        'min' => 3,
        'max' => 4,
        'size1' => 'md',
        'size2' => 'lg'
    );
    
    if (empty($args)) {
        $args = $default_args;
    } else {
        foreach ($default_args as $key => $value) {
            if (!isset($args[$key])) $args[$key] = $value;
        }
    }
    
    /*
     * If the first size change is not 'xs', make the initial size of the item
     * full width.
     */
    if ($args['size1'] != 'xs') {
        $col_classes .= $args['prefix'] . 'xs-12';
    
        // If the max columns per row is 1, we're done
        if ($args['max'] <= 1) return $col_classes;
        
        $col_classes .= ' ';
    }
    
    /*
     * Allowed mins and maxes, to make sure there are classes for the desired
     * column widths
     */
    $allowed_min_max = array(1, 2, 3, 4, 5, 6, 8, 12);
    
    // Special columns
    $special_columns = array(
        5 => 'one-fifth',
        8 => 'one-eighth'
    );
    
    /*
     * If the max is greater than or equal to 3 and the total divides evenly
     * by 3, make the columns 1/3 width at the first resize. Else, make them
     * half width.
     */
    if ($args['max'] >= 3 && $total % 3 == 0) {
        $col_classes .= $args['prefix'] . $args['size1'] . '-4';
    } else {
        $col_classes .= $args['prefix'] . $args['size1'] . '-6';
    }
    
    /* If the max columns per row is 2, we're done */
    if ($args['max'] <= 2) return $col_classes;
    
    /*
     * The following two for loops determine the best size for items at the
     * final resize, using the $total, $max, and $min.
     *
     * For example, with a $max of 5 items per row and a $min of 3 items per
     * row, first we'll start at $max and go down to $min and try to find a
     * perfect fit.
     * - We try to fit 5 items per row evenly                       $total % 5 == 0
     * - Then try 4 items per row evenly                            $total % 4 == 0
     * - Then try 3 items per row evenly                            $total % 3 == 0
     *
     * $gap is the gap between the items per row and how many are left over
     * in the last row. Ideally we would like $gap to be zero.
     *
     * If the items just won't divide evenly within the given range,  we keep
     * incrementing $gap by 1, to try to minimize the gap between the
     * items per row and the items in the last row.
     * - Return to 5 but try to have 4 in the last row              $total % 5 == 4
     * - Then try 4 items per row with 3 in the last row            $total % 4 == 3
     * - Then try 3 items per row with 2 in the last row            $total % 3 == 2
     * - Return to 5 but try to have 3 in the last row              $total % 5 == 3
     * - Then try 4 items per row with 2 in the last row            $total % 4 == 2
     * - Then try 3 items per row with 1 in the last row            $total % 3 == 1
     *
     * We stop the loop at $gap = $min because by then we should have always
     * reached a fit. Returning to the earlier example, you can see that we
     * have tried $total % 3 == 0, $total % 3 == 2, and $total % 3 == 1.
     * Mathematically all integers divided by 3 should have a remainder of
     * 0, 1, or 2.
     *
     * So, as stated, let's start $gap at 0 and work our way up to $min.
     */
    for ($gap = 0; $gap < $args['min']; $gap++) {
        /*
         * Start at the max items per row and work our way down to the min.
         * $n is the number of items we're presently trying to fit per row.
         */
        for ($n = $args['max']; $n >= $args['min']; $n--) {
            /*
             * If $n does not have a grid class (e.g. we don't have a class
             * for fitting 7 items per row), skip it.
             */
            if (!in_array($n, $allowed_min_max)) continue;
            
            /*
             * $remainder is how many are left over in the last row.
             *
             * Examples:
             * If $n is 5 and $gap is 0, $remainder is 0.
             * If $n is 5 and $gap is 1, $remainder is 4.
             * If $n is 3 and $gap is 2, $remainder is 1.
             */
            $remainder = ($gap == 0 ? 0 : $n - $gap);
            
            /*
             * If the total divided by $n is the desired $remainder, we have
             * found the best fit.
             */
            if ($total % $n == $remainder) {
                /*
                 * $col is the number for the class name.
                 * For example, for $n = 4 (4 items per row), the class for an item
                 * is "lg-3" (the item spans 3 columns in a 12 column layout).
                 */
                $col = (!empty($special_columns[$n]) ? $special_columns[$n] : 12 / $n);
                $col_classes .= ' ' . $args['prefix'] . $args['size2'] . '-' . $col;
                
                /* Break out of the 2 for loops. */
                break 2;
            }
        }
    }
    
    return $col_classes;
}

?>

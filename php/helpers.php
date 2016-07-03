<?php

/*
 * Puzzle Page Builder
 * Helper functions
 */

// Converts a hex value to rgb
//
// $hex - string of a hex color, e.g. '#abc123'
//
// Returns a string of the color converted to rgb, with values separated by commas
function ppb_hex2rgb($hex) {
    $hex = str_replace('#', '', $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    
    return implode(', ', $rgb); // returns a string of the rgb values separated by commas
    // return $rgb; // returns an array with the rgb values
}

// Add ppb_like_the_content Filter
//
// Has the same actions as the_content but for times when running
// the_content filter conflicts with plugins.
// 
// The only action this does not have is 'prepend_attachment' because
// it causes attachment pages to show attachments in weird places.
$actions = array('wptexturize', 'convert_smilies', 'convert_chars', 'wpautop', 'shortcode_unautop');
foreach ($actions as $action) {
    add_filter('ppb_like_the_content', $action);
}

// Generates width classes for an item
//
// $total - integer, the total number of items
// $min - integer, the minimum number of items per row, defaults to 3
// $max - integer, the maximum number of items per row, defaults to 4,
//        MUST be greater than $min or results will be strange
// $size1 - string, what size to make the first resize, defaults to 'md'
// $size2 - string, what size to make the final resize, defaults to 'lg'
//
// Returns a string of classes for the best fit for an item
function ppb_span_classes($total, $min = 3, $max = 4, $size1 = 'md', $size2 = 'lg') {
    $span_classes = '';
    
    // If the first size change is not 'xs', make the initial size of the item
    // full width.
    if ($size1 != 'xs') {
        $span_classes .= 'xs-span12';
    
        // If the max columns per row is 1, we're done
        if ($max <= 1) return $span_classes;
        
        $span_classes .= ' ';
    }
    
    // Allowed mins and maxes, to make sure there are classes for the desired
    // column widths
    $allowed_min_max = array(1, 2, 3, 4, 5, 6, 8, 12);
    
    // Special columns
    $special_columns = array(
        5 => '2point4',
        8 => '1point5'
    );
    
    // If the max is greater than or equal to 3 and the total divides evenly
    // by 3, make the columns 1/3 width at the first resize. Else, make them
    // half width.
    if ($max >= 3 && $total % 3 == 0) {
        $span_classes .= $size1 . '-span4';
    } else {
        $span_classes .= $size1 . '-span6';
    }
    
    // If the max columns per row is 2, we're done
    if ($max <= 2) return $span_classes;
    
    // The following two for loops determine the best size for items at the
    // final resize, using the $total, $max, and $min.
    //
    // For example, with a $max of 5 items per row and a $min of 3 items per
    // row, first we'll start at $max and go down to $min and try to find a
    // perfect fit.
    // - We try to fit 5 items per row evenly                       $total % 5 == 0
    // - Then try 4 items per row evenly                            $total % 4 == 0
    // - Then try 3 items per row evenly                            $total % 3 == 0
    //
    // $gap is the gap between the items per row and how many are left over
    // in the last row. Ideally we would like $gap to be zero.
    //
    // If the items just won't divide evenly within the given range,  we keep
    // incrementing $gap by 1, to try to minimize the gap between the
    // items per row and the items in the last row.
    // - Return to 5 but try to have 4 in the last row              $total % 5 == 4
    // - Then try 4 items per row with 3 in the last row            $total % 4 == 3
    // - Then try 3 items per row with 2 in the last row            $total % 3 == 2
    // - Return to 5 but try to have 3 in the last row              $total % 5 == 3
    // - Then try 4 items per row with 2 in the last row            $total % 4 == 2
    // - Then try 3 items per row with 1 in the last row            $total % 3 == 1
    //
    // We stop the loop at $gap = $min because by then we should have always
    // reached a fit. Returning to the earlier example, you can see that we
    // have tried $total % 3 == 0, $total % 3 == 2, and $total % 3 == 1.
    // Mathematically all integers divided by 3 should have a remainder of
    // 0, 1, or 2.
    
    // So, as stated, let's start $gap at 0 and work our way up to $min.
    for ($gap = 0; $gap < $min; $gap++) {
        // Start at the max items per row and work our way down to the min.
        // $n is the number of items we're presently trying to fit per row.
        for ($n = $max; $n >= $min; $n--) {
            // If $n does not have a grid class (e.g. we don't have a class
            // for fitting 7 items per row), skip it.
            if (!in_array($n, $allowed_min_max)) continue;
            
            // $remainder is how many are left over in the last row.
            //
            // Examples:
            // If $n is 5 and $gap is 0, $remainder is 0.
            // If $n is 5 and $gap is 1, $remainder is 4.
            // If $n is 3 and $gap is 2, $remainder is 1.
            $remainder = ($gap == 0 ? 0 : $n - $gap);
            
            // If the total divided by $n is the desired $remainder, we have
            // found the best fit.
            if ($total % $n == $remainder) {
                // $col is the number for the class name.
                // For example, for $n = 4 (4 items per row), the class for an item
                // is "lg-span3" (the item spans 3 columns in a 12 column layout).
                $col = (!empty($special_columns[$n]) ? $special_columns[$n] : 12 / $n);
                $span_classes .= ' ' . $size2 . '-span' . $col;
                
                // Break out of the 2 for loops.
                break 2;
            }
        }
    }
    
    return $span_classes;
}

// Converts a string to a slug with dashes. Removes special characters and
// replaces spaces with dashes.
//
// $string - the string to be converted
//
// Returns the slug as a string
function ppb_to_slug($string){
    $slug = $string;
    
    $slug = strtolower($slug);
    $slug = preg_replace('/[^a-z0-9\-\_\s]+/', '', $slug);
    $slug = trim($slug);
    $slug = preg_replace('/\s+/', '-', $slug);
    
    return $slug;
}

?>
<?php

/*
 * Puzzle Page Builder
 * Sections Class
 */

class PuzzleSections {
    // Static variable: array of PuzzleSection objects.
    private static $Sections = array();
    
    // Adds a section
    function add_section($new_section) {
        self::$Sections[$new_section->slug()] = $new_section;
        
        uasort(self::$Sections, function($a, $b) {
            return strnatcmp($a->get_order(), $b->get_order());
        });
    }
    
    // Returns the sections
    function sections() {
        return self::$Sections;
    }
}

?>

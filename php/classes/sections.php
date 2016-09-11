<?php

/*
 * Puzzle Page Builder
 * Sections Class
 */

class PuzzleSections {
    /* Static variable: array of PuzzleSection objects. */
    private static $Sections = array();
    function sections() { return self::$Sections; }
    
    /* Adds a section */
    function add_section($new_section) {
        self::$Sections[$new_section->slug()] = $new_section;
        
        uasort(self::$Sections, function($a, $b) {
            return strnatcmp($a->order(), $b->order());
        });
    }
    
    /* Returns a section by its slug */
    function section($slug) {
        return self::$Sections[$slug];
    }
    
    /* Remove a section by its slug */
    function remove_section($slug) {
        if (array_key_exists($slug, self::$Sections)) {
            unset(self::$Sections[$slug]);
        }
    }
    
    /*
     * Remove multiple sections by their slugs
     * $slugs - array, a list of slugs of sections to remove
     */
    function remove_sections($slugs) {
        foreach ($slugs as $slug) {
            self::remove_section($slug);
        }
    }
}

?>

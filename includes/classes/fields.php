<?php

/*
 * Puzzle Page Builder
 * Fields Class
 */

class PuzzleFields {
    /* Static variable: array of PuzzleField objects. */
    private static $Fields = array();
    
    /* Adds a field */
    function add_field($new_field) {
        self::$Fields[$new_field->id()] = $new_field;
    }
    
    /*
     * Returns a field by its id
     * By default this function returns a clone of the field so its properties
     * can be modified on a section by section basis, such as changing
     * the width.
     */
    function field($id, $clone = true) {
        return ($clone ? clone(self::$Fields[$id]) : self::$Fields[$id]);
    }
}

?>

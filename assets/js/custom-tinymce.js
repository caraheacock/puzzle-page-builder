jQuery('document').ready(function($){
    // Puzzle Button
    tinymce.create('tinymce.plugins.PuzzleButton', {
        init : function(ed, url) {
            ed.addButton('puzzlebutton', {
                title : 'Puzzle Button',
                image : url + '/../images/tinymce-puzzle-button-icon.png',
                onclick : function() {
                    var $insertButtonArea = $('#puzzle-insert-button-shortcode-area'),
                        $insertButtonSubmit = $('#puzzle-insert-button-submit'),
                        $insertButtonCancel = $('#puzzle-insert-button-cancel'),
                        $colorField = $('#puzzle-insert-button-color'),
                        $iconField = $('#puzzle-insert-button-icon'),
                        $linkField = $('#puzzle-insert-button-link'),
                        $newTabField = $('#puzzle-insert-button-new-tab'),
                        $textField = $('#puzzle-insert-button-text'),
                        resetValues = function() {
                            $colorField.val('primary-color');
                            $iconField.prop('checked', false);
                            $linkField.val('');
                            $newTabField.prop('checked', false);
                            $textField.val('');
                        };
                    
                    $insertButtonArea.addClass('show');
                    
                    $insertButtonSubmit.one('click', function(e) {
                        e.preventDefault();
                        
                        var $iconValue = 'false',
                            $newTabValue = 'false';
                            
                        if ($iconField.is(':checked')) {
                            $iconValue = 'true';
                        }
                        
                        if ($newTabField.is(':checked')) {
                            $newTabValue = 'true';
                        }
                        
                        ed.execCommand('mceInsertContent', false, '[puzzle_button color="' + $colorField.val() + '" icon="' + $iconValue + '" link="' + $linkField.val() + '" open_link_in_new_tab="' + $newTabValue + '" text="' + $textField.val() + '"]');
                        
                        $insertButtonArea.removeClass('show');
                        resetValues();
                    });
                    
                    $insertButtonCancel.one('click', function(e) {
                        e.preventDefault();
                        resetValues();
                        $insertButtonArea.removeClass('show');
                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Puzzle Button Shortcode",
                author : 'Cara Heacock',
                authorurl : 'http://caraheacock.com/',
                infourl : 'http://caraheacock.com/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('puzzlebutton', tinymce.plugins.PuzzleButton);
});
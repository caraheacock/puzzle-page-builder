jQuery('document').ready(function($) {
    var $window = $(window),
        $document = $(document),
        $pageBuilder = $('#puzzle-page-section-options'),
        $chooseSectionArea = $('#choose-section-area'),
        $chooseSectionButtons = $('#choose-section-area .button'),
        $removedSections = '',
        $addSectionButton = $('.puzzle-add-section'),
        $allSections = $('.puzzle-add-section-area'),
        $allColumns = $('.puzzle-add-section-area > .row > .column'),
        $sectionTypeField = $('#puzzle_section_type');

    // Show and hide areas depending on template
    var templateCheck = function() {
        if ($('#page_template').val() === 'template_page_builder.php') {
            $('#postdivrich, #post-preview').hide();
            $('#page_builder_options').show();
            $('#using-page-builder').val(1);
        } else {
            $('#postdivrich, #post-preview').show();
            $('#page_builder_options').hide();
            $('#using-page-builder').val(0);
        }
    };
    
    templateCheck();
    $('#page_template').change(templateCheck);
    
    // Shows and hides areas depending on template for custom post types
    var customTemplateCheck = function() {
        if ($('#puzzle_custom_template_select').val() === 'page_builder') {
            $('#postdivrich, #post-preview').hide();
            $('#page_builder_options').show();
            $('#using-page-builder').val(1);
        } else {
            $('#postdivrich, #post-preview').show();
            $('#page_builder_options').hide();
            $('#using-page-builder').val(0);
        }
    };
    
    if ($('#puzzle_custom_template_select').length > 0) {
        customTemplateCheck();
        $('#puzzle_custom_template_select').change(customTemplateCheck);
    }
    
    // Allow user to sort columns using jQuery UI sortable
    $('.puzzle-sections, .added-columns').sortable();
    
    // Show and hide sections and columns
    $document.on('click', '.puzzle-collapse', function() {
        t = $(this);
        t.toggleClass('fa-chevron-down');
        t.toggleClass('fa-chevron-up');
        t.parents('.puzzle-collapsable-menu').toggleClass('collapsed-state').parent().children('.puzzle-collapsable-content').toggleClass('show');
        
        if (t.siblings('input').val() === 'hide') {
            t.siblings('input').val('show');
        } else {
            t.siblings('input').val('hide');
        }
    });
    
    // Remove a section or column
    $document.on('click', '.puzzle-remove-section', function() {
        $(this).parent('.puzzle-collapsable-menu').parent().remove();
    });
    
    // Add Image
    var custom_uploader;
    
    $document.on('click', '.puzzle_add_image_button', function(e) {
        e.preventDefault();
        $button = $(this);

        // If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        // Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose File',
            button: {
                text: 'Choose File'
            },
            multiple: false
        });

        // When a file is selected, set the input's value as the post ID
        // and the preview image's src as the url.
        //
        // Saving the post ID instead of the url gives us more options
        // in terms of WordPress functions later.
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $button.siblings('input').val(attachment.id);
            $button.siblings('img').replaceWith('<img width="' + attachment.sizes.full.width + '" height="' + attachment.sizes.full.height + '" src="' + attachment.url + '" alt="' + attachment.alt + '" />');
        });

        // Open the uploader dialog
        custom_uploader.open();
    });
    
    // Remove Image
    $document.on('click', '.puzzle_remove_image_button', function(e) {
       e.preventDefault();
       $button = $(this);
       $button.siblings('input').val('');
       $button.siblings('img').replaceWith('<img src="" />');
    });
    
    // WYSIWYG Editor
    var $puzzleEditor = $('#puzzle-text-editor-area'),
        $puzzleEditorHTML = $('#puzzlecustomeditor'),
        $visualButton = $('#puzzlecustomeditor-tmce'),
        $textButton = $('#puzzlecustomeditor-html'),
        $updateButton = $('#puzzle-update-content'),
        $cancelButton = $('#puzzle-cancel-editor');
    
    $document.on('click', '.open-editor-button', function(e) {
        e.preventDefault();
        
        var $button = $(this),
            $originalTextBox = $button.siblings('textarea');
        
        $textButton.trigger('click');
        $puzzleEditorHTML.val($originalTextBox.val());
        $visualButton.trigger('click');
        
        $puzzleEditor.addClass('show');

        $updateButton.click(function(e) {
            e.preventDefault();
            $textButton.trigger('click');
            $originalTextBox.val($puzzleEditorHTML.val());
            $puzzleEditor.removeClass('show');
            $updateButton.off('click');
        });

        $cancelButton.click(function(e) {
            e.preventDefault();
            $puzzleEditor.removeClass('show');
        });
    });
    
    // Add icon
    var $iconLibrary = $('.puzzle-icon-library'),
        $iconMolecules = $('.icon-molecule'),
        $cancelIconButton = $('.puzzle-cancel-icon');
    
    $document.on('click', '.puzzle-add-icon', function(e) {
        e.preventDefault();
        $iconDisplay = $(this).siblings('i');
        $iconInput = $(this).siblings('input');
        
        $iconLibrary.addClass('show');
        
        $iconMolecules.click(function(e) {
            e.preventDefault();
            $iconLibrary.removeClass('show');
            iconValue = $(this).children('i').attr('class');
            
            $iconInput.val(iconValue);
            $iconDisplay.attr('class', iconValue);
        })
        
        $cancelIconButton.click(function(e) {
            e.preventDefault();
            $iconLibrary.removeClass('show');
        })
    });
    
    // Show and hide tip
    $document.on('click tap', '.puzzle-field-tip-button', function() {
        var $tipText = $(this).siblings('.puzzle-field-tip-content').children();
        $tipText.slideToggle();
    });
    
    // Initialize WordPress Color Picker
    var $colorFields = $('.color-field');
    
    if ($colorFields.length > 0) {
        $colorFields.wpColorPicker();
    }
});

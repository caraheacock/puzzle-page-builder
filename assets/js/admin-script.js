jQuery('document').ready(function($) {
    var $document = $(document),
        $body = $('body');

    /* Show and hide areas depending on template */
    var templateCheck = function() {
        if ($('#page_template').val() === 'template_page_builder.php') {
            $('#postdivrich, #post-preview').hide();
            $('#puzzle_page_builder_options').show();
            $('#using-puzzle-page-builder').val(1);
        } else {
            $('#postdivrich, #post-preview').show();
            $('#puzzle_page_builder_options').hide();
            $('#using-puzzle-page-builder').val(0);
        }
    };
    
    templateCheck();
    $('#page_template').change(templateCheck);
    
    /* Shows and hides areas depending on template for custom post types */
    var customTemplateCheck = function() {
        if ($('#puzzle_custom_template_select').val() === 'template_page_builder.php') {
            $('#postdivrich, #post-preview').hide();
            $('#puzzle_page_builder_options').show();
            $('#using-puzzle-page-builder').val(1);
        } else {
            $('#postdivrich, #post-preview').show();
            $('#puzzle_page_builder_options').hide();
            $('#using-puzzle-page-builder').val(0);
        }
    };
    
    if ($('#puzzle_custom_template_select').length > 0) {
        customTemplateCheck();
        $('#puzzle_custom_template_select').change(customTemplateCheck);
    }
    
    /* Allow user to sort sections and columns using jQuery UI sortable */
    $('.puzzle-sections').sortable({
        distance: 10,
        items: '.puzzle-section',
        revert: 100,
        tolerance: 'pointer'
    });
    $('.puzzle-columns-area').sortable({
        distance: 10,
        revert: 100,
        tolerance: 'pointer'
    });
    
    /* Show and hide add section buttons */
    $document.on('click', '.puzzle-add-section-open-buttons', function(e) {
        e.preventDefault();
        $(this).siblings('.puzzle-add-section-buttons').toggleClass('show');
    });
    
    $document.bind('click', function(e) {
        if ($(e.target).closest('.puzzle-add-section-open-buttons, .puzzle-add-section-buttons').length === 0) {
            $('.puzzle-add-section-buttons').removeClass('show');
        }
    });
    
    /* Show and hide sections and columns */
    $document.on('click', '.puzzle-section-menu-title', function(e) {
        e.preventDefault();
        
        if ($(e.target).hasClass('.puzzle-collapse-all') || $(e.target).closest('.puzzle-collapse-all').length > 0) {
            return false;
        }
        
        var $t = $(this),
            $menu = $t.closest('.puzzle-section-menu'),
            $collapsableContent = $menu.siblings('.puzzle-collapsable-content'),
            $allMenus = $t.closest('.puzzle-section').find('.puzzle-section-menu'),
            $sectionMenu = $allMenus.first();
        
        if ($menu.hasClass('show')) {
            $menu.removeClass('show');
            $collapsableContent.slideUp();
            
            if ($allMenus.length === $allMenus.not('.show').length) {
                $sectionMenu.removeClass('show-all');
            }
        } else {
            $menu.addClass('show');
            $collapsableContent.slideDown();
            
            if ($allMenus.not('.show').length === 0) {
                $sectionMenu.addClass('show-all');
            }
        }
    });
    
    /* Show and hide all content in a section */
    $document.on('click', '.puzzle-collapse-all', function(e) {
        e.preventDefault();
        
        var $t = $(this),
            $menu = $t.closest('.puzzle-section-menu'),
            $collapsableContents = $t.closest('.puzzle-section').find('.puzzle-collapsable-content'),
            $allMenus = $t.closest('.puzzle-section').find('.puzzle-section-menu');
        
        if ($menu.hasClass('show-all')) {
            $menu.removeClass('show-all');
            $allMenus.removeClass('show');
            $collapsableContents.slideUp();
        } else {
            $menu.addClass('show-all');
            $allMenus.addClass('show');
            $collapsableContents.slideDown();
        }
    });
    
    /* Remove a section or column */
    $document.on('click', '.puzzle-remove-section', function(e) {
        e.preventDefault();
        
        var $section = $(this).closest('.puzzle-section, .puzzle-page-builder-column'),
            $chooseSectionButtons = $section.next('.puzzle-add-section');
        
        if ($chooseSectionButtons.length > 0) { $chooseSectionButtons.remove(); }
        $section.remove();
    });
    
    /* Add image */
    var custom_uploader;
    
    $document.on('click', '.puzzle-add-image-button', function(e) {
        e.preventDefault();
        var $button = $(this);

        /* If the uploader object has already been created, reopen the dialog */
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        /* Extend the wp.media object */
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose File',
            button: {
                text: 'Choose File'
            },
            multiple: false
        });
        
        /*
         * When a file is selected, set the input's value as the post ID
         * and the preview image's src as the url.
         *
         * Saving the post ID instead of the url gives us more options
         * in terms of WordPress functions later.
         */
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $button.siblings('input').val(attachment.id);
            $button.siblings('img').replaceWith('<img width="' + attachment.sizes.full.width + '" height="' + attachment.sizes.full.height + '" src="' + attachment.url + '" alt="' + attachment.alt + '" />');
        });

        /* Open the uploader dialog */
        custom_uploader.open();
    });
    
    /* Remove image */
    $document.on('click', '.puzzle-remove-image-button', function(e) {
       e.preventDefault();
       var $button = $(this);
       $button.siblings('input').val('');
       $button.siblings('img').replaceWith('<img src="" />');
    });
    
    /* WYSIWYG editor */
    var $puzzleEditor = $('.puzzle-text-editor-area'),
        $puzzleEditorHTML = $('#puzzlecustomeditor'),
        $visualButton = $('#puzzlecustomeditor-tmce'),
        $textButton = $('#puzzlecustomeditor-html'),
        $updateButton = $('#puzzle-update-content'),
        $cancelButton = $('#puzzle-cancel-editor');
    
    $document.on('click', '.open-editor-button', function(e) {
        e.preventDefault();
        $body.addClass('modal-open');
        
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
            $body.removeClass('modal-open');
        });

        $cancelButton.click(function(e) {
            e.preventDefault();
            $puzzleEditor.removeClass('show');
            $body.removeClass('modal-open');
        });
    });
    
    /* Add icon */
    var $iconLibrary = $('.puzzle-icon-library'),
        $iconChoices = $('.puzzle-icon-choice'),
        $cancelIconButton = $('.puzzle-cancel-icon');
    
    $document.on('click', '.puzzle-add-icon', function(e) {
        e.preventDefault();
        var $iconDisplay = $(this).siblings('i'),
            $iconInput = $(this).siblings('input');
        
        $iconLibrary.addClass('show');
        $body.addClass('modal-open');
        
        $iconChoices.click(function(e) {
            e.preventDefault();
            $iconLibrary.removeClass('show');
            iconValue = $(this).children('i').attr('class');
            
            $iconInput.val(iconValue);
            $iconDisplay.attr('class', iconValue);
            $body.removeClass('modal-open');
            
            $iconChoices.off('click');
            $cancelIconButton.off('click');
        })
        
        $cancelIconButton.click(function(e) {
            e.preventDefault();
            $iconLibrary.removeClass('show');
            $body.removeClass('modal-open');
            
            $iconChoices.off('click');
            $cancelIconButton.off('click');
        })
    });
    
    /* Search icons */
    $document.on('keyup', '.puzzle-icon-library-search', function() {
        var searchValue = $(this).val();
        
        $('.puzzle-icon-library .puzzle-icon-choice').hide();
        $('.puzzle-icon-library .puzzle-icon-choice').filter(function() {
            return $(this).text().indexOf(searchValue) !== -1;
        }).show();
    });
    
    /* Show/hide tip */
    $document.on('click', '.puzzle-field-tip-button', function() {
        var $tipText = $(this).siblings('.puzzle-field-tip-content').children();
        $tipText.slideToggle();
    });

    /* Open/close dropdown */
    $document.on('click', '.puzzle-dropdown-trigger', function(e) {
        e.preventDefault();

        var $dropdown = $(this).closest('.puzzle-has-dropdown').children('ul');
        $dropdown.toggleClass('show');

        // Close other dropdowns
        $('.puzzle-has-dropdown ul.show').not($dropdown).removeClass('show');
    });
    
    /*
     * Close all dropdowns when the user clicks on something that is
     * not a dropdown
     */
    $document.bind('click', function(e) {
        if ($(e.target).closest('.puzzle-has-dropdown').length === 0) {
            $('.puzzle-has-dropdown').children('ul').removeClass('show');
        }
    });
    
    /* Initialize WordPress color picker */
    var $colorFields = $('.puzzle-color-field');
    if ($colorFields.length > 0) { $colorFields.wpColorPicker(); }
});

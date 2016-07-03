jQuery('document').ready(function($) {
    var $window = $(window);
    
    // Check if mobile width
    var isMobileWidth = function() {
        if ($mobileMenu.css('display') === 'block') {
            return true;
        } else {
            return false;
        }
    }
    
    // Accordion hide and reveal
    var $accordionHeadlines = $('.puzzle-accordion-headline'),
        $accordionButtons = $accordionHeadlines.find('.fa');

    var scrollToContent = function($content, time) {
        setTimeout(function() {
            var windowTop = $window.scrollTop(),
                windowHeight = $window.height(),
                windowBottom = windowTop + windowHeight,
                contentHeight = $content.outerHeight(),
                contentBottom = $content.offset().top + contentHeight;
        
            /*
             * If the user cannot see all of the new content,
             * scroll to a point where it is visible.
             */
            if (windowBottom < contentBottom) {
                var scrollPosition = $content.offset().top;
            
                /*
                 * On small screens or when the content is tall relative to the window,
                 * scroll so that the top of the new content is visible.
                 * Else, scroll far enough that the bottom of the new content is visible.
                 */
                if (isMobileWidth() || contentHeight > windowHeight - 150) {
                    scrollPosition -= 150;
                } else {
                    scrollPosition += contentHeight - windowHeight + 100;
                }
            
                $('html, body').animate({
                   scrollTop: scrollPosition
                }, 1000);
            }
        }, time);
    };

    $accordionHeadlines.click(function() {
        var $area = $(this).parents('.puzzle-accordions-content > .column > div'),
            $content = $area.find('.puzzle-accordion-content'),
            $siblingAccordionAreas = $area.parents('.puzzle-accordions-content').find('.column > div').not($area),
            $siblingAccordionContents = $area.parents('.puzzle-accordions-content').find('.puzzle-accordion-content').not($content),
            duration = 500;
            
        if ($siblingAccordionContents.filter(':visible').length > 0 && $content.parents('.puzzle-accordions-one-open').length > 0) {
            $siblingAccordionContents.slideUp(duration);
            $siblingAccordionAreas.removeClass('active-accordion');
            
            setTimeout(function() {
                $content.slideToggle(duration);
                $area.toggleClass('active-accordion');
                scrollToContent($area, duration);
            }, duration);
        } else {
            $content.slideToggle(duration);
            $area.toggleClass('active-accordion');
            scrollToContent($area, duration);
        }
    });
});
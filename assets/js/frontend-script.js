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
    var $accordionHeadlines = $('.pz-accordion-headline'),
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
        var $accordion = $(this).closest('.pz-accordion'),
            $content = $accordion.find('.pz-accordion-content'),
            $siblingAccordions = $accordion.closest('.pz-accordions-content').find('.pz-accordion').not($accordion),
            $siblingAccordionContents = $accordion.closest('.pz-accordions-content').find('.pz-accordion-content').not($content),
            duration = 500;
            
        if ($siblingAccordions.filter(':visible').length > 0 && $content.parents('.pz-accordions-one-open').length > 0) {
            $siblingAccordions.slideUp(duration);
            $siblingAccordionAreas.removeClass('pz-active-accordion');
            
            setTimeout(function() {
                $content.slideToggle(duration);
                $accordion.toggleClass('pz-active-accordion');
                scrollToContent($accordion, duration);
            }, duration);
        } else {
            $content.slideToggle(duration);
            $accordion.toggleClass('pz-active-accordion');
            scrollToContent($accordion, duration);
        }
    });
});

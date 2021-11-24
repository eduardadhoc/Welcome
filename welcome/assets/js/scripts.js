(function ($, root, undefined) {
	$('#pick').click(function(){
		$('.modal-welcome-container').addClass('visible');
	});
	$('.modal-welcome button').click(function(){
		$('.modal-welcome-container').removeClass('visible');
	});
	
	
	//Amagar boto scroll
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('.modal-welcome button').outerHeight();

    $(window).scroll(function(event){
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            $('.modal-welcome button').removeClass('nav-down').addClass('nav-up');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $('.modal-welcome button').removeClass('nav-up').addClass('nav-down');
            }
        }

        lastScrollTop = st;
    }	
})(jQuery, this);
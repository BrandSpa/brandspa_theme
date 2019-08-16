(function($){
	$(document).ready(function(){
		const header = $(".fade-transparent");
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			if (scroll >= 200) {
				header.removeClass('fade-transparent').addClass("fade-background");
			} else {
				header.removeClass("fade-background").addClass('fade-transparent');

			}
		});
	})
})(jQuery)

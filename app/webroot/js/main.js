$(document).ready(function () {
	var offset = 100;
	$('.navbar li a[href^="#"]').click(function(event) {
	    event.preventDefault();
	    $($(this).attr('href'))[0].scrollIntoView();
	    scrollBy(0, -offset);
	});

	$("[title]").tooltip({
		container: 'body', 
		html:true
	});

});
$(document).ready(function () {
	var offset = 100;
	$('a[href^="#"]').click(function(event) {
	    event.preventDefault();
	    $($(this).attr('href'))[0].scrollIntoView();
	    scrollBy(0, -offset);
	});

	$("label[title]").tooltip({
		container: 'body', 
		html:true,
		delay:{show:500,hide:0},
		placement:'left'
	});
	$("[title]").tooltip({
		container: 'body', 
		html:true,
		delay:{show:500,hide:200},
		placement:'bottom'
	});

});
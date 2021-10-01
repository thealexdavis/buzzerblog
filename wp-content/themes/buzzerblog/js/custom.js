jQuery(document).ready(function($) {
	$( "header#header a.menu, header#header .main a.close" ).click(function(e) {
		e.preventDefault();
		$("header#header .main").toggleClass("active");
	});
	$( "header#header a.search, header#header #search_box a.close" ).click(function(e) {
		e.preventDefault();
		$("header#header #search_box").toggleClass("active");
	});
	$( "iframe" ).each(function( index ) {
		if($(this).attr("src").includes("youtube.com") && $(this).parent("p")[0]){
			$(this).wrap( "<div class='wp-block-embed'><div class='wp-block-embed__wrapper'></div></div>" );
		}
	});
});
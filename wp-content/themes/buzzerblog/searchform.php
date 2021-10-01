<div id="search_box">
	<a class="close"><i class="far fa-times-circle"></i></a>
	<div class="container">
		<form action="/" method="get" class="search_form">
				<input type="text" name="s" id="search" placeholder="" title="Search" aria-label="" value="<?php the_search_query(); ?>" />
				<button type="submit" id="submit"><i class="fas fa-search" aria-hidden="true" title="Begin Search"></i></button>
				<input type="submit" value="Search">
		</form>
	</div>
</div>
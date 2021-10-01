<?php get_header(); 
$alert = "";
if ( is_active_sidebar( 'sitewide_alert' ) ){ if (!isset($_COOKIE['alert'])){ $alert = "alert"; } }
?>
	<div class="entry-content-page interior warningpage <?php echo $alert; ?>" id="main_content">
		<div class="container">
			<div id="top_hero"<?php if(get_the_post_thumbnail_url()){ echo 'class="withimg"'; } ?>>
				<div class="container">
					<h1>Sorry!</h1>
				</div>
			</div>
			<div class="fl-builder-content"><div class="fl-row">
			<h2>Page Not Found</h2>
			<p>We're sorry, the page you requested could not be found. This may be due to recent changes in our sitemap. You can use our site search to find what you're looking for.</p>
			<br>
			</div></div>
		</div>
	</div>

<?php  get_footer(); ?>
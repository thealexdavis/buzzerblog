<footer id="footer">
	<div class="top">
		<div class="container">
			<?php wp_nav_menu(array(
				'container' => false,                           // remove nav container
				'container_class' => 'menu cf',                 // class of container (should you choose to use it)
				'menu' => __( 'Social Media', 'buzzerblog' ),  // nav name
				'menu_class' => 'social cf',               // adding custom nav class
				'theme_location' => 'footer_nav_col_3',                 // where it's located in the theme
				'before' => '',                                 // before the menu
				'after' => '',                                  // after the menu
				'link_before' => '',                            // before each link
				'link_after' => '',                             // after each link
				'depth' => 0,                                   // limit the depth of the nav
				'fallback_cb' => ''                             // fallback function (if there is one)
			)); ?>
			<?php wp_nav_menu(array(
				'container' => false,                           // remove nav container
				'container_class' => 'menu cf',                 // class of container (should you choose to use it)
				'menu' => __( 'Footer Nav', 'buzzerblog' ),  // nav name
				'menu_class' => 'footernav cf',               // adding custom nav class
				'theme_location' => 'footer_nav_col_1',                 // where it's located in the theme
				'before' => '',                                 // before the menu
				'after' => '',                                  // after the menu
				'link_before' => '',                            // before each link
				'link_after' => '',                             // after each link
				'depth' => 0,                                   // limit the depth of the nav
				'fallback_cb' => ''                             // fallback function (if there is one)
			)); ?>
		</div>
	</div>
	<div class="bottom">
		<div class="container">
			<p>&copy; <?php echo date("Y"); ?> BuzzerBlog. All Rights Reserved.</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>

</body>
</html>
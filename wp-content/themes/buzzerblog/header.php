<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
  	<meta charset="utf-8">

	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/64323aca54.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/css/slick.css">
	<link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"
    />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/css/hamburgers.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/css/main.css">
	
	<?php wp_head(); ?>
	
	<?php
		global $post;
		if (!empty($post)){
			$post_slug=$post->post_name;
		}
		$postTypeName = "";
		if(!is_archive()){
			if(get_post_type($post) == "review"){
				$postTypeName = "Review: ";
			}
		}
		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
		$metaExcerpt = esc_html(get_the_excerpt());
		$metaThumb = get_the_post_thumbnail_url();
		$metaTitle = get_the_title();
		if(is_front_page()){
			$metaThumb = "https://www.buzzerblog.com/wp-content/uploads/2015/08/cropped-BuzzerBlog-Icon.png";
			$metaExcerpt = "Your Game Show News Source";
		}
		if(get_post_type($post) == "show"){
			$metaTitle = "Show: ".get_the_title();
			$postmeta = get_post_meta($post->ID);
			if ( has_post_thumbnail(get_the_ID())) { 
	        	$metaThumb = get_the_post_thumbnail_url(get_the_ID());
	        } else {
		        $metaThumb = $postmeta['img'][0];
	    	}
	    	$metaExcerpt = esc_html($postmeta['api_summary'][0]);
		} else if(get_post_type($post) == "review"){
			$metaTitle = "Review: ".get_the_title();
			$postmeta = get_post_meta($post->ID);
			if ( has_post_thumbnail(get_the_ID())) { 
	        	$metaThumb = get_the_post_thumbnail_url(get_the_ID());
	        }
	    	$metaExcerpt = esc_html(get_the_excerpt());
		} else if(is_category()){
			$catName = single_term_title( "", false );
			$metaTitle = $catName.' Archive | BuzzerBlog';
			$metaThumb = "https://www.buzzerblog.com/wp-content/uploads/2015/08/cropped-BuzzerBlog-Icon.png";
			$metaExcerpt = "View the ".$catName." archive from BuzzerBlog";
		} else if(is_tag()){
			$catName = single_term_title( "", false );
			$metaTitle = $catName.' Archive | BuzzerBlog';
			$metaThumb = "https://www.buzzerblog.com/wp-content/uploads/2015/08/cropped-BuzzerBlog-Icon.png";
			$metaExcerpt = "View the ".$catName." archive from BuzzerBlog";
		} else {
			$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
			if($url_path == "news"){
				$metaTitle = 'News | BuzzerBlog';
				$metaThumb = "https://www.buzzerblog.com/wp-content/uploads/2015/08/cropped-BuzzerBlog-Icon.png";
				$metaExcerpt = "Get all the latest news from BuzzerBlog";
			}
			if($url_path == "review"){
				$metaTitle = 'Reviews | BuzzerBlog';
				$metaThumb = "https://www.buzzerblog.com/wp-content/uploads/2015/08/cropped-BuzzerBlog-Icon.png";
				$metaExcerpt = "Find all the best game show reviews from BuzzerBlog";
			}
		}
		if($metaThumb == ""){
			$metaThumb = "https://www.buzzerblog.com/wp-content/uploads/2015/08/cropped-BuzzerBlog-Icon.png";
		}
    ?>
    
    <meta property="og:title" content="<?php echo $metaTitle; ?>">
	<meta property="og:description" content="<?php echo $metaExcerpt; ?>">
	<meta property="og:image" content="<?php echo $metaThumb; ?>">
	<meta property="og:url" content="<?php echo get_the_permalink(); ?>">
	<meta name="twitter:title" content="<?php echo $metaTitle; ?>">
	<meta name="twitter:description" content="<?php echo $metaExcerpt; ?>">
	<meta name="twitter:image" content="<?php echo $metaThumb; ?>">
	<meta name="twitter:card" content="summary_large_image">
    
    <title><?php echo $postTypeName; wp_title( '|', true, 'right' ); ?> BuzzerBlog | Your Game Show News Source</title>
	
	<!--[if lt IE 9]>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->
	
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2104061955655083" crossorigin="anonymous"></script>
	
</head>

<?php
	$loginclass = "";
	if ( !is_user_logged_in() ) {
		$loginclass = "user";
	}
?>

<body id="buzzerblog" class="<?php echo $loginclass; ?> <?php if(is_front_page()){echo 'front'; }; if(is_archive()){echo 'archive'; }; echo get_post_type(); ?>" data-id="<?php echo get_the_id(); ?>">
	
	<header id="header">
		<div id="utility">
			<div class="container">
				<?php include 'elements/navigation.php'; ?>
			</div>
		</div>
		<div id="core">
			<div class="container">
				<a href="/" class="logo"><img src="/wp-content/themes/buzzerblog/img/logo.svg"></a>
				<div class="nav_btns">
					<a class="search"><i class="fas fa-search"></i></a>
					<a class="menu"><i class="fas fa-bars"></i></a>
				</div>
				<?php 
					if(is_author()){
						echo '<h1 class="hidden">ARTICLES BY '.trim( "$fname $lname" ).'</h1>';
					} else if(is_archive()){
						echo '<h1 class="hidden">'.strtoupper(get_post_type()).' ARCHIVE</h1>';
					} else if(is_search()){
						echo '<h1 class="hidden">SEARCH RESULTS FOR '.strtoupper(get_search_query()).'</h1>';
					}
				?>
				<p>
					<?php if(is_author()){
						$fname = get_the_author_meta('first_name');
						$lname = get_the_author_meta('last_name');
						echo 'ARTICLES BY '.trim( "$fname $lname" );
					} else if(is_category()){
						echo strtoupper(single_term_title()).' ARCHIVE';
					} else if(is_tax()){
						$taxonomy = get_query_var( 'taxonomy' );
					    $queried_object = get_queried_object();
					    $term_id =  (int) $queried_object->term_id;
					    $term = get_term_by( 'id', $term_id, $taxonomy);
					    if($taxonomy == "network"){
							echo strtoupper($term->name)." SHOW ARCHIVE";
						} else {
							echo strtoupper($term->name).' ARCHIVE';
						}
					} else if(is_tag()){
						$category = get_queried_object();
						echo strtoupper('TAG ARCHIVE FOR "'.$category->slug.'"');
					} else if(is_archive()){
						echo strtoupper(get_post_type()).' ARCHIVE';
					} else if(is_search()){
						echo 'SEARCH RESULTS FOR '.strtoupper(get_search_query());
					} else {
						$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
						if(strpos($url_path, "show/") !== false && strpos($url_path, "/news") !== false){
							$showSlug = str_replace("/news", "", $url_path);
							$showSlugArray = explode("/page", $showSlug);
							$showSlug = $showSlugArray[0];
							for($x=0;$x<99;$x++){
								$showSlug = str_replace("/".$x, "", $showSlug);
							}
							$showId = url_to_postid(site_url($showSlug));
							echo get_the_title($showId)." NEWS ARCHIVE";	
						} else {
							date_default_timezone_set('America/New_York'); 
							echo date("F j, Y"); ?> &bull; YOUR GAME SHOW NEWS SOURCE
						<?php }
					 } ?>
				</p>
			</div>
			<?php echo get_search_form(); ?>
		</div>
		<?php include 'elements/main_nav.php'; ?>
	</header>
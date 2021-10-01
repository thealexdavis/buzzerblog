<?php get_header(); 
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$showSlug = str_replace("/video", "", $url_path);
	for($x=0;$x<99;$x++){
		$showSlug = str_replace("/".$x, "", $showSlug);
	}
	$showId = url_to_postid(site_url($showSlug));
	$paginationId = substr($url_path, strpos($url_path, "/video") + 1);
	$paginationId = str_replace("video", "", $paginationId);
	$paginationId = str_replace("/", "", $paginationId);
	if($paginationId == ""){
		$paginationId = 1;
	}
	$args = array(
	    'posts_per_page'   => 10,
	    'post_type'        => 'video',
	    'meta_query' => array(
	       array(
	           'key' => 'show_'.$showId,
	           'value' => 1  // for example: '111'
	       )
	   ),
	   'paged' => $paginationId
	);
	$the_query = new WP_Query( $args );
	$postItems = $the_query->posts;
	$my_wp_query = new WP_Query();
	$reviewsPages = $my_wp_query->query(array('post_type' => array('review'), 'posts_per_page' => -1, 'orderby'=> 'date', 'order' => 'DESC'));
// 	echo get_avatar_url($author->ID);
?>
	
	<div class="container post">
	        <div class="entry-content-page post archives singlevideo" id="main_content">
		        <div class="container">
				    <div class="the_post">
					    <div class="content">
						     <div class="title">
							    <h1><?php echo get_the_title($showId); ?> Video Archive</h1>
						    </div>
						    <div class="videoholder">
						  	<?php
						   if(count($postItems) > 0){
							   foreach($postItems as $post){
						    	$postmeta = get_post_meta( $post->ID ); 
								?>
	           				<div class="item">
		           				<a href="<?php echo $postmeta['videourl'][0]; ?>" data-fancybox>
		           				<?php
							    	 if($postmeta['videourl'][0] && $postmeta['videourl'][0] !== ""){
								    	parse_str( parse_url( $postmeta['videourl'][0], PHP_URL_QUERY ), $youtubeVidArray );
								    	$videoId = $youtubeVidArray['v'];
								    	echo '<img src="https://img.youtube.com/vi/'.$videoId.'/maxresdefault.jpg" alt="'.get_the_title($post->ID).'">';
							    	}  
							    ?>
							    <p><?php echo get_the_title($post->ID); ?></p>
		           				</a>
	           				</div>
	           				<?php
					    } } else {
						    echo "<h2>We're sorry, there are no results for what you're looking for. Please click one of the navigation links above to visit another page, or use the site search to find what you're looking for.</h2>";
					    }
					    ?>
					    </div>
					    </div>
					    <div class="sidebar">
						     <?php
							$showInstance = get_post($showId);
							if($showInstance){ 
								$showMeta = get_post_meta($showId); 
								$reviewFound = false;
								$reviewUrl = "";
								foreach($reviewsPages as $thisPage){
									$reviewmeta = get_post_meta( $thisPage->ID );
									if($reviewmeta['show_'.$showId] && $reviewmeta['show_'.$showId][0] == 1){
										$reviewFound = true;
										$reviewUrl = get_the_permalink($thisPage->ID);
										$thisValD = ($reviewmeta['ag_score1'][0] / 10 * 100) + ($reviewmeta['ag_score2'][0] / 10 * 100) + ($reviewmeta['ag_score3'][0] / 10 * 100);
										$scoreVal = $thisValD / 3; 
										$thisScore = $scoreVal;
									}
								}
							?>
								<div class="passport">
									<?php
								    	if ( has_post_thumbnail($showId)) { 
								        	echo '<img src="'.get_the_post_thumbnail_url($showId).'" alt="'.get_the_title($showId).' Logo">';
								        } else {
									        echo '<img src="'.$showMeta['img'][0].'" alt="'.get_the_title($showId).' Logo">';
								    	}
								    ?>
								     <p class="review"><a class="review" href="<?php echo get_the_permalink($showId); ?>"><?php if($reviewFound){?><span class="score"><?php echo changePercent($thisScore); ?>/5</span><?php } ?><span class="title"><?php echo $showInstance->post_title; ?></span></a></p>
								    <?php $networkTerms = get_the_terms($showId,'network'); if(count($networkTerms) > 0){ foreach($networkTerms as $networkTerm){ ?>
								    	<p class="network"><a href="/network/<?php echo $networkTerm->slug; ?>"><?php echo $networkTerm->name; ?></a></p>
								    <?php }} ?>
								    <?php if($reviewUrl && $reviewUrl !== ""){?>
								    	<p class="link"><a href="<?php echo $reviewUrl; ?>">Our Review</a></p>
								    <?php } ?>
								    <p class="link"><a href="<?php echo get_the_permalink($showId); ?>news">Read News</a></p>
							    </div>
							<?php }
										
							?>
						    <div class="popular">
						   		<h4>What's Popular Today</h4>
						   		<?php wpp_get_mostpopular(array(
							        'limit' => 5,
							        'range' => 'last24hours',
							        'order_by' => 'views',
							        'stats_views' => 0
							    )); ?>
						    </div>
						</div>
				    </div>
		        </div>
	        </div>
	</div>
<?php  get_footer(); ?>
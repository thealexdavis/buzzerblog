<?php get_header(); 
	$reviewUrl = false;
	$my_wp_query = new WP_Query();
	$reviewsPages = $my_wp_query->query(array('post_type' => array('review'), 'posts_per_page' => -1, 'orderby'=> 'date', 'order' => 'DESC'));
?>
	
	<div class="container post">
		<?php
	    while ( have_posts() ) : the_post();
	    $postmeta = get_post_meta( $post->ID ); ?>
	        <div class="entry-content-page post" id="main_content">
<!--
		        <div id="hero">
					<div class="container">
						<div class="content">
							<h1><?php echo the_title(); ?></h1>
							<p><?php the_date('m.d.y'); ?></p>
						</div>
					</div>
				</div>
-->
		        <?php if ( get_the_post_thumbnail_url(get_the_ID()) !== "" ) { 
		        //	echo '<div class="img" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID()).')"></div>';
		        } ?>
		        <div class="container">
			         <?php
				    	if(has_post_thumbnail()){
					    	echo '<div class="hero_holder"><img class="hero" src="'.get_the_post_thumbnail_url($post,"hero-img").'"></div>';
				    	}  
				    ?>
				    <div class="info">
					    <div class="sub">
						    <?php if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
							   echo '<span class="teaser">'.$postmeta['teaser'][0].'</span>'; 
						    } ?>
						    <span class="date"><?php echo get_the_date("F j, Y"); ?></span>
					    </div>
					    <div class="title">
						    <h1><?php echo the_title(); ?>  </h1>
						    <?php if(has_excerpt()){
							    echo '<h2> '.get_the_excerpt().'</h2>';
						    } ?>
					    </div>
					    <div class="author">
					    	<a class="by" href="#">BY <?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('last_name'); ?></a><br>
					    	<?php if(get_the_author_meta('twitter') && get_the_author_meta('twitter') !== ""){ ?>
					    		<a class="twitter" href="https://www.twitter.com/<?php echo get_the_author_meta('twitter'); ?>" target="_blank"><i class="fab fa-twitter"></i> @<?php echo get_the_author_meta('twitter'); ?></a>
					    	<?php } ?>
					    </div>
				    </div>
				    <div class="the_post">
					    <div class="content">
						    <?php if($postmeta['ag_video_url'][0] && $postmeta['ag_video_url'][0] !== ""){ 
							    parse_str( parse_url( $postmeta['ag_video_url'][0], PHP_URL_QUERY ), $youtubeVar );
						    ?>
								<div class="wp-block-embed"><div class="wp-block-embed__wrapper">
								  <iframe width="560" height="349" src="https://www.youtube.com/embed/<?php echo $youtubeVar['v']; ?>" frameborder="0" allowfullscreen></iframe>
								</div></div>
						    <?php } ?>
	           				<?php the_content(); ?>
					    </div>
					    <div class="sidebar">
						    <?php
							    if($postmeta['excludePassport'][0] !== 1 && $postmeta['excludePassport'][0] !== "1"){
	// 								print_r($postmeta);  
									foreach($postmeta as $key => $value) {
										if(strpos($key, "show_") !== false){
											if($value[0] == 1){
												$showId = str_replace("show_", "", $key);
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
													    <p class="link"><a href="<?php echo get_the_permalink($showId); ?>video">Watch Videos</a></p>
												    </div>
												<?php }
											}
										}
									}
								}
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
	
	    <?php
	    endwhile;
	    wp_reset_query();
	    ?>
	</div>
<?php  get_footer(); ?>
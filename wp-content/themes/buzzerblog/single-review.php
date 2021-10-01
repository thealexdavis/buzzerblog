<?php get_header(); ?>
	
	<div class="container post">
		<?php
	    while ( have_posts() ) : the_post();
	    $postmeta = get_post_meta( $post->ID ); ?>
	        <div class="entry-content-page post review" id="main_content">
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
					    <?php if($postmeta['longteaser'][0] && $postmeta['longteaser'][0] !== ""){
							   echo '<p class="extra">'.$postmeta['longteaser'][0].'</p>'; 
						} ?>
					    <div class="sub">
						    <?php if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
							   echo '<span class="teaser">'.$postmeta['teaser'][0].'</span>'; 
						    } ?>
						    <span class="date"><?php echo get_the_date("F j, Y"); ?></span>
					    </div>
					    <div class="title">
						    <h1>Review: <?php echo the_title(); ?>  </h1>
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
	           				<?php the_content(); ?>
					    </div>
					    <div class="sidebar">
						    <div class="metrics">
								<h4>What do we think?</h4>
								<div class="metric">
									<h5>Game</h5>
									<?php if($postmeta['ag_score1'][0] && $postmeta['ag_score1'][0] !== ""){ $thisValA = $postmeta['ag_score1'][0]; ?>
										<div class="bar"><div class="fill" style="width: <?php echo $thisValA / 10 * 100; ?>%"></div>
											<span>
												<?php 
													$scoreVal = $thisValA / 10 * 100; 
													$thisScore = $scoreVal;
													echo changePercent($thisScore)."/5";
												?>
											</span>
										</div>
									<?php } ?>
								</div>
								<div class="metric">
									<h5>Show</h5>
									<?php if($postmeta['ag_score2'][0] && $postmeta['ag_score2'][0] !== ""){ $thisValB = $postmeta['ag_score2'][0]; ?>
										<div class="bar"><div class="fill" style="width: <?php echo $thisValB / 10 * 100; ?>%"></div>
											<span>
												<?php 
													$scoreVal = $thisValB / 10 * 100; 
													$thisScore = $scoreVal;
													echo changePercent($thisScore)."/5";
												?>
											</span>
										</div>
									<?php } ?>
								</div>
								<div class="metric">
									<h5>Game Show</h5>
									<?php if($postmeta['ag_score3'][0] && $postmeta['ag_score3'][0] !== ""){ $thisValC = $postmeta['ag_score3'][0]; ?>
										<div class="bar"><div class="fill" style="width: <?php echo $thisValC / 10 * 100; ?>%"></div>
											<span>
												<?php 
													$scoreVal = $thisValC / 10 * 100; 
													$thisScore = $scoreVal;
													echo changePercent($thisScore)."/5";
												?>
											</span>
										</div>
									<?php } ?>
								</div>
								<div class="metric final">
									<h5>Final Score</h5>
									<?php $thisValD = ($thisValA / 10 * 100) + ($thisValB / 10 * 100) + ($thisValC / 10 * 100); ?>
									<div class="bar"><div class="fill" style="width: <?php echo $thisValD / 3; ?>%"></div>
										<span>
											<?php 
												$scoreVal = $thisValD / 3; 
												$thisScore = $scoreVal;
												echo changePercent($thisScore)."/5";
											?>
										</span>
									</div>
									<?php if($postmeta['ag_rating_summary'][0] && $postmeta['ag_rating_summary'][0] !== ""){ ?>
									<div class="copy">
										<p><?php echo $postmeta['ag_rating_summary'][0]; ?></p>
									</div>
									<?php } ?>
								</div>
						    </div>
						    <?php
// 								print_r($postmeta);  
								foreach($postmeta as $key => $value) {
									if(strpos($key, "show_") !== false){
										if($value[0] == 1){
											$showId = str_replace("show_", "", $key);
											$showInstance = get_post($showId);
											if($showInstance){ 
												$showMeta = get_post_meta($showId); 
											?>
												<div class="passport">
												    <?php
												    	if ( has_post_thumbnail($showId)) { 
												        	echo '<a href="'.get_the_permalink($showId).'"><img src="'.get_the_post_thumbnail_url($showId).'" alt="'.get_the_title($showId).' Logo"></a>';
												        } else {
													        echo '<a href="'.get_the_permalink($showId).'"><img src="'.$showMeta['img'][0].'" alt="'.get_the_title($showId).' Logo"></a>';
												    	}
												    ?>
												     <p class="review"><a class="review" href="<?php echo get_the_permalink($showId); ?>"><span class="title"><?php echo $showInstance->post_title; ?></span></a></p>
												    <?php $networkTerms = get_the_terms($showId,'network'); if(count($networkTerms) > 0){ foreach($networkTerms as $networkTerm){ ?>
												    	<p class="network"><a href="/network/<?php echo $networkTerm->slug; ?>"><?php echo $networkTerm->name; ?></a></p>
												    <?php }} ?>
												    <p class="link"><a href="<?php echo get_the_permalink($showId); ?>news">Read News</a></p>
												    <p class="link"><a href="<?php echo get_the_permalink($showId); ?>video">Watch Videos</a></p>
											    </div>
											<?php }
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
<?php get_header(); 
	$reviewUrl = false;
	$my_wp_query = new WP_Query();
	$showReview = false;
	$reviewsPages = $my_wp_query->query(array('post_type' => array('review'), 'posts_per_page' => -1, 'orderby'=> 'date', 'order' => 'DESC'));
	foreach($reviewsPages as $thisPage){
		$reviewmeta = get_post_meta( $thisPage->ID );
		if($reviewmeta['show_'.$post->ID] && $reviewmeta['show_'.$post->ID][0] == 1){
			$showReview = true;
			$reviewUrl = get_the_permalink($thisPage->ID);
			$thisValD = ($reviewmeta['ag_score1'][0] / 10 * 100) + ($reviewmeta['ag_score2'][0] / 10 * 100) + ($reviewmeta['ag_score3'][0] / 10 * 100);
			$scoreVal = $thisValD / 3; 
			$thisScore = $scoreVal;
		}
	}
	$args = array(
	    'posts_per_page'   => 6,
	    'post_type'        => 'video',
	    'meta_query' => array(
	       array(
	           'key' => 'show_'.$post->ID,
	           'value' => 1  // for example: '111'
	       )
	   ),
	   'paged' => $paginationId
	);
	$the_query = new WP_Query( $args );
?>
	
	<div class="container post">
		<?php
	    while ( have_posts() ) : the_post();
	    $postmeta = get_post_meta( $post->ID ); ?>
	        <div class="entry-content-page post show" id="main_content">
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
				    <div class="the_post">
					    <div class="content">
						    <div class="title">
						     <h1><?php echo the_title(); ?></h1>
						    </div>
	           				<p class="summary"><?php echo $postmeta['api_summary'][0]; ?><?php if($postmeta['api_summary'] && $postmeta['api_summary'][0] !== ""){ ?><br><span>-Source: TVMaze</span><?php } ?></p>
	           				<ul>
		           				<?php if($postmeta['network'] && $postmeta['network'][0] !== ""){ ?><li>Network: <strong><?php echo $postmeta['network'][0]; ?></strong></li><?php } ?>
		           				<?php if($postmeta['host'] && $postmeta['host'][0] !== ""){ ?><li>Host: <strong><?php echo $postmeta['host'][0]; ?></strong></li><?php } ?>
		           				<?php if($postmeta['status'] && $postmeta['status'][0] !== ""){ ?><li>Status: <strong><?php echo $postmeta['status'][0]; ?></strong></li><?php } ?>
		           				<?php if($postmeta['debut_date'] && $postmeta['debut_date'][0] !== ""){ ?><li>Debut Date: <strong><?php echo $postmeta['debut_date'][0]; ?></strong></li><?php } ?>
		           				<?php if($postmeta['country'] && $postmeta['country'][0] !== ""){ ?><li>Country: <strong><?php echo $postmeta['country'][0]; ?></strong></li><?php } ?>
		           				<?php if($postmeta['website'] && $postmeta['website'][0] !== ""){ ?><li><a href="<?php echo $postmeta['website'][0]; ?>" target="_blank">Visit the official website</a></li><?php } ?>
	           				</ul>
	           				<hr>
	           				<?php echo wpautop($postmeta['extras'][0]); ?>
	           				<?php echo get_the_content($post->ID); ?>
	           				<?php if(count($the_query->posts) > 0){
		           				echo '<hr><div class="video_holder"><h3>Videos</h3>';
		           				foreach($the_query->posts as $videoResult){ 
			           				 $videoMeta = get_post_meta( $videoResult->ID );
		           				?>
		           					<a href="<?php echo $videoMeta['videourl'][0]; ?>" data-fancybox>
				           				<?php
									    	 if($videoMeta['videourl'][0] && $videoMeta['videourl'][0] !== ""){
										    	parse_str( parse_url( $videoMeta['videourl'][0], PHP_URL_QUERY ), $youtubeVidArray );
										    	$videoId = $youtubeVidArray['v'];
										    	echo '<img src="https://img.youtube.com/vi/'.$videoId.'/maxresdefault.jpg" alt="'.get_the_title($post->ID).'">';
									    	}  
									    ?>
									    <p><?php echo get_the_title($videoResult->ID); ?></p>
				           				</a>
		           				<?php }	
		           				echo '</div>';
		           				echo '<a href="'.get_the_permalink($post->ID).'video/" class="btn">See All Videos</a>';
		           			}?>
					    </div>
					    <div class="sidebar">
						    <div class="popular">
							    
						    <?php 
								$showId = str_replace("show_", "", $key);
								$showInstance = get_post($post->ID);
								if($showInstance){ ?>
									<div class="passport">
										 <?php
									    	if ( has_post_thumbnail(get_the_ID())) { 
									        	echo '<img src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="'.get_the_title().' Logo">';
									        } else {
										        echo '<img src="'.$postmeta['img'][0].'" alt="'.get_the_title().' Logo">';
									    	}
									    ?>
									    <p class="review"><a class="review" href="<?php echo get_the_permalink($showId); ?>"><?php if($showReview){ ?><span class="score"><?php echo changePercent($thisScore); ?>/5</span><?php } ?><span class="title"><?php echo $showInstance->post_title; ?></span></a></p>
									    <?php $networkTerms = get_the_terms($post->ID,'network'); if(count($networkTerms) > 0){ foreach($networkTerms as $networkTerm){ ?>
									    	<p class="network"><a href="/network/<?php echo $networkTerm->slug; ?>"><?php echo $networkTerm->name; ?></a></p>
									    <?php }} ?>
									    <?php if($reviewUrl && $reviewUrl !== ""){?>
									    	<p class="link"><a href="<?php echo $reviewUrl; ?>">Our Review</a></p>
									    <?php } ?>
									    <p class="link"><a href="<?php echo get_the_permalink($showId); ?>news">Read News</a></p>
									    <p class="link"><a href="<?php echo get_the_permalink($showId); ?>video">Watch Videos</a></p>
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
	
	    <?php
	    endwhile;
	    wp_reset_query();
	    ?>
	</div>
<?php  get_footer(); ?>
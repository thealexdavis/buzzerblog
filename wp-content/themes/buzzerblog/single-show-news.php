<?php get_header(); 
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$showSlug = str_replace("/news", "", $url_path);
	$showSlugArray = explode("/page", $showSlug);
	$showSlug = $showSlugArray[0];
	for($x=0;$x<99;$x++){
		$showSlug = str_replace("/".$x, "", $showSlug);
	}
	$showId = url_to_postid(site_url($showSlug));
	$my_wp_query = new WP_Query();
	$reviewsPages = $my_wp_query->query(array('post_type' => array('review'), 'posts_per_page' => -1, 'orderby'=> 'date', 'order' => 'DESC'));
	
	$offset = 1;
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$showSlugFind = str_replace("/page", "", $showSlug);
	if(strpos($url_path, $showSlugFind."/news/page/") !== false ){
		$offset = str_replace($showSlugFind."/news/page/", "", $url_path);
	}
	$offsetNum = $offset - 1;
	$postList = archiveShowPageQuery($offsetNum, $showId);
	$postListTotal = archiveShowPageQueryTotal($offsetNum, $showId);
	$totalCount = count($postListTotal);
	
// 	echo get_avatar_url($author->ID);
?>
	
	<div class="container post">
	        <div class="entry-content-page post archives singleshow" id="main_content">
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
		        <div class="container">
				    <div class="the_post">
					    <div class="content">
						  	<?php
						   if(count($postList) > 0){
							   foreach($postList as $post){
						    	$postmeta = get_post_meta( $post->ID ); 
						    	$author_id = get_post_field ('post_author', $post->ID);
								?>
	           				<div class="item">
		           				<?php
							    	if(has_post_thumbnail()){
								    	echo '<img class="hero" src="'.get_the_post_thumbnail_url($post,"hero-img").'">';
							    	}  
							    ?>
							    <div class="info">
								    <div class="sub">
									    <?php if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
										   echo '<span class="teaser">'.$postmeta['teaser'][0].'</span>'; 
									    } ?>
									    <span class="date"><?php echo get_the_date("F j, Y", $post->ID ); ?></span>
								    </div>
								    <div class="title">
									    <h3><a href="<?php echo get_the_permalink($post->ID ); ?>"><?php echo get_the_title($post->ID ); ?></a></h3>
									    <?php if(has_excerpt()){
										    echo '<p> '.get_the_excerpt($post->ID ) .'</p>';
									    } ?>
								    </div>
								    <div class="author">
								    	<a class="by" href="<?php echo get_author_posts_url($author_id); ?>">BY <?php echo get_the_author_meta('first_name', $author_id); ?> <?php echo get_the_author_meta('last_name', $author_id); ?></a>
								    </div>
								    <a href="<?php echo get_the_permalink($post->ID ); ?>" class="btn" title="Read the story <?php echo get_the_title($post->ID ); ?>">READ MORE</a>
							    </div>
	           				</div>
	           				<?php
					    } } else {
						    echo "<h2>We're sorry, there are no results for what you're looking for. Please click one of the navigation links above to visit another page, or use the site search to find what you're looking for.</h2>";
					    }
					    ?>
					    <div class="pagination">
						    <a class="new <?php if($offsetNum < 1){ echo 'disabled'; }; ?>" <?php if($offsetNum < 1){ echo 'disabled'; }; ?> <?php if($offsetNum >= 1){ ?>href="/<?php echo $showSlugFind; ?>/news/<?php if($offsetNum !== 1){?>page/<?php echo $offsetNum; ?>/<?php } ?>"<?php } ?>><i class="fas fa-chevron-left"></i> Newer</a>
						    <a class="old <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?>" <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?> <?php if(($offset*10) < $totalCount){ ?>href="/<?php echo $showSlugFind; ?>/news/page/<?php echo $offsetNum + 2; ?>/"<?php } ?>>Older <i class="fas fa-chevron-right"></i></a>
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
	</div>
<?php  get_footer(); ?>
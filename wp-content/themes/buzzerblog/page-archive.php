<?php 
/*
* Template Name: Archive
*/
	get_header(); 
	$totalCountPost = wp_count_posts('post');
	$totalCountReview = wp_count_posts('review');
	$totalCount = $totalCountPost->publish + $totalCountReview->publish;
	$offset = 1;
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if(strpos($url_path, "news/page/") !== false ){
		$offset = str_replace("news/page/", "", $url_path);
	}
	$offsetNum = $offset - 1;
	$postList = archivePageQuery($offsetNum);
// 	echo get_avatar_url($author->ID);
?>
	
	<div class="container post">
	        <div class="entry-content-page post archives testing" id="main_content">
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
						    foreach($postList as $post){
						    	$postmeta = get_post_meta( $post->ID ); 
						    	$author_id = get_post_field( 'post_author', $post->ID );
								$fname = get_the_author_meta('first_name');
								$lname = get_the_author_meta('last_name');
								?>
	           				<div class="item">
		           				<?php
							    	if(has_post_thumbnail($post->ID)){
								    	echo '<img class="hero" src="'.get_the_post_thumbnail_url($post->ID,"hero-img").'">';
							    	}  
							    ?>
							    <div class="info">
								    <div class="sub">
									    <?php if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
										   echo '<span class="teaser">'.$postmeta['teaser'][0].'</span>'; 
									    } ?>
									    <span class="date"><?php echo get_the_date("F j, Y", $post->ID); ?></span>
								    </div>
								    <div class="title">
									    <h3><a href="<?php echo get_the_permalink($post->ID); ?>"><?php if( get_post_type($post->ID) == 'review' ) { echo "Review: "; }; echo get_the_title($post->ID); ?></a></h3>
									    <?php if(has_excerpt()){
										    echo '<p> '.get_the_excerpt($post->ID).'</p>';
									    } ?>
								    </div>
								    <div class="author">
								    	<a class="by" href="<?php echo get_author_posts_url($author_id); ?>">BY <?php echo get_the_author_meta('first_name',$author_id); ?> <?php echo get_the_author_meta('last_name',$author_id); ?></a>
								    </div>
								    <a href="<?php echo get_the_permalink($post->ID); ?>" class="btn" title="Read the story <?php echo get_the_title($post->ID); ?>">READ MORE</a>
							    </div>
	           				</div>
	           				<?php
					    }
					    wp_reset_query();
					    ?>
					    <div class="pagination">
						    <a class="new <?php if($offsetNum < 1){ echo 'disabled'; }; ?>" <?php if($offsetNum < 1){ echo 'disabled'; }; ?> <?php if($offsetNum >= 1){ ?>href="/news/page/<?php echo $offsetNum; ?>/"<?php } ?>><i class="fas fa-chevron-left"></i> Newer</a>
						    <a class="old <?php if(($offsetNum*10) >= $totalCount){ echo 'disabled'; }; ?>" <?php if(($offsetNum*10) >= $totalCount){ echo 'disabled'; }; ?> <?php if(($offsetNum*10) < $totalCount){ ?>href="/news/page/<?php echo $offsetNum + 2; ?>/"<?php } ?>>Older <i class="fas fa-chevron-right"></i></a>
					    </div>
					    </div>
					    <div class="sidebar">
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
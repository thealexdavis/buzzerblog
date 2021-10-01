<?php get_header(); 
	global $wp_query;
	$tax = $wp_query->get_queried_object();
	$taxName = strtolower($tax->name);
	$totalCount = $wp_query->found_posts;
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$offset = 1;
	if(strpos($url_path, "network/".$taxName."/page/") !== false ){
		$offset = str_replace("network/".$taxName."/page/", "", $url_path);
	}
	$offsetNum = $offset - 1;
// 	echo get_avatar_url($author->ID);
?>
	
	<div class="container post">
	        <div class="entry-content-page post archives category" id="main_content">
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
						    while ( have_posts() ) : the_post();
						    	$postmeta = get_post_meta( $post->ID ); ?>
	           				<div class="item">
		           				<?php
							    	if ( has_post_thumbnail($post->ID)) { 
							        	echo '<img src="'.get_the_post_thumbnail_url($showId).'" class="hero" alt="'.get_the_title($post->ID).' Logo">';
							        } else {
								        echo '<img src="'.$postmeta['img'][0].'" class="hero" alt="'.get_the_title($post->ID).' Logo">';
							    	} 
							    ?>
							    <div class="info">
								    <div class="title">
									    <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
									     <?php if($postmeta['api_summary'][0] && $postmeta['api_summary'][0] !== ""){
										   echo '<p>'.$postmeta['api_summary'][0].'</p>'; 
									    } ?>
								    </div>
								    <a href="<?php echo get_the_permalink(); ?>" class="btn" title="Read the story <?php echo get_the_title(); ?>">READ MORE</a>
							    </div>
	           				</div>
	           				<?php
					    endwhile;
					    wp_reset_query();
					    ?>
					     <div class="pagination">
						    <a class="new <?php if($offsetNum < 1){ echo 'disabled'; }; ?>" <?php if($offsetNum < 1){ echo 'disabled'; }; ?> <?php if($offsetNum >= 1){ ?>href="/network/<?php echo $taxName; ?>/page/<?php echo $offsetNum; ?>/"<?php } ?>><i class="fas fa-chevron-left"></i> Newer</a>
						    <a class="old <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?>" <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?> <?php if(($offset*10) < $totalCount){ ?>href="/network/<?php echo $taxName; ?>/page/<?php echo $offsetNum + 2; ?>/"<?php } ?>>Older <i class="fas fa-chevron-right"></i></a>
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
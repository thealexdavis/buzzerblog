<?php 
/*
* Template Name: Archive
*/
	get_header(); 
	
	global $wp_query;
	$totalCount = $wp_query->found_posts;
	$search_query = get_search_query();
	
	$offset = 1;
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if(strpos($url_path, "page/") !== false ){
		$offset = str_replace("page/", "", $url_path);
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
						  <?php if(have_posts() ){ while ( have_posts() ){ the_post();
						    	$postmeta = get_post_meta( $post->ID ); 
						    	$author_id = get_post_field( 'post_author', $post->ID );
								$fname = get_the_author_meta('first_name');
								$lname = get_the_author_meta('last_name');
								?>
	           				<div class="item">
		           				<?php
			           				if( get_post_type($post->ID) == 'video' ) {
				           				if($postmeta['videourl'][0] && $postmeta['videourl'][0] !== ""){
									    	parse_str( parse_url( $postmeta['videourl'][0], PHP_URL_QUERY ), $youtubeVidArray );
									    	$videoId = $youtubeVidArray['v'];
									    	echo '<img src="https://img.youtube.com/vi/'.$videoId.'/maxresdefault.jpg" alt="'.get_the_title($post->ID).'" class="hero">';
								    	} 
							    	} else { 
								    	if ( has_post_thumbnail(get_the_ID())) { 
								        	echo '<img class="hero" src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="'.get_the_title().' Logo">';
								        } else {
									        echo '<img class="hero" src="'.$postmeta['img'][0].'" alt="'.get_the_title().' Logo">';
								    	}
							    	}
							    ?>
							    <div class="info">
								    <?php if(get_post_type() !== "show"){ ?>
								    <div class="sub">
									    <?php if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
										   echo '<span class="teaser">'.$postmeta['teaser'][0].'</span>'; 
									    } ?>
									    <span class="date"><?php echo get_the_date("F j, Y", $post->ID); ?></span>
								    </div>
								    <?php } ?>
								    <div class="title">
									    <h3><a <?php if( get_post_type($post->ID) == 'video' ) { echo "data-fancybox"; }; ?> href="<?php if( get_post_type($post->ID) == 'video' ) { echo $postmeta['videourl'][0]; } else { echo get_the_permalink($post->ID);}; ?>"><?php if( get_post_type($post->ID) == 'review' ) { echo "Review: "; }; if( get_post_type($post->ID) == 'video' ) { echo "Watch: "; }; echo get_the_title($post->ID); ?></a></h3>
									    <?php if(has_excerpt()){
										    echo '<p> '.get_the_excerpt($post->ID).'</p>';
									    } ?>
									    <?php if(get_post_type() == "show" && $postmeta['api_summary'] && $postmeta['api_summary'][0] !== ""){?><p class="summary"><?php echo $postmeta['api_summary'][0]; ?><?php if($postmeta['api_summary'] && $postmeta['api_summary'][0] !== ""){ ?><br><span>-Source: TVMaze</span><?php } ?></p><?php } ?>
								    </div>
								    <?php if(get_post_type() !== "show"){ ?><div class="author">
								    	<a class="by" href="<?php echo get_author_posts_url($author_id); ?>">BY <?php echo get_the_author_meta('first_name',$author_id); ?> <?php echo get_the_author_meta('last_name',$author_id); ?></a>
								    </div>
								    <?php } ?>
								    <?php if( get_post_type($post->ID) == 'video' ) { ?>
								    	<a data-fancybox href="<?php echo $postmeta['videourl'][0]; ?>" class="btn" title="Watch the video <?php echo get_the_title($post->ID); ?>">WATCH VIDEO</a>
								    <?php } else { ?>
								    	<a href="<?php echo get_the_permalink($post->ID); ?>" class="btn" title="Read the story <?php echo get_the_title($post->ID); ?>">READ MORE</a>
								    <?php } ?>
							    </div>
	           				</div>
	           				<?php
					    } } else {
						     echo "<h2>We're sorry, there are no results for what you're looking for. Please click one of the navigation links above to visit another page, or use the site search to find what you're looking for.</h2>";
					    }
					    wp_reset_query();
					    ?>
					    <div class="pagination">
						    <a class="new <?php if($offsetNum < 1){ echo 'disabled'; }; ?>" <?php if($offsetNum < 1){ echo 'disabled'; }; ?> <?php if($offsetNum >= 1){ ?>href="/page/<?php echo $offsetNum; ?>/?s=<?php echo $search_query; ?>"<?php } ?>><i class="fas fa-chevron-left"></i> Newer</a>
						    <a class="old <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?>" <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?> <?php if(($offset*10) < $totalCount){ ?>href="/page/<?php echo $offsetNum + 2; ?>/?s=<?php echo $search_query; ?>"<?php } ?>>Older <i class="fas fa-chevron-right"></i></a>
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
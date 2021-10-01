<?php get_header(); 
	global $wp_query;
	$offset = 1;
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	if(strpos($url_path, "show/page/") !== false ){
		$offset = str_replace("show/page/", "", $url_path);
	}
	$offsetNum = $offset - 1;
	$postList = archiveShowQueryAll($offsetNum);
	$postListTotal = archiveShowQueryTotal($offsetNum);
	$totalCount = count($postListTotal);
?>
	
	<div class="container post">
	        <div class="entry-content-page post archives" id="main_content">
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
							  		foreach($postList as $postItem){
							    $post = get_post($postItem->ID);
							    $postmeta = get_post_meta( $postItem->ID );
							     ?>
	           				<div class="item">
		           				<?php
							    	if ( has_post_thumbnail(get_the_ID())) { 
							        	echo '<img class="hero" src="'.get_the_post_thumbnail_url(get_the_ID()).'" alt="'.get_the_title().' Logo">';
							        } else {
								        echo '<img class="hero" src="'.$postmeta['img'][0].'" alt="'.get_the_title().' Logo">';
							    	}
							    ?>
							    <div class="info">
								    <div class="sub">
									    <?php if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
										   echo '<span class="teaser">'.$postmeta['teaser'][0].'</span>'; 
									    } ?>
								    </div>
								    <div class="title">
									    <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
									    <p class="summary"><?php echo $postmeta['api_summary'][0]; ?><?php if($postmeta['api_summary'] && $postmeta['api_summary'][0] !== ""){ ?><br><span>-Source: TVMaze</span><?php } ?></p>
								    </div>
								    <a href="<?php echo get_the_permalink(); ?>" class="btn" title="Read the story <?php echo get_the_title(); ?>">READ MORE</a>
							    </div>
	           				</div>
	           				<?php
					    }}
					    wp_reset_query();
					    ?>
					    <div class="pagination">
						    <a class="new <?php if($offsetNum < 1){ echo 'disabled'; }; ?>" <?php if($offsetNum < 1){ echo 'disabled'; }; ?> <?php if($offsetNum >= 1){ ?>href="/show/page/<?php echo $offsetNum; ?>/"<?php } ?>><i class="fas fa-chevron-left"></i> Newer</a>
						    <a class="old <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?>" <?php if(($offset*10) >= $totalCount){ echo 'disabled'; }; ?> <?php if(($offset*10) < $totalCount){ ?>href="/show/page/<?php echo $offsetNum + 2; ?>/"<?php } ?>>Older <i class="fas fa-chevron-right"></i></a>
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
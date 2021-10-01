<?php 
get_header(); 
$totalCount = wp_count_posts('post','review');
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$fname = get_the_author_meta('first_name');
	$lname = get_the_author_meta('last_name');
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
							    	if(has_post_thumbnail()){
								    	echo '<img class="hero" src="'.get_the_post_thumbnail_url($post,"hero-img").'">';
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
									    <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
									    <?php if(has_excerpt()){
										    echo '<p> '.get_the_excerpt().'</p>';
									    } ?>
								    </div>
								    <div class="author">
								    	<a class="by" href="#">BY <?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('last_name'); ?></a>
								    </div>
								    <a href="<?php echo get_the_permalink(); ?>" class="btn" title="Read the story <?php echo get_the_title(); ?>">READ MORE</a>
							    </div>
	           				</div>
	           				<?php
					    endwhile;
					    wp_reset_query();
					    ?>
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
<?php
/*
* Template Name: Homepage
*/
get_header(); ?>
	<?php
    while ( have_posts() ) : the_post();
       if (get_the_post_thumbnail_url() !== ""){
            $thumbUrl = get_the_post_thumbnail_url();
            $xtraClass = "";
        } 
    ?>
	<div class="entry-content-page" id="main_content">
		<div class="container">
			<div id="featured">
				<?php
				$featuredTop = true;
				$stickies = get_option( 'sticky_posts' );
				$ignorePosts = array();
				// Make sure we have stickies to avoid unexpected output
				if ( $stickies ) {
				    $args = [
				        'post_type'           => 'post',
				        'post__in'            => $stickies,
				        'posts_per_page'      => 4,
				        'ignore_sticky_posts' => 1
				    ];
				    $the_query = new WP_Query($args);
				
				    if ( $the_query->have_posts() ) { 
				        while ( $the_query->have_posts() ) { 
				            $the_query->the_post();
				            $postmeta = get_post_meta( $post->ID );
				            array_push($ignorePosts, $post->ID);
				            $postThumb = false;
				            if(has_post_thumbnail()){
					            $postThumb = get_the_post_thumbnail_url($post->ID,array(680, 382.5));
				            }
				            $teaserText = false;
				            if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
							   $teaserText = $postmeta['teaser'][0]; 
						    }
				            if($featuredTop){
					            $featuredTop = false;
					        ?>
					        <div class="top">
								<div class="post">
									<div class="img">
										<?php if($postThumb !== false){ ?>
											<a href="<?php echo get_the_permalink(); ?>">
												<?php the_post_thumbnail( 'home-featured' ); ?>
											</a>
										<?php } ?>
										<?php if($teaserText !== false){ ?>
											<div class="teaser mobile">
												<p><?php echo $teaserText; ?></p>
											</div>
										<?php } ?>
									</div>
									<div class="content">
										<div class="divider desktop"></div>
										<?php if($teaserText !== false){ ?>
											<div class="teaser desktop">
												<p><?php echo $teaserText; ?></p>
											</div>
										<?php } ?>
										<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
										<p><?php echo get_the_excerpt(); ?></p>
										<a class="by" href="<?php $author_id = get_post_field ('post_author'); echo get_author_posts_url($author_id); ?>">By <?php echo get_the_author_meta('first_name',$author_id); ?> <?php echo get_the_author_meta('last_name',$author_id); ?></a>
									</div>
								</div>
								<div class="divider mobile"></div>
							</div>
							<div class="bottom">
					        <?php
				            } else {
					            ?>
					            <div class="post">
									<div class="content">
										<?php if($teaserText !== false){ ?>
											<p class="teaser"><?php echo $teaserText; ?></p>
										<?php } ?>
										<h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
									</div>
									<div class="img">
										<?php if($postThumb !== false){ ?>
											<a href="<?php echo get_the_permalink(); ?>">
												<?php the_post_thumbnail( 'smallfeature' ); ?>
											</a>
										<?php } ?>
									</div>
								</div>
					            <?php
				            }
				            ?>
				            
				            <?php
				        }    
				        wp_reset_postdata();    
				    }
				}	
				
				?>
				</div>
			</div>
			<div id="newsroom">
				<div class="top">
					<h3><i class="fas fa-newspaper"></i> <span>THE<br> NEWSROOM</span> <div class="divider"></div></h3>
				</div>
				<?php
				$postCount = 0;
				$number = 4;
				
				 $postsQuery = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type IN ('post','review') AND post_status = 'publish' AND ID NOT IN (".implode(",", $ignorePosts).") ORDER BY post_date DESC LIMIT 0,20;");
				
				for($x=0;$x<4;$x++){
					$post = get_post($postsQuery[$x]->ID);
					$postCount++;
					$postClass = "";
					if($postCount == 4){
						$postClass = "last";
					}
					$postThumb = false;
					if(has_post_thumbnail()){
			            $postThumb = get_the_post_thumbnail_url($post->ID,array(530,300));
		            }
		            $postmeta = get_post_meta( $post->ID );
		            $teaserText = false;
					if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
					   $teaserText = $postmeta['teaser'][0]; 
				    }
				?>
				<div class="post <?php echo $postClass; ?>">
					<?php if($postThumb !== false){ ?>
						<div class="img">
							<a href="<?php echo get_the_permalink(); ?>">
								<?php the_post_thumbnail( 'smallfeature' ); ?>
							</a>
						</div>
					<?php } ?>
					<div class="content">
						<p class="teaser <?php if($teaserText == false){ echo "none"; } ?>"><?php if($teaserText !== false){ echo $teaserText; }; ?> <span><?php echo get_the_date("F j, Y"); ?></span></p>
						<p class="title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></p>
					</div>
				</div>
				<?php
				}  
				?>
				<a class="btn" href="/news">View All News</a>
			</div>
			<div id="briefing">
				<div class="left">
					<?php
						$postCount = 0;
						$number = 4;
		
						for($x=4;$x<8;$x++){
						$post = get_post($postsQuery[$x]->ID);
						$postCount++;
						$postClass = "";
						if($postCount == 4){
							$postClass = "last";
						}
						$postThumb = false;
						if(has_post_thumbnail()){
				            $postThumb = get_the_post_thumbnail_url($post->ID,array(530,300));
			            }
			            $postmeta = get_post_meta( $post->ID );
			            $teaserText = false;
						if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
						   $teaserText = $postmeta['teaser'][0]; 
					    }
						?>
						<div class="post">
							<?php if($postThumb !== false){ ?>
								<div class="img">
									<a href="<?php echo get_the_permalink(); ?>">
										<?php the_post_thumbnail( 'smallfeature' ); ?>
										<?php if($teaserText !== false){
											echo '<p class="teaser">'.$teaserText.'</p>';
										}
										?>
									</a>
								</div>
							<?php } ?>
							<div class="content">
								<p class="title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></p>
								<p class="desc"><?php echo get_the_excerpt(); ?></p>
								<a class="author" href="<?php $author_id = get_post_field('post_author',$postsQuery[$x]->ID); echo get_author_posts_url($author_id); ?>">By <?php echo get_the_author_meta('first_name',$author_id); ?> <?php echo get_the_author_meta('last_name',$author_id); ?></a>
							</div>
						</div>
						<?php
						} 
						wp_reset_postdata();  
					?>
				</div>
				<div class="right">
					<h3><i class="fas fa-star"></i>  Reviews</h3>
					<?php
						$my_wp_query = new WP_Query();
						$reviewsPages = $my_wp_query->query(array('post_type' => array('review'), 'posts_per_page' => 5, 'orderby'=> 'DATE', 'order' => 'DESC'));
						foreach($reviewsPages as $reviewPage){
							$reviewmeta = get_post_meta( $reviewPage->ID );
							$reviewUrl = get_the_permalink($reviewPage->ID);
							$thisValD = ($reviewmeta['ag_score1'][0] / 10 * 100) + ($reviewmeta['ag_score2'][0] / 10 * 100) + ($reviewmeta['ag_score3'][0] / 10 * 100);
							$scoreVal = $thisValD / 3; 
							$thisScore = $scoreVal;
							echo '<a class="review" href="'.get_the_permalink($reviewPage->ID).'"><span class="score">'.changePercent($thisScore).'/5</span><span class="title">'.get_the_title($reviewPage->ID).'</span></a>';	
						}
						wp_reset_postdata();  
					?>
					<a class="btn" href="/review">Read More Reviews</a>
				</div>
			</div>
			<div id="bottomcallout">
				<?php
						$postCount = 0;
						$number = 4;
		
						for($x=8;$x<12;$x++){
						$post = get_post($postsQuery[$x]->ID);
						$postCount++;
						$postClass = "";
						if($postCount == 4){
							$postClass = "last";
						}
						$postThumb = false;
						if(has_post_thumbnail()){
				            $postThumb = get_the_post_thumbnail_url($post->ID,array(530,300));
			            }
			            $postmeta = get_post_meta( $post->ID );
			            $teaserText = false;
						if($postmeta['teaser'][0] && $postmeta['teaser'][0] !== ""){
						   $teaserText = $postmeta['teaser'][0]; 
					    }
						?>
						<div class="post">
							<?php if($teaserText !== false){
							echo '<p class="teaser">'.$teaserText.'</p>';
							} ?>
							<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
						</div>
						<?php
						}
						wp_reset_postdata();  
					?>
			</div>
		</div>
	</div>
    <?php
    endwhile;
    wp_reset_query();
    ?>
<?php  get_footer(); ?>
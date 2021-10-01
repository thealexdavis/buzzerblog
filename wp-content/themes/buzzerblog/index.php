<?php get_header(); ?>
	<?php
    while ( have_posts() ) : the_post();
       if (get_the_post_thumbnail_url() !== ""){
            $thumbUrl = get_the_post_thumbnail_url();
            $xtraClass = "";
        } 
    ?>
        <div class="entry-content-page tester  <?php if(!is_front_page()){ echo "interior"; }?>" id="main_content">
            <div class="container">
                <?php if(!is_front_page()){ ?>
                <div id="top_hero"<?php if(get_the_post_thumbnail_url()){ echo 'class="withimg"'; } ?>>
                    <div class="container">
                        <h1><?php echo get_the_title(); ?></h1>
                    </div>
                </div>
                <?php
                    if ( has_post_thumbnail() ) { 
                        the_post_thumbnail( 'hero-img' ); 
                    }
                ?>
                <?php } ?>
                <?php the_content(); ?>
            </div>
        </div>
    <?php
    endwhile;
    wp_reset_query();
    ?>
<?php  get_footer(); ?>
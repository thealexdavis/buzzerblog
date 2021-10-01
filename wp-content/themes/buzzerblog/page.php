<?php get_header(); ?>
	<?php
    while ( have_posts() ) : the_post();
       if (get_the_post_thumbnail_url() !== ""){
            $thumbUrl = get_the_post_thumbnail_url();
            $xtraClass = "";
        } 
    ?>
        <div class="entry-content-page post singlepage  <?php if(!is_front_page()){ echo "interior"; }?>" id="main_content">
            <div class="container">
                <?php if(!is_front_page()){ ?>
                <div id="top_hero"<?php if(get_the_post_thumbnail_url()){ echo 'class="withimg"'; } ?>>
                    <div class="container">
                        <h1 style="position: absolute;top:-100000px;left:-100000px;"><?php echo get_the_title(); ?></h1>
                    </div>
                </div>
                <?php } ?>
                <?php the_content(); ?>
            </div>
        </div>
    <?php
    endwhile;
    wp_reset_query();
    ?>
<?php  get_footer(); ?>
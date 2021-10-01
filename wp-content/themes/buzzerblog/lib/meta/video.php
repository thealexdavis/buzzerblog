<?php 

function video_callback( $post ) { 
	$showinfo = get_post_meta( $post->ID );
	$args = array(
        'post_type' => 'show',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);
    if ($query->have_posts() ) : 
	    echo '<p>Select which show(s) this story corresponds to. Shows are in alphabetical order, left to right.</p>';
	    echo '<div class="allshows">';
	    while ( $query->have_posts() ) : $query->the_post();
	    	$checkedVal = "";
	    	foreach($showinfo as $key => $value) {
				if(strpos($key, "show_") !== false){
					if($key == 'show_'.get_the_id() && $value[0] == 1){
						$checkedVal = "checked";
						break;
					}
				}
			}
	    	echo '<div class="input_box"><input type="checkbox" name="show_'.get_the_id().'" id="show_'.get_the_id().'" value="1" '.$checkedVal.'><label for="show_'.get_the_id().'">'.get_the_title().'</label></div>';
	    endwhile;
	    wp_reset_postdata();
	    echo '</div>';
	endif;
	
	?>
	
	<div class="field-group">
		<label for="videourl">Video URL</label>
		<input type="text" name="videourl" id="videourl" value="<?php echo $showinfo['videourl'][0]; ?>">
	</div>
	
<?php }
	
function videourl_save_postdata( $post_id ) {

if( isset( $_POST[ 'videourl' ])){ 
	$teaser = $_POST['videourl'];
    update_post_meta($post_id,'videourl',$teaser); 
}

}
add_action( 'save_post', 'videourl_save_postdata' );
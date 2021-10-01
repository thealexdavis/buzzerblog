<?php 

function show_callback( $post ) { 
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
	
	<?php } 
		
		function mycpt_assign_save_postdata( $post_id ) {
			$args = array(
		        'post_type' => 'show',
		        'posts_per_page' => -1
		    );
		    $query = new WP_Query($args);
			if ($query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post();
					if(!isset($_POST['show_'.get_the_id()])){
						update_post_meta( $post_id, 'show_'.get_the_id(), 0 );
					} else {
						update_post_meta( $post_id, 'show_'.get_the_id(), 1 );
					}
			    endwhile;
		    wp_reset_postdata();
		    endif;
/*
				echo $key;
				if(strpos($key, "show_") !== false){
					if(!isset($_POST[$key])){
						$finalVal = 0;
					} else {
						$finalVal = 1;
					}
					update_post_meta( $post_id, $key, $finalVal );
				}
*/

/*
			$newval = "show_35";
			if(!isset($_POST[$newval])){
				$finalVal = 0;
			} else {
				$finalVal = 1;
			}
			
			update_post_meta( $post_id, $newval, $finalVal );
*/
			
			
/*
    if( isset( $_POST['show_35'] ) ) {
        update_post_meta( $post_id, 'show_35', $_POST['show_35'] );
    }
*/
}
add_action( 'save_post', 'mycpt_assign_save_postdata' );
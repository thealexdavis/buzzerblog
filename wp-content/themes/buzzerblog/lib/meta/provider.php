<?php 

function providers_callback( $post ) { 
	$providerinfo = get_post_meta( $post->ID );
?>
	<p>
		<div class="sm-row-content custom">
			<label for="ln">Last name (used for sorting):</label>
			<input type="text" name="ln" id="ln" value="<?php if ( isset ( $providerinfo['ln'] ) ) echo $providerinfo['ln'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="position">Type:</label>
			<input type="text" name="position" id="position" value="<?php if ( isset ( $providerinfo['position'] ) ) echo $providerinfo['position'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="locationsbtns">Locations (click each location button to toggle on/off)</label>
			<?php
				$args = array(  
					'post_type' => 'location',
					'post_status' => 'publish',
					'posts_per_page' => 999, 
					'orderby' => 'title', 
					'order' => 'ASC', 
				);
			
				$loop = new WP_Query( $args ); 
					
				while ( $loop->have_posts() ) : $loop->the_post(); 
					$activeClass = "";
					if (in_array(get_the_id(), explode(",", $providerinfo['locations'][0]))) {
						$activeClass = "active";
					} else {
						$activeClass = "";
					}
					echo '<button value="'.get_the_id().'" class="locationbtn '.$activeClass.'">'.get_the_title().'</button>';
				endwhile;
			
				wp_reset_postdata(); 
			?>
			<input type="hidden" name="locations" id="locations" class="locationsall" value="<?php if ( isset ( $providerinfo['locations'] ) ) echo $providerinfo['locations'][0]; ?>" />
		</div>
		<div class="sm-row-content custom">
			<label for="position">Review Score:</label>
			<select name="review" id="review">
				<option value="0">-- SELECT STAR REVIEW SCORE --</option>
				<option value="1" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 1){ echo "selected"; }; ?>>1</option>
				<option value="2" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 2){ echo "selected"; }; ?>>2</option>
				<option value="3" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 3){ echo "selected"; }; ?>>3</option>
				<option value="4" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 4){ echo "selected"; }; ?>>4</option>
				<option value="5" <?php if (isset($providerinfo['review']) && $providerinfo['review'][0] == 5){ echo "selected"; }; ?>>5</option>
			</select>
		</div>
		<div class="sm-row-content logoupload custom">
			<label for="position">Choose a logo for the provider</label>
			<input type="hidden" name="logo_img" id="logo_img" value="<?php if ( isset ( $providerinfo['logo_img'] ) ) echo $providerinfo['logo_img'][0]; ?>" class="picval"/>
			<img src="<?php if ( isset ( $providerinfo['logo_img'] ) ) echo $providerinfo['logo_img'][0]; ?>" class="pic_show" id="logo_img-img">
			<input type="button" class="picbtn button" id="logo_img-button" class="button picbtn" value="<?php _e( 'Choose an Logo', 'myplugin_textdomain' )?>" />
			<input type="button" class="removepic button" id="removepic" value="Remove Logo">
		</div>
	</p>
<?php
	}
?>
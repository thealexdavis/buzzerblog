<?php 

function getShow($showCode) {
	$url = "https://api.tvmaze.com/shows/".$showCode;
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	
	$resp = curl_exec($curl);
	curl_close($curl);
	$data = json_decode($resp, true);
	return $data;
}

function showinfo_callback( $post ) { 
	$showinfo = get_post_meta( $post->ID );
// 	print_r($showinfo);
	
	?>
	
	<div class="field-group">
		<label for="tvmazenum">TVMaze ID Number</label>
		<input type="text" name="tvmazenum" id="tvmazenum" value="<?php echo $showinfo['tvmazenum'][0]; ?>">
	</div>
	
	<a href="#" class="updateshow page-title-action" id="updateshow">Refresh Show Information (pulled from TVMaze)</a>
	
	<div class="field-group">
		<label for="api_summary">Summary (Auto-fill from TVMaze on Update)</label>
		<?php wp_editor( $showinfo['api_summary'][0] , 'api_summary', $settings = array('textarea_name'=>'api_summary') ); ?>
	</div>
	<div class="field-group">
		<label for="extras">Extra Show Information (you can write in rules or additional notes)</label>
		<?php wp_editor( $showinfo['extras'][0] , 'extras', $settings = array('textarea_name'=>'extras') ); ?>
	</div>
	<div class="field-group">
		<label for="network">Network</label>
		<input type="text" name="network" id="network" value="<?php echo $showinfo['network'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="host">Host</label>
		<input type="text" name="host" id="host" value="<?php echo $showinfo['host'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="status">Status</label>
		<input type="text" name="status" id="status" value="<?php echo $showinfo['status'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="debut_date">Debut Date</label>
		<input type="text" name="debut_date" id="debut_date" value="<?php echo $showinfo['debut_date'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="country">Country</label>
		<input type="text" name="country" id="country" value="<?php echo $showinfo['country'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="website">Official Website</label>
		<input type="text" name="website" id="website" value="<?php echo $showinfo['website'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="website">Default Image (taken from TVMaze, you may want to insert a new one as Featured Image)</label>
		<input type="text" name="img" id="img" value="<?php echo $showinfo['img'][0]; ?>">
	</div>
	
	<?php } 
		
		function showinfo_save_postdata( $post_id ) {
			if( isset( $_POST[ 'tvmazenum' ] ) ) { 
				$metafield = $_POST['tvmazenum'];
			    update_post_meta($post_id,'tvmazenum',$metafield); 
			}
			if( isset( $_POST[ 'api_summary' ] ) ) { 
				$metafield = $_POST['api_summary'];
			    update_post_meta($post_id,'api_summary',$metafield); 
			}
			if( isset( $_POST[ 'extras' ] ) ) { 
				$metafield = $_POST['extras'];
			    update_post_meta($post_id,'extras',$metafield); 
			}
			
			if( isset( $_POST[ 'network' ] ) ) { 
				$metafield = $_POST['network'];
			    update_post_meta($post_id,'network',$metafield); 
			}
			if( isset( $_POST[ 'host' ] ) ) { 
				$metafield = $_POST['host'];
			    update_post_meta($post_id,'host',$metafield); 
			}
			if( isset( $_POST[ 'status' ] ) ) { 
				$metafield = $_POST['status'];
			    update_post_meta($post_id,'status',$metafield); 
			}
			if( isset( $_POST[ 'debut_date' ] ) ) { 
				$metafield = $_POST['debut_date'];
			    update_post_meta($post_id,'debut_date',$metafield); 
			}
			if( isset( $_POST[ 'country' ] ) ) { 
				$metafield = $_POST['country'];
			    update_post_meta($post_id,'country',$metafield); 
			}
			if( isset( $_POST[ 'website' ] ) ) { 
				$metafield = $_POST['website'];
			    update_post_meta($post_id,'website',$metafield); 
			}
			if( isset( $_POST[ 'img' ] ) ) { 
				$metafield = $_POST['img'];
			    update_post_meta($post_id,'img',$metafield); 
			}
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
add_action( 'save_post', 'showinfo_save_postdata' );
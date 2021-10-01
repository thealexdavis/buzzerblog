<?php 

function extra_callback( $post ) { 
	$xtrasinfo = get_post_meta( $post->ID );
	$featureCheck = ($xtrasinfo['excludePassport'][0] == 1) ? "checked" : false;
?>
	<div class="field-group">
		<input type="checkbox" value="1" name="excludePassport" id="excludePassport" <?php echo $featureCheck; ?>>
		<label for="excludePassport">Exclude Passport from Sidebar</label>
	</div>
	<div class="field-group">
		<label for="teaser">Short teaser</label>
		<input type="text" name="teaser" id="teaser" value="<?php echo $xtrasinfo['teaser'][0]; ?>">
	</div>
<?php
	
}
		
function extras_save_postdata( $post_id ) {

	if(!isset($_POST['excludePassport'])){
		update_post_meta( $post_id, 'excludePassport', 0 );
	} else {
		update_post_meta( $post_id, 'excludePassport', 1 );
	}
	
	if( isset( $_POST[ 'teaser' ] ) ) { 
		$teaser = $_POST['teaser'];
	    update_post_meta($post_id,'teaser',$teaser); 
	}

}
add_action( 'save_post', 'extras_save_postdata' );
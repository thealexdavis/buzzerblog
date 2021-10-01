<?php 

function review_callback( $post ) { 
	$reviewsInfo = get_post_meta( $post->ID );
// 	$featureCheck = ($xtrasinfo['homefeature'][0] == 1) ? "checked" : false;
?>
	<div class="field-group">
		<label for="ag_score1">Game score (out of 10)</label>
		<input type="number" name="ag_score1" id="ag_score1" value="<?php echo $reviewsInfo['ag_score1'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="ag_score2">Show score (out of 10)</label>
		<input type="number" name="ag_score2" id="ag_score2" value="<?php echo $reviewsInfo['ag_score2'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="ag_score3">Game Show score (out of 10)</label>
		<input type="number" name="ag_score3" id="ag_score3" value="<?php echo $reviewsInfo['ag_score3'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="ag_rating_text">Text Rating</label>
		<input type="text" name="ag_rating_text" id="ag_rating_text" value="<?php echo $reviewsInfo['ag_rating_text'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="ag_rating_summary">Text Summary</label>
		<textarea name="ag_rating_summary" id="ag_rating_summary"><?php echo $reviewsInfo['ag_rating_summary'][0]; ?></textarea>
	</div>
	<div class="field-group">
		<label for="teaser">Short teaser (located near date)</label>
		<input type="text" name="teaser" id="teaser" value="<?php echo $reviewsInfo['teaser'][0]; ?>">
	</div>
	<div class="field-group">
		<label for="longteaser">Longer teaser (located to right of title)</label>
		<input type="text" name="longteaser" id="longteaser" value="<?php echo $reviewsInfo['longteaser'][0]; ?>">
	</div>
<?php
	
}
		
function review_save_postdata( $post_id ) {

	if( isset( $_POST[ 'ag_score1' ] ) ) { 
		$teaser = $_POST['ag_score1'];
	    update_post_meta($post_id,'ag_score1',$teaser); 
	}
	if( isset( $_POST[ 'ag_score2' ] ) ) { 
		$teaser = $_POST['ag_score2'];
	    update_post_meta($post_id,'ag_score2',$teaser); 
	}
	if( isset( $_POST[ 'ag_score3' ] ) ) { 
		$teaser = $_POST['ag_score3'];
	    update_post_meta($post_id,'ag_score3',$teaser); 
	}
	if( isset( $_POST[ 'ag_rating_text' ] ) ) { 
		$teaser = $_POST['ag_rating_text'];
	    update_post_meta($post_id,'ag_rating_text',$teaser); 
	}
	if( isset( $_POST[ 'ag_rating_summary' ] ) ) { 
		$teaser = $_POST['ag_rating_summary'];
	    update_post_meta($post_id,'ag_rating_summary',$teaser); 
	}
	
	if( isset( $_POST[ 'teaser' ] ) ) { 
		$teaser = $_POST['teaser'];
	    update_post_meta($post_id,'teaser',$teaser); 
	}
	if( isset( $_POST[ 'longteaser' ] ) ) { 
		$longteaser = $_POST['longteaser'];
	    update_post_meta($post_id,'longteaser',$longteaser); 
	}

}
add_action( 'save_post', 'review_save_postdata' );
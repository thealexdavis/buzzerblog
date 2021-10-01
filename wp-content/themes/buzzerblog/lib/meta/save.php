<?php
	function bnp_save_meta( $post_id ) {
		if( isset( $_POST[ 'videourl' ] ) ) { 
			$videourl = $_POST['videourl'];
		    update_post_meta($post_id,'videourl',$videourl); 
		}
	}
	add_action( 'save_post', 'bnp_save_meta' );
	
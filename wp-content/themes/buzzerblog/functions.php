<?php
	
	//ADD TWITTER TO PROFILE PAGE
	add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Additional Information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="twitter"><?php _e("Twitter Username"); ?></label></th>
        <td>
            <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your Twitter handle."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="title"><?php _e("Title"); ?></label></th>
        <td>
            <input type="text" name="title" id="title" value="<?php echo esc_attr( get_the_author_meta( 'title', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your title."); ?></span>
        </td>
    </tr>
    <tr>
    </table>
<?php }
	
	add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
	add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
	
	function save_extra_user_profile_fields( $user_id ) {
	    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
	        return;
	    }
	    
	    if ( !current_user_can( 'edit_user', $user_id ) ) { 
	        return false; 
	    }
	    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	    update_user_meta( $user_id, 'title', $_POST['title'] );
	}
	
	add_image_size( 'hero-img', 1180, 400, array( 'center', 'top' ) );
	add_image_size( 'home-featured', 800, 800, array( 'center', 'center' ) );
	add_image_size( 'smallfeature', 650, 650, true );

// 	add_image_size( 'hero-img', 1600, 200, array( 'center', 'center' ) );

	add_action( 'init', 'buzzerblog_add_excerpts_to_pages' );
	function buzzerblog_add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}

/*
	//REGISTERING CUSTOMIZER OPTIONS
	function footer_logo_register( $wp_customize ) {
		$wp_customize->add_setting( 'footer_logo' ); // Add setting for logo uploader
			 
		// Add control for logo uploader (actual uploader)
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
			'label'    => __( 'Footer Logo', 'buzzerblogderm' ),
			'section'  => 'title_tagline',
			'settings' => 'footer_logo',
		) ) );
	}
	add_action( 'customize_register', 'footer_logo_register' );
*/
	
	add_theme_support( 'custom-logo' );
	
	//REGISTERING NAV
	register_nav_menus(
		array(
			'main_nav' => __('Main Nav','buzzerblogderm'),
			'utility_nav' => __('Utility Nav','buzzerblogderm'),
			'footer_nav_col_1' => __('Footer Nav Column 1','buzzerblogderm'),
			'footer_nav_col_2' => __('Footer Nav Column 2','buzzerblogderm'),
			'footer_nav_col_3' => __('Social Media','buzzerblogderm'),
		)	
	);
	
	//REGISTERING THUMBNAILS
	add_theme_support( 'post-thumbnails' );
	
	//REGISTERING POST TYPE
	function create_post_type() {
		register_post_type( 'show',
			array(
				'labels' => array(
					'name' => __( 'Shows' ),
					'singular_name' => __( 'Show' )
				),
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'thumbnail' ),
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-welcome-view-site',
			'rewrite' => array('slug' => 'show'),
			'taxonomies' => array('post_tag', 'network'),
			)
		);
		register_post_type( 'review',
			array(
				'labels' => array(
					'name' => __( 'Reviews' ),
					'singular_name' => __( 'Review' )
				),
			'public' => true,
			'has_archive' => true,
			'show_in_rest' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'menu_icon' => 'dashicons-awards',
			'rewrite' => array('slug' => 'review'),
			'taxonomies' => array('post_tag'),
			)
		);
		register_post_type( 'video',
			array(
				'labels' => array(
					'name' => __( 'Videos' ),
					'singular_name' => __( 'Video' )
				),
			'public' => true,
			'has_archive' => false,
			'show_in_rest' => true,
			'supports' => array( 'title' ),
			'menu_icon' => 'dashicons-video-alt3'
			)
		);
	}
	add_action( 'init', 'create_post_type' );
	
	//REGISTER TAXONOMY
	function themes_taxonomy() {

		register_taxonomy(  
			'network',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
			'show',        //post type name
			array(  
				'hierarchical' => true,  
				'label' => 'Network',  //Display name
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'network', // This controls the base slug that will display before each term
					'with_front' => false // Don't display the category base before 
				)
			)  
		); 

	}
	add_action( 'init', 'themes_taxonomy');
	
	//WIDGETS
	function buzzerblog_widgets() {
/*
		register_sidebar( array(
			'name'          => 'Footer CTAs',
			'id'            => 'footer_cta',
			'before_widget' => '',
			'after_widget'  => '',
		));
*/
	}
	add_action( 'widgets_init', 'buzzerblog_widgets' );
	
	//META FIELDS
	function meta_styles(){
		global $post;
		wp_enqueue_style( 'metastyles', get_template_directory_uri() . '/styles/css/metastyles.css' );
	}
	add_action( 'admin_print_styles', 'meta_styles' );
	function prfx_image_enqueue() {
		global $post;
			wp_enqueue_media();
	 
			// Registers and enqueues the required javascript.
			wp_register_script( 'meta-box-image', get_template_directory_uri() . '/js/metascripts.js', array( 'jquery' ) );
			wp_localize_script( 'meta-box-image', 'meta_image',
				array(
					'title' => __( 'Choose or Upload an Image', 'careers_thingtitle' ),
					'button' => __( 'Use this image', 'careers_thingtitle' ),
				)
			);
			wp_enqueue_script( 'meta-box-image' );
	}
	add_action( 'admin_enqueue_scripts', 'prfx_image_enqueue' );
	
	
	function custom_meta_boxes() {
 		$screens = ['page', 'post', 'review'];
 		$screensNoReview = ['page', 'post'];
	    foreach( $screens as $screen ) {
	        add_meta_box(
	            'show_select',
	            'Shows',
	            'show_callback',
	            $screen,
	            'side',
	            'low',
	             //not even sure that this array is necessary
	             array(
	                '__block_editor_compatible_meta_box' => true,
	                '__back_compat_meta_box'             => false,
	            )
	        );
	        add_meta_box(
	            'extra_select',
	            'Extras',
	            'extra_callback',
	            $screensNoReview,
	            'side',
	            'low',
	             //not even sure that this array is necessary
	             array(
	                '__block_editor_compatible_meta_box' => true,
	                '__back_compat_meta_box'             => false,
	            )
	        );
	        add_meta_box(
	            'review_select',
	            'Review Options',
	            'review_callback',
	            'review',
	            'side',
	            'low',
	             //not even sure that this array is necessary
	             array(
	                '__block_editor_compatible_meta_box' => true,
	                '__back_compat_meta_box'             => false,
	            )
	        );
	    }
	    add_meta_box(
            'showinfo_select',
            'Show Information',
            'showinfo_callback',
            'show',
            'side',
            'low',
             //not even sure that this array is necessary
             array(
                '__block_editor_compatible_meta_box' => true,
                '__back_compat_meta_box'             => false,
            )
        );
        add_meta_box(
            'video_select',
            'Video Information',
            'video_callback',
            'video',
            'normal',
            'low',
             //not even sure that this array is necessary
             array(
                '__block_editor_compatible_meta_box' => true,
                '__back_compat_meta_box'             => false,
            )
        );
	}
 	include 'lib/meta/shows.php';
 	include 'lib/meta/showinfo.php';
 	include 'lib/meta/extras.php';
 	include 'lib/meta/reviews.php';
 	include 'lib/meta/video.php';
	include 'lib/meta/save.php';
	add_action( 'add_meta_boxes', 'custom_meta_boxes' );
	
	//TINYMCE BUTTONS
	function buzzerblog_mce_buttons($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	add_filter('mce_buttons_2', 'buzzerblog_mce_buttons');
	
	function buzzerblog_mce_before_init_insert_formats( $init_array ) {  
	 
	 
		$style_formats = array(  

			array(  
				'title' => 'Hyperlink with Arrows',  
				'block' => 'span',  
				'classes' => 'arrows',
				'wrapper' => false,
			),
			array(  
				'title' => '2 Column List',  
				'block' => 'ul',  
				'classes' => 'twocol',
				'wrapper' => true,
			),
			array(  
				'title' => '3 Column List',  
				'block' => 'ul',  
				'classes' => 'threecol',
				'wrapper' => true,
			),
			array(  
				'title' => '4 Column List',  
				'block' => 'ul',  
				'classes' => 'fourcol',
				'wrapper' => true,
			),
			array(  
				'title' => 'Blue Outline Button',  
				'block' => 'a',  
				'classes' => 'btn',
				'wrapper' => true,
			),
			array(  
				'title' => 'Blue Button',  
				'block' => 'a',  
				'classes' => 'blue btn',
				'wrapper' => true,
			),
			array(  
				'title' => 'Orange Outline Button',  
				'block' => 'a',  
				'classes' => 'orangeoutline btn',
				'wrapper' => true,
			),
			array(  
				'title' => 'Orange Button',  
				'block' => 'a',  
				'classes' => 'orange btn',
				'wrapper' => true,
			),
		);  
		$init_array['style_formats'] = json_encode( $style_formats );  
		 
		return $init_array;  
	   
	} 
	// Attach callback to 'tiny_mce_before_init' 
	add_filter( 'tiny_mce_before_init', 'buzzerblog_mce_before_init_insert_formats' ); 
	
	add_action('init', function() {
	  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	  if(strpos($url_path, "show/") !== false && strpos($url_path, "/news") !== false){
	     // load the file if exists
	     $load = locate_template('single-show-news.php', true);
	     if ($load) {
	        exit(); // just exit if template was found and loaded
	     }
	  }
	  if(strpos($url_path, "show/") !== false && strpos($url_path, "/video") !== false){
	     // load the file if exists
	     $load = locate_template('single-show-video.php', true);
	     if ($load) {
	        exit(); // just exit if template was found and loaded
	     }
	  }
	});
	
	function add_author_support_to_posts() {
   add_post_type_support( 'review', 'author' ); 
}
add_action( 'init', 'add_author_support_to_posts' );

function changePercent($initVal) {
	$outofFive = $initVal/20;
	return round($outofFive,1);
	
}

function custom_excerpt_length( $length ) {
        return 20;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
    
function archivePageQuery($offset = 0){
	global $wpdb;
	$offset = $offset*10;
	$postsQuery = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type IN ('post','review') AND post_status = 'publish' ORDER BY post_date DESC LIMIT ".$offset.",10;");
	return $postsQuery;
}

function archiveShowQueryAll($offset = 0){
	global $wpdb;
	$offset = $offset*10;
	$postsQuery = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type IN ('show') AND post_status = 'publish' ORDER BY post_title ASC LIMIT ".$offset.",10;");
	return $postsQuery;
}

function archiveShowQueryTotal($offset = 0){
	global $wpdb;
	$offset = $offset*10;
	$postsQuery = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type IN ('show') AND post_status = 'publish' ORDER BY post_date DESC ");
	return $postsQuery;
}

function archiveShowPageQuery($offset = 0, $showid){
	global $wpdb;
	$offset = $offset*10;
	$postsQuery = $wpdb->get_results("SELECT wp_posts.ID, wp_postmeta.meta_key FROM wp_posts LEFT JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE post_type IN ('post','review') AND meta_key = 'show_".$showid."' AND meta_value = 1 AND post_status = 'publish' ORDER BY post_date DESC LIMIT ".$offset.",10;");
	return $postsQuery;
}

function archiveShowPageQueryTotal($offset = 0, $showid){
	global $wpdb;
	$offset = $offset*10;
	$postsQuery = $wpdb->get_results("SELECT wp_posts.ID, wp_postmeta.meta_key FROM wp_posts LEFT JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE post_type IN ('post','review') AND meta_key = 'show_".$showid."' AND meta_value = 1 AND post_status = 'publish' ORDER BY post_date DESC;");
	return $postsQuery;
}

add_action( 'generate_rewrite_rules', 'my_rewrite_rules' );
function my_rewrite_rules( $wp_rewrite )
{
    $wp_rewrite->rules = array(
        'news/([^/]+)/page/?([0-9]{1,})/?$' => $wp_rewrite->index . '?pagename=mypageslug&user=' . $wp_rewrite->preg_index( 1 ) . '&paged=' . $wp_rewrite->preg_index( 2 ),
        'news/([^/]+)/?$' => $wp_rewrite->index . '?pagename=mypageslug&user=' . $wp_rewrite->preg_index( 1 )

    ) + $wp_rewrite->rules;
}
	
?>
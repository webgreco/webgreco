<?php 

// kripse_arthra

function kripse_arthra() {
	// fere mou ta tessera teleutaia programmatismena posts tis katigorias ARTHRA
	$the_query = new WP_Query( array( 
		'category_name' => 'ΑΡΘΡΑ', 
		'posts_per_page' => 4,
		'post_status' => 'future'
	) ); 


	// if the query have posts
	if ( $the_query->have_posts() ) {
		$string = '<ul class="postsbycategory widget_recent_entries">';
		// The Loop - show post details
		
		$current_date = date("Y-m-d");

		while ( $the_query->have_posts() ) {

		$the_post = $the_query->the_post();

		$the_post_id = get_the_ID();

		$post_date = get_the_date( 'Y-m-d', $the_post_id );

		$string .=  'The post date is equal to'.$post_date ;

			$string .= '<li>'. get_the_date( 'Y-m-d', $the_post_id ) . '</li>';

				if ($current_date == $post_date) {
					stick_post($the_post_id);
					// $string .= 'Post are sticked';
				}

				$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
				
			}
		} else {
		// no posts found
	//  $string .= '<li>No Posts Found</li>';
	}
	// $string .= '</ul>';
	   
	return null;
}
// add_shortcode('kripse_arthra', 'kripse_arthra');
add_action('update_option_(sticky_posts)', 'kripse_arthra' , 10, 0);
// wp_schedule_event( time(), 'daily', 'update_option_(sticky_posts)');

// emfanise_arthra

function emfanise_arthra() {
	// fere mou ta tessera teleutaia programmatismena posts tis katigorias ARTHRA
	$the_query = new WP_Query( array( 
		'category_name' => 'ΑΡΘΡΑ', 
		'posts_per_page' => 4,
		'post__in' => get_option('sticky_posts'),
		'post_status' => 'publish'
	) ); 


	// if the query have posts
	if ( $the_query->have_posts() ) {
		$string = '<ul class="postsbycategory widget_recent_entries">';
		// The Loop - show post details
		
		$current_date = date("Y-m-d");

		while ( $the_query->have_posts() ) {

		// $the_post = $the_query->the_post();

		$the_post_id = get_the_ID();

		$post_date = get_the_date( 'Y-m-d', $the_post_id );

		$string .=  'The post date is equal to'.$post_date ;

			$string .= '<li>'. get_the_date( 'Y-m-d', $the_post_id ) . '</li>';

				if ($current_date != $post_date and is_sticky($the_post_id)) {
					unstick_post($the_post_id);
				}		
				$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
			}
		}

		
	
	return null;
}
// add_shortcode('emfanise_arthra', 'emfanise_arthra');
add_action('update_option_(sticky_posts)', 'emfanise_arthra', 10, 0);
// wp_schedule_event( time(), 'daily', 'emfanise_arthra');

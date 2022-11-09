<?php
// kripse_arthra

function kripse_arthra() {
	// fere mou ta tessera teleutaia dimosieumena posts tis katigorias ARTHRA
	$the_query = new WP_Query( array( 
		'category_name' => 'ΑΡΘΡΑ', 
		'posts_per_page' => 4,
		'post_status' => 'publish'
	) ); 

	// if the query have posts
	if ( $the_query->have_posts() ) {
		
		$current_date = date("Y-m-d");

		while ( $the_query->have_posts() ) {

		$the_post = $the_query->the_post();

		$the_post_id = get_the_ID();

		$post_date = get_the_date( 'Y-m-d', $the_post_id );

			if ($current_date == $post_date) {
				stick_post($the_post_id);
			}

			}
		} 

	return null;
}
// add_shortcode('kripse_arthra', 'kripse_arthra');
add_action('update_option_(sticky_posts)', 'kripse_arthra' , 10, 0);

// emfanise_arthra

function emfanise_arthra() {

	// fere mou ta tessera teleutaia dimosieumena sticky posts tis katigorias ARTHRA
	$the_query = new WP_Query( array( 
		'category_name' => 'ΑΡΘΡΑ', 
		'posts_per_page' => 4,
		// 'post__in' => get_option('sticky_posts'),
		'post_status' => 'publish'
	) ); 

	// an to query exei posts
	if ( $the_query->have_posts() ) {

		$current_date = date("Y-m-d");

		while ( $the_query->have_posts() ) {

		$the_post = $the_query->the_post();

		$the_post_id = get_the_ID();

		$post_date = get_the_date( 'Y-m-d', $the_post_id );

			// tsekare ean to post exei idia hmerominia me thn shmerini, ean einai sticky h einai sticky post kai einai to teleutaio
			if (($current_date != $post_date AND is_sticky($the_post_id)) OR (is_sticky($the_post_id) AND ($the_query->current_post - 1) == ($the_query->post_count))) {
				unstick_post($the_post_id);
			}		
		}
	}

	return null;
}
// add_shortcode('emfanise_arthra', 'emfanise_arthra');
add_action('update_option_(sticky_posts)', 'emfanise_arthra', 10, 0);

// unstick posts bulk option

function unstick_post_bulk() {

	// fere mou ta tessera teleutaia dimosieumena sticky posts tis katigorias ARTHRA
	$the_query = new WP_Query( array( 
		'category_name' => 'ΑΡΘΡΑ', 
		'posts_per_page' => 4,
		'post__in' => get_option('sticky_posts'),
		'post_status' => 'publish'
	) ); 


	// an to query exei posts
	if ( $the_query->have_posts() ) {

		while ( $the_query->have_posts() ) {

		$the_post = $the_query->the_post();

		$the_post_id = get_the_ID();

		unstick_post($the_post_id);

		}
	}

	return null;
}
// add_shortcode('unstick_post_bulk', 'unstick_post_bulk');
// add_action('update_option_(sticky_posts)', 'unstick_post_bulk', 10, 0);

?>

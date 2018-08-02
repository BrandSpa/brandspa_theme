<?php

function ra_posts_slider_sc( $atts ) {
	$at = shortcode_atts([], $atts);

  $query = new Wp_Query(array(
    'post_type' => 'post',
		'posts_per_page' => 9,
		'post_status' => 'publish'
  ));

	$posts = array_map(function($item) {
		$attachment_id = get_post_thumbnail_id($item->ID);
		$item->post_thumbnail = wp_get_attachment_image_src($attachment_id, 'thumbnail')[0];
		$item->post_image = wp_get_attachment_image_src($attachment_id, 'full')[0];
		$item->post_categories = get_the_category($item->ID);
		return $item;
	}, $query->get_posts());

	$props = ['posts' => $posts];

	foreach($posts as $post){
		$post->post_content="";
	}

	ob_start();
	?>
		<!--ra-posts-slider-->
		<div class="ra-posts-slider" data-props='<?php echo json_encode($props) ?>'></div>
		<!--/ra-posts-slider-->
	<?php
	return ob_get_clean();
}

add_shortcode( 'ra_posts_slider', 'ra_posts_slider_sc' );

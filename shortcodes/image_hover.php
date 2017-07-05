<?php


function ra_image_hover_sc( $atts ) {
	$at = shortcode_atts([
    "image" => "",
    "image_overlay" => "",
    "bg_color"  => "#000"
  ], $atts);

	$at['image'] = wp_get_attachment_url($at['image_overlay']);
	$at['image_overlay'] = wp_get_attachment_url($at['image_overlay']);

	ob_start();
	?>

		<!--ra_image_hover-->
    <div class="img_hover">
      <img data-src="<?php echo $at['image_overlay'] ?>" alt="" class="img_hover__overlay lazyload" />
      <img data-src="<?php echo $at['image'] ?>" alt="" class="img_hover__base lazyload" />
    </div>

		<!--/ra_image_hover-->
	<?php
	return ob_get_clean();
}

add_shortcode( 'ra_image_hover', 'ra_image_hover_sc' );

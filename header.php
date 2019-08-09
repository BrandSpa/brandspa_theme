<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="theme-color" content="#6031ba">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>BrandSpa</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap-grid.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/fonts/aktiv.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/fonts/gotham_rounded.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/client/dist/index.css?v=<?php echo filemtime(get_template_directory() . '/client/dist/index.css') ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/style.css?v=<?php echo filemtime(get_template_directory() . '/style.css') ?>">
	<!--wordpress files-->
	<?php wp_head(); ?>
	<!-- /wordpress files-->
		<script>
      function onLoad(cb) {
        if (window.addEventListener)
          window.addEventListener("load", cb, false);
        else if (window.attachEvent) {
          window.attachEvent("onload", cb);
        } else {
          window.onload = cb;
        }
      }
  </script>
	


</head>
<body <?php body_class(); ?>>
	
<header class="app-header">
<a href="<?php echo get_site_url(); ?>">
	<?php 
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
		echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="">';
	?>
</a>
	
	<div class="navbar">
	<?php
		wp_nav_menu(array(
			'menu'           => 'main-menu',
			'theme_location' => 'main-menu',
			'menu_id'        => 'navigation',
			'depth'          => 3,
			'container'      => false,
			'menu_class'     => 'nav',
			//Process nav menu using our custom nav walker
			'walker'         => new wp_bootstrap_navwalker()
		));
	?>
	</div>
	
</header>



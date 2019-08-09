<?php get_header() ?>

<div class="body-content">
  <?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content() ?>
		<?php  endwhile; ?>
  <?php else : ?>
    <h1>404</h1>
  <?php endif; ?>
</div>

<?php get_footer() ?>

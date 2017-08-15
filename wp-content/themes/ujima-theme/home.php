<!-- ?php get_template_part('templates/page', 'header'); ? -->

<div class="page-body" >
	<div class="wrapper">
		<div class="grid-3">
			<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
				<?php _e('Sorry, no results were found.', 'sage'); ?>
			  </div>
			  <?php get_search_form(); ?>
			<?php endif; ?>

			<?php while (have_posts()) : the_post(); ?>
			  <?php get_template_part('templates/content-index', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
			<?php endwhile; ?>
		</div>
		<?php the_posts_navigation(); ?>
	</div>
</div>

<?php get_template_part('templates/advert-full-w'); ?>

<?php get_template_part('templates/radio-show-3-modules'); ?>

<?php get_template_part('templates/email-sign-up-full-w'); ?>

<?php get_template_part('templates/home-page-social-media-modules'); ?>





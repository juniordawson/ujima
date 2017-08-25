
<div class="page-body">
	<div class="wrapper">
		<div class="grid-3">
			<span class="d-b mt-2 mb-2">
				<?php get_template_part('templates/page', 'header'); ?>
			</span>
			
			<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
			    <?php _e('Sorry, no results were found.', 'sage'); ?>
			  </div>
			  <?php get_search_form(); ?>
			<?php endif; ?>

			<?php while (have_posts()) : the_post(); ?>
			  <?php get_template_part('templates/content-index', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		</div>
	</div>
</div>
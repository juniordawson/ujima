<div class="col">
	<article <?php post_class(); ?>>
		<header>
			<?php if( get_field('main_image') ): ?>
				<a href="<?php the_permalink(); ?>"><img src="<?php the_field('main_image'); ?>" /></a>
			<?php endif; ?>
			
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php get_template_part('templates/index-meta'); ?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</article>
</div>
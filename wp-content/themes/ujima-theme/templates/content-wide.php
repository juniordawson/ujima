<div class="wrapper mt-2">
	<?php the_content(); ?>
	<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>
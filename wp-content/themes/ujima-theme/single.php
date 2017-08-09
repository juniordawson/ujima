<div class="wrapper mt-2">
	<div class="grid-2-3">
		<div class="grid-2-3">
			<div class="col-2-3">
				<?php get_template_part('templates/content-single', get_post_type()); ?>
			</div>
			<div class="col-1-3">
				<?php get_template_part('templates/sidebar', get_post_type()); ?>
			</div>
		</div>
	</div>
</div>


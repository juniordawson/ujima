<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
		<?php if( get_field('main_image') ): ?>
			<img src="<?php the_field('main_image'); ?>" class="mb-3" />
		<?php endif; ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php get_template_part('templates/entry-meta'); ?>
		<div class="entry-content">
			<?php the_content(); ?> 
		</div>
		
		<div class="w-50">
			<div class="replica-h3">Share this post</div>
          <?php get_template_part('templates/social-links'); ?>
        </div>
        <div class="w-50 ta-r pt-2">
         	<a href="" class="btn btn-boxed">Return to posts</a>
         </div> 
        
	<!--footer>
	  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
	</footer-->
	<!--?php comments_template('/templates/comments.php'); ?-->
  </article>
<?php endwhile; ?>




	  
	  
	  
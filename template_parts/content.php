<article <?php post_class(); ?>>
	<div class="postBox">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div>
			<?php the_excerpt(); ?> 
			<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('M j, Y'); ?></time>
		</div>
	</div>
</article>
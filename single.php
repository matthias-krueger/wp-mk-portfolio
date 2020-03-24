<?php get_header(); ?>
<main id="pageMain" role="main">
	<?php the_post(); ?>
	<article <?php post_class(); ?>>
		<section id="intro">
			<div class="table wrapper">
				<div class="tableCell">
					<div class="headingBox">
						<h1 class="heading">
							<small>Article</small><br><span class="name"><?php the_title(); ?></span>
						</h1>
						<div class="headingMore">
							<?php
								echo ( has_excerpt() ? the_excerpt() : '' );
							?>
							<small><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('M j, Y'); ?></time></small>
						</div>
					</div>
				</div>
			</div>
		</section>
		<aside>
			<?php echo mki_series_parts(); ?>
		</aside>
		<section class="content wrapper">
			<?php the_content(); ?>
		</section>
		<?php comments_template(); ?>
		<div class="pagination">
			<?php
				the_post_navigation( array(
					'prev_text'			=> '&laquo; Previous Episode',
					'next_text'         => 'Next Episode &raquo;',
					'in_same_term'      => true,
					'taxonomy'          => 'series',
					'screen_reader_text'=> 'Series navigation',
				) );
			?>
		</div>
	</article>
</main>
<?php get_footer(); ?>
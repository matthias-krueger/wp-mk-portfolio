<?php get_header(); ?>
<main id="pageMain" role="main">
	<section id="intro">
		<div class="table wrapper">
			<div class="tableCell">
				<div class="headingBox">
					<h1 class="heading">
						<small>All Episodes on</small><br><span class="name"><?php single_cat_title(); ?></span>
					</h1>
					<div class="headingMore">
						<?php echo category_description(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="wrapper">
			<?php
				if (have_posts()) {
					while (have_posts()) {
						the_post();
						get_template_part('template_parts/content');
					}
				} else {
					get_template_part('template_parts/content', 'none');
				}
			?>
		</div>
	</section>
	<?php get_template_part('template_parts/pagination'); ?>
</main>
<?php get_footer(); ?>
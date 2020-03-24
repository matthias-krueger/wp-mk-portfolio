<?php get_header(); ?>
<main id="pageMain" role="main">
	<section id="intro">
		<div class="table wrapper">
			<div class="tableCell">
				<div class="headingBox">
					<h1 class="heading">
						<small>Search</small><br><span class="name">Result</span>
					</h1>
					<div class="headingMore">
						<?php
							if ( have_posts() ) {
								if ( $wp_query->found_posts == 1 ) {
									echo '<p>One match found for "';
								} else {
									echo '<p>' . $wp_query->found_posts, ' matches found for "';
								}
							} else {
								echo '<p>No match found for "';
							}
							echo the_search_query() . '"</p>';
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="wrapper">
			<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
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
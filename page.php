<?php get_header(); ?>
<main id="pageMain" role="main">
	<article>
		<section id="intro">
			<div class="table wrapper">
				<div class="tableCell">
					<div class="headingBox">
						<h1 class="heading">
							<small>Legal</small><br><span class="name"><?php the_title(); ?></span>
						</h1>
					</div>
				</div>
			</div>
		</section>
		<section class="content wrapper">
			<?php
				the_post();
				the_content();
			?>
		</section>
	</article>
</main>
<?php get_footer(); ?>
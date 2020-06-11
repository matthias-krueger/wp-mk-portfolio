<?php get_header(); ?>
<main id="pageMain">
	<section id="intro">
		<div class="table wrapper">
			<div class="tableCell">
				<div class="headingBox">
					<h1 class="heading">
						<small>Category</small><br><span class="name"><?php single_cat_title(); ?></span>
					</h1>
					<div class="headingMore">
						<p>
                            <?php
                                foreach ( get_the_terms( get_the_ID(), 'category' ) as $term ) {
                                    echo $term->count . ' postings';
                                }
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
    <aside class="asideCategory menu">
        <div class="wrapper">
            <?php
                echo '<h2>Categories</h2><ul>';
                wp_list_categories( array(
                    'hide_empty'          => 1,
                    'orderby'             => 'name',
                    'separator'           => '',
                    'show_option_none'    => '',
                    'style'               => 'list',
                    'taxonomy'            => 'category',
                    'title_li'            => '',
                    'use_desc_for_title'  => 0,
                ) );
                echo '</ul>';
            ?>
        </div>
    </aside>
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
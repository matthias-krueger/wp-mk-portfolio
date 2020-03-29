<?php get_header(); ?>
<main id="pageMain" role="main">
	<section id="intro">
		<div class="table wrapper">
			<div class="tableCell">
				<div class="headingBox">
					<h1 class="heading">
						<small>I am<span class="blender"></span></small><br>
						<span class="name"><?php bloginfo('name'); ?><span class="blender"></span></span>
					</h1>
					<div class="headingMore">
						<p>a Web developer and <span>User Experience designer</span></p>
						<p>with a passion <span>for Accessibility</span></p>
						<p><small>and a Bachelor's degree <span>in Computer Science</span></small></p>
						<span class="blender"></span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="content">
		<div class="wrapper">
			<h2>Human System Interaction</h2>
			<p class="claim">My strength is the holistic combination of design and front-end development. I proceed as creatively as analytically with a user-centered design approach and keep the web accessibility in mind.</p>
			<h2>Recent Articles</h2>
			<?php
				$recent_posts = wp_get_recent_posts(array(
					'numberposts' => 3,
					'post_status' => 'publish'
				));
				foreach($recent_posts as $post) : ?>
					<article>
						<?php
							printf( '<h3><a href="%1$s">%2$s</a></h3><p>%3$s</p><time datetime="%4$s">%5$s</time>',
								esc_url(get_permalink( $post["ID"] )),
								$post['post_title'],
								$post['post_excerpt'],
								$post['post_date'],
								get_the_time( 'M j, Y', $post["ID"] )
							);
						?>
					</article>
				<?php endforeach; wp_reset_query();
			?>
		</div>
	</div>
</main>
<?php get_footer(); ?>


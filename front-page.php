<?php get_header(); ?>
<main id="pageMain" role="main">
	<article>
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
		<div class="content wrapper">
			<section class="flexBox homeHci flexOrder1">
				<div class="flexItem textBox">
					<h2>My focus is on<br>Human System Interaction</h2>
					<p>We interact with whole ecosystems composed of computers and machines in our environment and that often simultaneously. That is exactly where my fascination for aspects like Human Factors, Accessibility and Ergonomics come from.<br>In my study of computer science I focus on digital media and surrounding aspects. My interest thereby is for instance on usability, user experience and Accessibility.</p>
				</div>
				<div class="flexItem linkBox">
					<a href="<?php echo esc_url(get_permalink(7)); ?>" class="linkItem">
						<div><p><span class="icon iconLink"></span>Articles</p></div>
					</a>
				</div>
			</section>
			<section class="flexBox homeFeatured flexOrder2">
				<?php
					function mki_recent_article() {
						$criteria = array(
							'numberposts' => 1,
							'post_status' => 'publish'
						);
						$recentPosts = wp_get_recent_posts( $criteria );
						$recentPost = array_shift( $recentPosts );
						?>
						<div class="flexItem textBox">
							<?php
								printf( '<h2>Recent Article<br>%1$s</h2><p>%2$s<small>' .
									   ' <time datetime="%3$s">%4$s</time></small></p>',
									$recentPost['post_title'],
									$recentPost['post_excerpt'],
									$recentPost['post_date'],
									get_the_time( 'M j, Y', $recentPost["ID"] )
								);
							?>
						</div>
						<div class="flexItem linkBox">
							<a href="<?php echo esc_url(get_permalink( $recentPost["ID"] )); ?>" class="linkItem">
								<div><p><span class="icon iconLink"></span>Recent Article</p></div>
							</a>
						</div>
						<?php
						wp_reset_query();
					}
					mki_recent_article();
				?>
			</section>
<!--
			<section class="flexBox homeAbout flexOrder2">
				<div class="flexItem textBox">
					<h2>About Me,<br>Get In Touch</h2>
					<p>Learn a bit about my career and passions.</p>
				</div>
				<div class="flexItem linkBox">
					<a href="<?php echo esc_url(get_permalink(9)); ?>" class="linkItem">
						<span class="icon iconLogo"></span>
						<div><p><span class="icon iconLink"></span>About</p></div>
					</a>
				</div>
			</section>
-->
		</div>
	</article>
</main>
<?php get_footer(); ?>


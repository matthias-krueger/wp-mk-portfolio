	<footer class="siteFooter">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'nav_footer',
				'depth' => 1,
				'container' => '',
				'menu_id' => 'menuFooter',
			) );
		?>
		<p>&copy;<?php echo date(" Y "); bloginfo('name'); ?></p>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
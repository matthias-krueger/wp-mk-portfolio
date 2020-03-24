<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="Human System Interaction, Usability">
    <meta name="page-topic" content="Matthias Krueger Portfolio">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="siteHeader" role="banner">
		<a class="skipLink screen-reader-text" href="#pageMain" tabindex="0">Skip to main content</a>
		<nav class="navHeader" role="navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'nav_header',
					'depth' => 1,
					'container' => '',
					'menu_id' => 'menuHeader',
				) );
			?>
			<button id="searchButton" tabindex="0">Search</button>
		</nav>
		<?php get_search_form(); ?>
    </header>
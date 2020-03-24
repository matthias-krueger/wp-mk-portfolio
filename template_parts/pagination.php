<?php
	if ( get_next_posts_link() || get_previous_posts_link() ) {
		echo '<div class="pagination menu"><div class="nav-previous">';
		previous_posts_link();
		echo '</div><div class="nav-next">';
		next_posts_link();
		echo '</div></div>';
	}
?>
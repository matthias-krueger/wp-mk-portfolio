<div id="searchBox">
	<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
		<label for="searchField" class="screen-reader-text">search field</label>
		<input type="search" tabindex="-1" id="searchField" name="s" required value="" placeholder="search" title="enter search term">
		<button class="searchSend" tabindex="-1" type="submit" name="f" title="start">
			<span class="screen-reader-text">start search</span>
			<span class="icon iconSearch"></span>
		</button>
	</form>
	<div id="searchClose"></div>
</div>
<?php

//Register Theme Features
function mki_theme_features()  {
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_editor_style( '/assets/tinymce.css' );
	register_nav_menus( array(
		'nav_header' => 'Header-Navigation',
		'nav_footer' => 'Footer-Navigation'
	) );
}
add_action( 'after_setup_theme', 'mki_theme_features' );


//replaces no-js with js if JavaScript is executable
function mki_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'mki_javascript_detection', 0 );


//remove actions, filters
function mki_remove_actions() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	//disable emojis of all kind
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content', 'wptexturize' );
}
add_action( 'init', 'mki_remove_actions' );


//enqueue scripts and styles
function mki_scripts() {
	wp_enqueue_script( 'mki-main', get_template_directory_uri() . '/assets/main.js', array(), '0.1', true );
	wp_enqueue_style( 'mki-style', get_stylesheet_directory_uri() . '/style.css', array(), '0.1', 'all' );
	if ( is_single()) {
		wp_enqueue_script( 'mki-synhig-js', get_template_directory_uri() . '/assets/syntaxhighlighter.min.js', array(), '4.0.1', true );
		wp_enqueue_style( 'mki-synhig-css', get_stylesheet_directory_uri() . '/assets/syntaxhighlighter.css', array(), '0.9', 'all' );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ); 
	}
}
add_action( 'wp_enqueue_scripts', 'mki_scripts' );


//setting search result excerpt length
function mki_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mki_excerpt_length', 999 );


// custom excerpt more string
function mki_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'mki_excerpt_more' );


// Register Custom Taxonomy Series
function mki_taxonomy_series() {
	$labels = array(
		'name'                       => 'Series',
		'singular_name'              => 'Series',
		'menu_name'                  => 'Series',
		'all_items'                  => 'All Series',
		'parent_item'                => 'Parent Series',
		'parent_item_colon'          => 'Parent Series:',
		'new_item_name'              => 'New Series Name',
		'add_new_item'               => 'Add New Series',
		'edit_item'                  => 'Edit Series',
		'update_item'                => 'Update Series',
		'view_item'                  => 'View Series',
		'separate_items_with_commas' => 'Separate series with commas',
		'add_or_remove_items'        => 'Add or remove series',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Series',
		'search_items'               => 'Search Series',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No series',
		'items_list'                 => 'Series list',
		'items_list_navigation'      => 'Series list navigation'
	);
	$args = array(
		'labels'			=> $labels,
		'hierarchical'		=> true,
		'public'			=> true,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'show_in_nav_menus' => true,
		'show_tagcloud'		=> false
	);
	register_taxonomy( 'series', 'post', $args );

}
add_action( 'init', 'mki_taxonomy_series', 0 );


/**
* if viewed post is part of one or more series
* display for each Series the name and list the associated posts
*/
function mki_series_parts() {
	$output = '';
	$postId = get_the_ID();
	$postTerms = get_the_terms( $postId, 'series' );
	if ( $postTerms && !is_wp_error( $postTerms ) ) {
		$output = '<div class="wrapper"><div class="asideSeries menu">';
		foreach ( $postTerms as $postTerm ) {
			$output .= '<p>This article ist part of the ' . esc_html( $postTerm->name ) . ' series:</p><ol>';
			$postQuery = new WP_Query(
				array(
					'order'   	=> 'ASC',
					'tax_query' => array(
						array(
							'taxonomy' => $postTerm->taxonomy,
							'field'    => 'term_id',
							'terms'    => $postTerm->term_id
						)
					)
				)
			);
			while ( $postQuery->have_posts() ) {
				$postQuery->the_post();
				$output .= sprintf(
					'<li%1$s><a href="%2$s"><span class="icon iconLink"></span>%3$s</a></li>',
					$postQuery->post->ID == $postId ? ' class="currentSeriesItem"' : '',
					esc_url( get_permalink() ),
					esc_html( get_the_title() )
				);
			}
			$output .= '</ol>';
			wp_reset_postdata();
		}
		$output .= '</div></div>';
	}
	return $output;
}


function mki_body_classes( $classes ) {
	if ( is_page( 9 ) ) {
		$classes[] = 'about';
	}
	if ( is_page( 11 ) || is_page( 61 ) || is_page( 425 ) ) {
		$classes[] = 'legal';
	}
	if ( is_home() || is_archive() || is_search() ) {
		$classes[] = 'postList';
	}
	return $classes;
}
add_filter( 'body_class', 'mki_body_classes' );


//Commentlist Walker class
class comment_walker extends Walker_Comment {
	protected function html5_comment( $comment, $depth, $args ) {
		$awaitingApproval = false;
		if ( '0' == $comment->comment_approved ) {
			$awaitingApproval = true;
		} ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
            <article <?php echo $awaitingApproval ? ' class="awaitingApproval"' : '' ?>>
                <header class="commentHeader">
					<div class="avatarBox">
						<?php
							if ( 0 != $args['avatar_size'] ) {
								$avatarUrl = get_avatar_url( $comment, array( 'default' => '404' ) );
								$response = wp_remote_head( $avatarUrl );
								$headCode = $response['response']['code'];
								
								if( $headCode == '200' ) {
									echo get_avatar( $comment, $args['avatar_size'] );
								} else {
									$commentAuthor = $comment->comment_author;
									$spacePosition = strpos( $commentAuthor, ' ' );
									printf(
										'<div class="avatar commentInitial"><span>%1$s%2$s</span></div>',
										$commentAuthor[0],
										$spacePosition !== false ? $commentAuthor[$spacePosition + 1] : ''
									);
								}
							}
						?>
					</div>
					<p class="commentAuthor"><?php echo $comment->comment_author; ?></p>
					<span class="commentDot">&middot;</span>
					<?php
						echo '<time datetime="' . $comment->comment_date . '">' . get_comment_date( 'M j, Y', $comment ) . '</time>';
						if ( $awaitingApproval ) {
							echo '<p>Your comment is awaiting approval.</p>';
						}
					?>
                </header>
                <div class="commentContent">
                    <?php comment_text(); ?>
                </div>
 				<footer class="commentFooter">
					<?php
						if ( ! $awaitingApproval ) {
							comment_reply_link( array_merge( $args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '',
								'after'     => ''
							) ) );
							edit_comment_link( 'Edit', '<span class="commentDot">&middot;</span>' );
						}
					?>
	 			</footer>
			</article>
		</li>
<?php }
}


function mki_figure_max_width( $returnOutput, $attr, $content ) {
	$atts = shortcode_atts( array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => '',
		'class'   => '',
	), $attr, 'caption' );
	
	$atts['width'] = (int) $atts['width'];
	if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
		return $content;
	}
	if ( ! empty( $atts['id'] ) ) {
		$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';
	}
	$class = trim( 'caption ' . $atts['align'] . ' ' . $atts['class'] );
	
	if ( ! empty( $atts['align'] ) ) {
		return '<figure ' . $atts['id'] . 'style="width: ' . (int) $atts['width'] . 'px;" class="' . esc_attr( $class ) . '">' . do_shortcode( $content ) . '<figcaption>' . $atts['caption'] . '</figcaption></figure>';		
	} else {
		return '';
	}
}
add_filter( 'img_caption_shortcode', 'mki_figure_max_width', 10, 3 );


//setting format elements to TinyMCE editor
function mki_format_mce( $in ) {
//	$in['wpautop'] = true;
	$in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4";
	$in['toolbar1'] = 'formatselect, styleselect, bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, outdent, indent, bullist, numlist, link, unlink, wp_adv';
	$in['toolbar2'] = 'fullscreen, undo, redo, pastetext, removeformat, forecolor, charmap';
	return $in;
}
add_filter( 'tiny_mce_before_init', 'mki_format_mce' );


//reveal the hidden custom button in TinyMCE editor
function mki_mce_buttons ( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons', 'mki_mce_buttons' );


//format the custom button in TinyMCE editor
function mki_mce_button_formats( $init_array ) {
	$style_formats = array(
		array(
			'title' => '*Fussnote',
			'inline' => 'small'
		),
		array(
			'title' => '"quote"',
			'inline' => 'q'
		),
		array(
			'title' => '"blockquote"',
			'block' => 'blockquote',
			'wrapper' => true
		),
	);
	$init_array[ 'style_formats' ] = json_encode( $style_formats );
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'mki_mce_button_formats' );

//short code figure
function mki_figure( $atts, $content = null ) {
	return '<div class="figure">' .  do_shortcode( $content )  . '</div>';
}
add_shortcode( 'figure', 'mki_figure' );

//short code inlineCode
function mki_inline_code( $atts, $content = null ) {
	return '<code class="inlineCode">' . $content . '</code>';
}
add_shortcode( 'inlineCode', 'mki_inline_code' );

//short code span
function mki_source( $atts, $content = null ) {
	return '<span class="source">' . $content . '</span>';
}
add_shortcode( 'source', 'mki_source' );

//short code iframe box
function mki_frame( $atts, $content = null ) {
	$extract = shortcode_atts( array(
		'title' => 'Video',
	), $atts );
	return '<div class="videoBox"><div>' . $content . '</div><p>' .  esc_html( $extract['title'] ) . '</p></div>';
}
add_shortcode( 'frame', 'mki_frame' );


// add help text to the editor
function mki_metabox() {
    add_meta_box( 'mb-code', 'Shortcode', 'mki_mb_code', '', 'side', 'high' );
    add_meta_box( 'mb-syn', 'Syntax Highlighter', 'mki_mb_syn', '', 'side', 'high' );
}

// help text for metabox Shortcode
function mki_mb_code() {
    echo '[inlineCode]<br>//place it within a paragraph<br>"code content"<br>[/inlineCode]<br>' .
		'<br>[figure]<br>//generated caption shortcode<br>"additional content"<br>[/figure]<br>' .
		'<br>[frame title="//title"]<br>//generated iframe content<br>[/frame]<br>' .
		'<br>[source]"source content"[/source]';
}
add_action( 'add_meta_boxes', 'mki_metabox' );

// help text for metabox Syntax Highlighter
function mki_mb_syn() {
    echo '<p>Use <b>Text</b> not Visual Editor<br>Replace all <b><</b> characters with <b>&amp;lt;</b>' .
		'<br><b>Brushes:</b> css, html, js, php<br><b>Default Options:</b><br>auto-links:true;' .
		' (detection of links)<br>first-line:1; (starting line number)<br>gutter:true;' .
		' (gutter with line numbers)<br>highlight:null; (highlighting lines)<br>smartTabs:true;<br>tabSize:4;' .
		'<br><b>Example:</b><br>&lt;pre class="brush:js; highlight: [2,5]"><br>// content &lt;/pre></p>';
}
add_action( 'add_meta_boxes', 'mki_metabox' );

?>
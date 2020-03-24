<?php
/**
* Template for displaying the current comments and the comment form.
*/

if ( post_password_required() ) {
	return;
}
?>

<section class="commentBox">
	<div class="wrapper">
	<?php
	function mki_comment_markup( $required, $commenter, $identity ) {
		$formLabel = '';
		if ( have_comments() ) {
			$formLabel = 'Add a comment';
			echo '<h3>Comments</h3><ol class="commentList">';
			wp_list_comments( array(
				'walker' => new comment_walker(),
				'avatar_size' => 45,
				'style' => 'ol',
				'short_ping' => true,
				'reverse_top_level' => true,
				'reply_text' => 'Reply',
				'format' => 'html5'
			) );
			echo '</ol>';
		} elseif ( comments_open() ) {
			$formLabel = 'Leave the first comment';
		}
		if ( comments_open() ) {
			$fields =  array(
				'author' => sprintf(
						'<li class="commentInput commentName"><label for="commentFormAuthor" class="screen-reader-text">Name</label>%1$s<input id="commentFormAuthor" name="author" type="text" value="%2$s" placeholder="Name" size="30" maxlength="245" %3$s></li><!--',
						$required ? '<small>required</small>' : '',
						esc_attr( $commenter['comment_author'] ),
						$required ? 'aria-required="true" required' : ''
					),			
				'email' => sprintf(
						'--><li class="commentInput"><label for="commentFormEmail" class="screen-reader-text">Email</label><small>%1$swill not be published</small><input id="commentFormEmail" name="email" type="email" value="%2$s" placeholder="Email" size="30" maxlength="100" aria-describedby="email-notes" %3$s></li>',
						$required ? 'required, ' : '',
						esc_attr( $commenter['comment_author_email'] ),
						$required ? 'aria-required="true" required' : ''
					),
				'url' => '',
    		);
			comment_form( array(
				'fields' => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field' => '<ul><li><label for="commentFormText" class="screen-reader-text">Comment</label><textarea id="commentFormText" role="textbox" name="comment" placeholder="Comment" rows="2" cols="45" maxlength="65525" aria-label="comment" aria-required="true" required></textarea></li>',
				'logged_in_as' => '<p>You are logged in as ' . $identity . '.</p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'class_form' => 'commentForm',
				'title_reply' => $formLabel,
				'label_submit' => 'Send',
				'submit_field' => '<li id="commentFormSubmit">%1$s %2$s</li></ul>',
			));
		} else {
			echo '<div class="commentClosed"><p>This article can&apos;t be commented';
			echo ( have_comments() ? ' anymore.</p></div>' : '.</p></div>' );
		}
	}
	mki_comment_markup( $req, $commenter, $user_identity );
	?>
	</div>
</section>

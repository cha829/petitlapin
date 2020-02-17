<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package dekiru
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() ) : ?>
	<div class="comment">
		<h2 class="title-v4"><?php esc_html_e( 'Comments List', 'dekiru' ); ?></h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( 'Prevoius comment', 'dekiru' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next comment', 'dekiru' ) ); ?></div>
			</div>
		<?php endif; ?>

		<?php wp_list_comments( array( 'callback' => 'dekiru_custom_comment' ) ); ?>
	</div>
<?php endif; ?>

<div class="post-comment">
	<?php
		comment_form( array(
			'comment_field' => '<div class="margin-bottom-30"><textarea id="message" name="comment" class="form-control bg-color-light" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></div>',
			'title_reply_before' => '<h2 class="title-v4">',
			'title_reply_after' => '</h2>',
			'id_form' => 'sky-form3',
			'class_form' => 'sky-form comment-style-v2',
			'class_submit' => 'btn-u btn-u-default'
		) );
	?>
</div>
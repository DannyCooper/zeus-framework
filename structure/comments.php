<?php
/**
 * Template functions used for the site comments.
 *
 * @package zeus
 */

if ( ! function_exists( 'zeus_display_comments' ) ) {
	/**
	 * Zeus display comments
	 */
	function zeus_display_comments() {

		/*
		 * Returns a template file for the comments
		 *
		 * Usage:
		 * add_filter( 'zeus_comments_template', 'my_callback' );
		 * function my_callback(){
		 *     return '/my-comments.php';
		 * }
		 */
		$template = apply_filters( 'zeus_comments_template', '/comments.php' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || '0' !== get_comments_number() ) :
		    comments_template( $template );
		endif;
	}
}

if ( ! function_exists( 'zeus_comment' ) ) {
	/**
	 * Custom comment output
	 *
	 * @param object $comment The comment object.
	 * @param array  $args Comment display args.
	 * @param int    $depth Levels of comment depth to be shown.
	 */
	function zeus_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment; ?>

	<li <?php zeus_attr( 'comment' ); ?>>

	    <article>
	        <header class="comment-meta">

	            <div class="comment-author-avatar">
	                <?php echo get_avatar( $comment->comment_author_email, 100 ); ?>
	            </div>

	            <?php printf( __( '<cite %s>%s</cite> - ', 'zeus-framework' ), zeus_get_attr( 'comment-author' ), get_comment_author_link() ); ?>

	            <?php
	            // Check if author of comment is also author of post.
	            zeus_bypostauthor( $comment ); ?>

	            <time <?php zeus_attr( 'comment-published' ); ?>>
	                <?php printf( esc_html__( '%s ago', 'zeus-framework' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
	            </time>

	            <?php edit_comment_link( '<i class="icon-edit"></i>', '' ); ?>

	        </header><!-- .comment-meta -->

	        <div <?php zeus_attr( 'comment-content' ); ?>>
	            <?php comment_text(); ?>
	        </div><!-- .comment-content -->

	        <?php comment_reply_link(); ?>

	        <?php if ( $comment->comment_approved === '0' ) : ?>
	            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'zeus-framework' ); ?></em>
	        <?php endif; ?>
	    </article>

	    <?php
	}
}

if ( ! function_exists( 'zeus_bypostauthor' ) ) {
	/**
	 * Check if comment is by the author of the post
	 */
	function zeus_bypostauthor( $comment ) {

		global $post;

		// If current post author is also comment author, make it known visually.
		$visual = ( $comment->user_id === $post->post_author ? '<span>' . esc_html__( 'Post author', 'zeus-framework' ) . '</span>' : '');
		echo $visual;
	}
}

if ( ! function_exists( 'zeus_comments_nav' ) ) {
	/**
	 * Output the comment navigation.
	 *
	 * Can be overwritten  by adding a file named entry-meta.php to /template-parts in your
	 * theme or child theme.
	 */
	function zeus_comments_nav() {

		$priority = array(
			'template-parts/comments-nav.php',
			'zeus-framework/structure/template-parts/comments-nav.php',
		);

		locate_template( $priority, true );

	}
}

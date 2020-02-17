<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package  dekiru
 * @license  GNU General Public License v2.0
 * @since    dekiru 1.0
 */

function dekiru_get_header_image() {
	$options = get_option( 'dekiru_theme_options' );

	echo '<div class="dekiru-slider">'.PHP_EOL;

	if ( empty($options['slider1_image']) && empty($options['slider2_image']) && empty($options['slider3_image']) && empty($options['slider4_image']) && empty($options['slider5_image']) ) {

		echo '<div><img src="' . esc_url( get_header_image() ) . '"></div>'.PHP_EOL;

	} else {

		for ( $i=1; $i<=5; $i++ ) {
			if ( !empty($options['slider'.$i.'_image']) ) {
				$alt = !empty($options['slider'.$i.'_alt']) ? esc_attr($options['slider'.$i.'_alt']) : '';
				$img = '<img src="' . esc_url($options['slider'.$i.'_image']) . '" alt="' . $alt . '">';
				$caption = !empty($options['slider'.$i.'_caption']) ? '<p class="dekiru-slider-title">' . esc_html($options['slider'.$i.'_caption']) . '</p>' : '';

				if ( !empty($options['slider'.$i.'_link_url']) ) {
					$target = ( isset($options['slider'.$i.'_blank']) && $options['slider'.$i.'_blank'] ) ? ' target="_blank"' : '';

					echo '<div><a href="' . esc_url($options['slider'.$i.'_link_url']) . '"' . $target . '>' . $img . $caption . '</a></div>'.PHP_EOL;

				} else {
					echo '<div>' . $img . $caption . '</div>'.PHP_EOL;

				}
			}
		}

	}

	echo '</div>'.PHP_EOL;

}

function dekiru_wp_title( $title, $sep ) {
	$title = get_bloginfo('name');

	if ( is_home() || is_front_page() ) {
		$title = $title . '|' . get_bloginfo('description');

	} elseif ( is_404() ) {
		$title = esc_html__( 'Oops! That page can&rsquo;t be found.', 'dekiru' ) . '|' . $title;

	} elseif ( is_category() ) {
		$title = single_cat_title( '', false ) . '|' . $title;

	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false ) . '|' . $title;

	} elseif ( is_author() ) {
		$user = get_userdata($author);
		if ( !empty($user->Name) ) {
			$title = $user->Name . '|' . $title;
		} else {
			$title = get_the_author() . '|' . $title;
		} 

	} elseif ( is_date() ) {
		$title = sprintf(
			/* translators: %s: post date. */
			__( '%s of the article list', 'dekiru' ),
			get_the_time( __( 'F Y', 'dekiru' ) )
		) . '|' . $title;

	} else {
		$title = get_the_title() . '|' . $title;

	}

	return $title;

}
add_filter( 'wp_title', 'dekiru_wp_title', 10, 2 );

function dekiru_rtn_page_header() {
	$html = '<div class="breadcrumbs"><div class="container">';
	if ( function_exists('dekiru_bread_crumb') ) $html .= dekiru_bread_crumb( 'home_label=HOME&elm_class=breadcrumb&echo=false' );
	$html .= '</div></div>';

	echo wp_kses_post($html);
}

function dekiru_custom_archive_title() {
	if( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif( is_author() ) {
		$title = get_the_author() . ' ' . esc_html__( 'Post list', 'dekiru' );
	} elseif ( is_search() ) {
		$title = sprintf(
			esc_html__( 'Search Results for: %s', 'dekiru' ),
			'<span>' . get_search_query() . '</span>'
		);
	} else {
		$title = get_the_title();
	}

	return wp_kses_post($title);
}
add_filter( 'get_the_archive_title', 'dekiru_custom_archive_title' );

function dekiru_custom_excerpt_more( $more ) {
	return ' ...';
}
add_filter( 'excerpt_more', 'dekiru_custom_excerpt_more' );

function dekiru_custom_excerpt_mblength( $length ) {
	return 100;
}
add_filter( 'excerpt_mblength', 'dekiru_custom_excerpt_mblength' );

function dekiru_custom_search_form( $form ) {
	$form = '<div class="input-group margin-bottom-30">';
	$form .= '<form method="get" action="' . esc_url(home_url()) . '">';
	$form .= '<input type="text" name="s" class="form-control" placeholder="' . esc_attr__( 'Site Search', 'dekiru' ) . '" value="">';
	$form .= '<span class="input-group-btn">';
	$form .= '<input type="submit" class="btn-u" value="' . esc_attr__( 'Search', 'dekiru' ) . '" />';
	$form .= '</span>';
	$form .= '</form></div>';
	return $form;
}
add_filter( 'get_search_form', 'dekiru_custom_search_form' );

function dekiru_custom_comment( $comment, $args, $depth ) {
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$add_below = 'comment';
	} else {
		$add_below = 'div-comment';
	}

	$comment_reply = get_comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'dekiru' ),
							'add_below' => $add_below,
							'depth' => $depth,
							'max_depth' => $args['max_depth']
							)
						)
					);

	$html = '<div class="row blog-comments-v2">'
		. '<div class="commenter">' . get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'rounded-x' ) ) . '</div>'
		. '<div class="comments-itself">'
		. '<h4>' . get_comment_author_link() . '<span>' . sprintf( ('%1$s %2$s / %3$s'), get_comment_date(), get_comment_time(), $comment_reply ) . '</span></h4>'
		. get_comment_text() . '</div></div><hr/>';

	echo $html;
}

function dekiru_footerCopyRight() {
	$copyright = '<div>' . sprintf( esc_attr__( 'Copyright &copy; %s All Rights Reserved.', 'dekiru' ), get_bloginfo('name') ) . '</div>';

	$powered = __( '<div id="powered">Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a> &amp; <a href="https://www.communitycom.jp/dekiru" target="_blank" title="Free WordPress Theme Dekiru"> Dekiru Theme</a> by <a href="https://www.communitycom.jp/" target="_blank">Communitycom,Inc.</a></div>', 'dekiru');

	$html = '<div class="copyright"><div class="container"><div class="row"><div class="col-md-12">';

	$html .= apply_filters( 'dekiru_copyright_custom', $copyright );
	$html .= apply_filters( 'dekiru_powered_custom', $powered );

	$html .= '</div></div></div></div>';
	echo wp_kses_post($html);
}

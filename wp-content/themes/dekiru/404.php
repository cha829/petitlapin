<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package  dekiru
 * @license  GNU General Public License v2.0
 * @since    dekiru 1.0
 */

get_header(); ?>

	<div class="container content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="blog-grid margin-bottom-30">
					<h1 class="blog-grid-title-lg"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'dekiru' ); ?></h1>
				</div>
				<div class="error-v1">
					<span class="error-v1-title">404</span>
					<span><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'dekiru' ); ?></span>
					<p><a class="btn-u btn-bordered" href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Go to Top Page', 'dekiru' ); ?></a></p>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>

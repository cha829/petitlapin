<?php
/**
 * The template for displaying all single posts.
 *
 * @package dekiru
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php dekiru_rtn_page_header(); ?>

	<div class="container content">
		<div class="row">
			<div class="col-md-9 md-margin-bottom-50">
				<div class="blog-grid margin-bottom-30">
					<h1 class="blog-grid-title-lg"><?php the_title(); ?></h1>
				</div>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
          <?php
					$args = array(
						'before'           => '<nav class="page-link"><dl><dt>Pages :</dt><dd>',
						'after'            => '</dd></dl></nav>',
						'link_before'      => '<span class="page-numbers">',
						'link_after'       => '</span>',
						'echo'             => 1 );
					wp_link_pages( $args );
				?>

				</div>

				
				<?php comments_template(); ?>

			</div>
			<?php get_sidebar(); ?>

		</div>
	</div>

<?php endwhile; ?>

<?php get_footer(); ?>

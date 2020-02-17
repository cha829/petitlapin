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
					<div class="overflow-h margin-bottom-10">
						<ul class="blog-grid-info pull-left">
							<li><?php the_author_posts_link(); ?></li>
							<li><?php the_date(); ?></li>
						</ul>
					</div>
				</div>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
          <?php
					$args = array(
						'before'           => '<nav class="page-link"><dl><dt>' . __( 'Pages:', 'dekiru' ) . '</dt><dd>',
						'after'            => '</dd></dl></nav>',
						'link_before'      => '<span class="page-numbers">',
						'link_after'       => '</span>',
						'echo'             => 1
						);
					wp_link_pages( $args );
				?>
				</div>

				<?php
					$category_list = get_the_category();
					$tags_list = get_the_tags();
					if ( !empty($category_list) || !empty($tags_list) ) :
				?>
					<ul class="blog-grid-tags">
						<?php if ( !empty($category_list) ) : foreach ( $category_list as $category ) : ?>
							<li><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a></li>
						<?php endforeach; endif; ?>
						<?php if ( !empty($tags_list) ) : foreach ( $tags_list as $tag ) : ?>
							<li><a href="<?php echo esc_url(get_category_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a></li>
						<?php endforeach; endif; ?>
					</ul>
				<?php endif; ?>

				

				<?php comments_template(); ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php endwhile; ?>

<?php get_footer(); ?>

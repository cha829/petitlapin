<?php
/**
 * The main template file.
 *
 * @package  dekiru
 * @license  GNU General Public License v2.0
 * @since    dekiru 1.0
 */
get_header(); ?>

	<div class="container content-sm">
		<div class="row">
			<div class="col-md-9 md-margin-bottom-50">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="row margin-bottom-50">
							<?php if ( has_post_thumbnail() ) : ?>
							<div class="col-sm-4 sm-margin-bottom-20">
								<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive') ); ?>
							</div>
							<div class="col-sm-8">
							<?php else : ?>
							<div class="col-sm-12 sm-margin-bottom-20">
							<?php endif; ?>
								<div class="blog-grid">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<ul class="blog-grid-info">
										<li><?php the_author_posts_link(); ?></li>
										<li><?php echo esc_html( get_the_date() ); ?></li>
										<li><?php the_category(', '); ?><?php the_tags(', ', ', ', ''); ?></li>
									</ul>
									<p><?php the_excerpt(); ?></p>
									<a class="r-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'dekiru' ); ?></a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>

					<div class="text-center">
						<?php
							$args = array(
								'type' => 'list',
								'prev_text' => '&lt;',
								'next_text' => '&gt;',
							);
							the_posts_pagination( $args ); 
						?>
					</div>

				<?php else : ?>
					<div class="well"><p><?php esc_html_e('No posts.','dekiru');?></p></div>
				<?php endif; // have_post() ?>

			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
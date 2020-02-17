<?php
/**
 * The Front Page template file.
 *
 * @package  dekiru
 * @license  GNU General Public License v2.0
 * @since    dekiru 1.0
 */
?>
<?php $options = get_option('dekiru_theme_options');?>
<?php get_header();?>

	<div class="content-sm bg-color-darker">
		<?php dekiru_get_header_image();?>
	</div>

	<div class="container content">

		<div class="row">
			<div class="col-md-9 md-margin-bottom-50">

				<?php if (is_active_sidebar('front-page-top')): ?>
				<?php dynamic_sidebar('front-page-top');?>
				<?php endif;?>

				<?php if ('page' == get_option('show_on_front')): ?>
					<?php while (have_posts()): the_post();?>

							<article id="post-<?php the_ID();?>" <?php post_class();?>>
								<div class="entry-body">
									<?php the_content();?>
								</div>
								<?php wp_link_pages(array('before' => '<div class="page-link">' . 'Pages:', 'after' => '</div>'));?>
							</article>

						<?php endwhile;?>
				<?php else: ?>
					<h2 class="title-v4"><?php esc_html_e('What`s New', 'dekiru');?></h2>
					<?php while (have_posts()): the_post();?>
							<div class="row margin-bottom-50">
								<?php if (has_post_thumbnail()): ?>
								<div class="col-sm-4 sm-margin-bottom-20">
	              <a href="<?php the_permalink();?>">
									<?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
	                </a>
								</div>
								<div class="col-sm-8">
								<?php else: ?>
							<div class="col-sm-12 sm-margin-bottom-20">
							<?php endif;?>
								<div class="blog-grid">
									<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<ul class="blog-grid-info">
										<li><?php the_author_posts_link();?></li>
										<li><?php echo esc_html(get_the_date()); ?></li>
										<li><?php the_category(', ');?><?php the_tags(', ', ', ', '');?></li>
									</ul>
									<p><?php echo get_the_excerpt();?></p>
									<a class="r-more" href="<?php the_permalink();?>"><?php esc_html_e('Read More', 'dekiru');?></a>
								</div>
							</div>
						</div>
					<?php endwhile;?>
				<?php endif;?>

				<div class="text-center">
					<?php
$args = array(
    'type' => 'list',
    'prev_text' => '&lt;',
    'next_text' => '&gt;',
);
the_posts_pagination($args);
?>
				</div>

			</div><!-- .col-md-9 -->

			<?php get_sidebar();?>

		</div><!-- .row -->
	</div><!-- container -->

<?php get_footer();?>
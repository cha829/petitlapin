<?php
/**
 * The header for our theme.
 *
 * @package  dekiru
 * @license  GNU General Public License v2.0
 * @since    dekiru 1.0
 */

$options = get_option('dekiru_theme_options');
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
  <meta charset="<?php bloginfo('charset');?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head();?>
</head>

<body <?php body_class('header-fixed header-fixed-space-v2');?>>
  <div class="wrapper">
    <div class="header-v8 header-sticky">
      <div class="blog-topbar">
        <div class="container">
          <ul class="topbar-list topbar-menu">
            <li><?php echo bloginfo('description'); ?></li>
          </ul>
        </div>
      </div>

      <div class="navbar navbar-default mega-menu" role="navigation">
        <div class="container">
          <div class="res-container">
            <div class="navbar-brand">
              <?php if (is_home() || is_front_page()) {
                    echo '<h1>';
                }
              ?>
              <?php if ( has_custom_logo() ): ?>
              <?php the_custom_logo(); ?>
              <?php else: ?>
              <a href="<?php echo esc_url(home_url()); ?>" rel="home">
                <span id="title-header"><?php echo bloginfo('name'); ?></span>
              </a>
              <?php endif; ?>
              <?php if (is_home() || is_front_page()) {
                  echo '</h1>';
                }
              ?>
            </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target=".navbar-responsive-collapse">
              <span class="navbar-bar"></span>
              <span><?php esc_html_e('Menu', 'dekiru');?></span>
            </button>
          </div><!-- .navbar-header -->

          <?php
            $args = array(
                'theme_location' => 'GlobalNav',
                'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                'menu_class' => 'nav navbar-nav',
                'fallback_cb' => '',
                'echo' => false,
                'walker' => new dekiru_walker(),
            );
            $gMenu = wp_nav_menu($args);
            if ($gMenu):
                $gMenu = apply_filters('dekiru_gMenu', $gMenu);
                echo wp_kses_post($gMenu);

            else:
            ?>
          <div class="collapse navbar-collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
              <?php wp_list_pages(array('title_li' => '', 'walker' => new dekiru_walker_page()));?>
            </ul>
          </div>
          <?php endif;?>

        </div><!-- .container -->
      </div><!-- .navbar .navbar-default .mega-menu -->

    </div><!-- .header -->

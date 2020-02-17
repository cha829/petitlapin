<?php
/**
 * dekiru Theme Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
function dekiru_customize_register($wp_customize)
{
    $dekiru_theme_options = get_option('dekiru_theme_options');

    /*
     * Design Settings
     */
    $wp_customize->add_section('dekiru_design', array(
        'title' => __('Design Settings', 'dekiru'),
        'priority' => 500,
    ));

    $wp_customize->add_setting('dekiru_theme_options[keyColor]', array(
        'default' => '',
        'sanitize_callback' => 'maybe_hash_hex_color',
        'capability' => 'edit_theme_options',
        'type' => 'option',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'keyColor', array(
        'label' => __('Key color', 'dekiru'),
        'section' => 'dekiru_design',
        'settings' => 'dekiru_theme_options[keyColor]',
    )
    ));

    /*
     * Slider Settings
     */
    $wp_customize->add_section('dekiru_slider', array(
        'title' => __('Slide show', 'dekiru'),
        'priority' => 600,
    ));

    $priority = 610;

    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting('dekiru_theme_options[slider' . $i . '_image]', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'capability' => 'edit_theme_options',
            'type' => 'option',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            'slider' . $i . '_image',
            array(
                'label' => __('Slide image', 'dekiru') . ' ' . $i,
                'section' => 'dekiru_slider',
                'settings' => 'dekiru_theme_options[slider' . $i . '_image]',
                'priority' => $priority,
            )
        ));
        $priority++;

        $wp_customize->add_setting('dekiru_theme_options[slider' . $i . '_link_url]', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'capability' => 'edit_theme_options',
            'type' => 'option',
        ));
        $wp_customize->add_control('slider' . $i . '_link_url', array(
            'label' => __('Link url', 'dekiru') . ' ' . $i,
            'section' => 'dekiru_slider',
            'settings' => 'dekiru_theme_options[slider' . $i . '_link_url]',
            'type' => 'text',
            'priority' => $priority,
        ));
        $priority++;

        $wp_customize->add_setting('dekiru_theme_options[slider' . $i . '_blank]', array(
            'default' => false,
            'sanitize_callback' => 'dekiru_sanitize_checkbox',
            'capability' => 'edit_theme_options',
            'type' => 'option',
        ));
        $wp_customize->add_control('slider' . $i . '_blank', array(
            'label' => __('Open in new window', 'dekiru') . ' ' . $i,
            'section' => 'dekiru_slider',
            'settings' => 'dekiru_theme_options[slider' . $i . '_blank]',
            'type' => 'checkbox',
            'priority' => $priority,
        ));
        $priority++;

        $wp_customize->add_setting('dekiru_theme_options[slider' . $i . '_caption]', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
            'capability' => 'edit_theme_options',
            'type' => 'option',
        ));
        $wp_customize->add_control('slider' . $i . '_caption', array(
            'label' => __('Caption', 'dekiru') . ' ' . $i,
            'section' => 'dekiru_slider',
            'settings' => 'dekiru_theme_options[slider' . $i . '_caption]',
            'type' => 'textarea',
            'priority' => $priority,
        ));
        $priority++;

        $wp_customize->add_setting('dekiru_theme_options[slider' . $i . '_alt]', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
            'capability' => 'edit_theme_options',
            'type' => 'option',
        ));
        $wp_customize->add_control('slider' . $i . '_alt', array(
            'label' => __('Alt Tag', 'dekiru') . ' ' . $i,
            'section' => 'dekiru_slider',
            'settings' => 'dekiru_theme_options[slider' . $i . '_alt]',
            'type' => 'text',
            'priority' => $priority,
        ));
        $priority++;

    }

}
add_action('customize_register', 'dekiru_customize_register');

function dekiru_sanitize_checkbox($input)
{
    if ($input == true) {
        return true;
    } else {
        return false;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dekiru_customize_preview_js()
{
    wp_enqueue_script('dekiru_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20130508', true);
}
add_action('customize_preview_init', 'dekiru_customize_preview_js');

function dekiru_custom_keyColor_wphead()
{
    $options = get_option('dekiru_theme_options');
    if (!empty($options['keyColor'])):
        $keyColor = esc_attr($options['keyColor']);
        $keyColorCode = preg_replace('/#/', '', $keyColor);
        $keyColorCode = hexdec(substr($keyColorCode, 0, 2)) . ',' . hexdec(substr($keyColorCode, 2, 2)) . ',' . hexdec(substr($keyColorCode, 4, 2));
        ?>
<style type="text/css">
a,
a:focus,
a:hover,
a:active,
.title-v4,
.header-v8 .dropdown-menu .active>a,
.header-v8 .dropdown-menu li>a:hover,
.header-v8 .navbar-nav .open .dropdown-menu>li>a:hover,
.header-v8 .navbar-nav .open .dropdown-menu>li>a:focus,
.header-v8 .navbar-nav .open .dropdown-menu>.active>a,
.header-v8 .navbar-nav .open .dropdown-menu>.active>a:hover,
.header-v8 .navbar-nav .open .dropdown-menu>.active>a:focus,
.header-v8 .navbar-nav .open .dropdown-menu>.disabled>a,
.header-v8 .navbar-nav .open .dropdown-menu>.disabled>a:hover,
.header-v8 .navbar-nav .open .dropdown-menu>.disabled>a:focus,
.header-v8 .navbar-nav>li>a:hover,
.breadcrumb li.active,
.breadcrumb li a:hover,
.blog-grid h3 a:hover,
.blog-grid .blog-grid-info li a:hover {
  color: <?php echo esc_attr($keyColor);
  ?>;
}

.btn-u,
.btn-u.btn-u-default,
.blog-grid-tags li a:hover {
  background-color: <?php echo esc_attr($keyColor);
  ?>;
}

.pagination li a:hover,
.pagination li .current,
.widget_tag_cloud a:hover {
  background-color: <?php echo esc_attr($keyColor);
  ?>;
  border-color: <?php echo esc_attr($keyColor);
  ?>;
}

.header-v8 .dropdown-menu {
  border-top: 3px solid <?php echo esc_attr($keyColor);
  ?>;
}

.header-v8 .navbar-nav>.active>a,
.header-v8 .navbar-nav>.active>a:hover,
.header-v8 .navbar-nav>.active>a:focus {
  color: <?php echo esc_attr($keyColor);
  ?> !important;
}

.btn-u:hover,
.btn-u:focus,
.btn-u:active,
.btn-u.active,
.btn-u.btn-u-default:hover,
.btn-u.btn-u-default:focus,
.btn-u.btn-u-default:active,
.btn-u.btn-u-default.active,
.pagination li a:hover,
.blog-grid a.r-more {
  background-color: rgba(<?php echo esc_attr($keyColorCode);
  ?>, 0.7);
}

</style>
<?php
endif;
}
add_action('wp_head', 'dekiru_custom_keyColor_wphead');

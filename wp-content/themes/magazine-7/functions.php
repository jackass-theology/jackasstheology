<?php
/**
 * Magazine 7 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Magazine 7
 */

if (!function_exists('magazine_7_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
    /**
     *
     */
    /**
     *
     */
    function magazine_7_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Magazine 7, use a find and replace
	 * to change 'magazine-7' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('magazine-7', get_template_directory().'/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

        // Add featured image sizes
        add_image_size('magazine-7-slider-full', 1536, 1020, true); // width, height, crop
        add_image_size('magazine-7-slider-center', 936, 897, true); // width, height, crop
        add_image_size('magazine-7-featured', 1024, 0, false ); // width, height, crop
        add_image_size('magazine-7-medium', 720, 380, true); // width, height, crop
        add_image_size('magazine-7-medium-square', 675, 450, true); // width, height, crop

    /*
     * Enable support for Post Formats on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array( 'image', 'video', 'gallery' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
			'aft-primary-nav' => esc_html__('Primary Menu', 'magazine-7'),
			'aft-top-nav' => esc_html__('Top Menu', 'magazine-7'),
			'aft-social-nav' => esc_html__('Social Menu', 'magazine-7'),
			'aft-footer-nav' => esc_html__('Footer Menu', 'magazine-7'),
		));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

	// Set up the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('magazine_7_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)));

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		));




}
endif;
add_action('after_setup_theme', 'magazine_7_setup');

/**
 * Demo export/import
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Magazine 7
 */
if (!function_exists('magazine_7_ocdi_files')) :
    /**
     * OCDI files.
     *
     * @since 1.0.0
     *
     * @return array Files.
     */
    function magazine_7_ocdi_files() {

         return apply_filters( 'aft_demo_import_files', array(            
            array(
		      'import_file_name'             => esc_html__( 'Magazine 7', 'magazine-7' ),   
		      'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/default/magazine-7.xml',
              'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/default/magazine-7.wie',
              'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/default/magazine-7.dat',      
		      'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/magazine-7.jpg',    
		      'preview_url'                  => 'https://demo.afthemes.com/magazine-7/',
		    ),
		    array(
		      'import_file_name'             => esc_html__( 'Magazine 7 - Restro', 'magazine-7' ),   
		      'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/restro/magazine-7.xml',
              'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/restro/magazine-7.wie',
              'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/restro/magazine-7.dat',      
		      'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/magazine-7-restro.jpg',    
		      'preview_url'                  => 'https://demo.afthemes.com/magazine-7/restro/',
		    ),
		    array(
		      'import_file_name'             => esc_html__( 'Magazine 7 - Clean Blog', 'magazine-7' ),   
		      'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/clean-blog/magazine-7.xml',
              'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/clean-blog/magazine-7.wie',
              'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/clean-blog/magazine-7.dat',      
		      'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/magazine-7-clean-blog.jpg',    
		      'preview_url'                  => 'https://demo.afthemes.com/magazine-7/clean-blog/',
		    ),
        ));
    }
endif;
add_filter( 'pt-ocdi/import_files', 'magazine_7_ocdi_files');

/**
 * function for google fonts
 */
if (!function_exists('magazine_7_fonts_url')):

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function magazine_7_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Oswald, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Oswald font: on or off', 'magazine-7')) {
            $fonts[] = 'Source+Sans+Pro:400,400i,700,700i';
        }

        /* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Montserrat font: on or off', 'magazine-7')) {
            $fonts[] = 'Montserrat:400,700';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function magazine_7_content_width() {
	$GLOBALS['content_width'] = apply_filters('magazine_7_content_width', 640);
}
add_action('after_setup_theme', 'magazine_7_content_width', 0);



/**
 * Enqueue scripts and styles.
 */
function magazine_7_scripts() {

	$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG?'':'.min';
	wp_enqueue_style('font-awesome-v5', get_template_directory_uri().'/assets/font-awesome-v5/css/fontawesome-all'.$min.'.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/bootstrap/css/bootstrap'.$min.'.css');
	wp_enqueue_style('slick', get_template_directory_uri().'/assets/slick/css/slick'.$min.'.css');
	wp_enqueue_style('sidr', get_template_directory_uri().'/assets/sidr/css/jquery.sidr.dark.css');
	wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/magnific-popup/magnific-popup.css');

    $fonts_url = magazine_7_fonts_url();

    if (!empty($fonts_url)) {
        wp_enqueue_style('magazine-7-google-fonts', $fonts_url, array(), null);
    }

    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_style('magazine-7-woocommerce-style', get_template_directory_uri() . '/assets/woocommerce.css');
    }
	wp_enqueue_style('magazine-7-style', get_stylesheet_uri());


	wp_enqueue_script('magazine-7-navigation', get_template_directory_uri().'/js/navigation.js', array(), '20151215', true);
	wp_enqueue_script('magazine-7-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array(), '20151215', true);

	wp_enqueue_script('slick', get_template_directory_uri().'/assets/slick/js/slick'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/bootstrap/js/bootstrap'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('sidr', get_template_directory_uri().'/assets/sidr/js/jquery.sidr'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('magnific-popup', get_template_directory_uri().'/assets/magnific-popup/jquery.magnific-popup'.$min.'.js', array('jquery'), '', true);

	wp_enqueue_script('matchheight', get_template_directory_uri().'/assets/jquery-match-height/jquery.matchHeight'.$min.'.js', array('jquery'), '', true);


    wp_enqueue_script('sticky-sidebar', get_template_directory_uri() . '/assets/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
	wp_enqueue_script('magazine-7-script', get_template_directory_uri().'/assets/script.js', array('jquery'), '', 1);


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'magazine_7_scripts');



/**
 * Enqueue admin scripts and styles.
 *
 * @since Magazine 7 1.0.0
 */
function magazine_7__admin_scripts($hook){
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('magazine-7-widgets', get_template_directory_uri() . '/assets/widgets.js', array('jquery'), '1.0.0', true);
    }
}
add_action('admin_enqueue_scripts', 'magazine_7__admin_scripts');



/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-images.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory().'/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory().'/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/init.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/ocdi.php';



/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory().'/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}





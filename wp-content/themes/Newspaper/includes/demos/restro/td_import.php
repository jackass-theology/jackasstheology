<?php
/**
 * Created by ra on 5/14/2015.
 */



/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/
//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');



/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');



/*  ----------------------------------------------------------------------------
    logo
 */
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
));

/*  ----------------------------------------------------------------------------
    footer text
 */


/*  ----------------------------------------------------------------------------
    socials
 */
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'googleplus' => '#',
    'instagram' => '#',
    'twitter' => '#',
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();
td_demo_misc::add_ad_image('sidebar', 'td_sidebar_ad');


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '',
        'spot_id' => 'sidebar'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_instagram_widget',
    array (
        'custom_title' => '',
        'instagram_images_per_row' => 3,
        'instagram_number_of_rows' => 3,
        'instagram_id' => 'food52'
    )
);



/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'News',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_2_id =td_demo_category::add_category(array(
    'category_name' => 'Events',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_3_id =td_demo_category::add_category(array(
    'category_name' => 'Artisans',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));


/*  ----------------------------------------------------------------------------
    pages
 */
//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//menu page
$td_menupage_id = td_demo_content::add_page(array(
    'title' => 'Menu',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/menu.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//blog page
$td_blogpage_id = td_demo_content::add_page(array(
    'title' => 'Blog',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/blog.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//about page
$td_aboutpage_id = td_demo_content::add_page(array(
    'title' => 'About',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/about.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/footer-template.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
td_util::update_option( 'tds_footer_page', $td_footertemplate_id);

/*  ----------------------------------------------------------------------------
    menu
 */

//add the homepage to the menu
td_demo_menus::add_page(array(
    'title' => 'Home',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_homepage_id,
    'parent_id' => ''
));
//add the menu page to the menu
td_demo_menus::add_page(array(
    'title' => 'Menu',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_menupage_id,
    'parent_id' => ''
));
//add the blog page to the menu
td_demo_menus::add_page(array(
    'title' => 'Blog',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_blogpage_id,
    'parent_id' => ''
));
//add the blog page to the menu
td_demo_menus::add_page(array(
    'title' => 'About',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_aboutpage_id,
    'parent_id' => ''
));


/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'Master Class With Chef Ben Chiang',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Restro ‘Restaurant of the Year’',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Congratulations Peter Gunn!',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_4'
));

//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Social Cocktail Event",
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Featured Artisan October',
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "New Year’s Eve 2017",
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Featured Artisan September",
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Featured Artisan August",
    'file' => td_global::$get_template_directory . '/includes/demos/restro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));
<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

//top menu
$td_demo_top_menu = td_demo_menus::create_menu('td-demo-top-menu', 'top-menu');
td_demo_menus::add_link(array(
    'title' => 'About',
    'add_to_menu_id' => $td_demo_top_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_top_menu,
    'url' => '#',
    'parent_id' => ''
));

//footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');
td_demo_menus::add_link(array(
    'title' => 'About',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));

// main background > keep it empty to make sure that no bg img is set
td_demo_misc::update_background('');

// mobile menu/search background
td_demo_misc::update_background_mobile('td_pic_12');

// login background
td_demo_misc::update_background_login('td_pic_5');

/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
));

//footer
//td_demo_misc::update_footer_logo(array(
//    'normal' => 'td_logo_footer',
//    'retina' => 'td_logo_footer_retina'
//));

/*  ----------------------------------------------------------------------------
    footer text
*/

td_demo_misc::update_footer_text('Newspaper is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.');


/*  ----------------------------------------------------------------------------
    socials
*/

td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'twitter' => '#',
    'instagram' => '#',
    'youtube' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();
td_demo_misc::add_ad_image('custom_ad_1', 'td_custom_ad_1');



/*  ----------------------------------------------------------------------------
    sidebars
 */
//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');

/*  ----------------------------------------------------------------------------
    Cloud Templates
*/
//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - Classy',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));

// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );


//cloud template - type single
$td_cloud_post_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Single Cloud Template - Classy',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_cloud_template.txt',
    'template_type' => 'single',
));

// set the default site wide) post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);

//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Classy',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/author_cloud_template.txt',
    'template_type' => 'author',
));

// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

/*
  / Cloud Templates
* ----------------------------------------------------------------------------
*/

/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Lifestyle',
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
        'category_name' => 'Accessories',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_3_id =td_demo_category::add_category(array(
        'category_name' => 'Art & Culture',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_4_id =td_demo_category::add_category(array(
        'category_name' => 'Entertainment',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_5_id =td_demo_category::add_category(array(
        'category_name' => 'Health',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_6_id =td_demo_category::add_category(array(
        'category_name' => 'Inspiration',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_7_id =td_demo_category::add_category(array(
        'category_name' => 'Travel',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));

$demo_cat_8_id =td_demo_category::add_category(array(
    'category_name' => 'Men we Like',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_9_id =td_demo_category::add_category(array(
    'category_name' => 'Social',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_10_id =td_demo_category::add_category(array(
    'category_name' => 'Women',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_11_id =td_demo_category::add_category(array(
    'category_name' => 'Beauty',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_12_id =td_demo_category::add_category(array(
    'category_name' => 'Celebrity',
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
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));


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


// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Lifestyle',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Women',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_10_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Men we Like',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));


// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Beauty',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_11_id,
    'parent_id' => $parent_submenu_id
));

td_demo_menus::add_category(array(
    'title' => 'Celebrity',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_12_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Social',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id,
    'parent_id' => $parent_submenu_id
));
/*  ---------------------------------------------------------------------------
    posts
*/

// posts in featured category

/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'The Most Amazing Accessories to Buy This Fall',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Stay Inspired: Top Artists Reveal How They Find Creativity',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Our Top 10 Favourite Movies',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Top 5 Ways to Stay Healthy This Summer',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'The Coolest Vanity Apps for You and Your Friends',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'The 10 Best Apps for Planning Your Next Trip',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Official Designers for the Industry Giants',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Ben Whishaw Wants More Classic Lines for Q',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Advice for Becoming a Little More Adventurous',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'H&M\'s Supermodel Campaign is the Hottest Thing We’ve Seen All Week',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => '10 Affordable Jackets and Coats for the Cold Season',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_11'
));

/* ------------------------------------------------------------------ */
// posts in one category
/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Simon Pegg Feared Tom Cruise Would Die Making Mission: Impossible - Fallout',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Ariana Grande Announces Break from Twitter',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Cate Blanchett Admired Sir Ian McKellen on The Hobbit Set',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Alexa Chung and Sofia Vergara Don\'t Play by the Red Carpet Rules',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_9'
));


/* ------------------------------------------------------------------ */


td_demo_content::add_post(array(
    'title' => '5 Travel Outfits That Are Comfortable and Chic',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'What to Wear on a First Date? We Asked the Experts!',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => '15 of the Most Popular Make Up Tips on Pinterest',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Find Out Why 18 Models Went Platinum Backstage',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_8'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Celebrating Body Empowerment with Real Women',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => '6 High-Powered Women Share Their Secrets for Success',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Relaxation Is A Must For Me',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => '9 Famous People Who Will Inspire You to Never Give Up',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_12'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'The Top 5 Biggest Filatropists in the World',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Facebook Gives Emerging Markets Free Sales Platform',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'He Speaks 11 Languages – 7 Tricks To Learn Any Language',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Why Do People Brag on Social Media?',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Hugh Grant Lands New Romantic Comedy Role',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'The Lounge Suit Dress Code: A Complete Guide',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'The Best Dressed Footballers In The World',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => '3 Outfit Ideas for Cold Days',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Get Lost in Italy and Get Ready for Adventure!',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'How to Travel in Style: Finding a Perfect Flight',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => '10 Landscapes You Won’t Have Even Imagined Exist',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Romantic Getaway: Long Weekend in Montreal',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_11'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => '15 Beauties to Follow for Inspiration',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Discover Affordable Ways to Hide Fatigue',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Social Media is Changing the Beauty Industry',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'The 5 Most Incredible Body Transformations',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'How Often Do You Need to See Your Doctor?',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Why Growing Old Is Better Than You Think',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => '5 Small Acts of Self-Care You Can Do Any Time',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => '31 Healthy Meals You Can Make in 10 Minutes',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Our 5 Favourite Celeb Power Couples',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Cult British Teen Drama Shocks',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Striking photos from around the world',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Do film awards have a woman problem?',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Tips for Creating the Perfect Art Gallery Wall',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Oil Painting Portraits by Yunior Hurtado',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'A Centuries-Old Art Form Hides Within the Gilded Pages of Antique Books',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Innovative Architecture: 10 New Buildings',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'The Hottest Modern Accessories for a Stunning Look',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'The Best Ways to Show Off your Stunning Diamond Bling',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Looking Shady: Essential Sunglasses for the Summer',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'How To Match Your Leather Hat With Your Summer Dress',
    'file' => td_global::$get_template_directory . '/includes/demos/classy/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
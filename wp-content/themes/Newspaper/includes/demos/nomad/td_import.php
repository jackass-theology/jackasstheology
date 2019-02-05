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
// main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

// categories menu
$td_demo_categories_menu_id = td_demo_menus::create_menu('td-demo-custom-menu', 'custom-menu');



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
    'mobile' => ''
));

/*  ----------------------------------------------------------------------------
    footer text
 */


/*  ----------------------------------------------------------------------------
    socials
 */


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();


/*  ----------------------------------------------------------------------------
    sidebars
 */



/*  ----------------------------------------------------------------------------
    Cloud Templates
*/
//cloud template - type single
$td_cloud_post_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Single Cloud Template - Gaming',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_cloud_template.txt',
    'template_type' => 'single',
));
$td_cloud_post_template2_id = td_demo_content::add_cloud_template(array(
    'title' => 'Single Cloud Template 2 - Gaming',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_cloud_template_2.txt',
    'template_type' => 'single',
));
// set the default site wide post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);

//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - Gaming',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));
// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );

//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Gaming',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/author_cloud_template.txt',
    'template_type' => 'author',
));
// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

//cloud template - type search
$td_cloud_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - Gaming',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/search_cloud_template.txt',
    'template_type' => 'search',
));
// set the default site wide search template
td_util::update_option( 'tdb_search_template', 'tdb_template_' . $td_cloud_search_template_id );

//cloud template - type 404
$td_cloud_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - Gaming',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/404_cloud_template.txt',
    'template_type' => '404',
));
// set the default site wide 404 template
td_util::update_option( 'tdb_404_template', 'tdb_template_' . $td_cloud_404_template_id );


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id = td_demo_category::add_category(array(
    'category_name' => 'Reviews',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_2_id = td_demo_category::add_category(array(
    'category_name' => 'Action & Adventure',
    'parent_id' => $demo_cat_1_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_3_id = td_demo_category::add_category(array(
    'category_name' => 'Racing',
    'parent_id' => $demo_cat_1_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_4_id = td_demo_category::add_category(array(
    'category_name' => 'Shooter',
    'parent_id' => $demo_cat_1_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_5_id = td_demo_category::add_category(array(
    'category_name' => 'Simulation',
    'parent_id' => $demo_cat_1_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));

$demo_cat_6_id = td_demo_category::add_category(array(
    'category_name' => 'Coming soon',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_7_id = td_demo_category::add_category(array(
    'category_name' => 'Best deals',
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
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/footer-template.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
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
td_demo_menus::add_mega_menu(array(
    'title' => 'Reviews',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
), true);
td_demo_menus::add_mega_menu(array(
    'title' => 'Coming soon',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
), true);
td_demo_menus::add_category(array(
    'title' => 'Best deals',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id,
));

//add the categories to the categories menu
td_demo_menus::add_category(array(
    'title' => 'Coming soon',
    'add_to_menu_id' => $td_demo_categories_menu_id,
    'category_id' => $demo_cat_6_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Action & Adventure',
    'add_to_menu_id' => $td_demo_categories_menu_id,
    'category_id' => $demo_cat_2_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Racing',
    'add_to_menu_id' => $td_demo_categories_menu_id,
    'category_id' => $demo_cat_3_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Shooter',
    'add_to_menu_id' => $td_demo_categories_menu_id,
    'category_id' => $demo_cat_4_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Simulation',
    'add_to_menu_id' => $td_demo_categories_menu_id,
    'category_id' => $demo_cat_5_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Best deals',
    'add_to_menu_id' => $td_demo_categories_menu_id,
    'category_id' => $demo_cat_7_id,
    'parent_id' => ''
));


/*  ---------------------------------------------------------------------------
    posts
*/
/* ------------------------------------------------------------------ */
td_demo_content::add_post(array(
    'title' => 'Lawbreakers',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'PES 2018',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'We Happy Few',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_6',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'NBA 2K17',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_5',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Dirt Rally',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Donut County',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Payday 2 Switch',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));


td_demo_content::add_post(array(
    'title' => 'The Golf Club',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Hollow Knight',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_9',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Project Cars 2',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Hitman 2',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_1',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Battlefield 5',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_5',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Far Cry 5',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Train Simulator 2018',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Giant Machines',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'The Crew 2',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Mega Man 11',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Planet Alpha',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Strange Brigade',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Forza Motorsport 7',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Alien: Isolation',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_2',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Soul Calibur VI',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_8',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Lamplight City',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));

td_demo_content::add_post(array(
    'title' => 'Wolfenstein II',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'GT Sport',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_4',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Medieval Steve',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_9',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'NBA Live 19',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1',
    'review' => 'a:4:{s:10:"has_review";s:10:"rate_stars";s:14:"p_review_stars";a:4:{i:0;a:2:{s:4:"desc";s:7:"Visuals";s:4:"rate";s:1:"5";}i:1;a:2:{s:4:"desc";s:9:"Narrative";s:4:"rate";s:3:"4.5";}i:2;a:2:{s:4:"desc";s:8:"Gameplay";s:4:"rate";s:1:"4";}i:3;a:2:{s:4:"desc";s:5:"Audio";s:4:"rate";s:1:"4";}}s:17:"p_review_percents";a:3:{i:0;a:2:{s:4:"desc";s:9:"Feature 1";s:4:"rate";s:2:"90";}i:1;a:2:{s:4:"desc";s:9:"Feature 2";s:4:"rate";s:3:"100";}i:2;a:2:{s:4:"desc";s:9:"Feature 3";s:4:"rate";s:2:"50";}}s:6:"review";s:302:"God of War takes everything good about the franchise and elevates it. Almost every aspect is polished, with a particular standout being the world itself, and the new emphasis on telling a mature and meaningful story that explores remarkably complex themes. If you have a PS4, this is a must have title.";}'
));
td_demo_content::add_post(array(
    'title' => 'Trials Fusion',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_7',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Euro Fishing',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_2',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
td_demo_content::add_post(array(
    'title' => 'Forza Horizon 4',
    'file' => td_global::$get_template_directory . '/includes/demos/gaming/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4',
    'template' => 'tdb_template_' . $td_cloud_post_template2_id
));
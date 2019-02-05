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
    'title' => 'Single Cloud Template - LivingMag',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_cloud_template.txt',
    'template_type' => 'single',
));
// set the default site wide post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);

//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - LivingMag',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));
// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );

//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - LivingMag',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/author_cloud_template.txt',
    'template_type' => 'author',
));
// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

//cloud template - type search
$td_cloud_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - LivingMag',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/search_cloud_template.txt',
    'template_type' => 'search',
));
// set the default site wide search template
td_util::update_option( 'tdb_search_template', 'tdb_template_' . $td_cloud_search_template_id );

//cloud template - type 404
$td_cloud_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - LivingMag',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/404_cloud_template.txt',
    'template_type' => '404',
));
// set the default site wide 404 template
td_util::update_option( 'tdb_404_template', 'tdb_template_' . $td_cloud_404_template_id );


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id = td_demo_category::add_category(array(
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

$demo_cat_2_id = td_demo_category::add_category(array(
    'category_name' => 'Fashion',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));

$demo_cat_3_id = td_demo_category::add_category(array(
    'category_name' => 'Life',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et fermentum mauris, ut hendrerit nisl. Suspendisse eget volutpat felis. Aliquam vitae commodo felis. Curabitur nec leo erat.',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_4_id = td_demo_category::add_category(array(
    'category_name' => 'Food & Drink',
    'parent_id' => $demo_cat_3_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_5_id = td_demo_category::add_category(array(
    'category_name' => 'Things To Do',
    'parent_id' => $demo_cat_3_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_6_id = td_demo_category::add_category(array(
    'category_name' => 'Travel',
    'parent_id' => $demo_cat_3_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));

$demo_cat_7_id = td_demo_category::add_category(array(
    'category_name' => 'Entertainment',
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
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/footer-template.txt',
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
td_demo_menus::add_category(array(
    'title' => 'News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));
// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Fashion',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_2_id
));
// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Life',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_3_id,
    //'menu-item-url' => $demo_cat_1_id,
));
td_demo_menus::add_category(array(
    'title' => 'Entertainment',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
/* ------------------------------------------------------------------ */
td_demo_content::add_post(array(
    'title' => 'Is Rihanna shooting a movie with Donald Glover?',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Chimis – could this be the best steak in London?',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Apparently THIS is the best time to apply for a new job…',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Sia and Scott Walker to score new Natalie Portman film',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Conversation with Dominik Mueller',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Forbes’ highest earning actress wasn’t even in the top ten last year',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'A handy guide to Louis Theroux’s favourite documentaries',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'How to plan a weekend getaway to Cleveland',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => '10 patriotic looks you can wear any day',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'This is what to expect when you try a vegan keto diet',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'John Carpenter announces new ‘Halloween’ soundtrack',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));


td_demo_content::add_post(array(
    'title' => 'The Outlander cast had the most hilarious response to their celebrity fan',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Yona, the shoe-fanatic New Yorker',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Is there more to life than living in a big city?',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Aldi has released their own take on Aperol',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'The Royal Family has been hiding this documentary for 50 years',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Thailand off the beaten path with Global Basecamps',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Splash house festival fashion snaps',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => '10 reasons to get into skateboarding',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'The best places to go for afternoon tea in London',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Welcome to Dalila’s world: The Osa Peninsula',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Here’s how Cher responds to Hollywood director calling her “too old”',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => '5 upcoming eyewear trends this fall',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'This is how to make your avocados last longer',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Fast and furious in the fall in Tokyo',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Why you need to know the art of celebration',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Tom Cruise reportedly in line to play Green Lantern',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'The best rooftop bars to cool off with a drink',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'How you can spend a night at the zoo',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Where to stay in Mauritius for the ultimate escape',
    'file' => td_global::$get_template_directory . '/includes/demos/living_mag/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
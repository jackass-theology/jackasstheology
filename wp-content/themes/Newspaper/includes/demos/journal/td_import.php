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
    'title' => 'Single Cloud Template - Journal',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_cloud_template.txt',
    'template_type' => 'single',
));
// set the default site wide post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);

//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - Journal',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));
// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );

//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Journal',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/author_cloud_template.txt',
    'template_type' => 'author',
));
// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

//cloud template - type search
$td_cloud_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - Journal',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/search_cloud_template.txt',
    'template_type' => 'search',
));
// set the default site wide search template
td_util::update_option( 'tdb_search_template', 'tdb_template_' . $td_cloud_search_template_id );

//cloud template - type 404
$td_cloud_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - Journal',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/404_cloud_template.txt',
    'template_type' => '404',
));
// set the default site wide 404 template
td_util::update_option( 'tdb_404_template', 'tdb_template_' . $td_cloud_404_template_id );


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id = td_demo_category::add_category(array(
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

$demo_cat_2_id = td_demo_category::add_category(array(
    'category_name' => 'Travel',
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
    'category_name' => 'Food',
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
    'category_name' => 'Photography',
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
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/footer-template.txt',
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
    'title' => 'Lifestyle',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));
// mega menu one subcateg
td_demo_menus::add_category(array(
    'title' => 'Travel',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_2_id
));
// mega menu multiple subcateg
td_demo_menus::add_category(array(
    'title' => 'Food',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_3_id,
));
td_demo_menus::add_category(array(
    'title' => 'Photography',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_4_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
/* ------------------------------------------------------------------ */
td_demo_content::add_post(array(
    'title' => 'Better Stories, Better Photographs',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Stop Comparing and Start Living',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'How to Plan Your Best Vacation',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Why I Never Want to Settle Down',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Weeknight Dinner, Solved.',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Where Would You Travel in Italy?',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'On the Street… The Fortezza, Florence',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));


td_demo_content::add_post(array(
    'title' => 'A Pretty Apartment With Rustic Touches',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'One Thing I’ll Never Travel Without Again',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Five-Ingredient Lemony Chicken',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'My Favourite Photography Books',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'How to Create a Cohesive Instagram Feed',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Banana Oat Greek Yogurt Pancakes',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Are You Daydreaming About Summer Trips?',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'More Postcards from Jodhpur',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Trader Joe’s Breakfast Hack',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'How to Overcome Perfectionism',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'An Ode To Bad Family Vacations',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'On the Street… Via Maggio, Florence',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Grab-and-Go Baked Oatmeal Cups',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Postcards from the Maasai Mara',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'A Morning Routine for Productivity',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Alex’s 10-Minute Salmon Sandwich',
    'file' => td_global::$get_template_directory . '/includes/demos/journal/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
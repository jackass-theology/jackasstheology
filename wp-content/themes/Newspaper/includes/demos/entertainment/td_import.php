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
    'mobile' => 'td_logo_mobile'
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
    'title' => 'Single Cloud Template - Entertainment',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_cloud_template.txt',
    'template_type' => 'single',
));
// set the default site wide post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);

//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - Entertainment',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));
// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );

//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Entertainment',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/author_cloud_template.txt',
    'template_type' => 'author',
));
// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

//cloud template - type search
$td_cloud_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - Entertainment',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/search_cloud_template.txt',
    'template_type' => 'search',
));
// set the default site wide search template
td_util::update_option( 'tdb_search_template', 'tdb_template_' . $td_cloud_search_template_id );

//cloud template - type 404
$td_cloud_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - Entertainment',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/404_cloud_template.txt',
    'template_type' => '404',
));
// set the default site wide 404 template
td_util::update_option( 'tdb_404_template', 'tdb_template_' . $td_cloud_404_template_id );


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id = td_demo_category::add_category(array(
    'category_name' => 'Movies',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => 'Cras pharetra in lectus sed pretium. Aliquam at magna auctor, condimentum ipsum vitae, sagittis augue. Etiam eu viverra magna. Integer ut nunc ut eros dictum placerat vel sed nunc.',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_2_id = td_demo_category::add_category(array(
    'category_name' => 'Box Office',
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
    'category_name' => 'Interviews',
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
    'category_name' => 'Movie News',
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
    'category_name' => 'Movie Trailers',
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
    'category_name' => 'TV Shows',
    'parent_id' => $demo_cat_1_id,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));

$demo_cat_7_id = td_demo_category::add_category(array(
    'category_name' => 'Games',
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
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/footer-template.txt',
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
// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Movies',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id,
    //'menu-item-url' => $demo_cat_1_id,
));

td_demo_menus::add_category(array(
    'title' => 'TV Shows',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));
td_demo_menus::add_category(array(
    'title' => 'Games',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
/* ------------------------------------------------------------------ */
td_demo_content::add_post(array(
    'title' => 'Google May Be Working On A Game Streaming Service',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Metallica’s James Hetfield Just Joined The Ted Bundy Movie',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'How Black Panther’s Cast Feels About The Wakanda Border Debate',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Twitch Has Instituted A Dress Code For Streamers',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'How Much Black Panther Could Make During Opening Weekend',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Why James Mangold Hates When Logan Is Called High-Octane',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Sea Of Thieves May Be Getting An Open Beta Before Release',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'The Sweet Way Will & Grace Honored The Late Debbie Reynolds',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Star Wars Just Opened In China And Lost At The Box Office',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'James Bond Should Stay A Dude, Says Rachel Weisz',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'The Surprising Company That May Be Behind Metroid Prime 4',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));


td_demo_content::add_post(array(
    'title' => 'Tobin Bell Names His Three Favorite Traps From The Saw Franchise',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Coco Just Opened And Already Has Set A Box-Office Record',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'The Ocean’s 8 Trailer Finally Explains The Heist',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'How Disneyland’s New Parade Could Hint At Incredibles 2',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Two Six Feet Under Actors Who’d Like The Show To Come Back',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'DC’s Titans TV Show Will Feature Another Superhero Team',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Murder On The Orient Express Is Sneakily Making A Lot Of Money',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'The New Red Sparrow Trailer Is Brutal, But Thrilling',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'The Five Nights At Freddy’s Movie Is Moving Forward',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Punisher Season 2 Characters May Hint At An Iconic Comic Story',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Why Elizabeth Debicki Wants To Protect Cloverfield 3’s Secrets',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'How Much Jumanji: Welcome To The Jungle Made On Opening Night',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'The Obi-Wan Movie Looks To Be Taking A Step Forward',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'The Firefly Universe Is Officially Expanding Once Again',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'New Tomb Raider Trailer Gives Us Our Best Look At The Movie',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'What You Can Play For Free This Weekend On Steam',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'The Cloverfield Paradox Trailer Is Shocking And Awesome',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'The Super Bowl Dundee Trailer Is A Really Funny Surprise',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Will Carl’s Story Change The Walking Dead Comics At All?',
    'file' => td_global::$get_template_directory . '/includes/demos/entertainment/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
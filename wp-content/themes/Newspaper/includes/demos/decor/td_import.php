<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

// main background > keep it empty to make sure that no bg img is set
td_demo_misc::update_background('');

// mobile menu/search background
td_demo_misc::update_background_mobile('td_pic_1');

// login background
td_demo_misc::update_background_login('td_pic_1');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
));


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
    'title' => 'Category Cloud Template - Racing Mag',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));

// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );


//cloud template - type single
$td_cloud_post_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Single Cloud Template - Racing Mag',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_cloud_template.txt',
    'template_type' => 'single',
));

// set the default (site wide) post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);


//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Racing Mag',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/author_cloud_template.txt',
    'template_type' => 'author',
));

// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

//cloud template - type 404 - global
$td_cloud_global_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - Racing Mag',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/404_cloud_template.txt',
    'template_type' => '404',
));

// set - the default (global) cloud 404 template
td_demo_misc::update_global_404_template( 'tdb_template_' . $td_cloud_global_404_template_id );

//cloud template - type search - global
$td_cloud_global_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - Racing Mag',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/search_cloud_template.txt',
    'template_type' => 'search',
));

// set - the default (global) search template
td_demo_misc::update_global_search_template( 'tdb_template_' . $td_cloud_global_search_template_id );


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Motorsport',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
    $demo_cat_2_id =td_demo_category::add_category(array(
        'category_name' => 'Drag',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_3_id =td_demo_category::add_category(array(
        'category_name' => 'Formula 1',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_4_id =td_demo_category::add_category(array(
        'category_name' => 'Moto GP',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_5_id =td_demo_category::add_category(array(
        'category_name' => 'Motocross',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_6_id =td_demo_category::add_category(array(
        'category_name' => 'Rally',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
$demo_cat_7_id =td_demo_category::add_category(array(
    'category_name' => 'Horse',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_8_id =td_demo_category::add_category(array(
    'category_name' => 'Dog',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_9_id =td_demo_category::add_category(array(
    'category_name' => 'Boat',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_10_id =td_demo_category::add_category(array(
    'category_name' => 'Cycling',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
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
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));

//footer page
$td_footerpage_id = td_demo_content::add_page(array(
    'title' => 'Footer',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/footer.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

td_util::update_option( 'tds_footer_page', $td_footerpage_id);


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
    'title' => 'Motorsport',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Horse',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));
td_demo_menus::add_mega_menu(array(
    'title' => 'Dog',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));
td_demo_menus::add_mega_menu(array(
    'title' => 'Boat',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id
));
td_demo_menus::add_mega_menu(array(
    'title' => 'Cycling',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_10_id
));



/*  ---------------------------------------------------------------------------
    posts
*/
// posts in featured category

/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'Ferrari goes conservative with Abu Dhabi race tyre choice',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'R-Sport Team: Sebastien Ogier title priority over teams’ crown',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Jody’s true story of saddleback’s suicide mountain race',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Bradl to continue as Crutchlow’s stand-in in Valencia finale',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'LaFerrari, McLaren P1, and Porsche 918 fired up on racing strip',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Justify takes home 13th ever Triple Crown – in an unique way',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Thousands of Florida greyhounds will need homes after ban',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'London riverside perfect for watching this year’s Boat Race',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'They can have my power meter, it won’t change the race',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */
// posts in one category
/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'How to cycle in the wind: pro tips to help keep you upright',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Two time trials and nine possible summit finishes this year',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Vincent Thompson would consider future team-up with Barr',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Best seven things that can happen on a summer club ride',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_1'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'These young pilots must learn respect or they’ll squander their career',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Hamilton faced “imminent” engine failure in Brazil stage',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'McLaren will create “whole separate team” for Indy 500',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Vettel gets reprimand, heavy fine for weighbridge offence',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Meeke splits with co-driver just ahead of his second WRC return',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Neuville feels confident he still has upper hand in title fight',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Citroen could revive the third car for Loeb/Breen winning couple',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Mati Latvala fights and takes slender Rally Spain lead this weekend',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Are you ready? Complete recap of the motocross action shootout',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Rumors, gossip and unfounded truths: every motocross weekend story',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'The 26 Min Season Review by Mike Mayers and Jon Smith is now online!',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'KTM Marchetti signs with Larranaga and Zanotti for the next season',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_3'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'MotoGP signs Spanish TV deal with streaming service included',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Rabat hits the track ahead of Valencia race, attempting a win',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Analysis: Can Valentino Rossi end his winless streak at Sepang?',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Take a look at the Australian MotoGP qualifying as it happened',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Records tumble in Mount Barbados Race: We are delighted',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'CQS have taken the decision to retire from the Caribbean race',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Boat race athletes make time to compete the Rowing Team trials',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Carribeans reclaim their title after seeing off team Jamaica',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Scott Palmer pursues playoff victories after a pretty weak season',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Announcer and race descriptions confusing spectators and pilots',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'FIA/FIM-E Euro Finals starting at Santa Pod Raceway, England',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Last tour of duty for ‘the Sarge’ ends this Sunday, on Veterans Day',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Is favourite status at the horse racing a poisoned chalice?',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Tough, rough, courageous – the Mongol Derby starts this weekend',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'The unconquerable, invincible, unbeatable race horse is here',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Newmarket, a town that is all about horses and horse racing',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'The scene is set for the biggest race at Melbourne Cup heats',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Poco maintains her perfect Wenty record as she wins again today',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Closure of Tamworth track for remediation works is scheduled',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Gone to the dogs: how time has run out for greyhound racing',
    'file' => td_global::$get_template_directory . '/includes/demos/racing/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
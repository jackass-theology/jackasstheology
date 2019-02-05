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


//footer
td_demo_misc::update_footer_logo(array(
    'normal' => 'td_logo_footer',
    'retina' => 'td_logo_footer_retina'
));

/*  ----------------------------------------------------------------------------
    footer text
 */
td_demo_misc::update_footer_text('Newspaper is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.');


/*  ----------------------------------------------------------------------------
    socials
 */
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'instagram' => '#',
    'grooveshark' => '#',
    'twitter' => '#',
    'soundcloud' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();
td_demo_misc::add_ad_image('header', 'td_header_ad');
td_demo_misc::add_ad_image('sidebar', 'td_sidebar_ad');


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '',
        'spot_id' => 'sidebar'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Popular articles',
        'limit' => '5',
        'header_color' => ''
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_instagram_widget',
    array (
        'custom_title'  => "",
        'instagram_id'  => "music",
        'instagram_number_of_rows' => 3,
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
        'category_name' => 'Rock',
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
        'category_name' => 'EDM',
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
        'category_name' => 'Rap',
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
        'category_name' => 'Classical',
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
$demo_cat_7_id =td_demo_category::add_category(array(
    'category_name' => 'Photos',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_8_id =td_demo_category::add_category(array(
    'category_name' => 'Videos',
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
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php
    'td_layout' => '10',
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
    'title' => 'News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));


// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Events',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));

// add a category to the menu
td_demo_menus::add_category(array(
    'title' => 'Photos',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));

// add a category to the menu
td_demo_menus::add_category(array(
    'title' => 'Videos',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'Lost Fanny Mendelssohn Work Performed',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'KISS Star Peter Criss Explains Why He Is Retiring',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'No Plug Says He Misses Bankroll Fresh',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Champagne Drip Drops Second Single Of The Year',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Watch Future Islands Rate Keanu Reeves',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'PWR BTTM At The Garage In London',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));


//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Young Thug's New Album, Produced by Drake",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => 'Madonna Calls Biopic "Lies and Exploitation"',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => 'Radiohead "OK Computer" Anniversary Speculation',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => "An Exit Interview with Chairlift",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => "Are Music Festival Lineups Getting Worse?",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10',
    'template' => ''
));



//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Royal Blood Announce A Quartet Of Intimate UK Shows",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Woman Breaks Into Drake\'s Home & Steals Beverages',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Sound Radar Music Festival Paris",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "The 10 Best Britpop Albums",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Zedd Releases Official Video for \"Stay\"",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "BBC Music Announces Ten Pieces III",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Dua Lipa At Shepherd’s Bush Empire In London',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Judas Priest Launch Leather Jacket Art Exhibition",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Freddie Gibbs & Logic Settle Issues With Love Of Fine Art",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Shaky Knees Music Festival",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Explore Radiohead's Music Video for \"Karma Police\"",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Spotify Dominating RBYN Releases "Out Of The Dark"',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "LSO Announce Plans For Sir Simon’s Return",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Radiohead At KeyArena In Seattle",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Jimmy Fallon Tributes David Bowie On SNL",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Hip Hop Single Sales: Kendrick Lamar Debuts At #1",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'New Orleans Jazz & Heritage Festival',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "The Year in Over/Under 2016",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "A Day Out With Amber Arcades",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Lost Work By Stravinsky Restored",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Skott At The Mercury Lounge In NYC",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Def Leppard TV Special Preview Goes Online',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Phantogram Says New Big Grams Project With Big Boi On The Way",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Sound Radar Music Festival Chicago",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "The $5 Million Mansion Martin Garrix Stayed At",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => 'Music Hubs Receive £300 Million Boost',
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Nine Inch Nails Remix Todd Rundrgen's 'Deaf Ears'",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Big Sean's \"Bounce Back\" Certified Double Platinum",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Rita Ora Teases New Song With Marshmello",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Monster Energy Fort Rock",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_2'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Yo-Yo Ma And The Music Of Strangers",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "We Sat With Seven Lions Before Life In Color",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Watch Moderat Perform \"Bad Kingdom\" Live",
    'file' => td_global::$get_template_directory . '/includes/demos/sound_radar/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));
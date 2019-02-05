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


// mobile bg
td_demo_misc::update_background_mobile('td_pic_2');

// login bg
td_demo_misc::update_background_login('td_pic_4');

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
    'instagram' => '#',
    'twitter' => '#',
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

//footer 1 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::add_widget_to_sidebar('footer-1', 'td_block_popular_categories_widget',
    array (
        'custom_title'  => "Popular Topics",
        'limit' => 6,
    )
);

//footer 2 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::add_widget_to_sidebar('footer-2', 'td_block_21_widget',
    array (
        'custom_title'  => "Popular photos",
        'limit' => 6,
        'sort' => 'featured',
    )
);

//footer 3 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-3');
td_demo_widgets::add_widget_to_sidebar('footer-3', 'td_block_social_counter_widget',
    array (
        'custom_title'  => "Follow me",
        'facebook' => "TagDiv",
        'twitter' => "tagDivOfficial",
        'youtube' => "tagdiv",
        'instagram' => "nikon_photography_",
    )
);



/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Topics',
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
        'category_name' => 'Nature',
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
        'category_name' => 'Urban',
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
        'category_name' => 'Animals',
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
        'category_name' => 'People',
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
    'category_name' => 'Photo Of The Day',
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
    'category_name' => 'Behind The Scenes',
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
    'category_name' => 'Gear',
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
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'limit' => 9,
    'sidebar_position' => 'no_sidebar',
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
    'title' => 'Topics',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));


// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Photo Of The Day',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));


// mega menu one subcateg
td_demo_menus::add_category(array(
    'title' => 'Behind The Scenes',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));

// add a category to the menu
td_demo_menus::add_category(array(
    'title' => 'Gear',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'Crossing the Lines',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'High-Rise and Shine',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Western Spirit',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'A Flash In The Distance',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Comparing Black and White Films',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'Truth Behind Online Photos',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));


//  ----------------------------------------------------------------------------




//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "The City of Glass",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Social Climber',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Maneuvers in the Dark",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Nikon Announces New Nikon F3",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Rolling Green",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Friends in High Places",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Miniature Photography',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "The Porticoes of Bologna",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Spring Housekeeping",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Lost in Thought",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "47 Minutes on the History of Fujifilm",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Vermilion Lakes Sunrise',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Balancing Act",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Wedding Photography",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Urban Rebirth in South Africa",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Underwater Wonderland",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Eyes on the Pride',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "50mm vs 85mm Lenses And How to Choose",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "The Big Picture",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "The Devil's Gold",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "\"Perfect\" Instagram Photos",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Beijing in One Building',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Under the Sun",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Cloak Of Color",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "The Awakening",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => 'Just Married',
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "How to Live in a Shoebox",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Against the Wind",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Native Stand",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Calling All Hands",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_2'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "A Vision in Green",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "The Dancer",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Sunny Pool Days",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Absolute Best Budget Lenses",
    'file' => td_global::$get_template_directory . '/includes/demos/photography/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));
<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/


/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');
// mobile background
td_demo_misc::update_background_mobile('td_pic_1');

// login background
td_demo_misc::update_background_login('td_pic_1');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
    'mobile' => 'td_logo_mobile'
));

//footer
td_demo_misc::update_footer_logo(array(
    'normal' => 'td_logo_footer'
));

/*  ----------------------------------------------------------------------------
    footer text
*/
td_demo_misc::update_footer_text('Newspaper is your news, entertainment, music & fashion website. We provide you with the latest news and videos straight from the entertainment industry.');


/*  ----------------------------------------------------------------------------
    socials
*/
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'googleplus' => '#',
    'vimeo' => '#',
    'vk' => '#'
));

/*  ----------------------------------------------------------------------------
    sidebars
 */
//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'custom_title' => 'Most popular',
        'sort' => '',
        'limit' => '3'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_9_widget',
    array (
        'custom_title' => 'Recent posts'
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Art & Photography',
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
    'category_name' => 'Retro Games',
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
$demo_cat_4_id =td_demo_category::add_category(array(
    'category_name' => 'Retro music',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_5_id =td_demo_category::add_category(array(
    'category_name' => 'Gifts',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_6_id =td_demo_category::add_category(array(
    'category_name' => 'Funhouse',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));


// add pages
$td_homepage_page = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => true
));



// top menu
$td_demo_top_menu_id = td_demo_menus::create_menu('td-demo-top-menu', 'top-menu');
td_demo_menus::add_link(array(
    'title' => 'Blog',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Videos',
    'category_id' => $demo_cat_3_id,
    'add_to_menu_id' => $td_demo_top_menu_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Gifts',
    'category_id' => $demo_cat_5_id,
    'add_to_menu_id' => $td_demo_top_menu_id,
    'parent_id' => ''
));

// footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');
td_demo_menus::add_link(array(
    'title' => 'Blog',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Videos',
    'category_id' => $demo_cat_3_id,
    'add_to_menu_id' => $td_demo_footer_menu,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Gifts',
    'category_id' => $demo_cat_5_id,
    'add_to_menu_id' => $td_demo_footer_menu,
    'parent_id' => ''
));

// main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');
td_demo_menus::add_page(array(
    'title' => 'News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_homepage_page,
    'parent_id' => ''
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
	'title' => 'Retro games',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_2_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Music',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_4_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Videos',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_3_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Funhouse',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));

// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Gifts',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_5_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Art & Photography',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Retro Games',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_2_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Retro music',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_4_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Videos',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_3_id,
    'parent_id' => $parent_submenu_id
));

/*  ---------------------------------------------------------------------------
    posts
*/
/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'Multi-level Parking Building Proposed for Queenstown\'s Skyline',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Rhinoceros, a Auccessful Conservation Story in India',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => '5 Old Seattle Buildings Now Housing Cool Art Spaces',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Six of the Best Gadgets for Cats: Goodbye Analogue Mog',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Could Buildings of the Future be Suspended from the Sky',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'The Goat Race Along Clay Street',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
// -----------------------------------------

td_demo_content::add_post(array(
    'title' => 'Get Your Retro Game On With the NES Classic Using Nintendo',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Retro Game a Blast From the Past',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'Snake Pass review a Rare Kind of Platfomer',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Legend of Zelda Arcade Game Gets a Sophisticated Twist',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Atari 2600, SNES, Game Boy Color and Sega Mega Drive',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'Retro Wooden Bow and Arrow 3 Security Arrow',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Retro Mugs in Collectible Mugs from 1970 to Present Day',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Retro Sweets and Gifts - Britain\'s Best Sweet Shop',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'Whiskey Flask Retro Red Car Gift for Dad Husband',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Wine Bottle Holders Store Your Most Prehistoric Aged Wine',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'roject Hero Land Rover Has An Emergency Drone',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Why Is the Girl With the Blue Green Hair Walking Around',
    'file' => td_global::$get_template_directory . '/includes/demos/retro/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));

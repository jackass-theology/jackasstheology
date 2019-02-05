<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

//footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');


/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */

// mobile background
td_demo_misc::update_background_mobile('td_pic_4');

// footer background
td_demo_misc::update_background_footer('td_footer_background_image');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
    'mobile' => 'td_logo_footer'
));

//footer
td_demo_misc::update_footer_logo(array(
    'normal' => 'td_logo_footer',
    'retina' => 'td_logo_footer_retina'
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
    'twitter' => '#',
    'instagram' => '#',
    'vimeo' => '#',
    'youtube' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();
td_demo_misc::add_ad_image('sidebar', 'td_blog_architecture_sidebar_ad');
td_demo_misc::add_ad_image('custom_ad_1', 'td_blog_architecture_content_ad');


/*  ----------------------------------------------------------------------------
    sidebars
 */
//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_social_counter_widget',
    array (
        'custom_title'  => "",
        'facebook'      => "tagDiv",
        'instagram'     => "tagDiv",
        'googleplus'    => "+tagdivThemes",
        'youtube'       => "tagDiv",
        'twitter'       => "tagDivOfficial",
        'soundcloud'    => "envato",
        'style'         => "style7 td-social-boxed"
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '- Advertisement -',
        'spot_id' => 'sidebar'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_9_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'RECENT POSTS',
        'limit' => '5',
        'header_color' => '',
        'ajax_pagination' => "next_prev"
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_3_widget',
    array (
        'sort' => '',
        'custom_title' => 'MOST POPULAR ARTICLES',
        'limit' => '5',
        'header_color' => '',
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_15_widget',
    array (
        'sort' => '',
        'custom_title' => 'TRENDING NOW',
        'limit' => '6',
        'header_color' => '',
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Design Tips',
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
        'category_name' => 'Bathroom',
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
        'category_name' => 'Kitchen',
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
        'category_name' => 'Living Room',
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
        'category_name' => 'Office',
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
        'category_name' => 'Terrace & Garden',
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
    'category_name' => 'Dream Houses',
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
    'category_name' => 'Highlights',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    'tdc_category_td_grid_style' => '2'
));
$demo_cat_9_id =td_demo_category::add_category(array(
    'category_name' => 'Innovative Designs',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    'tdc_category_td_grid_style' => ''
));
$demo_cat_10_id =td_demo_category::add_category(array(
    'category_name' => 'Top Stories',
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
    'category_name' => 'Celebrity Style',
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
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '1',
    'sidebar_position' => 'no_sidebar',
    'homepage' => true,
    'limit' => '12'
));

//about
$td_aboutpage_id = td_demo_content::add_page(array(
    'title' => 'About Us',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/about.txt',
    'template' => 'page-pagebuilder-title.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//contact
$td_contactpage_id = td_demo_content::add_page(array(
    'title' => 'Contact',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/contact.txt',
    'template' => 'page-pagebuilder-title.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

/*  ----------------------------------------------------------------------------
    menus
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
    'title' => 'Design Tips',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
	'title' => 'Dream Houses',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_7_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Innovative Designs',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id
));

// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Celebrity Style',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_11_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Highlights',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_10_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Top Stories',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_11_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_page(array(
    'title' => 'About Us',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_aboutpage_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_contactpage_id,
    'parent_id' => $parent_submenu_id
));

td_demo_menus::add_page(array(
    'title' => 'About Us',
    'add_to_menu_id' => $td_demo_footer_menu,
    'page_id' => $td_aboutpage_id,
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_footer_menu,
    'page_id' => $td_contactpage_id,
    'parent_id' => ''
));

/*  ---------------------------------------------------------------------------
    posts
*/

/* ------------------------------------------------------------------ */
// posts in multiple categories Highlights + Innovative Designs

td_demo_content::add_post(array(
    'title' => 'Designing a Bulletproof-Glass Wall for the Eiffel Tower',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Multi-Level Family Home in El Paso Mountains',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Striking Airline Terminals That Inspire Travel',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Floating Architecture is Making Waves',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Spectacular Green Roofs Around the World',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Desert Home Built from Volcanic Stone. Contrasts with White Stucco in Texas',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Studio Libeskind Unveils a Twisting, Tree-Covered Skyscraper for Toulouse',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Denmark to Get Its First Purpose-built Architecture School this Year',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'MIT Named World\'s Top Architecture School for Third Year in a Row',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Dubai Frame Nears Completion Despite Claims of Copyright Breach',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_10'
));

/* ------------------------------------------------------------------ */
// posts in one category

td_demo_content::add_post(array(
    'title' => '45 Outdoor Kitchen and Patio Design Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'The Hottest Kitchen Trends for 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Country Kitchens with Delicate Colors',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Breakfast Bar Ideas for the Social Kitchen',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_4'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Exquisite Contemporary Bathroom Vanities',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Interior Bathroom Design Photos for Inspiration',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Spectacular Sauna Designs for Your Home',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'How to Light Your Bathroom Right',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Modern Living Room Wall Units With Storage Inspiration',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Affordable Ways to Update the Look of a Living Room',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Comfort and Variation are the Key in Contemporary Design',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Timeless Allure: Cozy and Creative Rustic Living Rooms',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'A Simple Guide to Modernising Your Office',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Smart Workspaces and Office Decor Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Top 20 Most Awesome Company Offices',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Best Home Office Interiors in 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_12'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Think Green: 20 Vertical Garden Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Porch Ideas To Set Outdoor Space for Summer',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'The 5 Biggest Garden Trends of 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Best Designs for Urban Gardening',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Ellie Goulding\'s Living Room Is All About Texture',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Step Inside Ellen\'s Sprawling Santa Barbara Villa',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Tommy Hilfiger\'s Florida Mansion Is The Funkiest Home Ever Seen',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Drake\'s Mansion in Toronto Is Captured by Drone Video',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_12'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Multi-Level Family Home in El Paso Mountains',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Striking Airline Terminals That Inspire Travel',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Floating Architecture is Making Waves',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Spectacular Green Roofs Around the World',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'A Bulletproof-Glass Wall for the Eiffel Tower',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_10'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Architectural Details: The Perfect Prefabricated Home',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Japanese House in a Forest Landscape with Views of Trees and Sky',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Landscape Architecture Is Experiencing a New Golden Age',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Examining the Architectural Impact of Indonesian Volcanic Geography',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_2'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Classic Farmhouse Aesthetics Meet Modern Refinement',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Take a Peak at this Outstanding Swedish Villa House with Modern Garden at Night Time',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id,get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Amazing Mountain Chalet Overlooking The Alps',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Rustic Mountain Home In A Breathtaking Landscape',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id,get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_8'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Desert Home Built from Volcanic Stone. Contrasts with White Stucco in Texas',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Studio Libeskind Unveils a Twisting, Tree-Covered Skyscraper for Toulouse',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Denmark to Get Its First Purpose-built Architecture School this Year',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'MIT Named World\'s Top Architecture School for Third Year in a Row',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_architecture/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));
<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//top menu
$td_demo_top_menu_id = td_demo_menus::create_menu('td-demo-top-menu', 'top-menu');

//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

//footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');


/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */

// mobile background
td_demo_misc::update_background_mobile('td_footer_background_image');

// footer background
td_demo_misc::update_background_footer('td_footer_background_image');

// login background
td_demo_misc::update_background_login('td_footer_background_image');


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

td_demo_misc::update_footer_text('Newspaper is your news, entertainment, music & fashion website. We provide you with the latest news and videos straight from the entertainment industry.');


/*  ----------------------------------------------------------------------------
    socials
*/

td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'linkedin' => '#',
    'twitter' => '#',
    'yahoo' => '#',
    'rss' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();
td_demo_misc::add_ad_image('sidebar', 'td_business_sidebar_ad');
td_demo_misc::add_ad_image('header', 'td_business_header_ad');


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
        'spot_title' => '- Advertisement -',
        'spot_id' => 'sidebar'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_social_counter_widget',
    array (
        'custom_title'  => "Get in touch",
        'twitter'       => "tagDivofficial",
        'instagram'     => "tagDiv",
        'googleplus'    => "+tagdivThemes",
        'style'         => "style8 td-social-boxed td-social-font-icons"
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_9_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Recent Posts',
        'ajax_pagination' => "next_prev"
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_21_widget',
    array (
        'custom_title' => 'Most Popular',
    )
);

td_demo_widgets::add_widget_to_sidebar('footer-2', 'td_block_7_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Most Viewed',
        'limit' => '3'
    )
);

td_demo_widgets::add_widget_to_sidebar('footer-3', 'td_block_10_widget',
    array (
        'custom_title' => 'Trending Now',
        'limit' => '3'
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id = td_demo_category::add_category(array(
    'category_name' => 'Top Global News',
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
        'category_name' => 'Technology',
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
        'category_name' => 'Industries',
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
        'category_name' => 'Markets',
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
        'category_name' => 'Automotive',
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
        'category_name' => 'Healthcare',
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
    'category_name' => 'Entrepreneurs',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_8_id = td_demo_category::add_category(array(
    'category_name' => 'Retail',
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
$demo_cat_9_id = td_demo_category::add_category(array(
    'category_name' => 'Real Estate',
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
$demo_cat_10_id = td_demo_category::add_category(array(
    'category_name' => 'Eurozone',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_11_id = td_demo_category::add_category(array(
    'category_name' => 'Investments',
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
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '1',
    'sidebar_position' => 'no_sidebar',
    'homepage' => true,
    'limit' => '12'
));

//contact
$td_contactpage_id = td_demo_content::add_page(array(
    'title' => 'Contact',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/contact.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

/*  ----------------------------------------------------------------------------
    menus
 */

//main header menu
//add the homepage to the menu
td_demo_menus::add_page(array(
    'title' => '<i class="td-icon-home"></i>',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_homepage_id,
    'parent_id' => ''
));

// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Top Global News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
	'title' => 'Eurozones',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_10_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Investments',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_11_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Markets',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_4_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Real Estate',
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
    'title' => 'Retail',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Entrepreneurs',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Automotive',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_5_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Healthcare',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Industries',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_3_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Technology',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_2_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_contactpage_id,
    'parent_id' => $parent_submenu_id
));

//footer menu
td_demo_menus::add_link(array(
    'title' => 'About Us',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_footer_menu,
    'page_id' => $td_contactpage_id,
    'parent_id' => ''
));

//top menu
td_demo_menus::add_category(array(
    'title' => 'Technology',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'category_id' => $demo_cat_2_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Automotive',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'category_id' => $demo_cat_5_id,
    'parent_id' => ''
));
td_demo_menus::add_category(array(
    'title' => 'Markets',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'category_id' => $demo_cat_4_id,
    'parent_id' => ''
));

/*  ---------------------------------------------------------------------------
    posts
*/
// posts in featured category

td_demo_content::add_post(array(
    'title' => 'Brexit would Trigger \'Economic and Financial Shock\' to UK',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Vancouver\'s Real Estate Market could Crash Thanks to China',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Mercedes Will Retain Global Luxury Sales Crown In Years To Come',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Oil Extends Gain as Stocks Struggle; Pound Climbs: Markets Wrap',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'London Stock Exchange and Deutsche B�rse Merger Blocked by EU',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'EU Recommends Suspending Hundreds of Drugs Tested by Indian Firm',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Invest in a Cleaner Environment to Make the Market Booming',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_10'
));


/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'Sony PS4 Sales Top 35 Million after Holiday Boost',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Dollar Weakens Against Yen Following Another North Korean Missile Test',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'US Raises Medicare Payments to Insurers by 45 percent in 2018',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_15'
));

td_demo_content::add_post(array(
    'title' => 'How BlackBerry Stays Relevant in the Age of the iPhone',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Samsung Profit Set to Hit a high Thanks to Chips',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'London Stock Exchange and Deutsche B�rse Merger Blocked by EU',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'BP\'s Sale of Key Pipeline to Billionaire is Bad for UK',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Your New-Construction Home Should Come With A Warranty',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_13'
));

td_demo_content::add_post(array(
    'title' => 'Europe\'s New Car Sales Speed to Record High in Last Years',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Foreign Investors are Piling into the US Commercial Real Estate',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_10_id,$demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */
// posts in one category

td_demo_content::add_post(array(
    'title' => 'Samsung Profit Set to Hit a high Thanks to Chips',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Facebook\'s Whatsapp Is Getting Into Digital Payments',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_14'
));

td_demo_content::add_post(array(
    'title' => 'How BlackBerry Stays Relevant in the Age of the iPhone',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Sony PS4 Sales Top 35 Million after Holiday Boost',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Apple\'s Gained 50% of Smartwatch Market: Research',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_18'
));

td_demo_content::add_post(array(
    'title' => 'The PC Market has had its Worst Year Ever',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_13'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'ExxonMobil, Qatar Petroleum Sign Drilling Deal With Cyprus',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_17'
));

td_demo_content::add_post(array(
    'title' => 'The Oil And Gas Situation: The Rigs Just Keep On Coming',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'European Stocks End With Gains as Miners, Oil Giants Rally',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'PetroChina Suffers Worst Year Posting Lowest-Ever Profit',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'BP\'s Sale of Key Pipeline to Billionaire is Bad for UK',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_3'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Dollar Weakens Against Yen Following Another North Korean Missile Test',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Oil Extends Gain as Stocks Struggle; Pound Climbs: Markets Wrap',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'The Oil Market is Finally Starting to Make Sense as Prices Lower',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'JPMorgan is Targeting Silicon Valley Tech Talents and Technology Firms',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'London Stock Exchange and Deutsche B�rse Merger Blocked by EU',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Volkswagen Reveals Record Car Sales Amid Emissions Scandal',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Toyota to Invest �240m in a United Kingdom Plant at Burnaston',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_15'
));

td_demo_content::add_post(array(
    'title' => 'Europe\'s New Car Sales Speed to Record High in Last Years',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Mercedes Will Retain Global Luxury Sales Crown In Years To Come',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Peugeot Owner PSA very Close to Deal to Buy Vauxhall and Opel',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_17'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Hospital Shares Bounce as Obamacare Replacement Opposition Grows',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'EU Recommends Suspending Hundreds of Drugs Tested by Indian Firm',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'US Raises Medicare Payments to Insurers by 45 percent in 2018',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_15'
));

td_demo_content::add_post(array(
    'title' => 'California Could Become The Cannabis Industry\'s Safe Haven',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_16'
));

td_demo_content::add_post(array(
    'title' => 'The Huge Impact of Health Care Reform Might Have on Drug Pricing',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'UK Investment Funds Suffered �5.7bn Outflows after Brexit Vote on June',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Invest in a Cleaner Environment to Make the Market Booming',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Volkswagen is Investing $2 billion to Push into Electric Vehicles',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Boeing and JetBlue Invested in a Electric-Jet to Revolutionize Air Travel',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_17'
));

td_demo_content::add_post(array(
    'title' => 'Tesla is Investing Millions in its Giant Gigafactory and Hiring Hundreds',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_3'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Foreign Investors are Piling into the US Commercial Real Estate',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Vancouver\'s Real Estate Market could Crash Thanks to China',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'The \'Frenzy\' for Manhattan Commercial Real Estate is Over',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'The Oil Crash is Crushing the UAE\'s Real Estate Market',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Your New-Construction Home Should Come With A Warranty',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_13'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'European Markets Close Lower as Oil Slides Again',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Bank Closures Taking their Toll on Businesses Across Greece',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'Brexit would Trigger \'Economic and Financial Shock\' to UK',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Eurozone Inflation Drops below Zero as Prices Fall by 0.1%',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'European Banks Sitting on �1tn "Mountain" of Bad Debt',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_3'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Stock Exchanges to Back Entrepreneurs Approved by South Africa',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_16'
));

td_demo_content::add_post(array(
    'title' => 'How Entrepreneurs Make Use of Technology to Boost Cashflow',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_15'
));

td_demo_content::add_post(array(
    'title' => 'Developers in the Desert: Google\'s Oasis for Startups in Dubai',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_18'
));

td_demo_content::add_post(array(
    'title' => 'The Best Financial Habits of Every Successful Entrepreneur',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_17'
));

td_demo_content::add_post(array(
    'title' => 'New Housing Law May Offer an Opportunity for Entrepreneurs',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_14'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Sports Direct Workers Paid Less than Minimum Wage',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_13'
));

td_demo_content::add_post(array(
    'title' => 'Cadbury and Halfords Profit as Camping Gear Rise Strongly',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Retail Sales Fall for a Third Month in a Row',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Marks & Spencer Profits Jump for First Time in Four Years',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Tesco Boss Hails End of \'Space Race\' as Profits Crash',
    'file' => td_global::$get_template_directory . '/includes/demos/business/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));
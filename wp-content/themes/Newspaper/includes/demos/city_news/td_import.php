<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

//top menu

//footer menu

// main background > keep it empty to make sure that no bg img is set
td_demo_misc::update_background('');

// mobile menu/search background
td_demo_misc::update_background_mobile('td_pic_1');

// login background
td_demo_misc::update_background_login('td_pic_2');

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
    'normal' => 'td_logo_footer',
    'retina' => 'td_logo_footer_retina'
));

/*  ----------------------------------------------------------------------------
    footer text
*/

td_demo_misc::update_footer_text('City News promises to be a fair and objective portal, where readers can find the best information, recent facts and entertaining news. Newspaper is the best selling News Theme of all time and powers this amazing demo!');


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
td_demo_misc::add_ad_image('header', 'td_city_header_ad');
td_demo_misc::add_ad_image('custom_ad_1', 'td_city_sidebar_ad');
td_demo_misc::add_ad_image('custom_ad_2', 'td_city_header_ad');
td_demo_misc::add_ad_image('sidebar', 'td_city_small_ad');


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
        'facebook'      => "tagdiv",
        'instagram'     => "tagDiv",
        'youtube'       => "tagDiv",
        'twitter'       => "envato",
        'style'         => "style10 td-social-boxed td-social-colored"
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '',
        'spot_id' => 'sidebar'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Latest posts',
        'limit' => '5',
        'header_color' => ''
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Business',
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
        'category_name' => 'Finance',
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
        'category_name' => 'Marketing',
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
        'category_name' => 'Politics',
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
        'category_name' => 'Strategy',
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
    $demo_cat_7_id =td_demo_category::add_category(array(
        'category_name' => 'Celebrity',
        'parent_id' => $demo_cat_6_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_8_id =td_demo_category::add_category(array(
        'category_name' => 'Makeup',
        'parent_id' => $demo_cat_6_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_9_id =td_demo_category::add_category(array(
        'category_name' => 'Music',
        'parent_id' => $demo_cat_6_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_10_id =td_demo_category::add_category(array(
        'category_name' => 'Weird',
        'parent_id' => $demo_cat_6_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));

$demo_cat_11_id =td_demo_category::add_category(array(
    'category_name' => 'Tech',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
    $demo_cat_12_id =td_demo_category::add_category(array(
        'category_name' => 'Audio',
        'parent_id' => $demo_cat_11_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_13_id =td_demo_category::add_category(array(
        'category_name' => 'Entertainment',
        'parent_id' => $demo_cat_11_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_14_id =td_demo_category::add_category(array(
        'category_name' => 'Gadgets',
        'parent_id' => $demo_cat_11_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_15_id =td_demo_category::add_category(array(
        'category_name' => 'Television',
        'parent_id' => $demo_cat_11_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));

$demo_cat_16_id =td_demo_category::add_category(array(
    'category_name' => 'Food',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));

$demo_cat_17_id =td_demo_category::add_category(array(
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



/*  ----------------------------------------------------------------------------
    pages
*/

//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
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
    'title' => 'Business',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Lifestyle',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Tech',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_11_id
));


// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Food',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_16_id,
    'parent_id' => $parent_submenu_id
));

td_demo_menus::add_category(array(
    'title' => 'Travel',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_17_id,
    'parent_id' => $parent_submenu_id
));

/*  ---------------------------------------------------------------------------
    posts
*/
// posts in featured category

/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'Now Is the Time to Think About Your Small-Business Success',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'How Nancy Reagan Gave Glamour and Class to the White House',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Things to Look For in a Financial Trading Platform Environment',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Sanders Gets Respectful Welcome at Conservative College',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Burberry is the First Brand to get an Apple Music Channel Outfit Lines',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'The Most Popular Celebrity Baby Names List of the Millennium is Here',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Blake Shelton Goes Up Against Christina Aguilera',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'The 25 Best Cities You Can Find in Italy to Satisfy the Love for Pizza',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Discover the Newest Waterproof and Rugged Smartwatches that Come on Sale',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Entertainment Buzz: Taylor Swift gets an Emmy Award on Her 25 Year Old Birthday',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Trinity Audio Delta Review: Fighting the Hybrid Fight is Harder than Ever',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Trinity Audio Delta Review: Fighting the Hybrid Fight is Harder than Ever',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Silicon Valley Stunned by the Fulminant Slashed Investments',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Cover Girl Announces Star Wars Makeup Line is Due for Next December',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_12_id,$demo_cat_13_id,$demo_cat_14_id,$demo_cat_15_id,$demo_cat_16_id,$demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_4'
));


/* ------------------------------------------------------------------ */
// posts in one category
/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => '10 Things You Should Know Before You Visith South America’s Jungles',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Ultimate Guide to Vienna’s Coffee Renaissance Packed in One Weekend',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Vacation Bucket List: The Top 10 Trips of a Lifetime You Should Take',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'The Cliffs of Moher Reach 1 Million Visitors Every Year Since 2014',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_17_id),
    'featured_image_td_id' => 'td_pic_4'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Easy Breakfast Receipes: 4 Healthy Smoothie Bowls and Cereal Pancakes',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_16_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'This Week in Houston Food Blogs: High-Protein Recipes and Low Fat Shakes',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_16_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Moroccan Salmon with Mayonnaise is Common in Southern Spain',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_16_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Best Places to Get Your Mexican Food Fix When You Visit Mexico City',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_16_id),
    'featured_image_td_id' => 'td_pic_8'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Rupert Murdoch and Jerry Hall Tie the Knot in Amazing Event',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_15_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'American Honey Reads Donald Trump’s Mean Tweets on the Street',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_15_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Kourtney Kardashian Was Going For Full Custody Last Year',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_15_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Formula 1 Legend Murray Walker will Make Amazing TV Comeback',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_15_id),
    'featured_image_td_id' => 'td_pic_2'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'The Hottest Wearable Tech and Smart Gadgets of 2018 Will Blow Your Mind',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_14_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'New Technology Will Help Keep Your Smart Home from Becoming Obsolete',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_14_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Apple Watch Climbs the List of the Top Wearable Gadgets in Forbes Magazine',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_14_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Gigabyte GeForce GTX 950 Review: Pricing is Not Always the Only Criteria',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_14_id),
    'featured_image_td_id' => 'td_pic_6'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Lenovo Introduces it’s Best Entertainment Systems that Will Hit the Market in June',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'The Best Bloggers Reveal a New Way to Take Better Liked Photos for Instagram',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'How Grand Theft Auto Hijacked the Industry, Cutting a big Piece of Gaming Totals',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Village Roadshow Entertainment Secures $480 Million in Hollywood Contract Deal',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_10'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'A Breakthough for This Year: New Holiday Birds-Eye View Debuting in Sweeden',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Grain Audio On-Ear Speakers Are the Next Wave in Sound Technology Systems',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Bose SoundTrue Ultra In-Ear Headphones Launched and They Are Awesome',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'New Samsung Speakers Play 360-Degree Audio Stream and Have Incredible Base',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_4'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'The Car Insurance Catch that can Double Your Cover in Two Months',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'The Weirdest Places Ashes Have Been Scattered in New Zeeland',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'The Next Wave of Superheroes Has Arrived with Astonishing Speed',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Watch Awesome Kate Middleton Go Full Skiing Pro in Austria',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_1'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Scream is Now the Second Biggest Name in Drone Filming Equipment',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'New Movies and TV Shows Will Stream on Netflix, Amazon and Hulu this Fall',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'How Pixar Brings it’s Animated Movies to Life with Disney’s New Film',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'For Composer Derrick Spiva, Music is all About Embracing Life',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Take a Stroll Through All the Advantages of Permanent Eyebrows Tattoos',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => '10 Cool Startups that Will Change Your Perspective on Clothes & Fashion',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => '10 Outfits Inspired by Famous Works of Art are Auctioned in London',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'The Make-up Conference in New York this Winter Unveils Hot Innovations',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Kristen Stewart Visits the Toronto Film Festival with New Boyfriend',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Celebrity Make-up Artist Gary Meyers Shows you His Beauty Tricks',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Ben Affleck and Jennifer Garner Visit the Famous Ranches of California',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'E!’s Fashion Finder: Biggest Shows, Parties and Celebrity for New Years',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_3'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'The Definitive Guide To Marketing Your Business On Instagram',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Olimpic Athlete Reads Donald Trump’s Mean Tweets on Kimmel',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Kansas City Has a Massive Array of Big National Companies',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Program Will Lend $10M to Detroit Minority Businesses',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'The Politics Behind Marocco’s Stock Market Turbulence Last Year',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Expanding Peacefull Political Climate Gears up for 2019’s Election',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Things You Didn’t Know About the American Past Presidents',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'India’s Presidential Candidates Presented in Just a Few Minutes',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Customer Engagement Marketing: A New Strategy for the Economy',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Social Media Marketing for Franchises is Meant for Women',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Entrepreneurial Advertising: The Future Of Marketing',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Mobile Marketing is Said to Be the Future of E-Commerce',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Dell Will Invest $125 Billion in China’s Tech in the Next 5 Years',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Boxtrade Lands $50 Million in Another New Funding Round with IBM',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'A Look at How Social Media & Mobile Gaming Can Increase Sales',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'The Secret to Your Company’s Financial Health is Very Important',
    'file' => td_global::$get_template_directory . '/includes/demos/city_news/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
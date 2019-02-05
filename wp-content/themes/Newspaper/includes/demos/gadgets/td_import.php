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
$td_demo_top_menu = td_demo_menus::create_menu('td-demo-top-menu', 'top-menu');
td_demo_menus::add_link(array(
    'title' => 'Disclaimer',
    'add_to_menu_id' => $td_demo_top_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'About',
    'add_to_menu_id' => $td_demo_top_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_top_menu,
    'url' => '#',
    'parent_id' => ''
));

//footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');
td_demo_menus::add_link(array(
    'title' => 'About',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));


/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');

// mobile background
td_demo_misc::update_background_mobile('td_pic_12');

// login popup background
td_demo_misc::update_background_login('td_pic_9');

// footer background
td_demo_misc::update_background_footer('td_gadgets_footer_bg');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header',
    'mobile' => 'td_logo_mobile'
));

//footer
td_demo_misc::update_footer_logo(array(
    'normal' => 'td_logo_footer',
    'retina' => 'td_logo_footer'
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
td_demo_misc::add_ad_image('custom_ad_1', 'td_gadgets_ad');
td_demo_misc::add_ad_image('sidebar', 'td_gadgets_sidebar_ad');


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
        'style'         => "style4 td-social-colored"
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '',
        'spot_id' => 'sidebar'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_9_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Recent Posts',
        'limit' => '5',
        'header_color' => ''
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
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
    $demo_cat_2_id =td_demo_category::add_category(array(
        'category_name' => 'Audio',
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
        'category_name' => 'Drones',
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
        'category_name' => 'Phones',
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
        'category_name' => 'Photography',
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
        'category_name' => 'Video',
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
        'category_name' => 'Wearables',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));

$demo_cat_8_id =td_demo_category::add_category(array(
    'category_name' => 'Smart Home',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_9_id =td_demo_category::add_category(array(
    'category_name' => 'Gaming',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_10_id =td_demo_category::add_category(array(
    'category_name' => 'Social Networks',
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
    'category_name' => 'Computing',
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
    'category_name' => 'Internet',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_13_id =td_demo_category::add_category(array(
    'category_name' => 'Security',
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
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
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
    'title' => 'Gear',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
	'title' => 'Smart Home',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_8_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Gaming',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Social Networks',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_10_id
));

// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Computing',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_11_id,
    'parent_id' => $parent_submenu_id
));

td_demo_menus::add_category(array(
    'title' => 'Internet',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_12_id,
    'parent_id' => $parent_submenu_id
));

td_demo_menus::add_category(array(
    'title' => 'Security',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_13_id,
    'parent_id' => $parent_submenu_id
));

/*  ---------------------------------------------------------------------------
    posts
*/
// posts in featured category

td_demo_content::add_post(array(
    'title' => 'Here’s a New Way to Take Better Photos for Instagram',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'In-Ear Computer Filters Noise to Make You a Better Listener',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Malware May Soon Infect Smart Home’s Operating Systems',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'All You Need to Know About the Global Nokia Launching',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'The Smart Wireless Earphones for DJ’s Are a Real Breakthrough',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_5'
));


/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'This New Underwater Drone Is Your Own Personal Submarine',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Your Next Choice: 10 Drones for Kids Ranked Best to Worst',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Top Tip: How to Use Snapchat on iPhone and Android',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Canon Crop Factor: How the Camera Model Affects Your Lenses',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Apple Unveils the iTunes Top 5 Best Selling Movies of All-Time',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'This Transcribing Smartwatch is a Note-Takers Dream',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'New Card Will Keep Your Smart Home from Becoming Obsolete',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Microsoft to Start Reality Development Kits in March',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Discover a Better Camera for Your YouTube Account',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Snapdragon Super Chip Mounted on the Latest DSLR Photo Cameras',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Computer Internet Connection Doesn’t Work (Ethernet or WiFi)',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Why the Apple Watch Has Some Security Pros Worried',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_11_id,$demo_cat_12_id,$demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_12'
));

/* ------------------------------------------------------------------ */
// posts in one category
/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'This New Senate Bill Might Ban Unbreakable Encryption',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => '12 Computer Security Mistakes You’re Probably Making',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Beware: This New iTunes Scam Can Steal Your Identity',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => '3 Looming Security Threats That Should Scare You',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_13_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Friday’s Internet Outages May Be Just the Beginning',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Images from Hundreds of PCs & Control Systems Put Online',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Facebook Using Lasers to Deliver Lightning-Fast Internet',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Tip: How Much Internet Speed Should You Really Pay For?',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_12_id),
    'featured_image_td_id' => 'td_pic_4'
));

/* ------------------------------------------------------------------ */


td_demo_content::add_post(array(
    'title' => 'Android Nougat Review: Little Improvements Make a Big Difference',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'This New Holographic Computer Gives Tactile Feedback in Mid-Air',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'In-Ear Computer Filters Noise to Make You a Better Listener',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'A Breakthough for This Year: New Holiday Birds-Eye View Debuting',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_11_id),
    'featured_image_td_id' => 'td_pic_8'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Your Tumblr Blog Could Soon Start to Make You Money',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Here’s a New Way to Take Better Photos for Instagram',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'How to Snag a Pair of Snapchat Spectacles Online',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Facebook Now Lets You Log In with a Physical Key',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_12'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Why 2017 Might Just Be the Worst Year Ever for Gaming',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Ghost Racer Wants to Be the Most Ambitious Car Game',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'New Nintendo Wii Console Goes on Sale in Strategy Reboot',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'You and Your Kids can Enjoy this News Gaming Console',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Sneak Peak: Best Smart Home Gadgets & Features in 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Light Bulb Guide for your Home: LED vs. CFL vs. Halogen',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Malware May Soon Infect Smart Home’s Operating Systems',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Prepare to Meet the Next Big Thing for Smart Homes',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => '10 Best Ways to Use and Personalize Your Apple Watch',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Huawei Watch 2: Good Looks, But Lacking a Major Feature',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Samsung Gear VR Gets Refreshed With a Touch Controller',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'This Sexy Steel Smartwatch Keeps Ticking When Turned Off',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_3'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Apple Unveils the iTunes Top 5 Best Selling Movies of All-Time',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Nikon Portable Video Camera to be Launched in 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Virtual Reality Could Change Twitch Streaming Forever',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'This New Gear Virtual Reality Controller Feels Like the Future',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'This New Breakthrough Phone Camera Has Periscoping Zoom',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'The Best Point and Shoot Cameras for your Next Vacation',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'How to Share Multiple Images and Video in Your Instagram',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Discover the Newest Waterproof and Rugged Cameras of 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Top Tip: How to Use Snapchat on iPhone and Android',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Apple’s Next Smartphone May Have Ultra HD OLED Screens',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'iPhone will Adopt Fast Charging and Retain Lightning Port',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Google Pixel 2 Will Arrive this Spring in the Premium Segment',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Intruder in Your Home? The Alarm Will Release the Drones',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Camera Passport Review: You Can Take This Drone Anywhere',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'This New Underwater Drone Is Your Own Personal Submarine',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Air Hogs Drone Gives You a Bird’s-Eye View in VR Mode',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Discover the 9 Best Songs to Stream & Share Right Now',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'The Smart Wireless Earphones for DJ’s Are a Real Breakthrough',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Best Smart Surround Earphones for Your Next Workout Session',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'How to Save $100 on Top-Selling Bose Kitchen Audio System',
    'file' => td_global::$get_template_directory . '/includes/demos/gadgets/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
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


/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');

// mobile background
td_demo_misc::update_background_mobile('td_pic_2');

// login popup background
td_demo_misc::update_background_login('td_pic_5');

// footer background


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header',
    'mobile' => 'td_logo_mobile'
));

//footer


/*  ----------------------------------------------------------------------------
    footer text
*/

/*  ----------------------------------------------------------------------------
    socials
*/

/*  ----------------------------------------------------------------------------
    ads
 */

/*  ----------------------------------------------------------------------------
    sidebars
 */
//default sidebar


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

/*  ----------------------------------------------------------------------------
    pages
 */

//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'homepage' => true
));

//pricing page
$td_pricingpage_id = td_demo_content::add_page(array(
    'title' => 'Pricing',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/pricing.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//customers page
$td_customerspage_id = td_demo_content::add_page(array(
    'title' => 'Customers',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/customers.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//demo page
$td_demopage_id = td_demo_content::add_page(array(
    'title' => 'Demo',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/demo.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//news page
$td_newspage_id = td_demo_content::add_page(array(
    'title' => 'News',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/news.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//footer page
$td_footerpage_id = td_demo_content::add_page(array(
    'title' => 'Footer',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/footer.txt',
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

//add the pricing page to the menu
td_demo_menus::add_page(array(
    'title' => 'Pricing',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_pricingpage_id,
    'parent_id' => ''
));

//add the customers page to the menu
td_demo_menus::add_page(array(
    'title' => 'Customers',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_customerspage_id,
    'parent_id' => ''
));

//add the demo page to the menu
td_demo_menus::add_page(array(
    'title' => 'Demo',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_demopage_id,
    'parent_id' => ''
));

//add the news page to the menu
td_demo_menus::add_page(array(
    'title' => 'News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_newspage_id,
    'parent_id' => ''
));

/*  ---------------------------------------------------------------------------
    posts
*/


td_demo_content::add_post(array(
    'title' => 'You and Your Kids can Enjoy this News Gaming Console',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'A Breakthough for This Year: New Holiday Birds-Eye View Debuting',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Discover the Newest Waterproof and Rugged Cameras of 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Apple XI Will Arrive this Spring in the Premium Segment',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'The Smart Wireless Earphones for DJ’s Are a Real Breakthrough',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'New Technology Will Keep Your Smart Home from Becoming Obsolete',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'In-Ear Computer Filters Noise to Make You a Better Listener',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => '10 Best Ways to Use and Personalize Your Apple Watch',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => '12 Computer Security Mistakes You’re Probably Making',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Here’s a New Way to Take Better Photos for Instagram',
    'file' => td_global::$get_template_directory . '/includes/demos/technology/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_10'
));

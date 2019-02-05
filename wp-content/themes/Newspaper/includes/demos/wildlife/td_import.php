<?php
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

// mobile background
td_demo_misc::update_background_mobile('td_pic_1');

// login popup background
td_demo_misc::update_background_login('td_pic_2');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header',
    'mobile' => 'td_logo_header'
));


/*  ----------------------------------------------------------------------------
    socials
*/
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'googleplus' => '#',
    'twitter' => '#',
));


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar

/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Blog',
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
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));

//about page
$td_aboutpage_id = td_demo_content::add_page(array(
    'title' => 'About',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/about.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//gallery page
$td_gallerypage_id = td_demo_content::add_page(array(
    'title' => 'Gallery',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/gallery.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//contact page
$td_contactpage_id = td_demo_content::add_page(array(
    'title' => 'Contact',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/contact.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//footer page
$td_footerpage_id = td_demo_content::add_page(array(
    'title' => 'Footer',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/footer.txt',
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


//add the about page to the menu
td_demo_menus::add_page(array(
    'title' => 'About',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_aboutpage_id,
    'parent_id' => ''
));


//add the services page to the menu
td_demo_menus::add_page(array(
    'title' => 'Gallery',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_gallerypage_id,
    'parent_id' => ''
));


//add the blog category to the menu
td_demo_menus::add_category(array(
    'title' => 'Blog',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id,
    'parent_id' => ''
));


//add the contact page to the menu
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_contactpage_id,
    'parent_id' => ''
));


/*  ---------------------------------------------------------------------------
    posts
*/

td_demo_content::add_post(array(
    'title' => 'Wild photography session in island',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Tracking and living among lions in wild Kenya',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Discover Europe’s most rare and endangered bird species',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Northern Russia is home of the big wild siberian ecosystem',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'The amazonian wilderness one of the most unique in the world',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'North of China is home to vast areas of uncharted lands',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Last chance to meet the few of the carpathian brown bears',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'I found that oceans still hold the world’s biggest mysteries',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'These exotic bird species caught me completely off guard',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'All of Earth’s forests sustain the most complex ecosystems',
    'file' => td_global::$get_template_directory . '/includes/demos/wildlife/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_10'
));
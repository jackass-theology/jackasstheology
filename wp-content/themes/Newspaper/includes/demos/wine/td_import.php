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
td_demo_misc::update_background_mobile('sun');

// login popup background


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'logo-header',
    'retina' => 'logo-header-retina',
    'mobile' => 'logo-mobile'
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
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_instagram_widget',
    array (
        'custom_title'  => "",
        'instagram_id'  => "winedestinations",
        'instagram_images_per_row' => 2,
        'instagram_number_of_rows' => 5,
        'instagram_margin' => 2,
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'LATEST ARTICLES',
        'limit' => '5',
        'header_color' => ''
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


/*  ----------------------------------------------------------------------------
    pages
*/

//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));

//products page
$td_productspage_id = td_demo_content::add_page(array(
    'title' => 'Products',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/products.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//about page
$td_aboutpage_id = td_demo_content::add_page(array(
    'title' => 'About',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/about.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//news page
$td_newspage_id = td_demo_content::add_page(array(
    'title' => 'News',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/news.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//contact page
$td_contactpage_id = td_demo_content::add_page(array(
    'title' => 'Contact',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/contact.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//footer page
$td_footerpage_id = td_demo_content::add_page(array(
    'title' => 'Footer',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/footer.txt',
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


//add the campaigns page to the menu
td_demo_menus::add_page(array(
    'title' => 'Products',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_productspage_id,
    'parent_id' => ''
));


//add the about page to the menu
td_demo_menus::add_page(array(
    'title' => 'About',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_aboutpage_id,
    'parent_id' => ''
));


//add the news page to the menu
td_demo_menus::add_page(array(
    'title' => 'News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_newspage_id,
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
    'title' => 'Dining: Rose grapes with fresh goat cheese',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'How to set your annual wine budget?',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Unemployment rate at 17-year low',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'How Aroma is changing the Valley',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Wine Aroma brands’ earnings on the rise',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Bibi Graetz joins folio fine wine partners',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Board of directors elects 2018 leadership',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Damaged vineyards face uncertainty',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Wine and spirits disappoint on sales',
    'file' => td_global::$get_template_directory . '/includes/demos/wine/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));
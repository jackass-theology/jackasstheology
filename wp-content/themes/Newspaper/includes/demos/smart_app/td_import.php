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
td_demo_misc::update_background_mobile('bg_mobile');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
    'mobile' => 'td_logo_header_retina'
));

/*  ----------------------------------------------------------------------------
    socials
*/
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'googleplus' => '#',
    'twitter' => '#',
    'vk' => '#'
));

/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id = td_demo_category::add_category(array(
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

// add pages
$td_homepage_page = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => true
));
$td_features_page = td_demo_content::add_page(array(
    'title' => 'Features',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/features.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_pricing_page = td_demo_content::add_page(array(
    'title' => 'Pricing',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/pricing.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_support_page = td_demo_content::add_page(array(
    'title' => 'Support',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/support.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_download_page = td_demo_content::add_page(array(
    'title' => 'Download',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/download.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/footer-template.txt',
    'template' => 'pag.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
td_util::update_option( 'tds_footer_page', $td_footertemplate_id);


// main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');
td_demo_menus::add_page(array(
    'title' => 'Home',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_homepage_page,
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Features',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_features_page,
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Pricing',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_pricing_page,
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Support',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_support_page,
    'parent_id' => ''
));
// add a category to the menu
td_demo_menus::add_category(array(
    'title' => 'Blog',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));
td_demo_menus::add_page(array(
    'title' => 'Download APP',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_download_page,
    'parent_id' => ''
));

/*  ---------------------------------------------------------------------------
    posts
*/
/* ------------------------------------------------------------------ */
// posts in multiple categories
//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "I can’t browse the sites I like at work because company firewall policy is too strict",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_8'
));
td_demo_content::add_post(array(
    'title' => "Client-side vs Server-side Validation in Web Applications",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_2'
));
td_demo_content::add_post(array(
    'title' => "My microwave is too small to fit the microwave popcorn bag",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_3'
));
td_demo_content::add_post(array(
    'title' => "This watermelon I bought on a whim is pretty good, but I can definitely imagine a better one.",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_4'
));
td_demo_content::add_post(array(
    'title' => "Modern Language Wars, PHP vs Python vs Ruby",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_5'
));
td_demo_content::add_post(array(
    'title' => "Scalable code without bloat: DCI, Use Cases, and You",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_6'
));
td_demo_content::add_post(array(
    'title' => "Game of Hacks – See How Good You Are",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_7'
));
td_demo_content::add_post(array(
    'title' => 'Moogle Corp: Company you might be working for',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_8'
));
td_demo_content::add_post(array(
    'title' => "Terraform – Cross PaaS configuration management?",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_9'
));
td_demo_content::add_post(array(
    'title' => "50 Tips and Insights About Productivity, Happiness, and Life",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_3'
));
td_demo_content::add_post(array(
    'title' => 'Why you should choose Microsoft over Linux',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_2'
));
td_demo_content::add_post(array(
    'title' => "Going Beyond Amazon: A New Model for Authors, Retailers, and Publishers",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_7'
));

td_demo_content::add_post(array(
    'title' => "Wind and solar power are even more expensive than is commonly thought",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_3'
));
td_demo_content::add_post(array(
    'title' => 'Building an API in 60 seconds, without any server setup',
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_4'
));
td_demo_content::add_post(array(
    'title' => "FCC chair accuses Verizon of throttling unlimited data to boost profits",
    'file' => td_global::$get_template_directory . '/includes/demos/smart_app/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_post_5'
));
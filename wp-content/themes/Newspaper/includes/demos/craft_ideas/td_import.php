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
    'twitter' => '#',
    'vk' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
 */

/*  ----------------------------------------------------------------------------
    sidebars
 */
//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_image_box_widget',
    array (
        'custom_title'  => "Don't miss",
        'height'      => 120,
        'gap'     => 20,
        'display'       => "vertical",
        'style'       => "style-2",
        'image_item0'         => "",
        'image_title_item0' => "DIY Makeup",
        'image_item1'         => "",
        'image_title_item1' => "Home Ideas",
        'image_item2'         => "",
        'image_title_item2' => "DIY & How to"
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'custom_title' => 'Most popular',
        'sort' => 'random_posts',
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
    'category_name' => 'DIY & How to',
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
        'category_name' => 'Decorating ideas',
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
        'category_name' => 'Fun stuff',
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
        'category_name' => 'Home ideas',
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
        'category_name' => 'Nail art',
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
        'category_name' => 'DIY Makeup',
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
    'category_name' => 'Lifehacks',
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
    'category_name' => 'Food & Recipes',
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
$demo_cat_9_id =td_demo_category::add_category(array(
    'category_name' => 'Videos DIY',
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


// add pages
$td_about_page = td_demo_content::add_page(array(
    'title' => 'About me',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/about.txt',
    'template' => 'page.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_contact_page = td_demo_content::add_page(array(
    'title' => 'Contact',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/contact.txt',
    'template' => 'page.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_homepage_page = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '18',
    'sidebar_position' => '',
    'homepage' => true
));



// top menu
$td_demo_top_menu_id = td_demo_menus::create_menu('td-demo-top-menu', 'top-menu');
td_demo_menus::add_page(array(
    'title' => 'About me',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'page_id' => $td_about_page,
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Blog',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'page_id' => $td_contact_page,
    'parent_id' => ''
));

// footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');
td_demo_menus::add_page(array(
    'title' => 'About me',
    'add_to_menu_id' => $td_demo_footer_menu,
    'page_id' => $td_about_page,
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Blog',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_footer_menu,
    'page_id' => $td_contact_page,
    'parent_id' => ''
));

// main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');
td_demo_menus::add_page(array(
    'title' => '<i class="ico-craft-home"></i>Home',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_homepage_page,
    'parent_id' => ''
));

// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => '<i class="ico-craft-diy"></i>Beauty',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
	'title' => '<i class="ico-craft-lifehacks"></i>Lifehacks',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_7_id
));

td_demo_menus::add_mega_menu(array(
    'title' => '<i class="ico-craft-food"></i>Food & Recipes',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));

td_demo_menus::add_mega_menu(array(
    'title' => '<i class="ico-craft-circle"></i>Videos DIY',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id
));

// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => '<i class="ico-craft-buttons"></i>More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Decorating ideas',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_2_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Fun stuff',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_3_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Home ideas',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_4_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Nail art',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_5_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'DIY Makeup',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id,
    'parent_id' => $parent_submenu_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'Gorgeous DIY Button Wall Art Made From Old Plates',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Genius Decorating Ideas for Every Room in Your House',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'These Are The Colors Everyone Will Be Talking About In 2017',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'The Prettiest Candles to Repurpose',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'How to Make DIY Spring Art Using Only Buttons',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Budget Friendly Home Decorating Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Festive and Cozy Ideas for Thanksgiving Decorations',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'DIY Cosmetics | Easy Makeup Recipe Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Most Beautiful Homemade Cake Decorating Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id,$demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_1'
));

// -----------------------------------------

td_demo_content::add_post(array(
    'title' => 'Tasty and Easy Fruit Dessert Recipes',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Most Beautiful Homemade Cake Decorating Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Yummy Vegetable to Make for Dinner',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'How to Make a Button Bracelet',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Easy Crafts to Make This Easter',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'How to Get Younger Looking Eyes',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'The Cutest Buttons Ever',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'How to Make DIY Natural Make-Up',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Natural Blush Makeup Recipe',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'Lazy Girl Nail Art Ideas That Are Actually Easy',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));


td_demo_content::add_post(array(
    'title' => 'Tasty and Easy Fruit Dessert Recipes',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Most Beautiful Homemade Cake Decorating Ideas',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Yummy Vegetable to Make for Dinner',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'How to Make a Button Bracelet',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Easy Crafts to Make This Easter',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'How to Get Younger Looking Eyes',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'The Cutest Buttons Ever',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'How to Make DIY Natural Make-Up',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Natural Blush Makeup Recipe',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'Lazy Girl Nail Art Ideas That Are Actually Easy',
    'file' => td_global::$get_template_directory . '/includes/demos/craft_ideas/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
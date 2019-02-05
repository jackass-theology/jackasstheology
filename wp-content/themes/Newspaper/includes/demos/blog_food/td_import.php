<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

//menu background
td_demo_misc::update_background_header('');

//main background > keep it empty to make sure that no bg img is set
td_demo_misc::update_background('');

//mobile menu/search background
td_demo_misc::update_background_mobile('td_pic_1');

//login background
td_demo_misc::update_background_login('');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'mobile' => 'td_logo_mobile'
));


/*  ----------------------------------------------------------------------------
    socials
*/
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'twitter' => '#',
    'instagram' => '#',
    'youtube' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
*/
td_demo_misc::clear_all_ads();

/*  ----------------------------------------------------------------------------
    sidebars
*/
//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');


/*  ----------------------------------------------------------------------------
    Cloud Templates
*/
//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - Food Blog',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));

// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );


//cloud template - type single
$td_cloud_post_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Single Cloud Template - Food Blog',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_cloud_template.txt',
    'template_type' => 'single',
));

// set the default (site wide) post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);


//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Food Blog',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/author_cloud_template.txt',
    'template_type' => 'author',
));

// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

//cloud template - type 404 - global
$td_cloud_global_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - Food Blog',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/404_cloud_template.txt',
    'template_type' => '404',
));

// set - the default (global) cloud 404 template
td_demo_misc::update_global_404_template( 'tdb_template_' . $td_cloud_global_404_template_id );


//cloud template - type search - global
$td_cloud_global_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - Food Blog',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/search_cloud_template.txt',
    'template_type' => 'search',
));

// set - the default (global) search template
td_demo_misc::update_global_search_template( 'tdb_template_' . $td_cloud_global_search_template_id );


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Food',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
    $demo_cat_2_id =td_demo_category::add_category(array(
        'category_name' => 'Breakfast',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_3_id =td_demo_category::add_category(array(
        'category_name' => 'Desserts',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_4_id =td_demo_category::add_category(array(
        'category_name' => 'Main Dishes',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_5_id =td_demo_category::add_category(array(
        'category_name' => 'Pasta',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_6_id =td_demo_category::add_category(array(
        'category_name' => 'Salads',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));

$demo_cat_7_id =td_demo_category::add_category(array(
    'category_name' => 'Drinks',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_8_id =td_demo_category::add_category(array(
    'category_name' => 'Healthy',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_9_id =td_demo_category::add_category(array(
    'category_name' => 'Travel',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'boxed_layout' => 'hide', //leave empty for boxed layout, write "hide" for full layout
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
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));

//about page
$td_aboutpage_id = td_demo_content::add_page(array(
    'title' => 'About',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/about.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//footer page
$td_footerpage_id = td_demo_content::add_page(array(
    'title' => 'Footer',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/footer.txt',
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


// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Food',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Drinks',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));
td_demo_menus::add_mega_menu(array(
    'title' => 'Healthy',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));
td_demo_menus::add_mega_menu(array(
    'title' => 'Travel',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id
));



/*  ---------------------------------------------------------------------------
    posts
*/
//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Caramel Whipped Cream Chocolate Cake",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_6',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => "Best Chocolate Chip Cookies",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => "Rocky Road Ice Cream",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_8',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => "Soft Double Chocolate Cookies",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_9',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => "Fresh Fruit Cobbler",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_10',
    'template' => ''
));
td_demo_content::add_post(array(
    'title' => "coffee & delicious macaroons in paris",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_11',
    'template' => ''
));



//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Ultimate Triple Chocolate Muffins",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "Chicken and Couscous Salad",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Spicy Warm Chicken Salad',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Broccoli and Cauliflower Salad With Feta",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Blackberry Spinach Salad",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_4'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Bacon, Egg and Potato Salad",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Healthy Roast Chicken",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Roast Beef With Thyme and Fennel Crust",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Duck and Pepper Stir Fry",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Beef Pot Roast",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Chicken Jalfrezi",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Chicken and Fried Rice",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "Pork Kebabs With Grilled Plums and Couscous",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => 'Quick Italian Tomato Sauce',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Basil Chicken with Vermicelli",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_2'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Spicy Herb Chicken Pasta",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Chinese Noodle Chicken",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Greek Pasta Salad',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Spicy Herb Chicken Pasta",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Easy Olive Oil, Tomato and Basil Pasta",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_7'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Clean Eating Green Smoothie",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Sparkling Strawberry Smoothie",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Red, White and Blue Protein Smoothie",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Blueberry Cheesecake Protein Shake",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "Girl Scout Cookie Samoa Shake",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'Skinny Avocado Egg Sandwich',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Apple Pumpkin Muffins",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => "Chunky Monkey Pancakes",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Fast and Easy Pancakes',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));


td_demo_content::add_post(array(
    'title' => 'Fresh Fruit Trifle',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Rocky Road Bites",
    'file' => td_global::$get_template_directory . '/includes/demos/blog_food/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_6'
));
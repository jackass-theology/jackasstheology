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
td_demo_misc::update_background_mobile('td_pic_12');

/// footer background
td_demo_misc::update_background_footer('td_pic_8');

// login background

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
td_demo_misc::add_ad_image('custom_ad_1', 'td_blog_fitness_ad');
td_demo_misc::add_ad_image('sidebar', 'td_blog_fitness_sidebar_ad');


/*  ----------------------------------------------------------------------------
    sidebars
 */
//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '',
        'spot_id' => 'sidebar'
    )
);


td_demo_widgets::add_widget_to_sidebar('default', 'td_block_21_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Recent Posts',
        'limit' => '5',
        'header_color' => ''
    )
);

//footer 1 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::add_widget_to_sidebar('footer-1', 'td_block_21_widget',
    array (
        'custom_title'  => "LATEST POSTS",
        'limit' => 3,
    )
);

//footer 2 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::add_widget_to_sidebar('footer-2', 'td_block_instagram_widget',
    array (
        'custom_title'  => "INSTAGRAM",
        'instagram_id'  => "unsplash",
        'instagram_images_per_row' => 2,
        'instagram_number_of_rows' => 2,
        'instagram_margin' => 5,
    )
);

//footer 3 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-3');
td_demo_widgets::add_widget_to_sidebar('footer-3', 'td_block_popular_categories_widget',
    array (
        'custom_title'  => "CATEGORIES",
        'limit' => 10,
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Training',
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
        'category_name' => 'Fitness class',
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
        'category_name' => 'Gym equipment',
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
        'category_name' => 'Routines',
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
        'category_name' => 'Sport equipment',
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
    'category_name' => 'Nutrition',
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
    'category_name' => 'Motivation',
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
    'category_name' => 'Videos',
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
    'category_name' => 'Health',
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

/*  ----------------------------------------------------------------------------
    pages
 */

//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/homepage.txt',
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
    'title' => 'Training',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
	'title' => 'Nutrition',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_6_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Motivation',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Videos',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));

// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Health',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id,
    'parent_id' => $parent_submenu_id
));

td_demo_menus::add_category(array(
    'title' => 'Lifestyle',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_10_id,
    'parent_id' => $parent_submenu_id
));

/*  ---------------------------------------------------------------------------
    posts
*/
// posts in featured category

td_demo_content::add_post(array(
    'title' => 'The impact of bodybuilding over a social life',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Are you taking your meds like everybody else?',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Awesome fitness motivation quotes to keep you going',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => '15 simple diets and fitness tips you should know',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_4'
));

/* ------------------------------------------------------------------ */
// posts in multiple categories

td_demo_content::add_post(array(
    'title' => 'Useful information guide about chest machine',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_7_id,$demo_cat_6_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'What celebrities wear at the basic training?',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_7_id,$demo_cat_6_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Most common gym clothing mistakes ever seen',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_7_id,$demo_cat_6_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'More helpful ideas and tips about gym wear',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_7_id,$demo_cat_6_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => '5 things you should never wear to the gym',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_7_id,$demo_cat_6_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => '3 Better ways to dress for a gym workout',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_9_id,$demo_cat_10_id,$demo_cat_7_id,$demo_cat_6_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6'
));

/* ------------------------------------------------------------------ */
// posts in one category
/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'How to be successful in bodybuilding, and in life!',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Daily workouts help you cope better with stress',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Better ways yoga can improve your productivity',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'How physical exercise makes your brain better?',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_12'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'What are the benefits of cardio traning?',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'How streching can improve flexibility and health',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Massive reasons to jump for Kangoo Jumps',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => '6 Suprising health benefits of Yoga exercises',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Discover ten ways for an amazing fat burning Yoga',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Few tips to relieve muscle soreness after workout',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'How to burn calories with simple home exercises',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'More stretching for beginners is highly recommended',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Explosive workout monster training forces the limit',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Motivational songs to have a successful workout',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Few helpful ideas to improve your motivation',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Few smart ways to motivate yourself to work out',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Perfect morning workouts for a healthy mind',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_11'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Nutrition rules to get stronger and build muscle',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Some perfect meals for bodybuilding diet',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'How to lose your weight by eating healthy food',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => '30 Rules which help you to have amazing health',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Useful information guide about chest machine',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Most common gym clothing mistakes ever seen',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => '3 Better ways to dress for a gym workout',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => '5 things you should never wear to the gym',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Awesome exercises for building triceps and biceps',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'The ultimate exercises to improve back muscles',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Most helpful shoulders exercises that you need',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Do 10 Minutes workout to toned abs and legs',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Best exercises to build a big and defined chest',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_11'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'How to increase your strength with arms machines',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'How to use back machines? Important tips!',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Press machine for bigger and strong shoulders',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Best gym equipment for building abs and legs',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Lose your weight working some Tae-Bo technique',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Shape your body: Use the Booty Step N Sculpt',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_11'
));

td_demo_content::add_post(array(
    'title' => 'Increase your endurance through Pilates method',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_12'
));

td_demo_content::add_post(array(
    'title' => 'The power of the yoga exercises will help you',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'No excuse: Cardio pump workout for healthy body',
    'file' => td_global::$get_template_directory . '/includes/demos/blog_fitness/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));
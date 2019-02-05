<?php
/**
 * Created by ra on 5/14/2015.
 */



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
td_demo_misc::update_background_mobile('td_pic_10');



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


/*  ----------------------------------------------------------------------------
    socials
 */
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'instagram' => '#',
    'twitter' => '#',
    'youtube' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();
td_demo_misc::add_ad_image('sidebar', 'td_rec_sidebar');
td_demo_misc::add_ad_image('custom_ad_1', 'td_church_homepage_ad');


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_social_counter_widget',
    array (
        'custom_title'  => "Keep in touch",
        'block_template_id' => 'td_block_template_2',
        'facebook' => "tagDiv",
        'twitter' => "tagDivOfficial",
        'youtube' => "tagdiv",
        'style' => "style6 td-social-boxed",
    )
);
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'custom_title' => 'Podcasts',
        'block_template_id' => 'td_block_template_2',
        'sort' => 'random_posts',
        'limit' => '4',
    )
);
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'custom_title' => 'Latest sermons',
        'block_template_id' => 'td_block_template_2',
        'sort' => 'random_posts',
        'limit' => '4',
    )
);

// footer 1 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-1');

//footer 2 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::add_widget_to_sidebar('footer-2', 'td_block_popular_categories_widget',
    array (
        'custom_title'  => "Popular categories",
        'limit' => 3,
    )
);

//footer 3 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-3');
td_demo_widgets::add_widget_to_sidebar('footer-3', 'td_block_text_with_title_widget',
    array (
        'custom_title'  => "Give",
        'content' => '<a class="td-donation-btn" href="#">Support our work</a>',
    )
);



/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Channels',
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
        'category_name' => 'Christian living',
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
        'category_name' => 'Ministry',
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
        'category_name' => 'Bible & Theology',
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
        'category_name' => 'Arts & Culture',
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
    'category_name' => 'Sermons',
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
    'category_name' => 'Events',
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
    'category_name' => 'Podcast',
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
    'category_name' => 'Books',
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
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php, for default no extension needed
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
    'title' => 'Channels',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));


// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Sermons',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));


// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Books',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));

// add a category to the menu
td_demo_menus::add_category(array(
    'title' => 'Events',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id
));

// add a category to the menu
td_demo_menus::add_category(array(
    'title' => 'Podcast',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'The Church in China at the Threshold',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'The Pastor, the People, and the Pursuit of Joy',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'

));
td_demo_content::add_post(array(
    'title' => 'Does God Love Everyone the Same?',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Help, Don’t Hurt, the Poor',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Reflection - The Compass of Our Heart',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));


//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Kyle Idleman: God Never Wastes What We Go Through",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "6 Markers of Especially Welcoming Churches",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Helping People Connect Faith and Work",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "Do Not Be Anxious About Tomorrow",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "How We Know the Bible Is True",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_3'
));



//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Teach Teens Discernmen",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Realizing Your Deepest Desires',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Does Jesus Want to Heal Me?",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Where to Stand When All Is Shaking",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "An All-Consuming Passion for Jesus",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_10'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Why We Need Both ‘Silence’ and ‘Hacksaw Ridge’",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Life After Romans 8:28",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "10 Things I Did Not Do that Improved My Congregation’s Singing",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Meditation: Letting Thought Clouds Come and Go",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Five Minutes to a Happier You",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "3 Overlooked Gifts of the Reformation",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Thabiti Anyabwile on Preaching and Pastoral Ministry",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => '3 Questions to Consider Before You Share',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "How Obedience Sets Us Free ... Or Not",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "Desiring God",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_6'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Make History Great Again",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_13'
));
td_demo_content::add_post(array(
    'title' => 'Trusting Our Awakening Heart',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Stewarding a Multiethnic Campus",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Stop Cheating Your Church",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Doctrine Matters",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "An Ambition to Keep Our Conduct in Step with the Gospel",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "The Liszts",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "How Art Moved Me Beyond the Cliché",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Don’t Go Until You’re Sent",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "H. B. Charles Jr. on Why Sola Scriptura Matters",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_8'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'The Role of Christian Journalism',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Holy Ambition for All the Peoples to Praise Christ",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => "The Reformation Changed the Way We Sing",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'Europe’s Most Godless Country May Surprise You',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "For Your Joy",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "The Pride of Babel and the Praise of Christ",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_14'
));
td_demo_content::add_post(array(
    'title' => 'Can You Have Justice Without Jesus?',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Refuge in Truth, Love and Awareness",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "How to Help Your Teenager Choose Friends",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "The National Book Awards Longlist: Poetry",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_8'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'Juan Sanchez on Why Grace Alone Matters',
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "The Sale of Joseph and the Son of God",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "How the Reformation Recovered Preaching",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Roald Dahl Turns a Hundred",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "The National Book Awards Longlist: Fiction",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_1'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "The Revolution of Tenderness",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Meet Generation Z",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "One Church’s Story of Resettling a Syrian Refugee Family",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "This Week in Fiction: Petina Gappah on the Insular World of Boarding School",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Carla Hayden Takes Charge of the World’s Largest Library",
    'file' => td_global::$get_template_directory . '/includes/demos/church/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_10_id),
    'featured_image_td_id' => 'td_pic_3'
));
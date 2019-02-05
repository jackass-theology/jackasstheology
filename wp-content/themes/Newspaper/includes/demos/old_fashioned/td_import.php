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



/*  ----------------------------------------------------------------------------
    logo
 */
td_demo_misc::update_logo(array(
    'normal' => 'td_logo_header',
    'retina' => 'td_logo_header_retina',
));


//footer
td_demo_misc::update_footer_logo(array(
    'normal' => 'td_logo_footer',
    'retina' => 'td_logo_footer_retina'
));

/*  ----------------------------------------------------------------------------
    footer text
 */
td_demo_misc::update_footer_text('Newspaper is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.');


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
td_demo_misc::add_ad_image('custom_ad_1', 'td_custom_ad_1');
td_demo_misc::add_ad_image('custom_ad_2', 'td_custom_ad_2');
td_demo_misc::add_ad_image('custom_ad_3', 'td_custom_ad_3');


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '',
        'spot_id' => 'custom_ad_3'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_9_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Popular articles',
        'limit' => '4',
        'header_color' => ''
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_social_counter_widget',
    array (
        'custom_title'  => "",
        'facebook'      => "tagdiv",
        'twitter'     => "tagDivOfficial",
        'youtube'       => "tagdiv",
        'style'         => "style7 td-social-boxed"
    )
);

//footer 1 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-1');

//footer 2 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::add_widget_to_sidebar('footer-2', 'td_block_instagram_widget',
    array (
        'custom_title'  => "",
        'instagram_id'  => "old_ny_photos",
        'instagram_images_per_row' => 4,
        'instagram_number_of_rows' => 2,
        'instagram_margin' => 2,
    )
);

//footer 3 sidebar
td_demo_widgets::remove_widgets_from_sidebar('footer-3');
td_demo_widgets::add_widget_to_sidebar('footer-3', 'td_block_popular_categories_widget',
    array (
        'custom_title' => "Popular categories",
        'limit' => 6,
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
    $demo_cat_2_id =td_demo_category::add_category(array(
        'category_name' => 'Mainland',
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
        'category_name' => 'World news',
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
        'category_name' => 'Technology',
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
        'category_name' => 'Science',
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
    'category_name' => 'Art',
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
    'category_name' => 'Period photos',
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
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/homepage.txt',
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
    'title' => 'News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));


// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Art',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));

// add a category to the menu
td_demo_menus::add_category(array(
    'title' => 'Period photos',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));


/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'Arrested Alchemist Must Make Gold To Win Freedom',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Lindbergh Takes Off On Transatlantic Flight',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Printer Invents Typewriting Machine',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Churchill Expects Trouble from Nazis',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Unpacking the head of the Statue of Liberty',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));


//  ----------------------------------------------------------------------------




//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Engineers Detonate Huge Blast In New York",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Ferry Boatman Challenges Steamboat Monopoly',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Liberty on the Barricades",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Dictionary Project Falls Behind Schedule",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Astronomer Reports Explosions on Sun",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Animals being used as part of medical therapy',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Alamo Falls, Texas Army Retreats",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Charles Babbage Invents Mechanical Calculator",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "On the road to Falco, near Palermo, Sicily",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => 'Stage Actor Charlie Chaplin Tries Making Movies',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Earth May Revolve Around Sun",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Convict chain gang and prison guard in Georgia",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Pinkerton Suspects Socialite of Espionage",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "English Gentleman Invents Photography",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'The Syndics, by Rembrandt van Rijn',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Space Chimp Posing After a Mission To Space",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Steam Power Moves Ancient Monument",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "The Real Winnie the Pooh and Christopher Robin",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Professor Organizes Bus Boycott',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Professor W.C. Röntgen Discovers X-Rays",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Square Of The Capitolino Museum",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_2'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Robert Bruce Claims Crown of Scotland",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Anesthesia Makes Surgery Painless',
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Paine Urges Americans To Declare Independence",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Chester Carlson Invents Machine To Copy Documents",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Weather Warning May Delay Invasion",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Ancient Ruins Of Karnak Temple In Egypt",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Inventors Wage Patent War",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Emperor of Ethiopia Battles Italian Army",
    'file' => td_global::$get_template_directory . '/includes/demos/old_fashioned/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_10'
));
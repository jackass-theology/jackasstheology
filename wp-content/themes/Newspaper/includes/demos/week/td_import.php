<?php
/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');

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
td_demo_misc::update_background_mobile('td_pic_1');

// login background
td_demo_misc::update_background_login('td_pic_2');

/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => '',
    'retina' => '',
    'mobile' => ''
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
td_demo_misc::add_ad_image('custom_ad_1', 'td_city_rec_1');
td_demo_misc::add_ad_image('custom_ad_2', 'td_city_rec_2');


/*  ----------------------------------------------------------------------------
    sidebars
 */
//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');

//remove footer widgets > remove existing widgets from footer widgets areas
td_demo_widgets::remove_widgets_from_sidebar('footer-1');
td_demo_widgets::remove_widgets_from_sidebar('footer-2');
td_demo_widgets::remove_widgets_from_sidebar('footer-3');

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '- Advertisment -',
        'spot_id' => 'custom_ad_2'
    )
);

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_7_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => '',
        'limit' => '5',
        'header_color' => ''
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Community',
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
    'category_name' => 'Faith',
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
    'category_name' => 'Healthcare',
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
    'category_name' => 'Opinions',
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
    'category_name' => 'Racism',
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
    'category_name' => 'Business',
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
$demo_cat_8_id =td_demo_category::add_category(array(
    'category_name' => 'Careers',
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
    'category_name' => 'Education',
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
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/homepage.txt',
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
    'title' => 'Community',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Business',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));

td_demo_menus::add_mega_menu(array(
    'title' => 'Lifestyle',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));

// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Careers',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id,
    'parent_id' => $parent_submenu_id
));

td_demo_menus::add_category(array(
    'title' => 'Education',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_9_id,
    'parent_id' => $parent_submenu_id
));


/*  ---------------------------------------------------------------------------
    posts
*/

// posts in multiple categories
td_demo_content::add_post(array(
    'title' => 'The Silent War of African American Women Starting their Careers',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Discover Just How Black Women are Taking Care of Business',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Talented Nigerian Artist is Trying to Reduce Global Pollutions',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Young Architects Fight to Save Historic Building from Developers',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'This Connecticut Bill Would Make Famillies a Lot More Happier',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Black Lives Matter Activists Turn Attention to Statehouses',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Trump Eases Emigration Rules Intended to Help Civilians in the US',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'King Daughter Says Her Mother’s Papers Should Be Published',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'Meningitis Cases Soar in the Latest Outbreak with 324 Killedr',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Maria Jackson Gives Large Bags With Essentials to the Poor in New York',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_10'
));

/* ------------------------------------------------------------------ */
// posts in one category
/* ------------------------------------------------------------------ */


td_demo_content::add_post(array(
    'title' => 'Artist Creates Haunting Ode To Black Women Who Have Gone Missing',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Please Stop Asking this Woman to Record Your Voice Messages',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'At-home Massage Service for Women of Color is Changing The Game',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'King Daughter Says Her Mother’s Papers Should Be Published',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Great News: Black Owned Businesses Thrive in the Inland Region',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Proposed Tax on Services Could Hurt Small Business Ownerse',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Former Convict Creates Day Care Business in Los Angeles',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => '1st Detroit Startup Week Helps Black Business Entrepreneurs',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'This Young Man Will Be Sworn-In as Trump’s Only Black Choice',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Vast New Online Archive of African American History Materials',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Tale of Africa’s First Black Doctor Bound for the Big Screen',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'New Documentary Examines History of African American Speech',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_3'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Applauds for NYC Mayor’s Pledge To Close Rikers Island Prison',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Community Celebrates Black Woman after Successful Transplant',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Lawmakers to Host Meeting in Town Hall on Missing Black Girls',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Trump Eases Emigration Rules Intended to Help Civilians in the US',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Courage: A Black Woman Just Sued Fox News for Racial Discrimination',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'New Film Shows a Real Representation of American Racist Practices',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_9'
));

td_demo_content::add_post(array(
    'title' => 'Today, Civil Rights Leaders Meet with Attorney General Jeff Sessions',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Man Accused of Stabbing Black New Yorker is Charged With Terrorism',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Obama is Holed Up Writing His Book On a South Pacific Island',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'The Subtle Ways Landlords Try to Keep Out Transgender Renters',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Woman Loves Costco so Much, She Made it Her Birthday Party Theme',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'A Gay Gymnast’s Struggle To Come Out To His College Coach',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_5'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Uninsured Blacks Eligible for More Aid under Affordable Care Act',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Saving Hearts and Lives in the African-American Community',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'Ladies Combat Health Issues in Black Community with Screenings',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'House Leaders Came up Short in their Effort to Kill Obamacare',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

/* ------------------------------------------------------------------ */

td_demo_content::add_post(array(
    'title' => 'Muslim Organizations Plan to Rebuild Old and Torched Black Churches',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => 'Plan Your Trip so You Can Celebrate Easter in This Historic Church',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Donors Raise Over $200,000 for Historic Black Church in Mississippi',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Gospel Legend Shirley Caesar’s Viral Leads to New Fame, More Charity',
    'file' => td_global::$get_template_directory . '/includes/demos/week/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_3'
));
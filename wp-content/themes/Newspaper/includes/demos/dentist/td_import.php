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
$td_demo_top_menu = td_demo_menus::create_menu('td-demo-top-menu', 'top-menu');
td_demo_menus::add_link(array(
    'title' => '<i class="tds-icon tdc-font-tdmp tdc-font-tdmp-location"></i>Pasadena 100369, United States',
    'add_to_menu_id' => $td_demo_top_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => '<i class="tds-icon tdc-font-tdmp tdc-font-tdmp-envelope-open"></i>office@dentalstud.io',
    'add_to_menu_id' => $td_demo_top_menu,
    'url' => '#',
    'parent_id' => ''
));


//footer menu


/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');

// mobile background
td_demo_misc::update_background_mobile('td_pic_9');

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
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'googleplus' => '#',
    'linkedin' => '#',
    'twitter' => '#',
));

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
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'homepage' => true
));

//contact page
$td_contactpage_id = td_demo_content::add_page(array(
    'title' => 'Contact',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/contact.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//gallery page
$td_gallerypage_id = td_demo_content::add_page(array(
    'title' => 'Gallery',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/gallery.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

//footer page
$td_footerpage_id = td_demo_content::add_page(array(
    'title' => 'Footer',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/footer.txt',
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

$url = site_url();

td_demo_menus::add_link(array(
    'title' => '<span data-scroll-target="' . $url . '" data-scroll-to-class="td-services" data-scroll-offset="-100">Services</span>',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_link(array(
    'title' => '<span data-scroll-target="' . $url . '" data-scroll-to-class="td-team" data-scroll-offset="-50">Team</span>',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_link(array(
    'title' => '<span data-scroll-target="' . $url . '" data-scroll-to-class="td-blog-section" data-scroll-offset="-50">Blog</span>',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_link(array(
    'title' => '<span data-scroll-target="' . $url . '" data-scroll-to-class="td-gallery-section" data-scroll-offset="-100">Gallery</span>',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
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
    'title' => 'What You Need to Know About Your Wisdom Teeth',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_1'
));

td_demo_content::add_post(array(
    'title' => 'Many Things You Can Do to Prevent Tooth Loss',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_2'
));

td_demo_content::add_post(array(
    'title' => 'Why Dental Implants are Growing in Popularity',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_3'
));

td_demo_content::add_post(array(
    'title' => 'Why Is Good Dental Equipment so Important',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_4'
));

td_demo_content::add_post(array(
    'title' => 'Your Children Can Brush and Floss With Pleasure',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_5'
));

td_demo_content::add_post(array(
    'title' => 'Know About the Signs of Cavity Formation',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));

td_demo_content::add_post(array(
    'title' => 'Braces vs Invisible Braces – What is the Difference?',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_7'
));

td_demo_content::add_post(array(
    'title' => 'How to Save Your Child’s Smile with Cosmetic Dentistry',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_8'
));

td_demo_content::add_post(array(
    'title' => 'What Can You Do to Promote Good Dental Health',
    'file' => td_global::$get_template_directory . '/includes/demos/dentist/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_9'
));
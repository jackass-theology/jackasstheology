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
    'mobile' => 'td_logo_mobile'
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




/*  ---------------------------------------------------------------------------
    categories
*/


/*  ----------------------------------------------------------------------------
    pages
 */
//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/ink/pages/home.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//themes page
$td_artistspage_id = td_demo_content::add_page(array(
    'title' => 'The artists',
    'file' => td_global::$get_template_directory . '/includes/demos/ink/pages/the-artists.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//about page
$td_shoppage_id = td_demo_content::add_page(array(
    'title' => 'The shop',
    'file' => td_global::$get_template_directory . '/includes/demos/ink/pages/the-shop.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//contact page
$td_bookingpage_id = td_demo_content::add_page(array(
    'title' => 'Booking',
    'file' => td_global::$get_template_directory . '/includes/demos/ink/pages/booking.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/ink/pages/footer-template.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
td_util::update_option( 'tds_footer_page', $td_footertemplate_id);

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
//add the menu page to the menu
td_demo_menus::add_page(array(
    'title' => 'The artists',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_artistspage_id,
    'parent_id' => ''
));
//add the blog page to the menu
td_demo_menus::add_page(array(
    'title' => 'The shop',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_shoppage_id,
    'parent_id' => ''
));
//add the blog page to the menu
td_demo_menus::add_page(array(
    'title' => 'Booking',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_bookingpage_id,
    'parent_id' => ''
));


/*  ---------------------------------------------------------------------------
    posts
*/
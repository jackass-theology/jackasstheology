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
td_demo_misc::update_background('concrete-texture', false);
// mobile background
td_demo_misc::update_background_mobile('project1');


/*  ----------------------------------------------------------------------------
    logo
*/
td_demo_misc::update_logo(array(
    'normal' => 'logo',
    'retina' => 'logo@2x',
    'mobile' => ''
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


// add pages
$td_homepage_page = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => td_global::$get_template_directory . '/includes/demos/construction/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => true
));
$td_about_page = td_demo_content::add_page(array(
    'title' => 'About',
    'file' => td_global::$get_template_directory . '/includes/demos/construction/pages/about.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_services_page = td_demo_content::add_page(array(
    'title' => 'Services',
    'file' => td_global::$get_template_directory . '/includes/demos/construction/pages/services.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_projects_page = td_demo_content::add_page(array(
    'title' => 'Projects',
    'file' => td_global::$get_template_directory . '/includes/demos/construction/pages/projects.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
$td_contact_page = td_demo_content::add_page(array(
    'title' => 'Contact',
    'file' => td_global::$get_template_directory . '/includes/demos/construction/pages/contact.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => '',
    'homepage' => false
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => td_global::$get_template_directory . '/includes/demos/construction/pages/footer-template.txt',
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
    'title' => 'About',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_about_page,
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Services',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_services_page,
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Projects',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_projects_page,
    'parent_id' => ''
));
td_demo_menus::add_page(array(
    'title' => 'Contact',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_contact_page,
    'parent_id' => ''
));
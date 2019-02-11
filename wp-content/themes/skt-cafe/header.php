<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Cafe
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--HEADER STARTS-->
<?php 
	$contact_no = get_theme_mod('contact_no'); 
	$contact_top_address = get_theme_mod('contact_top_address'); 
	$hidetopbar = get_theme_mod('hide_header_topbar', 1);
if( $hidetopbar == '') { ?>
<div class="head-info-area">
<div class="center">
<div class="left">
	        <?php if(!empty($contact_top_address)){?>
		 <span class="phntp">
          <span class="phoneno"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon-address.png" alt="" /> 
          <?php echo esc_html($contact_top_address); ?></span>
        </span>
        <?php } ?> 
</div> 
		<?php if(!empty($contact_no)){?>
		<div class="right">
        	<span class="emltp">
			<?php echo esc_html($contact_no); ?>
            </span>
            </div>
        <?php } ?> 
<div class="clear"></div>                
</div>
</div>
<?php } ?>
<!--HEADER ENDS-->
<div class="header">
  <div class="container">
    <div class="logo">
		<?php skt_cafe_the_custom_logo(); ?>
        <div class="clear"></div>
		<?php	
        $description = get_bloginfo( 'description', 'display' );
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <h2 class="site-title"><?php bloginfo('name'); ?></h2>
        <?php if ( $description || is_customize_preview() ) :?>
        <p class="site-description"><?php echo esc_html($description); ?></p>                          
        <?php endif; ?>
        </a>
    </div>
         <div class="toggle"><a class="toggleMenu" href="#" style="display:none;"><?php esc_attr_e('Menu','skt-cafe'); ?></a></div> 
        <div class="sitenav">
          <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>         
        </div><!-- .sitenav--> 
        <div class="clear"></div> 
  </div> <!-- container -->
</div><!--.header -->
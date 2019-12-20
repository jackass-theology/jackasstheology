<?php
/*  Copyright 2013-2019 Renzo Johnson (email: renzojohnson at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/



function mce_author() {

	$author_pre = 'Contact form 7 Mailchimp extension by ';
	$author_name = 'Renzo Johnson';
	$author_url = '//renzojohnson.com';
	$author_title = 'Renzo Johnson - Web Developer';

	$mce_author = '<p style="display: none !important">';
  $mce_author .= $author_pre;
  $mce_author .= '<a href="'.$author_url.'" ';
  $mce_author .= 'title="'.$author_title.'" ';
  $mce_author .= 'target="_blank">';
  $mce_author .= ''.$author_title.'';
  $mce_author .= '</a>';
  $mce_author .= '</p>'. "\n";

  return $mce_author;
}



function mce_referer() {

  // $mce_referer_url = $THE_REFER=strval(isset($_SERVER['HTTP_REFERER']));

  if(isset($_SERVER['HTTP_REFERER'])) {

    $mce_referer_url = $_SERVER['HTTP_REFERER'];

  } else {

    $mce_referer_url = 'direct visit';

  }

	$mce_referer = '<p style="display: none !important"><span class="wpcf7-form-control-wrap referer-page">';
  $mce_referer .= '<input type="hidden" name="referer-page" ';
  $mce_referer .= 'value="'.$mce_referer_url.'" ';
  $mce_referer .= 'class="wpcf7-form-control wpcf7-text referer-page" aria-invalid="false">';
  $mce_referer .= '</span></p>'. "\n";

  return $mce_referer;
}



function mce_getRefererPage( $form_tag ) {

  if ( $form_tag['name'] == 'referer-page' ) {

    $form_tag['values'][] = $_SERVER['HTTP_REFERER'];

  }

  return $form_tag;

}



if ( !is_admin() ) {

  add_filter( 'wpcf7_form_tag', 'mce_getRefererPage' );

}

add_action( 'init', 'mce_init_constants' );
function mce_init_constants(){

  define( 'MCE_URL', '//renzojohnson.com/contributions/contact-form-7-mailchimp-extension' );
  define( 'MCE_AUTH', '//renzojohnson.com' );
  define( 'MCE_AUTH_COMM', '<!-- campaignmonitor extension by Renzo Johnson -->' );
  define( 'MCE_NAME', 'MailChimp Contact Form 7 Extension' );
  define( 'MCE_SETT', admin_url( 'admin.php?page=wpcf7' ) );
  define( 'MCE_DON', 'https://www.paypal.me/renzojohnson' );

}


function mc_get_latest_item(){
    $args = array(
            'post_type'         => 'wpcf7_contact_form',
            'posts_per_page'    => -1,
            'fields'            => 'ids',
        );

    $form = 0 ;
    if ( class_exists( 'WPCF7') ) {
       $maxpost =  get_posts($args)  ;
       $form = ( count ( $maxpost ) == 0  ) ? 0 : max( $maxpost ) ;
    }

    //$form = ( class_exists( 'WPCF7') ? max( get_posts($args) ) : 0 ) ;
    $out = '';
    if (!empty($form)) {
        $out .= $form;
    }
    return $out;
}


function wpcf7_form_mce_tags() {
  $manager = class_exists('WPCF7_FormTagsManager') ? WPCF7_FormTagsManager::get_instance() : WPCF7_ShortcodeManager::get_instance(); // ff cf7 46. and earlier
  $form_tags = $manager->get_scanned_tags();
  return $form_tags;
}


function mce_mail_tags() {

  $listatags = wpcf7_form_mce_tags();
  $tag_submit = array_pop($listatags);
  $tagInfo = '';

    foreach($listatags as $tag){

      $tagInfo .= '<span class="mailtag code used">[' . $tag['name'].']</span>';

    }

  return $tagInfo;

}

function wpcf7_mce_ga_pageview () {
   global $wpdb;

   $utms  = '?utm_source=MailChimp';
   $utms .= '&utm_campaign=w' . get_bloginfo( 'version' ) . '-' . mce_difer_dateact_date() . 'c' . WPCF7_VERSION . ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) . '';
  $utms .= '&utm_medium=cme-' . SPARTAN_MCE_VERSION . '';
  $utms .= '&utm_term=F' . ini_get( 'allow_url_fopen' ) . 'C' . ( function_exists( 'curl_init' ) ? '1' : '0' ) . 'P' . PHP_VERSION . 'S' .  $wpdb->db_version() . '';

  $varurl = MCE_URL .$utms.'activated'; // all is url
  $varurl = str_replace ( ' ','',$varurl  ) ;

  //var_dump  ( $varurl  ) ;

  return vc_ga_send_pageview ('renzojohnson.com',$varurl,'Activated') ;

}

function plugin_activation( $plugin ) {
    if( ! function_exists('activate_plugin') ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    if( ! is_plugin_active( $plugin ) ) {
        activate_plugin( $plugin );
    }
}



if (!function_exists('chimpmatic_tags')) {
  function chimpmatic_tags( $output, $name, $html ) {

    if ( '_domain' == $name ) {
      $output = chimpmatic_domain();
    }

    if ( '_formID' == $name ) {
      $output = chimpmatic_form_id();
    }


    return $output;

  }
}
add_filter( 'wpcf7_special_mail_tags', 'chimpmatic_tags', 10, 3 );


if (!function_exists('chimpmatic_add_form_tag_posts')) {
  function chimpmatic_add_form_tag_posts() {

    wpcf7_add_form_tag('_domain', 'chimpmatic_domain');
    wpcf7_add_form_tag('_formID', 'chimpmatic_form_id');

  }
}
add_action('wpcf7_init', 'chimpmatic_add_form_tag_posts', 11);


if (!function_exists('chimpmatic_domain')) {
  function chimpmatic_domain() {

    $strToLower       = strtolower(trim( get_home_url() ));
    $httpPregReplace  = preg_replace('/^http:\/\//i', '', $strToLower);
    $httpsPregReplace = preg_replace('/^https:\/\//i', '', $httpPregReplace);
    $wwwPregReplace   = preg_replace('/^www\./i', '', $httpsPregReplace);
    $explodeToArray   = explode('/', $wwwPregReplace);
    $finalDomainName  = trim($explodeToArray[0]);

    return $finalDomainName;

  }
}


if (!function_exists('chimpmatic_form_id')) {
  function chimpmatic_form_id() {

    $wpcf7 = WPCF7_ContactForm::get_current();
    $res = $wpcf7->id();

    return $res;

  }
}
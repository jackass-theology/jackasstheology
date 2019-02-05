<?php
/*  Copyright 2013-2017 Renzo Johnson (email: renzojohnson at gmail.com)

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

    *1: By default the key label for the name must be FNAME
    *2: parse first & last name
    *3: ensure we set first and last name exist
    *4: otherwise user provided just one name
    *5: By default the key label for the name must be FNAME
    *6: check if subscribed
    *bh: email_type
    *aw: double_optin
    *xz: update_existing
    *rd: replace_interests
    *gr: send_welcome
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
  define( 'MCE_SETT', admin_url( 'admin.php?page=wpcf7&post='.mc_get_latest_item().'&active-tab=4' ) );
  define( 'MCE_DON', 'https://www.paypal.me/renzojohnson' );

}


function mc_get_latest_item(){
    $args = array(
            'post_type'         => 'wpcf7_contact_form',
            'posts_per_page'    => -1,
            'fields'            => 'ids',
        );
    // Get Highest Value from CF7Forms
    $form = max(get_posts($args));
    $out = '';
    if (!empty($form)) {
        $out .= $form;
    }
    return $out;
}


function wpcf7_form_mce_tags() {
  // $manager = WPCF7_FormTagsManager::get_instance();
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





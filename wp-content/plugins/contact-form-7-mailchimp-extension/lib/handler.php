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

$plugins = get_option('active_plugins');
$plugchimpmail ='chimpmail/chimpmail.php';

if ( in_array( $plugchimpmail , $plugins ) ) {
    //do_action( 'ep_before_list',$panels);
}else {
  add_filter( 'wpcf7_editor_panels', 'show_mch_metabox' );
  add_action( 'wpcf7_after_save', 'wpcf7_mch_save_mailchimp' );
  add_filter('wpcf7_form_response_output', 'spartan_mce_author_wpcf7', 40,4);
  add_action( 'wpcf7_before_send_mail', 'wpcf7_mch_subscribe_remote' );
  add_filter( 'wpcf7_form_class_attr', 'spartan_mce_class_attr' );
}


function wpcf7_mch_add_mailchimp($args) {

	if ( function_exists ( "wpcf7_chimp_add_mailchimp" ) )
      return ;

  $host = esc_url_raw( $_SERVER['HTTP_HOST'] );
  $url = $_SERVER['REQUEST_URI'];
  $urlactual = $url;

  $cf7_mch_defaults = array();
  $cf7_mch = get_option( 'cf7_mch_'.$args->id(), $cf7_mch_defaults );

  $mce_txcomodin = $args->id() ;
  $listatags = wpcf7_mce_form_tags();

  if ( ( ! isset( $cf7_mch['listatags'] ) ) or is_null( $cf7_mch['listatags'] ) ) {
      unset( $cf7_mch['listatags'] );
      $cf7_mch = $cf7_mch + array( 'listatags' => $listatags ) ;
      update_option( 'cf7_mch_'.$args->id(), $cf7_mch );
  }

  $logfileEnabled = ( isset( $cf7_mch['logfileEnabled'] ) ) ? $cf7_mch['logfileEnabled']  : 0 ;

  $mceapi = ( isset( $cf7_mch['api'] )   ) ? $cf7_mch['api'] : null ;

  //$tmp = wpcf7_mce_validate_api_key( $mceapi,$logfileEnabled,'cf7_mch_'.$mce_txcomodin );
	$apivalid = ( isset( $cf7_mch['api-validation'] )   ) ? $cf7_mch['api-validation'] : null ;

	//$tmp = wpcf7_mce_listasasociadas( $mceapi,$logfileEnabled,'cf7_mch_'.$mce_txcomodin,$apivalid );
	$listdata = ( isset( $cf7_mch['lisdata'] )   ) ? $cf7_mch['lisdata'] : null ;

  $chm_valid = '<span class="chmm valid"><span class="dashicons dashicons-yes"></span>API Key</span>';
  $chm_invalid = '<span class="chmm invalid"><span class="dashicons dashicons-no"></span>API Key</span>';

  include SPARTAN_MCE_PLUGIN_DIR . '/lib/view.php';

}


function wpcf7_mch_save_mailchimp($args) {
	 if ( function_exists ( "wpcf7_chimp_save_mailchimp" ) )
      return ;


  if (!empty($_POST)){


		$default = array () ;
		$cf7_mch = get_option ( 'cf7_mch_'.$args->id(), $default  ) ;

		$apivalid = ( isset( $cf7_mch['api-validation'] ) ) ? $cf7_mch['api-validation'] : 0   ;
		$listdata = ( isset( $cf7_mch['lisdata'] ) ) ? $cf7_mch['lisdata'] : 0   ;

		$globalarray = $_POST['wpcf7-mailchimp'] ;

		if ( !isset( $_POST['wpcf7-mailchimp']['api-validation'] ) )
				$globalarray += array ('api-validation' => $apivalid  ) ;

		if ( !isset( $_POST['wpcf7-mailchimp']['lisdata'] )  ) {
				$globalarray += array ('lisdata' => $listdata  ) ;
		}

    update_option( 'cf7_mch_'.$args->id(), $globalarray );

  }

}


function show_mch_metabox ( $panels ) {

  $new_page = array(
    'MailChimp-Extension' => array(
      'title' => __( 'ChimpMatic Lite', 'contact-form-7' ),
      'callback' => 'wpcf7_mch_add_mailchimp'
    )
  );

  $panels = array_merge($panels, $new_page);

  return $panels;

}



function spartan_mce_author_wpcf7( $mce_supps, $class, $content, $args ) {

  $cf7_mch_defaults = array();
  $cf7_mch = get_option( 'cf7_mch_'.$args->id(), $cf7_mch_defaults );
  $cfsupp = ( isset( $cf7_mch['cf-supp'] ) ) ? $cf7_mch['cf-supp'] : 0;

  if ( 1 == $cfsupp ) {

    $mce_supps .= mce_referer();
    $mce_supps .= mce_author();

  } else {

    $mce_supps .= mce_referer();
    $mce_supps .= '<!-- Chimpmail extension by Renzo Johnson -->';
  }
  return $mce_supps;

}


function cf7_mch_tag_replace( $pattern, $subject, $posted_data, $html = false ) {

  if( preg_match($pattern,$subject,$matches) > 0) {

    if ( isset( $posted_data[$matches[1]] ) ) {
      $submitted = $posted_data[$matches[1]];

      if ( is_array( $submitted ) )
        $replaced = join( ', ', $submitted );
      else
        $replaced = $submitted;

      if ( $html ) {
        $replaced = strip_tags( $replaced );
        $replaced = wptexturize( $replaced );
      }

      $replaced = apply_filters( 'wpcf7_mail_tag_replaced', $replaced, $submitted,'','' );

      return stripslashes( $replaced );
    }

    if ( $special = apply_filters( 'wpcf7_special_mail_tags', '', $matches[1],'' ))
      return $special;

    return $matches[0];
  }
  return $subject;

}


function wpcf7_mch_subscribe_remote($obj) {
  if ( function_exists ( "wpcf7_chimp_subscribe" ) )
      return ;

  $cf7_mch = get_option( 'cf7_mch_'.$obj->id() );
	$idform = 'cf7_mch_'.$obj->id() ;

	if ( $cf7_mch['api-validation'] != 1 )
		 return ;

  $submission = WPCF7_Submission::get_instance();

  $logfileEnabled = isset($cf7_mch['logfileEnabled']) && !is_null($cf7_mch['logfileEnabled']) ? $cf7_mch['logfileEnabled'] : false;


  if( $cf7_mch ) {
    $subscribe = false;

    $regex = '/\[\s*([a-zA-Z_][0-9a-zA-Z:._-]*)\s*\]/';
    $callback = array( &$obj, 'cf7_mch_callback' );

    $email = cf7_mch_tag_replace( $regex, $cf7_mch['email'], $submission->get_posted_data() );
    $name = cf7_mch_tag_replace( $regex, $cf7_mch['name'], $submission->get_posted_data() );

    $lists = cf7_mch_tag_replace( $regex, $cf7_mch['list'], $submission->get_posted_data() );
    $listarr = explode(',',$lists);

    $merge_vars=array('FNAME'=>$name);// *x1

        // *x2
        $parts = explode(" ", $name);
        if(count($parts)>1) { // *x3

          $lastname = array_pop($parts);
          $firstname = implode(" ", $parts);
          $merge_vars=array('FNAME'=>$firstname, 'LNAME'=>$lastname);

        } else { // *x4

          $merge_vars=array('FNAME'=>$name);// *x5

        }


    for($i=1;$i<=20;$i++){

      if( isset($cf7_mch['CustomKey'.$i]) && isset($cf7_mch['CustomValue'.$i]) && strlen(trim($cf7_mch['CustomValue'.$i])) != 0 ) {

        $CustomFields[] = array('Key'=>trim($cf7_mch['CustomKey'.$i]), 'Value'=>cf7_mch_tag_replace( $regex, trim($cf7_mch['CustomValue'.$i]), $submission->get_posted_data() ) );
        $NameField=trim($cf7_mch['CustomKey'.$i]);
        $NameField=strtr($NameField, "[", "");
        $NameField=strtr($NameField, "]", "");
        $merge_vars=$merge_vars + array($NameField=>cf7_mch_tag_replace( $regex, trim($cf7_mch['CustomValue'.$i]), $submission->get_posted_data() ) );
      }

    }

    $mce_csu = 'subscribed';

    if( isset($cf7_mch['confsubs']) && strlen($cf7_mch['confsubs']) != 0 ) {

      if ( isset($cf7_mch['accept']) && strlen($cf7_mch['accept']) != 0 ) {
           $accept = cf7_mch_tag_replace( $regex, trim( $cf7_mch['accept'] ) , $submission->get_posted_data() );
         if ( strlen( trim($accept) ) != 0  ) {
            $mce_csu = 'pending';
         } else {
            $mce_csu = 'unsubscribed';
         }
      } else $mce_csu = 'pending';

    } else {

       if ( isset($cf7_mch['accept']) && strlen($cf7_mch['accept']) != 0 ) {
           $accept = cf7_mch_tag_replace( $regex, trim( $cf7_mch['accept'] ) , $submission->get_posted_data() );
         if ( strlen( trim($accept) ) != 0  ) {
            $mce_csu = 'subscribed';
         } else {
            $mce_csu = 'unsubscribed';
         }
      } else $mce_csu = 'subscribed';

    }

      try {

        $cad_mergefields = "";
        $cuentarray = count($merge_vars);

        //Armando mergerfields
        foreach($merge_vars as $clave=>$valor) {
            $cadvar= '"'.$clave.'":"' .$valor. '", ';
            $cad_mergefields = $cad_mergefields . $cadvar ;
        }

        $cad_mergefields = substr($cad_mergefields,0,strlen($cad_mergefields) -2);


        // rj tests
        // ================================================================
        $api   = $cf7_mch['api'];
        $dc    = explode( "-", $api );
        $urlmcv3 = "https://anystring:$dc[0]@$dc[1].api.mailchimp.com/3.0";
        $list  = $lists;
        $vc_date = date( 'Md.H:i' );
        $vc_user_agent = '.' . SPARTAN_MCE_VERSION . '.' . strtolower( $vc_date );  // rj
        $vc_headers = array( "Content-Type" => "application/json" ) ;


        // 1
        // ================================================================
        $url_get_merge_fields = "$urlmcv3/lists/$list/merge-fields";  //// $urlmcv3
        $opts = array(
                  'headers' => $vc_headers,
                  'user-agent' => 'mce-r' . $vc_user_agent
                );

        $mergerfield = wp_remote_get( $url_get_merge_fields, $opts );
        $resultbody = wp_remote_retrieve_body( $mergerfield );
        $arraymerger = json_decode( $resultbody, True );

        $campreque = array_column($arraymerger['merge_fields'],'required','merge_id'); // arr de req campos

          foreach($campreque as $clave=>$valor) {

              if ($valor) {
                  $cadreq = '{"required":false}';
                  $url_edit   = "$urlmcv3/lists/$list/merge-fields/$clave"; //// $urlmcv3

                  $opts = array(
                            'method' => 'PATCH',
                            'headers' => $vc_headers,
                            'body' => $cadreq,
                            'user-agent' => 'mce-h' . $vc_user_agent
                          );

                  $resptres = wp_remote_post( $url_edit, $opts );

              }

          }


        // 2
        // ================================================================
        $url_put   = "$urlmcv3/lists/$list";  //// $urlmcv3
        $info  = '{"members": [

                    { "email_address": "'.$email.'",
                      "status": "'.$mce_csu.'",
                      "merge_fields":{ '.$cad_mergefields.' }
                    }

                  ],
                  "update_existing": true}';

        $opts = array(
                  'method' => 'POST',
                  'headers' => $vc_headers,
                  'body' => $info,
                  'user-agent' => 'mce-p' . $vc_user_agent
                );

        $respenvio = wp_remote_post( $url_put, $opts );
        $resp = wp_remote_retrieve_body( $respenvio );

        mce_save_contador();


				$chimp_db_log = new chimp_db_log( 'mce_db_issues',  $logfileEnabled,'api',$idform );

				$chimp_db_log->chimp_log_insert_db(1, 'Subscribe Response: ' , $resp  );

      } // end try

      catch (Exception $e) {

				$chimp_db_log = new chimp_db_log( 'mce_db_issues' , $logfileEnabled,'api',$idform );
				$chimp_db_log->chimp_log_insert_db(4, 'Contact Form 7 response: Try Catch  ' . $e->getMessage()  , $e  );

      }  // end catch
  }
}

function mce_save_contador() {
  $option_name = 'mce_sent' ;
  $new_value = 1 ;
  $valorvar = get_option( $option_name );

  if ( $valorvar !== false ) {

    update_option( $option_name, $valorvar + 1 );

  } else {

    $deprecated = null;
    $autoload = 'no';
    add_option( $option_name, $new_value, $deprecated, $autoload );

  }

}

function mce_get_contador() {
  $option_name = 'mce_sent' ;
  $new_value = 1 ;

  $valorvar = get_option( $option_name );

  if ( $valorvar !== false ) {

    echo 'Contador: '.$valorvar;

  } else {
    echo 'Contador: 0' ;
  }
}

function spartan_mce_class_attr( $class ) {
  $class .= ' mailchimp-ext-' . SPARTAN_MCE_VERSION;
  return $class;

}

if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

function mce_set_welcomebanner() {
    $Defaultpanel = '<p class="about-description">Hello. My name is Renzo, I <span alt="f487" class="dashicons dashicons-heart red-icon"> </span> WordPress and I develop this free plugin to help users like you. I drink copious amounts of coffee to keep me running longer <span alt="f487" class="dashicons dashicons-smiley red-icon"> </span>. If you'. "'".'ve found this plugin useful, please consider making a donation.</p><br>
      <p class="about-description">Would you like to <a class="button-primary" href="http://bit.ly/cafe4renzo" target="_blank">buy me a coffee?</a> or <a class="button-primary" href="http://bit.ly/cafe4renzo" target="_blank">Donate with Paypal</a></p>' ;

   $banner = $Defaultpanel ;

   if ( get_site_option('mce_conten_panel_welcome') == null  ) {
      add_site_option( 'mce_conten_panel_welcome', $Defaultpanel ) ;
      $banner = $Defaultpanel ;
   }
    else  {
      $grabbanner = trim( get_site_option('mce_conten_panel_welcome') ) ;
      $banner = ( $grabbanner  == ''  ) ? $Defaultpanel : $grabbanner ;
    }

  return $banner ;

}


function mce_get_bannerladilla (&$check,&$tittle) {
    $check = 0 ;
    $response = wp_remote_get( 'https://renzojohnson.com/wp-json/wp/v2/posts?categories=16&orderby=modified&order=desc' );

    if ( is_wp_error( $response ) ) {
      $check = -1;
      return '' ;
    }

    $posts = json_decode( wp_remote_retrieve_body( $response ) );

    if ( empty( $posts ) or is_null ( $posts  ) ) {
        $check = -2;
		    return '' ;
	  }

    if ( $response["response"]["code"] != 200 ) {
      $check = -3;
		  return ''  ;
    }

	if ( ! empty( $posts ) ) {
		  foreach ( $posts as $post ) {
			    $fordate =  $post->modified  ;
        $tittle = $post->title->rendered ;
        return $post->content->rendered ;
		  }
	}
}


function mce_lateral_banner () {
  ?>
    <div id="informationdiv_aux" class="postbox mce-move mc-lateral" style="display:none">
      <?php echo mce_set_lateralbanner()  ?>
    </div>
<?php
}


function mce_set_lateralbanner() {
   $Defaultpanel = '<h3>ChimpMatic Pro is Here!</h3>
      <div class="inside">
        <p>We have the the best tool to integrate <b>Contact Form 7</b> & <b>Mailchimp.com</b> mailing lists. We have new nifty features:</p>
        <ol>
          <li><a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=Groups" target="_blank">Groups / Categories</a></li>
          <li><a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=UnlimitedFields" target="_blank">Unlimited Fields</a></li>
          <li><a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=UnlimitedAudiences" target="_blank">Unlimited Audiences</a></li>
          <li><a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=html-txt" target="_blank">Let visitors choose HTML or Plain text</a></li>
          <li><a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=sync" target="_blank">Sync WordPress Users</a></li>
          <li><a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=GreatPricing" target="_blank">Great Pricing Options</a></li>
        </ol>
        <p><a href="https://chimpmatic.com?utm_source=ChimpMatic&utm_campaign=LearnMore" class="dops-button is-primary" target="_blank">Learn More</a></p>
      </div>';

   $banner = $Defaultpanel ;
   //delete_site_option('mce_conten_panel_lateralbanner');

   if ( get_site_option('mce_conten_panel_lateralbanner') == null  ) {
      add_site_option( 'mce_conten_panel_lateralbanner', $Defaultpanel ) ;
      $banner = $Defaultpanel ;
   }
    else  {
      $grabbanner = trim( get_site_option('mce_conten_panel_lateralbanner') ) ;
      $banner = ( $grabbanner  == ''  ) ? $Defaultpanel : $grabbanner ;
    }

  return $banner ;

}


function mce_get_bannerlateral (&$check,&$tittle) {
    $check = 0 ;
    $response = wp_remote_get( 'https://renzojohnson.com/wp-json/wp/v2/posts?categories=17&orderby=modified&order=desc' );

    if ( is_wp_error( $response ) ) {
      $check = -1;
      return '' ;
    }

    $posts = json_decode( wp_remote_retrieve_body( $response ) );

    if ( empty( $posts ) or is_null ( $posts  ) ) {
        $check = -2;
		    return '' ;
	  }

   if ( $response["response"]["code"] != 200 ) {
      $check = -3;
		  return ''  ;
    }

	if ( ! empty( $posts ) ) {
		  foreach ( $posts as $post ) {
			    $fordate =  $post->modified  ;
        $tittle = $post->title->rendered ;
        return $post->content->rendered ;
		  }
	}
}


